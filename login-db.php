<?php
    session_start();
    require_once "functions/functions.php";
    $inputEmail = $_POST['inputEmail'];
    $inputPassword = $_POST['inputPassword'];
    
    $login = conn();
    if($user_id = $login->query("SELECT id_user FROM users WHERE email = '$inputEmail' AND password = '$inputPassword'")){
        while($row = $user_id->fetch_object()){
            $_SESSION['user_id'] = $row->id_user;
        }
        header("Location: index.php");
    }
    else {
        $_SESSION['notice'] = "Wrong email or password";
        $_SESSION['class-notice'] = "alert alert-danger mb-2";
		header("Location: login.php");
    }
?>