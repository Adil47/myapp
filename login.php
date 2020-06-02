<?php
session_start();
include "connection.php";




if(isset($_POST["logout"]))
{
	unset($_SESSION["Email"]);
	unset($_SESSION["img"]);
	setcookie("Email",time() - 3600);
	setcookie("Password",time() - 3600);
	unset($_COOKIE["Email"]);
	unset($_COOKIE["Password"]);

}

if(isset($_SESSION["Email"]))
{
	header("Location:index.php");
}

if(isset($_POST["login"]))
{


	$Email=$_POST["Email"];
	$Password=$_POST["Password"];
	$query=mysqli_query($con,"select * from student where Email='$Email' and Password='$Password'") or die(mysqli_error($con));
	if($row=mysqli_fetch_array($query))
	{

		$_SESSION["Email"]=$row["Email"];
		$_SESSION["img"]=$row["imgPath"];

		if(isset($_POST["remember-me"]))
		{
			setcookie("Email",$row["Email"],time()+3600);
			setcookie("Password",$row["Password"],time()+3600);

		}
		else
		{
			setcookie("Email","",time());
			setcookie("Password","",time());
		}

		header("Location:index.php");

	}
	else
	{
		$msg="Email or Password incorrect";
	}

}
if(isset($_COOKIE["Email"])  && isset($_COOKIE["Password"]))
{
	


	$Email=$_COOKIE["Email"];
	$Password=$_COOKIE["Password"];
	$query=mysqli_query($con,"select * from student where Email='$Email' and Password='$Password'");
	if($row=mysqli_fetch_array($query))
	{

		$_SESSION["Email"]=$Email;
		$_SESSION["img"]=$row["imgPath"];

		setcookie("Email",$row["Email"],time()+3600); // set cookie for one year
		setcookie("Password",$row["Password"],time()+3600);// set cookie for one year

		header("Location:index.php");

	}
	else
	{
		$msg="Email or Password incorrect";
	}
}




?>



<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V15</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="Assets/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Assets/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Assets/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="Assets/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Assets/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="Assets/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="Assets/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(images/bg-01.jpg);">
					<span class="login100-form-title-1">
						Sign In
					</span>
				</div>

				<form class="login100-form validate-form" action="login.php" method="POST">
					<center><p style="color: red"><?php echo @$msg?></p></center>
					<div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">
						<span class="label-input100">Email</span>
						<input class="input100" type="text" name="Email" placeholder="Enter Email">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="Password" placeholder="Enter password">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-b-30">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							<a href="#" class="txt1">
								Forgot Password?
							</a>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" name="login" class="login100-form-btn">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="Assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="Assets/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="Assets/vendor/bootstrap/js/popper.js"></script>
	<script src="Assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="Assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="Assets/vendor/daterangepicker/moment.min.js"></script>
	<script src="Assets/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="Assets/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="Assets/js/main.js"></script>

</body>
</html>