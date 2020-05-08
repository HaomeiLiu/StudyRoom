<?php
    require "config/config.php";

    session_start();
    echo $_SESSION['user_id'];
    if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])){
        header("Location: http://localhost:8888/project/git_track/login.php");
        exit;
    }
    $user_id = (int) $_SESSION['user_id'];

    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ( $mysqli->connect_errno ) {
            echo $mysqli->connect_error;
            exit();
        }
    $mysqli->set_charset('utf8');

    // GET USER INFO
    $sql = "SELECT user_room_id, user_auth FROM users WHERE user_id = ". $user_id. ";";
    $results = $mysqli->query($sql);
    $row = $results->fetch_assoc();

    // room null, display join room
    $displayJoin = true;
    $auth = false;
    if(!isset($row['user_room_id']) || empty($row['user_room_id'])){
        $displayJoin = true;
    }
    else{
        if(isset($row['user_auth']) && !empty($row['user_auth'])){
            $auth = true;
        }
        $displayJoin = false;
        $room_id = $row['user_room_id'];
        // Load room info
        $sql = "SELECT * FROM studyroom WHERE studyroom_id = ". $room_id .";";
        $results = $mysqli->query($sql);
        $row = $results->fetch_assoc();
        $room_name = $row['studyroom_name'];
        $room_ann = $row['studyroom_ann'];
        $room_count = $row['studyroom_count'];
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>StudyRoom</title>
    <link rel="icon" href="images/icon.png">
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <script src="https://kit.fontawesome.com/6bbcae6afb.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style.css">
    <style>
        .room-container {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .room-info {
            width: 40%;
            background-color: #273469;
            margin: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            max-width: 600px;
        }

        .title-image {
            position: relative;
        }

        .room-info img {
            width: 100%;
            opacity: 0.5;
            border-radius: 15px 15px 0 0;
        }

        .room-info .title {
            position: absolute;
            bottom: 10%;
            left: 10%;
            color: #FAFAFF;
            font-family: font_curl;
            font-size: 60px;
        }

        .member-list {
            width: 40%;
            margin: 20px;
        }

        .room-info .info ul {
            margin-top: 20px;
        }

        .room-info .info li {
            color: #FAFAFF;
            font-family: font_norm;
        }

        .room-info .action {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .room-info .action button {
            color: #718cf7;
        }

        .member-list .list-group li {
            display: flex;
            flex-direction: row;
        }

        .member-list .list-group li .text {
            margin-left: 20px;
        }

        @media (max-width: 991px) {
            .room-info {
                width: 80%;
            }

            .member-list {
                width: 60%;
            }

            .room-info .title {
                bottom: 10%;
                left: 25%;
            }

            .room-container {
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }
        }

        @media (max-width: 767px) {
            .room-info .title {
                font-size: 40px;
            }
        }

        #info-space {
            height: 50px;
        }

        .not-visible {
            display: none;
        }

        .room-info .action {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .not-visible {
            display: none;
        }
    </style>
</head>

<body onload="startTime()">
    <nav class="navbar navbar-expand-md navbar-light navbar-offcanvas" style="background-color: #00000000;">
        <div class="container-fluid">
            <a class="navbar-brand" href="http://303.itpwebdev.com/~haomeili/assignment13/index.html"><img
                    src="./images/icon.png" width="60" height="60" class="d-inline-block align-top" alt="">
            </a>
            <a class="navbar-brand" href="http://303.itpwebdev.com/~haomeili/assignment13/index.html">StudyRoom</a>
            <ul class="navbar-nav navbar-top">
                <li class="nav-item">
                    <a class="nav-link" href="http://303.itpwebdev.com/~haomeili/assignment13/index.html">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="http://303.itpwebdev.com/~haomeili/assignment13/studyroom.html"><span
                            class="sr-only">(current)</span>StudyRoom</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://303.itpwebdev.com/~haomeili/assignment13/stats.html">Statistics</a>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right navbar-icon" type="button" data-toggle="collapse"
                data-target="#navbar-mobile" aria-controls="navbar-mobile" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="icon-bar bar1"></span>
                <span class="icon-bar bar2"></span>
                <span class="icon-bar bar3"></span>
            </button>
            <div class="navbar-collapse collapse ml-auto" id="navbar-mobile">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-image">
                        <img src="images/avatar_default.png" alt="">
                        <div class="nav-info">
                            User Name
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="#!" class="nav-link">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="#!" class="nav-link">Edit</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Time -->
    <div class="container-fluid" id="date">
    </div>
    <!-- Room Info -->
    <div class="container-fluid room-container">
        <div class="room-info">
            <div class="title-image">
                <img src="images/studyroom.jpg">
                <div class="title">StudyRoom Title</div>
            </div>
            <div class="info">
                <ul>
                    <li>Total Member: 3</li>
                    <li>Announcement: Null</li>
                </ul>
            </div>
            <div id="info-space"></div>
            <div class="action">
                <button type="button" class="btn">Exit StudyRoom</button>
                <button type="button super" class="btn">Manage StudyRoom</button>
            </div>
        </div>
        <!-- Member List -->
        <div class="member-list">
            <ul class="list-group">
                <li class="list-group-item active">
                    <img src="images/avatar_default.png" width="45" height="45">
                    <div class="text">
                        <h5>User Name</h5>
                        <small>User signiture</small>
                    </div>
                </li>
                <li class="list-group-item">
                    <img src="images/avatar_default.png" width="45" height="45">
                    <div class="text">
                        <h5>User Name</h5>
                        <small>User signiture</small>
                    </div>
                </li>
                <li class="list-group-item">
                    <img src="images/avatar_default.png" width="45" height="45">
                    <div class="text">
                        <h5>User Name</h5>
                        <small>User signiture</small>
                    </div>
                </li>
                <li class="list-group-item">
                    <img src="images/avatar_default.png" width="45" height="45">
                    <div class="text">
                        <h5>User Name</h5>
                        <small>User signiture</small>
                    </div>
                </li>
                <li class="list-group-item">
                    <img src="images/avatar_default.png" width="45" height="45">
                    <div class="text">
                        <h5>User Name</h5>
                        <small>User signiture</small>
                    </div>
                </li>
                <li class="list-group-item">
                    <img src="images/avatar_default.png" width="45" height="45">
                    <div class="text">
                        <h5>User Name</h5>
                        <small>User signiture</small>
                    </div>
                </li>
                <li class="list-group-item">
                    <img src="images/avatar_default.png" width="45" height="45">
                    <div class="text">
                        <h5>User Name</h5>
                        <small>User signiture</small>
                    </div>
                </li>
                <li class="list-group-item">
                    <img src="images/avatar_default.png" width="45" height="45">
                    <div class="text">
                        <h5>User Name</h5>
                        <small>User signiture</small>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-- FAB -->
    <div class="FAB">
        <a class="new-item" href="http://303.itpwebdev.com/~haomeili/assignment13/new.html"><i
                class="fas fa-plus fa-lg"></i></a>
    </div>
    <!-- Footer -->
    <div class="container-fluid footer">
        StudyRoom 2020. By Haomei Liu.
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script src="./script.js"></script>
    <script src="./studyroom.js"></script>

</body>

</html>