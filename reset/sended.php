<?php
    include("../dataconnection.php");
    session_start();
  
    if(isset($_POST['back_btn']))
    {
        header("location: ../login.php");
    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <title>Email sended</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/sended.css">
    </head>
    <body>
        <div class="container">
           <div class="form-outer">
               <form action="#" method="POST" autocomplete="off">
                    <div class="page">
                        <img src="../images/header_footer/logo.png" width="80%" style="margin: 0 auto; padding-top: 20px;">
                        <div class="title">Email Sent!!</div>
                        <div class="title_sub" style="text-align:left; padding: 20px;">An email has been sent to <?php echo $_SESSION['email']; ?>. Please click the link in the email to reset your account password.</div>
                        <div class="button_field" style="margin-top: 10%;">
                        <button name="back_btn">Continue</button>
                        </div>
                   </div>
               </form>
            </div>      
        </div>
    </body>
</html>