<?php   
    require "config/config.php";
    if(!isset($_POST['sign_submit'])){
        header("Location: http://localhost:8888/project/git_track/login.php");
        exit;
    }
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pass = $_POST['password_sign'];

    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ( $mysqli->connect_errno ) {
        echo $mysqli->connect_error;
        exit();
    }

    // Check if the account exists

    $sql = "SELECT * FROM users WHERE user_email LIKE '%" . $email . "%';";
    $results = $mysqli->query($sql);
    if($results->num_rows == 0) {
        $statement = $mysqli->prepare(
            "INSERT INTO users (user_pass, user_fname, user_lname, user_email) VALUES(?, ?, ?, ?)"
        );
        
        $statement->bind_param("ssss",$pass, $fname, $lname, $email);
    
        $executed = $statement->execute();
        if(!$executed){
            echo $mysqli->error;
            exit("Database connection error");
        }
        
        if($mysqli->affected_rows == 1) {
            $isInserted = true;
        }

        // GET user_id
        $sql = "SELECT * FROM users WHERE user_email LIKE '%" . $email . "%';";
        $results = $mysqli->query($sql);
        $row = $results->fetch_assoc();

        $user_id = $row['user_id'];
        session_start();
        $_SESSION['user_id'] = $user_id;
        
        $statement->close();
    }
    else{
        $isInserted = false;
    }

	$mysqli->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
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
            <p>Your email is already registered. Please try logging in directly.</p>
            <a href="http://303.itpwebdev.com/~haomeili/final_project/login.php">Back to Login Page</a>
        </div>
        <div class="add_info <?php if(!$isInserted){
            echo "not-visible";
            }?>">
            <h3>Add More Info to Get Started</h3>
            <form id="supp_form" action="index.php" method="POST">
                <div class="row nname-container">
                    <div class="form-group">
                        <label for="nickname"></label>
                        <input type="text" class="form-control" name="nname" id="nname" placeholder="Nickname"
                            autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <input type="number" class="not-visible" name="user_id" id="user-id" value="<?php echo $user_id;?>">
                        <input type="number" class="not-visible" name="avatar-num" id="avatar-num">
                        <label for="avatar">Choose Your Avatar</label>
                        <ul id="avatar-pick">
                            <li class="pic" value="2"><img src="images/avatar/1.png" width="60" height="60"
                                    class="d-inline-block align-top pic-btn" /></li>
                            <li class="pic" value="3"><img src="images/avatar/2.png" width="60" height="60"
                                    class="d-inline-block align-top pic-btn" /></li>
                        </ul>
                    </div>
                </div>
                <div class="row bio-container">
                    <div class="form-group">
                        <label for="bio">Bio</label>
                        <input type="text" class="form-control" name="bio" id="bio" placeholder="Your goal, mood, etc." autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 submit-container">
                        <button type="submit" class="btn btn-submit" name="supp_submit" id="supp-submit">Enter StudyRoom</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <!-- Footer -->
    <div class="container-fluid footer">
        StudyRoom 2020. By Haomei Liu.
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="./sign_confirmation.js"></script>


</body>

</html>