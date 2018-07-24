<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="style.css">
	<title>Signup SN</title>
</head>
<body>
	<div class="container flex-box font-weight-normal lh">
		<form class="form-signin flex-box lh full-width" action="register.php">
			<img class="mb-1" src="logo.svg">
			<h1 class="mb-2 font-weight-normal">Please Sign up</h1>
			<input type="name" name="inputName" id="inputName" class="form-control full-width" placeholder="Name" required autofocus>
			<input type="name" name="inputLName" id="inputLName" class="form-control full-width" placeholder="Last name" required autofocus>
			<input type="email" name="inputEmail" id="inputEmail" class="form-control full-width" placeholder="Email" required autofocus>
			<input type="password" name="inputPassword" id="inputPassword" class="form-control full-width" placeholder="Password" required>
			<input type="password" id="inputPassRepeat" class="form-control full-width" placeholder="Repeat password" required>
			<div class="font-weight-normal mb-2 full-width">
				<label>
					<input type="checkbox" value="acept-me"> Acept-me
				</label>
			</div>
			<button class="btn font-weight-normal lh full-width" type="submit">Sign in</button>
			<p class="mb-2 text-muted">&copy; Copyleft 2018 - ASN, no rights reserved.</p>
		</form>
	</div>
</body>
</html>