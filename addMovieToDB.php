<?php

    session_start();

    if(!isset($_POST['val']))
        header("location: index.php");

    require_once('model/DBInit.php');

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = strip_tags($data);
        return $data;
    }

    $db = DBInit::getInstance();

    $_POST['title'] = test_input($_POST['title']);
    $_POST['description'] = test_input($_POST['description']);
    $_POST['year'] = test_input($_POST['year']);

    foreach ($genres as $genre) {
        $genre = test_input($genre);
    }
    
    // insert movie
    $stmt = $db->prepare("INSERT INTO Movie(title, description, year, youtubeLink) VALUES(:title, :description, :year, :youtubeLink)");
    $stmt->bindParam(":title", $_POST['title'], PDO::PARAM_STR);
    $stmt->bindParam(":description", $_POST['description'], PDO::PARAM_STR);
    $stmt->bindParam(":year", ($_POST['year']), PDO::PARAM_INT);
    $stmt->bindParam(":youtubeLink", $_POST['youtubeLink'], PDO::PARAM_STR);

    $stmt->execute();
    $movieID = $db->lastInsertId();

    $genres = json_decode($_POST['genres']);
    // insert genres
    foreach ($genres as $genre) {
        $stmt = $db->prepare("SELECT tag FROM genre where tag = :tag");
        $stmt->bindParam(":tag", $genre, PDO::PARAM_STR);
        $stmt->execute();

        if($stmt->rowCount() <= 0){
            $stmt = $db->prepare("INSERT INTO Genre(tag) VALUES(:tag)");
            $stmt->bindParam(":tag", $genre, PDO::PARAM_STR);
            $stmt->execute();
        }
    }
    
    // insert movie_has_genre
    foreach ($genres as $genre) {
        $stmt = $db->prepare("SELECT tag FROM genre where tag = :tag");
        $stmt->bindParam(":tag", $genre, PDO::PARAM_STR);
        $stmt->execute();

        echo $genre . ' -- ' . $stmt->rowCount();
        if($stmt->rowCount() === 1){
            $tag = $stmt->fetch();

            $stmt = $db->prepare("INSERT INTO movie_has_genre(movieID, tag) VALUES(:movieID, :tag)");
            $stmt->bindParam(":movieID", $movieID, PDO::PARAM_INT);
            $stmt->bindParam(":tag", $tag['tag'], PDO::PARAM_STR);
            $stmt->execute();
        }
    }

    // insert download links

    $links = json_decode($_POST['downloadLinks']);
    foreach ($links as $link) {
        $stmt = $db->prepare("INSERT INTO download_link(movieID, link) VALUES(:movieID, :link)");
        $stmt->bindParam(":movieID", $movieID, PDO::PARAM_INT);
        $stmt->bindParam(":link", $link, PDO::PARAM_STR);
        $stmt->execute();
    }

    // save movie poster to local folder

    $_FILES["moviePoster"]["name"] = "$movieID.jpg";
    $target_dir = "movie-thumbnails/";
    $target_file = $target_dir . basename($_FILES["moviePoster"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["moviePoster"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        echo $_FILES["moviePoster"]["tmp_name"] . "<br>";
        if (move_uploaded_file($_FILES["moviePoster"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["moviePoster"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // redirect to movie-details page

    header("location: movie-details.php?movieID=$movieID");
?>
