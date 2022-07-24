<?php

require_once('DBInit.php');

class MovieDB {
    static function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = strip_tags($data);
        return $data;
    }

    public static function getMovieCount(){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT count(movieID) as 'movieLength' FROM movie");
        $statement->execute();

        return $statement->fetch();
    }

    public static function getLatestMovies($limit = 1000000) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT movieID, title, description, year 
            FROM movie ORDER BY movieID DESC LIMIT :lim");
        $statement->bindParam(":lim", $limit, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getLatestMoviesByLimit($page = 1, $moviesPerPage = 1000000){
        $db = DBInit::getInstance();

        $startCount = ($page-1) * $moviesPerPage;
        $statement = $db->prepare("SELECT movieID, title, description, year 
            FROM movie ORDER BY movieID DESC LIMIT ?, $moviesPerPage");
        $statement->bindParam(1, $startCount, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getMovieByID($movieID){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT movieID, title, description, year, youtubeLink 
            FROM movie where movieID = :movieID");
        $statement->bindParam(":movieID", $movieID, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public static function getAllGenres(){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT tag FROM genre");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getMovieGenres($movieID) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT tag 
            FROM movie_has_genre where movieID = :movieID");
        $statement->bindParam(":movieID", $movieID, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getLatestMovieReviews($movieID){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT userID, comment, rating 
            FROM review where movieID = :movieID ORDER BY reviewID DESC");
        $statement->bindParam(":movieID", $movieID, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getUserByID($userID){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT userID, username, role 
            FROM user where userID = :userID");
        $statement->bindParam(":userID", $userID, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public static function getMoviesByGenres($genres = [], $search_input = "", $currPage = 1, $moviesPerPage = 1000000){
        $db = DBInit::getInstance();

        $str = "SELECT m.movieID, m.title, m.description, m.year FROM Movie m";

        for($i=0;$i<count($genres);$i++){
            if($i == 0){
                $str = $str . " where";
            }
            $str = $str . " m.movieID in (select movieID from movie_has_genre where tag = ':genre')";
            $genres[$i] = test_input($genres[$i]);
            $str = str_replace(":genre", $genres[$i], $str);
            if($i != count($genres)-1)
                $str = $str . " and ";
        }

        if(strlen($search_input) > 0){
            if(count($genres) > 0)  // če ni žanrov, potem moramo dati spredi "where", če pa so pa dodamo "and"
                $str = $str . " and";
            else
                $str = $str . " where";

            $str = $str . ' LOWER(m.title) LIKE CONCAT("%",LOWER(":query"),"%")';
            $search_input = test_input($search_input);
            $str = str_replace(":query", $search_input, $str);
        }

        $startCount = ($currPage-1) * $moviesPerPage;
        $str = $str . " LIMIT ? , $moviesPerPage";
        $statement = $db->prepare($str);


        $statement->bindParam(1, $startCount, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getMovieLinks($movieID) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT link, resolution, video_format
            FROM download_link where movieID = :movieID");
        $statement->bindParam(":movieID", $movieID, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

}

?>