<?php
    session_start();
    
    require_once "functions/functions.php";
	$post = $_GET['user-post'];
	$user_id = $_SESSION['user_id'];
    
    $mysqli = conn();
    if($mysqli->query("INSERT INTO posts (post_id, content, likes, user_id) VALUES (NULL, '$post', 0, $user_id)")){
		$mysqli->close();
		header("Location: index.php");  
    }
?>