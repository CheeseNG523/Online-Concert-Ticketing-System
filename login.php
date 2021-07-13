<?php
session_start();
include("dataconnection.php");

$err_email = "";
$err_pass = "";
//$Msg = "";

if(isset($_POST['submitbtn']))
{
	//check if user do the captcha
	//$secret = '6Le3c_cZAAAAAJBjVnMIxYehs49KiU_o0sGYqiIY';
	//$responseKey = $_POST['g-recaptcha-response'];
	//$userIP = $_SERVER['REMOTE_ADDR'];
  
	//$verifyResponse = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$responseKey&remoteip$userIP";
	//$response = file_get_contents($verifyResponse);
	//$response = json_decode($response);

	//if($response->success)
	//{
		
	$email = $_POST['email'];
	$user_pass = $_POST['userpass'];
	
	//Used to remove special characters e.g.: '\n', ';'
	//Prevent from sql injection
	$email = mysqli_real_escape_string($connect, $email);
	$password = mysqli_real_escape_string($connect, $user_pass);
	$pw = md5($user_pass);
	
	$result = mysqli_query($connect, "SELECT * FROM customer WHERE Cust_Email='$email' AND Cust_Password='$pw'");
	
	$count = mysqli_num_rows($result);
	
	if($count==1)
	{
		//check if account is verified
		$row = mysqli_fetch_assoc($result);
		$verified = $row['verified'];
		$ban_status = $row['Cust_Ban_Status'];

		if($verified==1 && $ban_status==0)
		{
			$_SESSION['email']=$row['Cust_Email'];
		
			//redirect user to home page
			header("location: index.php");
		}
		else if($verified==0)
		{
			$err_email = "This account has not yet been verified. Please verify before login.";
		}
		else
		{
			$err_email = "This account has been banned from using the website.";
		}
	}
	else
	{
		$err_email = "Email entered is invalid";
		$err_pass = "Password entered is invalid";
	}

	//}
	//else
	//{
		//$Msg = 'Verification failed, please try again.';
	//}
	
	mysqli_close($connect);
}

?>
<html>
<head>
<title>Log in</title>

<link rel="stylesheet" href="login3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="preconnect" href="https://fonts.gstatic.com">
<script src='https://www.google.com/recaptcha/api.js' async defer ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>

<div class="loginbox" style='height: 62%;'>
	<img src="images/header_footer/logo.png">
	<form name="login" method="post" action="">
	<div class="email">
		<i class="material-icons" style="font-size: 32px;">person</i>
		<input type="email" name="email" placeholder="Enter email"></input>
		<br><span class="error" style="padding-top: 6px; padding-left: 4px;"> <?php echo $err_email; ?> </span>
	</div>
	<div class="pass">
		<i class="material-icons" style="font-size: 32px;">lock</i>
		<input type="password" name="userpass" id="userpass" placeholder="Enter password" maxlength="20" 
		style="width: 76%; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-right: none;"></input>
		<div class="password_visible">
			<input type="checkbox" onclick="showpw()" style="width: 20px; height: 20px;">
			<div class="icon-box1">
				<span class="material-icons" style="font-size: 25px;">visibility</span>
			</div>
			<div class="icon-box2">
				<span class="material-icons" style="font-size: 25px;">visibility_off</span>
			</div>
		</div>
		<br><span class="error" style="padding-top: 6px; padding-left: 4px;"> <?php echo $err_pass; ?> </span>
	</div>

	<script>
	function showpw() 
	{   
		//to show password
		var x = document.getElementById("userpass");
		
		if(x.type === "password")
			x.type = "text";
		else
			x.type = "password";
	}
	</script>

	<!-- RECAPTCHA -->
	<div class="captcha-box">
		<div class="g-recaptcha" data-sitekey="6Le3c_cZAAAAAC5YQjECjEfxTDINw6lVWewCjbEz" data-callback="verifyCaptcha" style="padding-left: 7px;"> </div>
		<span class="error_captcha"></span>
	</div>

	<input type="submit" class="submit" name="submitbtn" value="Login" style="cursor: pointer;">

	<div class="forgot_password" style='padding-left: 95px;'>
		<a class="newacc" href="reset/forgot_pwd.php" style="text-decoration: none; color: #3f89e7;">Forgot password?</a>
	</div>
	<div class="reg_msg">
		<p style="color: slategrey;">Don't have an account yet? <a class="newacc" href="register/register.php" style="text-decoration: none; color: #3f89e7;">Register</a> now!</p>
	</div>
	</form>
</div>

<!--Captcha verification-->
<script>
	const submitbtn = document.querySelector(".submit");
	function verifyCaptcha()
	{
		$('.error_captcha').text("");
	}

	submitbtn.addEventListener("click", function(event)
	{
		var response = grecaptcha.getResponse();
		console.log(response.length)
		if(response.length == 0)
		{
			event.preventDefault();
			$('.error_captcha').text("Please verify that you are not a robot.");
			return false;
		}
		return true;
	});
</script>
</body>
</html>