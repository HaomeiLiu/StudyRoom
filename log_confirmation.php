<?php   
    require "config/config.php";
    if(!isset($_POST['log-submit'])){
        echo "not submitted";
        header("Location: http://localhost:8888/project/git_track/login.php");
        exit;
    }
    if(isset($_POST['email-log']) && !empty($_POST['email-log']) && isset($_POST['password-log']) && !empty($_POST['password-log'])){
        $email = $_POST['email-log'];
        $pass = $_POST['password-log'];
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ( $mysqli->connect_errno ) {
            echo $mysqli->connect_error;
            exit();
        }
        $sql = "SELECT user_id, user_pass FROM users WHERE user_email LIKE '%" . $email . "%';";
        $results = $mysqli->query($sql);
        $row = $results->fetch_assoc();
        if($results->num_rows == 0){
            $notFound = true;
        }
        else if($row['user_pass'] == $pass){
            session_start();
            $_SESSION['user_id'] = $row['user_id'];
            header("Location: http://localhost:8888/project/git_track/index.php");
            exit;
        }
        else{
            $notFound = false;
        }
    }
    else{
        // Unexpected error
        header("Location: http://localhost:8888/project/git_track/login.php");
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Logging In</title>
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
        <div class="to-login <?php if($isInserted){
            echo "not-visible";
            }?>" id="to-login">
            <p><?php if($notFound){
                echo "Email not registered.";
            }
            else{
                echo "Incorrect password";
            }
            ?></p>
            <a href="http://303.itpwebdev.com/~haomeili/final_project/login.php">Back to Login Page</a>
        </div>
    </div>
    <!-- Footer -->
    <div class="container-fluid footer">
        StudyRoom 2020.
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</body>

</html>