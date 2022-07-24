<?php 
    session_start();
    if(isset($_SESSION['email']))
        header("location: index.php");
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
    <title>Login</title>
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
                    <li><a class="selected-nav" href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php } ?>
            </ul>
        </nav>
    </header>

    <div class="main-content">
        <section class="login-form">
            <form action="login-auth.php" method="post">
                <?php if(isset($_GET['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_GET['error']; ?>
                    </div>
                <?php } ?>
                <!-- Email input -->
                <div class="form-outline mb-2">
                    <label class="form-label" for="form2Example1">Email address</label>
                    <input type="email" name="email" id="form2Example1" class="form-control" required/>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example2">Password</label>
                    <input type="password" name="password" id="form2Example2" class="form-control" required/>
                </div>

                <!-- Submit button -->
                <div class="login-button">
                    <button type="submit" class="btn btn-primary btn-block mb-2">Sign in</button>
                </div>

                <!-- Register buttons -->
                <div class="text-center">
                    <p>Not a member? <a class="register-button" href="register.php">Register</a></p>

                </div>
            </form>
        </section>
    </div>

    <footer>
        <p>Copyrights Daniel Z.</p>
    </footer>
</body>
</html>