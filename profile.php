<?php 

    session_start();
    if(!isset($_SESSION['email']))
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
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/profile.css">

    <link rel="icon" href="icons-svg/MovieTube-icon.ico">
    <title>Profile</title>
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
                        <li><a class="selected-nav" href="profile.php"><?= $_SESSION['username'] ?></a></li>
                        <li><a href="logout.php">Log Out</a></li>
                <?php } else { ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php } ?>
            </ul>
        </nav>
    </header>
    <div class="main-content">
        <section class="profile-container">
            <form action="changeProfile.php" method="post">
                <div class="card-container">
                    
                        <img src="profile-images/1.jpg" alt="">
                        <div>
                            <label class="form-label" for="username">Username</label>
                            <input id="form2Example1" type="text" name="username" value="<?php echo $_SESSION['username']; ?>" readonly id="" class="form-control">
                        </div>

                        <div>
                            <label class="form-label" for="username">Email</label>
                            <input id="form2Example1" type="email" name="email" value="<?php echo $_SESSION['email']; ?>" readonly id="" class="form-control">
                        </div>
                        
                        <div>
                            <label class="form-label" for="username">Old  Password</label>
                            <input id="form2Example2" type="password" name="oldPassword" id="" class="form-control" required>
                        </div>
                        
                        <div>
                        <label class="form-label" for="username">New Password</label>
                            <input id="form2Example2" type="password" name="newPassword" id="" class="form-control" required> 
                        </div>
                        
                        <input class="change-button" type="submit" value="Change">  

                        <input type="hidden" name="val" value="fromForm">

                        <?php if(isset($_GET['error'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_GET['error']; ?>
                            </div>
                        <?php } ?>
                    
                </div>
            </form>
        </section>
    </div>
    
    <footer>
        <p>Copyrights Daniel Z.</p>
    </footer>
</body>
</html>