<?php

    require_once('model/MovieDB.php');

    session_start();

    if(isset($_SESSION['email'])){
        if(!($_SESSION['role'] === 'admin')){
            header("location: index.php");
        }
    }else {
        header("location: index.php");
    }

    $genres = MovieDB::getAllGenres();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="scripts/add-movie.js"></script>
    <script src="scripts/navigation.js"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/add-movie.css">

    <link rel="icon" href="icons-svg/MovieTube-icon.ico">
    <title>Add Movie</title>
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
                        <li><a class="selected-nav" href="add-movie.php">Add movie</a></li>
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
    <form action="addMovieToDB.php" method="post" enctype="multipart/form-data">
    <div class="main-content">

        <section class="movie-details-section">
            <div class="left">
                <input class="movie-poster-picker" id="poster-file" name="moviePoster" type="file" onchange="readURL(this);" />
                <img src="movie-thumbnails/example.jpg" alt="" class="movie-poster left">
            </div>
            <div class="right">
                <div class="title-container">
                    <h2 id="title" class="movie-details-title" contentEditable="true">Title example</h2>
                    <h2>&nbsp;</h2>
                    <h2>(<span contentEditable="true" id="year">2022</span>)&nbsp</h2>
                </div>
                <hr>
                <div class="movie-description">
                    <p contentEditable="true" id="description">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    </p>
                </div>
                <div class="movie-genre-container">
                    <?php foreach ($genres as $genre): ?>
                        <div class="movie-genre"><a href="#" selected="false"><?php echo $genre['tag'] ?></a></div>
                    <?php endforeach; ?>
                    <div class="add-new-genre-container">
                        <div class="movie-genre" id="add-movie-genre-button">
                            <a href="#">Add new Genre</a>
                        </div>
                    </div>

                </div>
                <div class="movie-trailer-container">
                    <div class="movie-trailer">
                        <iframe id="youtubeLink" class="trailer-frame" width="100%" height="315" allowfullscreen
                            src="https://www.youtube.com/embed/u8-H1aNEdY8">
                        </iframe>
                        <input class="trailer-link" type="text" name="" value="https://www.youtube.com/embed/u8-H1aNEdY8">
                    </div>
                </div>

                <div class="links-container">
                    <div class="links-input-container">
                        <input type="text" name="" class="link-input" id="add-link-input" placeholder="magnet:?xt=urn:btih:D679E2C2F360E09B6...">
                        <button type="button" class="link-button" id="add-link-button">Add Download Link</button>
                    </div>
                    
                </div>
            </div>
        </section>
        <section class="add-movie-section">
                <input type="submit" id="add-movie-button" value="Add Movie" name="submit"/>
                <input type="hidden" name="title" value="gay">
                <input type="hidden" name="description">
                <input type="hidden" name="year">
                <input type="hidden" name="youtubeLink">
                <input type="hidden" name="genres">
                <input type="hidden" name="downloadLinks">
                <input type="hidden" name="val" value="fromForm">
        </section>


    </div>
</form>
    <footer>
        <p>Copyrights Daniel Z.</p>
    </footer>
    
</body>
</html>