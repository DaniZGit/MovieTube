<?php

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = strip_tags($data);
        return $data;
    }

    if(!isset($_POST['username']) || strlen($_POST['username'] === 0)){
        $error = "Username is required";
        header("location: register.php?error=$error");
    } else if(!isset($_POST['email']) || strlen($_POST['email'] === 0)){
        $error = "Email is required";
        header("location: register.php?error=$error");
    } else if(!isset($_POST['password']) || strlen($_POST['password'] === 0)){
        $error = "Password is required";
        header("location: register.php?error=$error");
    } else if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){
        $error = $_POST['email'] . " is not a valid email address";
        header("location: login.php?error=$error");
    } else {

        $_POST['username'] = test_input($_POST['username']);
        $_POST['email'] = test_input($_POST['email']);
        $_POST['password'] = test_input($_POST['password']);

        require_once('model/DBInit.php');
        $db = DBInit::getInstance();

        $stmt = $db->prepare("SELECT username, email, password, role FROM User WHERE username = :username");
        $stmt->bindParam(":username", $_POST['username'], PDO::PARAM_STR);
        $stmt->execute();
        
        if($stmt->rowCount() != 1){
            $stmt = $db->prepare("SELECT username, email, password, role FROM User WHERE email = :email");
            $stmt->bindParam(":email", $_POST['email'], PDO::PARAM_STR);
            $stmt->execute();

            if($stmt->rowCount() != 1){
                $stmt = $db->prepare("INSERT INTO User(username, email, password, role) VALUES(:username, :email, :password, 'user')");
                $stmt->bindParam(":username", $_POST['username'], PDO::PARAM_STR);
                $stmt->bindParam(":email", $_POST['email'], PDO::PARAM_STR);
                $stmt->bindParam(":password", password_hash($_POST['password'], PASSWORD_DEFAULT), PDO::PARAM_STR);

                $stmt->execute();

                session_start();
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['password'] = $_POST['password'];
                $_SESSION['role'] = "user";

            } else {
                $error = "An account with this email already exists";
                header("location: register.php?error=$error");
            }
        } else {
            $error = "An account with this username already exists";
            header("location: register.php?error=$error");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="scripts/navigation.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">

    <link rel="icon" href="icons-svg/MovieTube-icon.ico">
    <title>Redirection</title>
</head>
<body>
    <header>
        <h1 class="logo">
            <a href="index.php">MovieTube</a>
        </h1>
        <button expanded="false" id="menu-button"></button>
        <nav class="main-nav">
            <ul>
                <li><a href="browse-movies.php">Browse movies</a></li>
                <?php if(isset($_SESSION['role'])) { 
                    if($_SESSION['role'] === "admin") { ?>
                        <li><a href="add-movie.php">Add movie</a></li>
                <?php } } ?>
                <?php if(isset($_SESSION['email'])) { ?>
                        <li><a href="profile.php"><?= $_SESSION['username'] ?></a></li>
                        <li><a href="logout.php">Log Out</a></li>
                <?php } else { ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php } ?>
            </ul>
        </nav>
    </header>

    <div class="main-content">
        <div class="alert alert-success" role="alert" style="margin-top: 200px; text-align: center;">
            Succesfully Registered. You have been automatically logged in.
            You will be redirected shortly.
        </div>
    </div>

    <footer>
        <p>Copyrights Daniel Z.</p>
    </footer>
</body>
</html>

<?php 
    header("refresh:2;index.php");
?>