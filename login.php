<?php
	session_start();
	if(isset($_SESSION['class-notice'])){
		$classNotice = $_SESSION['class-notice'];
		$notice = $_SESSION['notice'];
		unset($_SESSION['class-notice']);
		unset($_SESSION['notice']);
	}
	if(isset($_SESSION['user_id'])){
		header("Location: index.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="style.css">
	<title>Login SN</title>
</head>
<body>
	<div class="container flex-box font-weight-normal lh">
		<form class="form-signin flex-box lh full-width" action="login-db.php" method="POST">
			<img class="mb-1" src="logo.svg">
			<h1 class="mb-2 font-weight-normal">Please sign in</h1>
			<div class="<?php echo isset($classNotice)? $classNotice : '' ?>" role="alert">
				<?php echo isset($notice)? $notice : '' ?>
			</div>
			<input type="email" name="inputEmail" id="inputEmail" class="form-control full-width" placeholder="Email" required autofocus>
			<input type="password" name="inputPassword" id="inputPassword" class="form-control full-width" placeholder="Password" required>
			<div class="font-weight-normal mb-2 full-width">
				<label>
					<input type="checkbox" value="remember-me"> Remember me
				</label>
			</div>
			<button class="btn font-weight-normal lh full-width" type="submit">Sign in</button>
			<div class="ata">
				Not registered?<a href="signup.php"> Click here!</a>
			</div>
			<p class="mb-2 text-muted">&copy; Copyleft 2018 - ASN, no rights reserved.</p>
		</form>
	</div>
</body>
</html>