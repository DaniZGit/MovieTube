<div class="movies-container">
    <?php 
        require_once('model/MovieDB.php');
        $movies = MovieDB::getLatestMoviesByLimit($_POST['page'], $_POST['movieCount']);

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