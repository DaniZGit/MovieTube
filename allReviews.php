<?php
    session_start();
    if(!isset($_POST['val']))
        header("location: index.php");
        
    require_once('model/MovieDB.php');

    $reviews = MovieDB::getLatestMovieReviews($_POST['movieID']);

    if(count($reviews) <= 0) {
        echo "<h3 style='align-self: center;'>Be the first to review the movie!</h3>";
    }
    for($i=0;$i<$_POST['limit'] && $i<count($reviews); $i++){ 
        $user = MovieDB::getUserByID($reviews[$i]['userID']);
?>
        <div class="movie-reviews-box">
            <div class="upper">
                <!--<img src="profile-images/<?php echo $user['userID'] ?>.jpg" alt="No image" class="user-profile-image">-->
                <img src="profile-images/2.jpg" alt="No image" class="user-profile-image">
                <h4 class="user-profile-name"><?php echo $user['username'] ?></h4>
                <h6 class="user-rating"><?php echo $reviews[$i]['rating'] ?></h6><div class="review-star-icon"></div>
            </div>
            <div class="vl"></div>
            <div class="user-profile-comment lower show-more-box">
                <p><?php echo $reviews[$i]['comment'] ?> </p>
            </div>
        </div>
<?php
    }
    if(count($reviews) > 0){ ?>
        <button class="show-more-reviews-button" onclick="refreshData()">
            Show More
        </button>
    <?php }
?>