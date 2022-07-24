<?php 
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
    <script src="scripts/browse-movies.js"></script>
    <script src="scripts/navigation.js"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/movies-section.css">
    <link rel="stylesheet" href="css/browse-movies.css">

    <link rel="icon" href="icons-svg/MovieTube-icon.ico">
    <title>Browse Movies</title>
</head>
<body>
    <header>
        <h1 class="logo">
            <a href="index.php">MovieTube</a>
        </h1>
        <button expanded="false" id="menu-button"></button>
        <nav class="main-nav">
            <ul>
                <li><a class="selected-nav" href="browse-movies.php">Browse movies</a></li>
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

        <section class="search-bar-section">
            <div class="search-bar-container">
                <h2 class="search-bar-title">
                    Search Movies
                </h2>
                <input type="search" name="search" id="movie-search-bar" placeholder="Movie title">
            </div>
        </section>

        <section class="filter-section">
            <div class="genre-selection-container">
                <h2 class="filter-title">
                    Filter by tags
                </h2>
                <div class="movie-genre-container">
                    <?php 
                    require_once('model/MovieDB.php');
                    $genres = MovieDB::getAllGenres();
                    foreach ($genres as $genre): ?>
                        <a class="movie-genre" selected="false"><?php echo $genre['tag'] ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        <!--
            <div class="order-selection">
                <div class="order-selection-container">
                    <h2 class="filter-title">
                        Order by
                    </h2>
                    <select class="filter-select" name="genre-filter" id="genre-filter">
                        <option value="all">Show all</option>
                        <option value="Latest">Latest</option>
                        <option value="Adventure">Adventure</option>
                        <option value="Drama">Drama</option>
                        <option value="Sci-Fi">Sci-Fi</option>
                    </select>
                </div>
            </div> 
        -->
        </section>

        <section class="movies-section" id="ajaxdata">

        </section>

        <section class="paging-section">
            <button class="prev-page-button">PREV</button>
            <div class="pages" id="pages">
            </div>
            <button class="next-page-button">NEXT</button>
        </section>

    </div>

    

    <footer>
        <p>Copyrights Daniel Z.</p>
    </footer>

</body>
</html>

