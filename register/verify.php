<?php
include '..\dataconnection.php';

if(isset($_GET['vkey']))
{
    $vkey = $_GET['vkey'];
    
    $result = mysqli_query($connect,"select verified,vkey from customer where verified = 0 and vkey = '$vkey'
    limit 1");

    if(mysqli_num_rows($result)==1)
    {
        $update = mysqli_query($connect,"update customer set verified = 1 where vkey = '$vkey' limit 1");
        if($update)
        {
            $title = "Email Verify Successful";//can do 404 page.
            $title_sub = "This account is invalid or verified.";
        }
    }
    else
    {
        $title = "Opps! Email Verify Fail";//can do 404 page.
        $title_sub = "This account is invalid or verified.";
    }
}
else
{
    $title = "Opps! Something went wrong";//can do 404 page.
    $title_sub = "This link is no longer avaliable.";
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
           <script src='https://www.google.com/recaptcha/api.js' async defer ></script>
           <script src="js/cleave.js"></script>
           <script src="js/cleave-phone.my.js"></script>
           <script src="js/register_validation.js"></script>
        <title>Email Verification</title>
    </head>
    <body>
        <div class="container" style="width:330px; height:416.6px;">
           <div class="form-outer">
               <form action="#" method="POST" autocomplete="off">
                    <div class="page">
                        <img src="../images/header_footer/logo.png" width="80%" style="margin: 0 auto; padding-top: 20px;">
                        <div class="title" style="font-size: 18px;"><?php echo $title; ?></div>
                        <div class="title_sub" style="text-align:center; padding-top: 10%; font-size: 15px;"><?php echo $title_sub; ?></div>
                        <div class="title_sub count_down" style="text-align: center; font-size: 10px; color: grey; padding-top:10%;">This window will close automatically within <span id="counter" style="color: red;">10</span> second(s).</div>
                   </div>
               </form>
            </div>      
        </div>
        <script type="text/javascript">
            function countdown() {
                var i = document.getElementById('counter');
                i.innerHTML = parseInt(i.innerHTML)-1;
                
                if (parseInt(i.innerHTML)<=0)
                {
                    window.close();
                }
            }
            setInterval(function(){ countdown(); },1000);
        </script>
    </body>
</html>