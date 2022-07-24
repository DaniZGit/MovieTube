<?php
    session_start();
    if(!($_SESSION['role'] === "admin" && isset($_POST['movieID'])))
        header("location: index.php");

    require_once('model/DBInit.php');

    $db = DBInit::getInstance();

    // insert movie
    $stmt = $db->prepare("DELETE FROM Movie WHERE movieID = :movieID");
    $stmt->bindParam(":movieID", $_POST['movieID'], PDO::PARAM_STR);

    $stmt->execute();

    header("location: index.php");
?>  