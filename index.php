<?php
session_start(); 
	include ("classes/connect.php");
	include ("classes/signup.php");
	include ("classes/login.php");
	

	////////////////////////////////
	$username = "";
	$email = "";
	$fullname = "";

	if ($_SERVER ["REQUEST_METHOD"] == 'POST')
	{  
		if (isset($_POST['signinb'])) {

			$login= new login ();
			$result = $login->evaluate($_POST);
			if ($result!=""){
				echo "<div style='text-align:center;font-size:12px;color:white;background-color:red;'>";
				echo "Error is : <br><br>";
				echo $result;
				echo "</div>";
			}
			else {
				header ("location:home.php");
				die;
			}
		}
		if (isset($_POST['signupb'])){
			$signup = new Signup();
			$result = $signup ->evaluate($_POST); 
			if ($result!=""){
				echo "<div style='text-align:center;font-size:12px;color:white;background-color:red;'>";
				echo "Error is : <br><br>";
				echo $result;
				echo "</div>";

			}else
			{
				echo "<div style='text-align:center;font-size:12px;color:white;background-color:green;'>";
				echo "Welcome to MERCURY <br> TRy to login";
				echo "</div>";
			}

			$username = $_POST['username'];
			$email = $_POST['email'];
			$fullname = $_POST['fullname'];

		}
			
					
		
	}
		
?>


<style>
	<?php
	include('style/stylelogpage.css');
	?>
</style>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>mercury login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">


</head>
<body>
<!-- partial:index.partial.html -->
<div class="container right-panel-active">
			<!-- Sign Up -->
			<div class="container__form container--signup">
				<form action="index.php" class="form" id="form" method="post">
					<h2 class="form__title">Sign Up</h2>
					<input value= "<?php echo $username ?>" name="username" id="username" type="text" placeholder="username" class="input" />
					<input value ="<?php echo $fullname ?>" name="fullname" id="fullname" type="text" placeholder="fullname" class="input" />
					<input value= "<?php echo $email ?>"name="email" id="email" type="email" placeholder="Email" class="input" />
					<input  name="password" id="password" type="password" placeholder="Password" class="input" />
					<button type="submit" name="signupb" value="signupb" class="btn">Sign Up</button>
				</form>
			</div>

			<!-- Sign In -->
			<div class="container__form container--signin">
				<form action="#" class="form" id="form" method="post">
					<h2 class="form__title">Sign In</h2>
					<input name="log_email" type="email" placeholder="Email" class="input" />
					<input name="log_password" type="password" placeholder="Password" class="input" />
					<a href="forgot.php" class="link">Forgot your password?</a>
					<button type="submit" name="signinb" value="signinb"  class="btn">Sign In</button>
				</form>
			</div>

			<!-- Overlay -->
			<div class="container__overlay">
				<div class="overlay">
					<div class="overlay__panel overlay--left">
						<button name="btnsi" class="btn" id="signIn">Sign In</button>
					</div>
					<div class="overlay__panel overlay--right">
						<button class="btn" id="signUp">Sign Up</button>
					</div>
				</div>
			</div>
		</div>
<!-- partial -->
  <script  src="app/script.js"></script>

</body>
</html>
