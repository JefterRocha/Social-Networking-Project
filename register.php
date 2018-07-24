<?php
    session_start();
    
    require_once "functions/functions.php";
    
    $inputName = $_GET['inputName'].' '.$_GET['inputLName'];
    $inputEmail = $_GET['inputEmail'];
    $inputPassword = $_GET['inputPassword'];
    
    $register = conn();
    if($register->query("INSERT INTO users (id_user, user_name, logged, friends_list, email, password) VALUES (NULL, '$inputName', '0', NULL, '$inputEmail', '$inputPassword')")){
        $_SESSION['notice'] = "Successfully registered";
        $_SESSION['class-notice'] = "alert alert-success mb-2";
    }
    else {
        $_SESSION['notice'] = "Error while registering";
        $_SESSION['class-notice'] = "alert alert-danger mb-2";
    }
    $register->close();
    header("Location: login.php");
?>