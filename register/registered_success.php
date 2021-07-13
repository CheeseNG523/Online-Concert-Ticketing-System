<?php
    session_start();
    if(isset($_POST['submit_btn']))
    {
        header("location: register_out.php");
    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <title>Register Successful</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
           <script src='https://www.google.com/recaptcha/api.js' async defer ></script>
           <script src="js/cleave.js"></script>
           <script src="js/cleave-phone.my.js"></script>
           <script src="js/register_validation.js"></script>
    </head>
    <body>
        <div class="container" style="width:330px; height:416.6px;">
           <div class="form-outer">
               <form action="#" method="POST" autocomplete="off">
                    <div class="page">
                        <img src="../images/header_footer/logo.png" width="80%" style="margin: 0 auto; padding-top: 20px;">
                        <div class="title">Account Created!!</div>
                        <div class="title_sub" style="text-align:left; padding-top: 20px;">An email has been sent to <?php echo $_SESSION['register_email']; ?>. Please follow the link in this email message to verify your account.</div>
                        <div class="button_field" style="margin-top: 30%;">
                        <button name="submit_btn">Login Now</button>
                        </div>
                   </div>
               </form>
            </div>      
        </div>
    </body>
</html>