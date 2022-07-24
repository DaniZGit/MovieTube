<?php 

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = strip_tags($data);
        return $data;
    }

    session_start();

    if(!isset($_POST['oldPassword']) || strlen($_POST['oldPassword'] === 0)){
        $error = "Old password is required";
        header("location: profile.php?error=$error");
    } else if(!isset($_POST['newPassword']) || strlen($_POST['newPassword'] === 0)){
        $error = "New password is required";
        header("location: profile.php?error=$error");
    } else {
        require_once('model/DBInit.php');
        $db = DBInit::getInstance();

        $_POST['password'] = test_input($_POST['password']);
        
        $stmt = $db->prepare("SELECT userID, username, email, password, role FROM User WHERE email = :email");
        $stmt->bindParam(":email", $_POST['email'], PDO::PARAM_STR);
        $stmt->execute();

        if($stmt->rowCount() == 1){
            $user = $stmt->fetch();
            var_dump($user);
            if (password_verify($_POST['oldPassword'], $user['password'])){
                echo "huu";
                $stmt = $db->prepare("UPDATE User SET password = :password where userID = :userID");
                $stmt->bindParam(":userID", $user['userID'], PDO::PARAM_STR);
                $stmt->bindParam(":password", password_hash($_POST['newPassword'], PASSWORD_DEFAULT), PDO::PARAM_STR);
                
                $stmt->execute();

                session_start();
                $_SESSION['password'] = $_POST['newPassword'];

                $error = "Password has been changed";
                header("location: profile.php?error=$error");
            } else {
                $error = "Wrong old password";
                header("location: profile.php?error=$error");
            }
        } else {
            $error = "Wrong email or password";
            header("location: profile.php?error=$error");
        }
    }
?>