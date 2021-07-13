<?php
    session_start();
	include "dataconnection.php";
    
    if(!isset($_SESSION['email']))
    {
        header("location: login.php");
    }
    else
    {
        $email = $_SESSION['email'];
        $email_query = "SELECT * FROM customer WHERE Cust_Email = '$email'";
        $email_search = mysqli_query($connect, $email_query);
        $cust_details = mysqli_fetch_assoc($email_search);
    }
?>
<!DOCTYPE html>
<html>
<head>
<title>My profile</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://kit.fontawesome.com/14a3a3f38a.js" crossorigin="anonymous"></script>
    <script src="profile_validation.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="head-foot3.css">
    <link rel="stylesheet" href="cust_profile3.css">
    <link rel="stylesheet" href="profile-sidebar1.css">
    <link rel="stylesheet" href="tnc_privacy.css">
<style>
.main-container div{
    padding: 0;
}

.main-container input[type='text'],
.main-container input[type='password'] {
    outline: none;
    border: 1px solid transparent;
    border-radius: 8px 0px 0px 8px;
    padding: 5px 8px;
    background-color: rgba(63, 191, 191, 0.2);
    font-family: 'Poppins', sans-serif;
    resize: none;
}
</style>
</head>
<?php include "header.php"; ?>
	<div class="button">
		<a href="index.php">Home</a>
		<a href="aboutus.php">About Us</a>
		<a href="concert.php">Concert</a>
		<a href="merchandise.php">Merchandise</a>
		<a href="singer.php">Singer</a>
	</div>
  </div>
</div>

<?php include "profile-sidebar.php"; ?>
        <a href='profile.php'><i class='material-icons'>portrait</i>My profile</a><br>
        <a href='edit_profile.php'><i class='material-icons'>edit</i>Edit profile</a><br>
        <a href='#' class='active'><i class='material-icons'>lock</i>Change password</a><br>
        <a href='history-ticket.php'><i class='material-icons'>history</i>History</a>
    </div>

    <form class="main-container" action='' name='edit_form' method='post'>
        <div class='main-title' style='padding: 0 10px;'>
            <h1>Change Password</h1>
        </div>
        
        <div class='pass_label'>
            <p>Current password</p>
        </div>
        <div class='pass_input'>
            <input type='password' class='current_pass' id='current_pass' placeholder='Your current password'></input>
            <div class="password_visible">
                <input type="checkbox" onclick="show_password()">
                <div class="icon-box1">
                    <span class="material-icons" style="font-size: 25px;">visibility</span>
                </div>
                <div class="icon-box2">
                    <span class="material-icons" style="font-size: 25px;">visibility_off</span>
                </div>
		    </div>
        </div>

        <div class='pass_label'>
            <p>New Password</p>
        </div>
        <div class='pass_input'>
            <input type='password' class='new_pass' id='new_pass' maxlength='20' placeholder='Your new password'></input>
            <div class="password_visible" style='bottom: 0; height: 30px;'>
                <input type="checkbox" onclick="show_new_pass()">
                <div class="icon-box1">
                    <span class="material-icons" style="font-size: 25px;">visibility</span>
                </div>
                <div class="icon-box2">
                    <span class="material-icons" style="font-size: 25px;">visibility_off</span>
                </div>
		    </div>
            <!-- <span id='error_same_pass' style='color:red; height: 30px; width: 100%; display:block; font-size: 15px;'></span> -->
        </div>

        <!-- validation box -->
        <div id="messagebox">
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

        <div class='pass_label'>
            <p>Confirm New Password</p>
        </div>
        <div class='pass_input'>
            <input type='password' class='confirm_new_pass' id='confirm_new_pass' maxlength='20' placeholder='Confirm your password'></input>
            <div class="password_visible">
                <input type="checkbox" onclick="show_Cnew_pass()">
                <div class="icon-box1">
                    <span class="material-icons" style="font-size: 25px;">visibility</span>
                </div>
                <div class="icon-box2">
                    <span class="material-icons" style="font-size: 25px;">visibility_off</span>
                </div>
		    </div>
        </div>

        <!-- submit button -->
        <div class='label'>
            <input type='submit' value='Save Password' name='submitbtn' class='pass_edit_submit_btn'></input>
        </div>
    </form>
</div>

<script>
//to show password
function show_password() 
{   
    var x = document.getElementById("current_pass");
    
    if(x.type === "password")
        x.type = "text";
    else
        x.type = "password";
}

function show_new_pass()
{
    var y = document.getElementById("new_pass");

    if(y.type === "password")
        y.type = "text";
    else
        y.type = "password";
}

function show_Cnew_pass()
{
    var z = document.getElementById("confirm_new_pass");

    if(z.type === "password")
        z.type = "text";
    else
        z.type = "password";
}

var newpass = document.getElementById("new_pass");

// When the user clicks on the password field, show the message box
newpass.onfocus = function() {
    document.getElementById("messagebox").style.display = "block";
}

//When the user clicks outside of the password field, hide the message box
newpass.onblur = function() {
    document.getElementById("messagebox").style.display = "none";
}
</script>

<?php include "footer.php"; ?>