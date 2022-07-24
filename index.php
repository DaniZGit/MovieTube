<?php 
    require_once('model/MovieDB.php');

    session_start();
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
    <link rel="stylesheet" href="css/movies-section.css">
    <link rel="stylesheet" href="css/main-page.css">

    <link rel="icon" href="icons-svg/MovieTube-icon.ico">
    <title>MovieTube</title>
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
        <section class="movies-section movies-section-newest">
            <h2 class="section-title">
                <a href="#">LATEST RELEASES</a>
            </h2>

            <div class="movies-container">
                <?php 
                    $movies = MovieDB::getLatestMovies();
                    foreach ($movies as $key=>$movie): ?>
                        <div class="movie-box" onclick="location.href='movie-details.php?movieID=<?php echo $movie['movieID']; ?>'" style="cursor: pointer;">
                            <img src="movie-thumbnails/<?php echo $movie['movieID']; ?>.jpg" alt="" class="movie-img">
                            <h3 class="movie-title">
                                <?php echo $movie['title']; ?>
                            </h3>
                            <h5 class="movie-year">
                                <?php echo $movie['year']; ?>
                            </h5>
                        </div>
                    <?php endforeach;?>
            </div>
        </section>

        <section class="movies-section movies-section-popular">
            <h2 class="section-title">
                <a href="#">TRENDING MOVIES</a>
            </h2>

            <div class="movies-container">
                <?php 
                    $movies = MovieDB::getLatestMovies();
                    foreach ($movies as $key=>$movie): ?>
                        <div class="movie-box" onclick="location.href='movie-details.php?movieID=<?php echo $movie['movieID']; ?>'" style="cursor: pointer;">
                            <img src="movie-thumbnails/<?php echo $movie['movieID']; ?>.jpg" alt="" class="movie-img">
                            <h3 class="movie-title">
                                <?php echo $movie['title']; ?>
                            </h3>
                            <h5 class="movie-year">
                                <?php echo $movie['year']; ?>
                            </h5>
                        </div>
                    <?php endforeach;?>
            </div>
        </section>

        <section class="movies-section movies-section-upcoming">
            <h2 class="section-title">
                <a href="#">UPCOMING MOVIES</a>
            </h2>

            <div class="movies-container">
                <?php 
                    $movies = MovieDB::getLatestMovies();
                    foreach ($movies as $key=>$movie): ?>
                        <div class="movie-box" onclick="location.href='movie-details.php?movieID=<?php echo $movie['movieID']; ?>'" style="cursor: pointer;">
                            <img src="movie-thumbnails/<?php echo $movie['movieID']; ?>.jpg" alt="" class="movie-img">
                            <h3 class="movie-title">
                                <?php echo $movie['title']; ?>
                            </h3>
                            <h5 class="movie-year">
                                <?php echo $movie['year']; ?>
                            </h5>
                        </div>
                    <?php endforeach;?>
            </div>
        </section>
    </div>

    <footer>
        <p>Copyrights Daniel Z.</p>
    </footer>
</body>
</html>