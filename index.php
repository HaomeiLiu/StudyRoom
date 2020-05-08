<?php
    require "config/config.php";
    session_start();
    if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])){
        header("Location: http://localhost:8888/project/git_track/login.php");
        exit;
    }
    $user_id = (int) $_SESSION['user_id'];

    // FROM sign_confirmation.php
    if(isset($_POST['supp_submit'])){
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ( $mysqli->connect_errno ) {
            echo $mysqli->connect_error;
            exit();
        }
        $mysqli->set_charset('utf8');
        // if(isset($_POST["user_id"]) && !empty($_POST["user_id"])){
        //     $user_id = $_POST["user_id"];
        // }
        // else{
        //     exit("Unexpected error, no user_id from sign conf");
        // }
        if(isset($_POST["nname"]) && !empty($_POST["nname"])){
            $nname = $_POST["nname"];
        }
        else{
            $release_date = NULL;
        }
        if(isset($_POST["avatar-num"]) && !empty($_POST["avatar-num"])){
            $avatar_num = $_POST["avatar-num"];
        }
        else{
            $avatar_num = 0;
        }
        if(isset($_POST["bio"]) && !empty($_POST["bio"])){
            $bio = $_POST["bio"];
        }
        else{
            $bio = NULL;
        }
        $statement = $mysqli->prepare(
            "UPDATE users SET user_nickname =?, user_sign = ?, user_avatar = ? WHERE user_id = ?"
        );
        $statement->bind_param("ssii",$nname, $bio, $avatar_num, $user_id);

        $executed = $statement->execute();
        if(!$executed) {
            echo $mysqli->error;
        }
    
        if($statement->affected_rows == 1){
            $isUpdated = true;
        }
    }
    // GET USER INFO FROM DB
    $sql = "SELECT * FROM users WHERE user_id = ". $user_id. ";";
    $results = $mysqli->query($sql);
    $row = $results->fetch_assoc();

    if($row['user_nickname'] != null){
        $displayName = $row['user_nickname'];
    }
    else{
        $displayName = $row['user_fname'];
    }

    if($row['user_timestamp'] != null){
        if($row['user_timestamp'] < date("Y-m-d")){
            // Not current date's record
            $displayTime = 0;
        }
        else{
            if($row['user_timestamp'] != null){
                // Defensive, should always be true
                $displayTime = $row['user_timestamp'];
            }
            else{
                $displayTime = 0;
            }
        }
    }
    else{
        $displayTime = 0;
    }

    if($row['user_avatar'] != null){
        // defensive
        $displayAvatar = $row['user_avatar'];
        $sql_ava = "SELECT avatar_path FROM avatar WHERE avatar_id = ". $displayAvatar. ";";
        $results_ava = $mysqli->query($sql_ava);
        $row_ava = $results_ava->fetch_assoc();
        $displayPath = $row_ava['avatar_path'];
    }
    else{
        $displayPath = "images/avatar/0.png";
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link rel="icon" href="images/icon.png">
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <script src="https://kit.fontawesome.com/6bbcae6afb.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="./style.css">
    <style>
        /* Time */
        #date {
            margin: 10px;
            font-family: font_norm;
        }

        /* Welcome msg */

        .welcome {
            box-sizing: border-box;
            position: relative;
            text-align: center;
            background-color: rgba(48, 52, 63, 0.952);
            /* #050A24 */
            margin: 20px;
            border-radius: 15px;
            width: 95%;
            border: #30343F 1px solid;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .welcome img {
            max-width: 400px;
        }

        @media (min-width: 767px) {
            .welcome img {
                margin-right: 63%;
            }
        }

        @media (max-width: 991px) {
            .welcome .welcome-msg {
                font-size: 70px;
            }

            .welcome .welcome-prompt {
                font-size: 19px;
            }
        }

        @media(max-width: 767px) {
            .welcome {
                display: flex;
                justify-content: center;
                flex-direction: column;
            }

            .welcome .welcome-msg {
                position: relative;
                right: 0;
                top: 0;
            }

            .welcome .welcome-prompt {
                position: relative;
                margin-top: 10px;
                margin-bottom: 20px;
                bottom: 0;
                right: 0;
            }

        }

        .welcome-msg {
            font-family: font_curl;
            font-size: 80px;
            color: #FAFAFF;
            position: absolute;
            top: 26px;
            right: 60px;
        }

        .welcome-prompt {
            position: absolute;
            bottom: 40px;
            right: 60px;
            font-family: font_norm;
            font-size: 30px;
            text-align: center;
            color: #FAFAFF;
        }

        .modules {
            text-align: center;
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
            margin: 0 auto;
        }

        .module {
            border-radius: 15px;
            width: 30%;
            margin-top: 30px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            transition: all 0.2s cubic-bezier(.25, .8, .25, 1);
        }

        .module img {
            border-radius: 15px;
        }

        .module:hover {
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
        }

        @media(max-width: 767px) {
            .modules {
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            .module {
                width: 60%;
                min-width: 350px;
            }
        }

        .modules .module .title {
            position: relative;
        }

        .modules .module .title .text {
            position: absolute;
            height: 80%;
            opacity: 0.8;
            top: 10%;
            left: 0;
            width: 100%;
            text-align: center;
            color: #FAFAFF;
            font-family: font_norm;
            font-size: 30px;
        }

        .title .text1 {
            background-color: #1E2749;
        }

        .title .text2 {
            background-color: rgb(211, 173, 162);
        }

        .title .text3 {
            background-color: dimgray;
        }

        .text:hover {
            opacity: 0.4;
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
                <li class="nav-item active">
                    <a class="nav-link" href="http://303.itpwebdev.com/~haomeili/assignment13/index.html">Home <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="http://303.itpwebdev.com/~haomeili/assignment13/studyroom.html">StudyRoom</a>
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
                        <img src="<?php echo $displayPath;?>" alt="">
                        <div class="nav-info">
                            <?php echo $displayName;?>
                        </div>
                    </li>
                    <li class="nav-item" id="profile-btn">
                        <a href="#!" class="nav-link">Profile</a>
                    </li>
                    <li class="nav-item" id="edit-btn">
                        <a href="#!" class="nav-link">Edit</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Time -->
    <div class="container-fluid" id="date">
    </div>
    <!-- Welcome Message -->
    <div class="container-fluid welcome">
        <div class="welcome-img">
            <img class="img-fluid" src="images/study.png">
        </div>
        <div class="welcome-msg">Welcome, <?php echo $displayName;?>!</div>
        <div class="welcome-prompt">You have focused <?php echo $displayTime;?> minutes today.</div>
    </div>

    <!-- Display Modules -->
    <div class="container-fluid modules">
        <div class="module">
            <div class="title">
                <img src="images/cover2.jpg" class="img-fluid">
                <div class="text text1">StudyRoom Rank</div>
            </div>
        </div>
        <div class="module">
            <div class="title">
                <img src="images/cover1.png" class="img-fluid">
                <div class="text text2">Today's Focus</div>
            </div>
        </div>
        <div class="module">
            <div class="title">
                <img src="images/cover3.png" class="img-fluid">
                <div class="text text3">TODO Items</div>
            </div>
        </div>
    </div>
    <!-- FAB -->
    <div class="FAB">
        <a class="new-item" href="http://303.itpwebdev.com/~haomeili/assignment13/new.html"><i class="fas fa-plus fa-lg"></i></a>
    </div>
    <!-- Footer -->
    <div class="container-fluid footer">
        StudyRoom 2020.
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
    <script src="./index.js"></script>

</body>

</html>