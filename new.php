<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Session</title>
    <link rel="icon" href="images/icon.png">
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <link rel="stylesheet" href="./style.css">
    <style>
        .focus-container {
            margin-top: 20px;
        }

        .pie-container {
            position: relative;
            margin: 40px auto;
            width: 250px;
            height: 250px;
        }

        .pie-container .pie {
            width: 50%;
            height: 100%;
            transform-origin: 100% 50%;
            position: absolute;
            background-color: #273469;
            border: 5px solid rgba(0, 0, 0, 0.5);
        }

        .pie-container .spinner {
            border-radius: 100% 0 0 100% / 50% 0 0 50%;
            z-index: 200;
            border-right: none;
            animation: rota 5s linear infinite;
        }

        .pie-container:hover .spinner,
        .pie-container:hover .mask {
            animation-play-state: running;
        }

        .pie-container .filler {
            border-radius: 0 100% 100% 0 / 0 50% 50% 0;
            left: 50%;
            opacity: 0;
            z-index: 100;
            animation: opa 5s steps(1, end) infinite reverse;
            border-left: none;
        }

        .pie-container .mask {
            width: 50%;
            height: 100%;
            position: absolute;
            background: inherit;
            opacity: 1;
            z-index: 300;
            animation: opa 5s steps(1, end) infinite;
        }

        .pie-container .not-visible {
            display: none;
        }

        .pie-container .initial {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            position: relative;
            background: #273469;
            border: 5px solid rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pie-btn {
            color: #FAFAFF;
            border-color: #273469;
            font-family: font_bold;
        }

        .pie-btn:hover {
            background-color: rgba(250, 250, 255, 0.445);
            border-color: rgba(250, 250, 255, 0.164);
            color: #1E2749;
        }

        @keyframes rota {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes opa {
            0% {
                opacity: 1;
            }

            50%,
            100% {
                opacity: 0;
            }
        }

        .focus-container .slider {
            -webkit-appearance: none;
            width: 75%;
            background-color: rgba(30, 39, 73, 0.411);
            border-radius: 3px;
            height: 8px;
            outline: none;
            padding: 0;
            margin: 0;
            margin-right: 10px;
        }

        @media(max-width: 767px) {
            .focus-container .slider {
                width: 68%;
            }
        }

        .slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #273469;
            color: #273469;
            cursor: pointer;
        }

        .slider::-webkit-slider-thumb:hover {
            background-color: #FFCE32;
        }

        .slider-value {
            display: inline-block;
            position: relative;
            width: 40px;
            line-height: 20px;
            text-align: center;
            background-color: #273469;
            color: #FFCE32;
            border-radius: 3px;
            padding: 5px 5px;
        }

        .slider-value:after {
            position: absolute;
            top: 8px;
            left: -7px;
            width: 0;
            height: 0;
            border-top: 7px solid transparent;
            border-right: 7px solid #273469;
            border-bottom: 7px solid transparent;
            content: '';
        }

        #focus-title {
            max-width: 290px;
            margin-left: 30px;
        }

        #focus-form {
            margin-top: 20px;
        }

        .space {
            height: 100px;
        }

        .section {
            margin: 0 auto;
        }

        h2 {
            margin-top: 20px;
            margin-left: 20px;
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
                    <a class="nav-link" href="http://303.itpwebdev.com/~haomeili/assignment13/index.html"><span
                            class="sr-only">(current)</span>Home</a>
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
    <h2>Create New Focus Session</h2>
    <div class="container-fluid focus-container">
        <div class="row">
            <div class="col-10 col-lg-7 col-md-8 col-sm-10 section">
                <div class="form-center">
                    <form id="focus-form">
                        <div class="form-group">
                            <div class="row container">
                                <label for="focus-title">Title: </label>
                                <input type="text" class="form-control" id="focus-title" placeholder="Study"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="focus-duration">Duration</label>
                            <input type="range" class="slider" min="0" max="180" step="10" list="tickmarks">
                            <datalist id="tickmarks">
                                <option value="30"></option>
                                <option value="60" label="1h"></option>
                                <option value="90"></option>
                                <option value="120" label="2h"></option>
                            </datalist>
                            <span class="slider-value">90</span>
                        </div>
                        <div class="form-group pie-container">
                            <div class="pie spinner not-visible"></div>
                            <div class="pie filler not-visible"></div>
                            <div class="mask not-visible"></div>
                            <div class="pie initial">
                                <button type="submit" class="btn btn-outline-primary pie-btn">Start Session</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="space"></div>

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
    <script src="./new.js"></script>

</body>

</html>