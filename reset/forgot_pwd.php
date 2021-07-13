<?php
    include("../dataconnection.php");
    session_start();
    $err_email = "";
    
    if(isset($_POST['forgot_btn']))
    {
        $email = $_POST['email'];
        $email = mysqli_real_escape_string($connect, $email);
        
        if(empty($email)){    
            $err_email = "Please fill in the field!";
        }
        else
        {
            $result = mysqli_query($connect, "SELECT * FROM customer WHERE Cust_Email='$email'");
            $count = mysqli_num_rows($result);
            
            if($count==1)
	        {
                $row = mysqli_fetch_assoc($result);
                $verified = $row['verified'];
                $status = $row['Cust_Ban_Status']; 
                $name = $row['Cust_Lname'];
                //check if account is verified
                if($verified == 1)
                {
                    if($status == 0)
                    {
                        //pass email
                        $_SESSION['email']= $email;
                        $key = bin2hex(random_bytes(8));
                        
                        //send email to the user
                        $to = $email;
                        $subject = "Concerta:: Password Reset";
                        $message = "<p>We received a request to change your password on Concerta Online</p><br><p>Click the link below to set a new password.</p><p>Link: <a href='http://localhost/concerta/reset/reset_pwd.php?key=$key'>Reset Password</a></p><p>If you dont want to change your password, you can ignore this email.</p>";
                        $headers = "From: concerta.my@gmail.com \r\n";
                        $headers .= "MIME-Version: 1.0"."\r\n";
                        $headers .= "Content-type:text/html;charset=UTP-8"."\r\n";
                            
                        mail($to,$subject,$message,$headers);

                        mysqli_query($connect,"update customer set Reset_Vkey = '$key' where Cust_Email = '$email'");

                        header('location:sended.php');
                    }
                    else
                    {
                        $err_email = "This account has been banned";
                    }
                }
                else
                {
                    $err_email = "This account has not yet been verified.";
                }
            }
            else
            {
                $err_email = "Sorry...Your email is not found!";
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
<title>Forgot password</title>
<link rel="stylesheet" href="css/forgot_pwd.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
<div class="container">
  <img src="../images/header_footer/logo.png">
  <form name="fgt_pwdfrm" method="post" action="" autocomplete="off">
    <h2>Forgot your password?</h2>
    <div class="detail">Please enter your email, we'll send you a link to reset your password.</div>
    <a href="../login.php"><i class="material-icons" style="font-size: 22px; float: right;" title="Go back to the login page" >arrow_back</i></a>
    <div class="email">
        <i class="material-icons" style="font-size: 28px; margin-top: 5px;">mail</i>
        <label style='margin-left: 10px; margin-bottom: 5px;'>Email Address</label>
	    <input type="email" name="email" class='user_email' placeholder="Enter email"></input>
	    <!-- <br><span class="error"> <?php echo $err_email; ?> </span> -->
    </div>
    <input type="submit" name="submitbtn" class='submitbtn' value="Reset password">
  </form> 
</div>

<script>
$('.submitbtn').on('click', function(event){
    event.preventDefault();
    if($(".user_email").val() == "" || $('.user_email').val() == null)
    {
        event.preventDefault();
        Swal.fire({
            icon: 'error',
            title:'Oops...', 
            text:'Please enter your email.'
        });
    }
    else if(($(".user_email").val().indexOf("@") == -1))
    {
        event.preventDefault();
        Swal.fire({
            icon: 'error',
            title:'Oops...', 
            text:'Wrong email format.'
        });
    }
    else if(($(".user_email").val().indexOf(".") == -1))
    {
        event.preventDefault();
        Swal.fire({
            icon: 'error',
            title:'Oops...', 
            text:'Wrong email format.'
        });
    }
    else
    {
        $.ajax({
            type: "POST",
            url: "forgot_pwd.php",
            dataType: 'json',
            data: {
                "forgot_btn": 1,
                "email": $(".user_email").val(),
            },
            beforeSend: function()
            {
               Swal.fire({
                title:'Successful!', 
                text:'Please check your email', 
                icon:'success',
                didClose: () => window.open('sended.php','_self')});
            }
        });
    }
})
</script>

</body>
</html>