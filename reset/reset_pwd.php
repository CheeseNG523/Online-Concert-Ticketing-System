<?php
    session_start();
    include("../dataconnection.php");
    
    if(isset($_GET['key']))
    {
        $key = $_GET['key'];
        $result = mysqli_query($connect, "select * from customer where Reset_Vkey = '$key' limit 1");
        if(mysqli_num_rows($result) ==1)
        {
            $email_get = mysqli_fetch_assoc($result);
            $_SESSION['cust_mail'] = $email_get['Cust_Email'];
        }
        else
        {
            header('location: used.php');
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
<title>Reset password</title>
<link rel="stylesheet" href="css/reset_pwd1.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/reset_pwd_validation.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<style>
.error-npass, .error-cpass {
    display: inline-block;
    font-family: sans-serif;
    font-weight: bold;
    font-size: 10pt; 
    color: red;
    margin-top: -10px;
    margin-bottom: 10px;
}

#messagebox{
    display: none;
    width: 270px;
    background-color:rgba(0, 0, 0, 0.7);
    border-radius: 6px;
    padding: 5px 0;
    z-index: 1;
    top: 37%; 
    left: 61%;
    position: absolute;
    padding: 10px;
}

#messagebox label{
    display: block;
    padding: 2.5px 0;
    margin-bottom: -10px;
}

#messagebox label span{
    font-size: 15px;
    padding: -.1px 2.5px; 
}

.tooltiptext::after{
    content: '';
	height: 0;
	width: 0;
	border-top: 20px solid transparent;
	border-bottom: 20px solid transparent;
	position: absolute;
	top: 40px;
	left: -20px;
    border-right: 20px solid rgba(0, 0, 0, 0.7);
}

.alert{
    border-radius: 5px;
    text-align: left;
    padding: 5px 10px;
    background-color: #f44336;
    color: white;
    opacity: 0;
}

.alert label{
    font-size: 13px;
    color: white;
}
</style>
</head>
<body>

<div class="container">
  <img src="../images/header_footer/logo.png">
  <form name="resetpwdfrm" class="resetpwdfrm" method="post" action="" autocomplete="off">
  <a href="../login.php"><i class="material-icons" style="font-size: 22px; margin-top: 41px; float: right;" title="Cancel" >close</i></a>
    <div class="alert password_alert" style="margin: 10px 0px;">
      <!--   <span class="material-icons password_alert_icon" style="vertical-align: middle; font-size: 20px; clear:both;">error</span>
        <label class="change_password_alert"></label> -->
    </div>
    <div class="txt_field" style="display: block;">
        <i class="material-icons" style="font-size: 32px;">lock</i>
        <label style="float: left;">New Password</label><br><br>
	    <input type="password" name="new_pwd" id="newpwd" class="check-npass" placeholder="Enter new password" maxlength="20"></input>
        <div class="password_visible">
            <input type="checkbox" onclick="shownewpw()">
            <div class="icon-box1">
                <span class="material-icons" style="font-size: 25px;">visibility</span>
            </div>
            <div class="icon-box2">
                <span class="material-icons" style="font-size: 25px;">visibility_off</span>
            </div>
		</div>
        <span class="error-npass"></span>
    </div>
        <i class="material-icons" style="font-size: 32px; clear:both;">lock</i>
        <label style="float: left">Confirm Password</label><br><br>
        <div class="seperate" style="clear: both;">
	    <input type="password" name="cfm_pwd" id="cfmpwd" class="check-cpass" placeholder="Enter confirm password" maxlength="20"></input>
        <div class="password_visible">
            <input type="checkbox" onclick="showcfmpw()">
            <div class="icon-box1">
                <span class="material-icons" style="font-size: 25px;">visibility</span>
            </div>
            <div class="icon-box2">
                <span class="material-icons" style="font-size: 25px;">visibility_off</span>
            </div>
        </div>
        <span class="error-cpass"></span>
    <button type="button" name="resetbtn" class="sbbtn">Reset password</button>
  </form>
  <div id="messagebox" class="tooltiptext">
        <label style="color:white;">Password must contain the following:</label>
        <label style="color:rgba(255, 0, 0, 0.8);" class="letter">
        <span class="material-icons cancel_icon4">cancel</span>
        <span class="material-icons checked_icon4" style="display:none">check_circle</span>
        A lowercase letter</label>
        <label style="color:rgba(255, 0, 0, 0.8);" class="capital">
        <span class="material-icons cancel_icon3">cancel</span>
        <span class="material-icons checked_icon3" style="display:none">check_circle</span>
        A capital (uppercase) letter</label>
        <label style="color:rgba(255, 0, 0, 0.8);" class="number">
        <span class="material-icons cancel_icon2" >cancel</span>
        <span class="material-icons checked_icon2" style="display:none">check_circle</span>
        A number</label>
        <label style="color:rgba(255, 0, 0, 0.8);" class="special">
        <span class="material-icons cancel_icon5">cancel</span>
        <span class="material-icons checked_icon5" style="display:none">check_circle</span>
        A special characters</label>
        <label style="color:rgba(255, 0, 0, 0.8); margin-bottom: 0px;" class="length">
        <span class="material-icons cancel_icon1">cancel</span>
        <span class="material-icons checked_icon1" style="display:none">check_circle</span>
        12-20 characters</label>
    </div>
</div>
</body>
</html>
<script>
	function shownewpw() 
	{   
		//to show password
        var x = document.getElementById("newpwd");
        
		if(x.type === "password")
            x.type = "text";
        else
            x.type = "password";
    }
    function showcfmpw() 
	{   
		//to show password
        var x = document.getElementById("cfmpwd");
        
		if(x.type === "password")
            x.type = "text";
        else
            x.type = "password";
    }

    var newpass = document.getElementById("newpwd");
    var cfmpass = document.getElementById("cfmpwd");
    const sbbtn = document.querySelector(".sbbtn");
    
    // When the user clicks on the password field, show the message box
    newpass.onfocus = function() {
        document.getElementById("messagebox").style.display = "block";
    }

    //When the user clicks outside of the password field, hide the message box
    newpass.onblur = function() {
        document.getElementById("messagebox").style.display = "none";
    }
</script>