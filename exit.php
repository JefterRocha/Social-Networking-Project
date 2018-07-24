<?php
	session_start();
	unset(
		$_SESSION['class-notice'],
		$_SESSION['notice'],
		$_SESSION['user_id']
	);
	session_destroy();
	header("Location: login.php");
?>