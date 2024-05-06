<!DOCTYPE html>
	<html>
		<head>
			<link rel="stylesheet" href="style.css">
			<script src="app.js"></script>
			<title>Register!</title>
		</head>
		<body>
			<p>This is the Register page!</p>
			<form action="post.php" method="POST"><!--this form will be posted to the post.php file -->
				<input type="text" name="first" placeholder="First Name"><br><!-- user will enter their first name -->
				<input type="text" name="last" placeholder="Last Name"><br><!-- user will enter their last name -->
				<input type="text" name="user" placeholder="Username"><br><!-- user will enter a prospective username-->
				<input type="text" name="email" placeholder="Email"><br><!-- user will enter their email -->
				<input type="password" name="pass" placeholder="Password"><br><!-- user will enter their desired password -->
				<input type="submit"><!-- on submit action will take place-->
			</form>
		</body>

	</html>
