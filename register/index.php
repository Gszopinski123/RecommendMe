<!DOCTYPE html>
	<html>
		<head>
			<link rel="stylesheet" href="style.css">
			<script src="app.js"></script>
			<title>Register!</title>
		</head>
		<body>
			<p>This is the Register page!</p>
			<form name="register" onsubmit="return verify();"action="post.php" method="POST"><!--This will tell form what action to take and what to do -->
				<input type="text" name="first" placeholder="First Name" required><br><!-- firstname input-->
				<input type="text" name="last" placeholder="Last Name" required><br><!--lastname input -->
				<input type="text" name="user" placeholder="Username" required><br><!-- username input-->
				<input type="text" name="email" placeholder="Email" required><br><!-- email input -->
				<input id="pass" type="password" name="pass" placeholder="Password" required><br><!-- password input-->
				<p id="mess"></p><!-- extra for user later-->
				<input type="submit" value="submit"><!-- allows user to attempt to submit -->
				<script>//script used to verify password is the correct length and other factors
					function upperCase(str) {//will test for upper case letters
						for (let i =0; i < str.length; i++) {//uses ascii
							if (str.charCodeAt(i) >= 65 && str.charCodeAt(i) <= 90)	{ return true; }
						}
						return false;
					}
					function lowerCase(str) {//check for lowercase
						for (let i =0; i < str.length; i++) {//uses ascii
							if (str.charCodeAt(i) >= 97 && str.charCodeAt(i) <= 122) { return true;}
						}
						return false;
					}
					function numbers(str) {//check for number(s)
						for (let i =0; i < str.length; i++) {//uses ascii
							if (str.charCodeAt(i) >= 48 && str.charCodeAt(i) <= 57)	{ return true;}
						}
						return false;
					}
					function specialChar(str) {//checks for special characters 
						for (let i =0; i < str.length; i++) {//uses ascii
							if (str.charCodeAt(i) >= 33 && str.charCodeAt(i) <= 47) { return true;}
						}
						return false;
					}
					function verify() {//will verify password overall main function
						let pass = document.forms['register']['pass'].value;//get the password value
						if (upperCase(pass) && lowerCase(pass) && numbers(pass) && specialChar(pass) && pass.length >= 10) {return true;} //makes sure the password has all the requirements
						else {return false;}//will return false if it doesnt
					}
					//last updated 5/12/24 Broomy
				</script>
			</form>
		</body>

	</html>

