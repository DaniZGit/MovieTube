<?php
    require_once('model/MovieDB.php');

    session_start();

    if(isset($_GET['movieID'])){
        $movie = MovieDB::getMovieByID($_GET['movieID']);
        if(!isset($movie['movieID']))
            header('location: index.php');
    }else
        header('location: index.php');

    $genres = MovieDB::getMovieGenres($_GET['movieID']);
    $reviews = MovieDB::getLatestMovieReviews($_GET['movieID']);
    $links = MovieDB::getMovieLinks($_GET['movieID']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="scripts/movie-details.js"></script>
    <script src="scripts/navigation.js"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/movies-section.css">
    <link rel="stylesheet" href="css/show-mosre.css">
    <link rel="stylesheet" href="css/movie-details.css">

    <link rel="icon" href="icons-svg/MovieTube-icon.ico">
    <title><?=$movie['title'] . " (" . $movie['year'] . ")"?></title>
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
        <section class="movie-details-section">
            <div class="left">
                <img src="movie-thumbnails/<?php echo $movie['movieID']; ?>.jpg" alt="" class="movie-poster left">
            </div>
            <div class="right">
                <h2 class="movie-details-title"><?php echo $movie['title'] . " (" . $movie['year'] . ")"; ?></h2>
                <hr>
                <div class="movie-description">
                    <?php echo $movie['description']; ?>
                </div>
                <div class="movie-genre-container">
                    <?php foreach ($genres as $genre): ?>
                        <div class="movie-genre"><a href=""><?php echo $genre['tag'] ?></a></div>
                    <?php endforeach; ?>
                </div>
                <div class="movie-trailer">
                    <iframe width="100%" height="315" allowfullscreen
                        src="<?php echo $movie['youtubeLink'] ?>">
                    </iframe>
                </div>

                <div class="movie-downloads-container">
                    <button class="dropbtn">Available downloads: (<?= count($links) ?>)</button>
                    <?php if(count($links) > 0) { ?>
                        <div class="dropdown-content">
                        <?php
                            $i = 1; 
                            foreach ($links as $link): ?>
                            <a href="<?php echo $link['link'] ?>"><?php echo "link $i: " . $link['resolution'] . "-" . $link['video_format'] ?></a>
                        <?php endforeach; ?>
                        </div>
                    <?php } ?>  
                </div>
            </div>
        </section>

        <section class="movie-reviews-section"  movieID="<?= $movie['movieID'] ?>">
            <h2 class="movie-reviews-title">User Reviews</h2>
            <div id="ajaxdata">

            </div>

            <?php if(isset($_SESSION['email'])) { ?>
                    <div class="add-new-reivew">
                        <h4>What are your thoughts on the movie?</h4>
                        <!--<form action="addNewReview.php" method="POST" id="comment-form">-->
                        <textarea name="comment" class="form-control comment" id="exampleFormControlTextarea1" rows="3" placeholder="Write your thoughts in here..."></textarea>
                        <button class="add-new-review-button">
                            Submit
                        </button>
                    </div>
            <?php } else { ?>
                    <h3 style='align-self: center;'>You need to be logged in to review the movie!</h3>
            <?php } ?>
        </section>

        <section class="movies-recommendation-section">
            <h2 class="movies-recommendation-title">Latest Movies</h2>
            <div class="movies-container">
                <?php 
                    $movies = MovieDB::getLatestMovies(6);
                    $c = 0;
                    foreach ($movies as $key=>$movie):
                    if(!($movie['movieID'] == $_GET['movieID'])) { $c++; ?>
                        <div class="movie-box" onclick="location.href='movie-details.php?movieID=<?php echo $movie['movieID']; ?>'" style="cursor: pointer;">
                            <img src="movie-thumbnails/<?php echo $movie['movieID']; ?>.jpg" alt="" class="movie-img">
                            <h3 class="movie-title">
                                <?php echo $movie['title']; ?>
                            </h3>
                            <h5 class="movie-year">
                                <?php echo $movie['year']; ?>
                            </h5>
                        </div>
                    <?php } ?>
                <?php endforeach;?>
            </div>
        </section>

        <?php
        if(isset($_SESSION['role'])) 
            if($_SESSION['role'] === "admin") { ?>
                <section class="delete-movie">
                    <form action="deleteMovie.php" method="post" onsubmit="return confirm('Are you sure about deleting this movie?');">
                        <input id="delete-movie-button" type="submit" value="Delete Movie">
                        <input type="hidden" name="movieID" value="<?= $_GET['movieID'] ?>">
                    </form>
                </section>
            <?php }?>
    </div>

    <footer>
        <p>Copyrights Daniel Z.</p>
    </footer>
</body>
</html>