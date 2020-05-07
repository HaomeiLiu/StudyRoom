<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stats</title>
    <link rel="icon" href="images/icon.png">
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <script src="https://kit.fontawesome.com/6bbcae6afb.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style.css">
    <style>
        .total-display {
            display: flex;
            justify-content: space-evenly;
            margin: 0 auto;
            padding: 10px;
            box-sizing: border-box;
        }

        .accumulated {
            background-color: #273469;
            font-family: font_norm;
            color: #FAFAFF;
            border-radius: 15px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            width: 40%;
            margin: 20px;
        }

        .total-display .accu-title {
            margin: 10px;
        }
        .accumulated h6, .daily h6 {
            font-family: font_bold;
        }

        .daily {
            background-color: #273469;
            font-family: font_norm;
            color: #FAFAFF;
            border-radius: 15px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            width: 40%;
            margin: 20px;
        }

        @media (max-width: 767px) {
            .total-display {
                flex-direction: column;
                align-items: center;
            }

            .daily,
            .accumulated {
                width: 70%;
            }
        }

        .charts {
            margin-top: 25px;
            color: #FAFAFF
        }

        .charts .chart-container {
            background-color: #273469;
            padding: 15px;
            text-align: center;
        }

        .charts .chart-container h3 {
            margin: 0 0 10px;
            font-size: 17px;
            font-family: font_bold;
        }

        .myCharts {
            display: flex;
            justify-content: space-evenly;
        }

        .myCharts .chart1, .myCharts .chart2 {
            width: 40%;
        }

        @media (max-width: 991px) {
            .myCharts {
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
            .myCharts .chart1, .myCharts .chart2 {
                max-width: 600px;
                width: 70%;
            }
        }

        .space {
            height: 110px;
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
                <li class="nav-item">
                    <a class="nav-link"
                        href="http://303.itpwebdev.com/~haomeili/assignment13/studyroom.html">StudyRoom</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="http://303.itpwebdev.com/~haomeili/assignment13/stats.html"><span
                            class="sr-only">(current)</span>Statistics</a>
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

    <!-- Stats Modules -->
    <!-- Accumulated Count -->
    <div class="container-fluid total-display">
        <div class="accumulated">
            <div class="container">
                <div class="row accu-title"><h6>Accumulated Focus Time</h6></div>
                <div class="row">
                    <div class="col">Sessions</div>
                    <div class="col">Total Time</div>
                    <div class="col">Daily Average</div>
                </div>
                <div class="row">
                    <div class="col">2</div>
                    <div class="col">180 min</div>
                    <div class="col">90 min</div>
                </div>
            </div>
        </div>
        <!-- Daily Focus -->
        <div class="daily">
            <div class="container">
                <div class="row accu-title"><h6>Today's Focus</h6></div>
                <div class="row">
                    <div class="col">Sessions</div>
                    <div class="col">Total Time</div>
                </div>
                <div class="row">
                    <div class="col">1</div>
                    <div class="col">30min</div>
                </div>
            </div>
        </div>
    </div>
    <!-- Daily Focus Distribution -->
    <section class="charts">
        <div class="container-fluid myCharts">
            <div class="chart1">
                <div class="chart-container">
                    <h3>Daily Focus Time Distribution</h3>
                    <canvas id="chart-day"></canvas>
                </div>
            </div>
            <!-- Weekly Focus Distribution -->
            <div class="chart2">
                <div class="chart-container">
                    <h3>Weekly Focus Time Distribution</h3>
                    <canvas id="chart-week"></canvas>
                </div>
            </div>
        </div>
    </section>
    <!-- FAB -->
    <div class="FAB">
        <a class="new-item" href="http://303.itpwebdev.com/~haomeili/assignment13/new.html"><i class="fas fa-plus fa-lg"></i></a>
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
    <script src='https://cdn.jsdelivr.net/npm/chart.js@2.8.0'></script>
    <script src="./stats.js"></script>


</body>

</html>