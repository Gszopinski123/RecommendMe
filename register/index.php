<!DOCTYPE html>
	<html>
		<head>
			<link rel="stylesheet" href="style.css">
			<script src="app.js"></script>
			<title>Register!</title>
		</head>
		<body>
			<?php
				session_start();
				if (isset($_SESSION['loggedin'])) {
					if ($_SESSION['loggedin']) {
						$userId = $_SESSION['username'];
						echo "
						<div class='dropdown'>
							<button class='dropbtn'>Menu</button>
								<div class='dropdown-content'>
									<a href='../Home/home.php'>home</a>
									<a href='../profiles/profile.php?user=$userId'>My page</a>
									<a href='../login/index.php'>register</a>
									<a href='../Home/logout.php?logout=1&type=0'>logout</a>
								</div>
						</div>
						";
					} else {
						echo "
						<div class='dropdown'>
							<button class='dropbtn'>Menu</button>
								<div class='dropdown-content'>
									<a href='../Home/home.php'>home</a>
									<a href='index.php'>register</a>
									<a href='login.php'>login</a>
								</div>
						</div>
						";
					}
				} else {
					echo "
						<div class='dropdown'>
							<button class='dropbtn'>Menu</button>
								<div class='dropdown-content'>
									<a href='../Home/home.php'>home</a>
									<a href='index.php'>register</a>
									<a href='login.php'>login</a>
								</div>
						</div>
						";
				}
			?>
			<p id="center">This is the Register page!</p>
			<form id="center" name="register" onsubmit="return verify();"action="post.php" method="POST"><!--This will tell form what action to take and what to do -->
				<input class="input" type="text" name="first" placeholder="First Name" required><br><br><!-- firstname input-->
				<input class="input" type="text" name="last" placeholder="Last Name" required><br><br><!--lastname input -->
				<input class="input" type="text" name="user" placeholder="Username" required><br><br><!-- username input-->
				<input class="input" type="text" name="email" placeholder="Email" required><br><br><!-- email input -->
				<input class="input" id="pass"  type="password" name="pass" placeholder="Password" required><br><!-- password input-->
				<p id="mess">password needs to contain at least:<br>  
					1 uppercase letter,<br> 
					1 lowercase letter,<br> 
					1 special character '!@#$%*&^?/' etc,<br> 
					1 number character,<br> 
					and 10 characters long
				</p><!-- extra for user later-->
				<input type="submit" value="Register"><!-- allows user to attempt to submit -->
				<?php
				if (isset($_REQUEST['exists'])) {
					if ($_REQUEST['exists']) {
						echo "<p id='mess'>There is an account with that username!</p>";
					}
				}
				?>
				
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
					//last updated 5/16/24 Broomy
				</script>
			</form>
		</body>

	</html>