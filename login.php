<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="icon" href="images/icon.png">
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="./login_style.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row head-container">
            <a class="navbar-brand" href="http://303.itpwebdev.com/~haomeili/assignment13/index.html"><img
                    src="./images/icon.png" width="60" height="60" class="d-inline-block align-top" alt="">
            </a>
            <a class="navbar-brand" href="http://303.itpwebdev.com/~haomeili/assignment13/index.html">StudyRoom</a>
            <div class="col ad">Sign up today to enjoy online studying groups and boost your efficiency!</div>
        </div>
    </div>
    <div class="space"></div>
    <div class="container-fluid box">
        <div class="container">
            <div class="row">
                <div class="btn-group" role="group" aria-label="login-group-btn">
                    <button type="button" class="btn btn-secondary btn-sign">Sign Up</button>
                    <button type="button" class="btn btn-secondary btn-login">Log In</button>
                </div>
            </div>
            <div class="row title">
                <h2 id="login-title">Sign Up Today for Free!</h2>
            </div>
            <form id="sign-form" action="sign_confirmation.php" method="POST">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group input-item">
                            <label for="fname"></label>
                            <input type="text" required class="form-control" name="fname" id="fname" placeholder="First Name"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group input-item">
                            <label for="lname"></label>
                            <input type="text" required class="form-control" id="lname" name="lname" placeholder="Last Name"
                                autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="email"></label>
                            <input type="email" class="form-control" required id="email" name="email" placeholder="Email Address"
                                autocomplete="email">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="password"></label>
                            <input type="password" required class="form-control" id="password" 
                            name="password_sign" placeholder="Password"
                                autocomplete="off"
                                minlength="6" maxlength="20">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="passconf"></label>
                            <input type="password" required class="form-control" id="passconf"
                                placeholder="Confirm Password" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 submit-container">
                        <button type="submit" class="btn btn-submit" name="sign_submit" id="sign-submit">Create Account</button>
                    </div>
                </div>
            </form>
            <div id="log-container" class="not-visible">
                <form id="log-form" action="log_confirmation.php" method="POST">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email"></label>
                                <input type="email" class="form-control" required id="email-log" name="email-log" 
                                    placeholder="Email Address" autocomplete="email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="password"></label>
                                <input type="password" required class="form-control" id="password-log" name="password-log" 
                                    placeholder="Password" autocomplete="off" minlength="6" maxlength="20">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 submit-container">
                            <button type="submit" class="btn btn-submit" id="log-submit" name="log-submit">Log In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <div class="container-fluid footer">
        StudyRoom 2020. By Haomei Liu.
    </div>
    <script src="./login.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</body>

</html>