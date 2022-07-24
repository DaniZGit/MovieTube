<?php
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if(!isset($_POST['search_value']))
        header("location: index.php");
?>

<div class="movies-container">
    <?php 
        require_once('model/MovieDB.php');
        $_POST['search_value'] = test_input($_POST['search_value']);
        $movies = MovieDB::getMoviesByGenres(json_decode($_POST['selected_genre']), $_POST['search_value'], $_POST['page'], $_POST['movieCount']);
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