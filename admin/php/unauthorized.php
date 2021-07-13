<?php
    include '../dataconnection.php';
    session_start();
    if(!isset($_SESSION['admin_email']))
    {
        header("location: ..\login\login.php");
    }
    $title = "Unauthorized Access";//can do 404 page.
    $title_sub = "Your action have been recored.";
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
        <div class="container" style="width:330px; height:416.6px;">
           <div class="form-outer">
               <form action="#" method="POST" autocomplete="off">
                    <div class="page">
                        <img src="../../images/header_footer/logo_admin.png" width="80%" style="margin: 0 auto; padding-top: 20px;">
                        <div class="title" style="font-size: 18px; margin-top:50px;"><?php echo $title; ?></div>
                        <div class="title_sub" style="text-align:center; padding-top: 10%; font-size: 15px;"><?php echo $title_sub; ?></div>
                        <div class="title_sub count_down" style="text-align: center; font-size: 10px; color: grey; padding-top:10%;">Will be login out within <span id="counter" style="color: red;">10</span> second(s).</div>
                   </div>
               </form>
            </div>      
        </div>
        <script type="text/javascript">
            function countdown(){
                var i = document.getElementById('counter');
                i.innerHTML = parseInt(i.innerHTML)-1;
                
                if (parseInt(i.innerHTML)<=0)
                {
                    window.open('../php/admin_out.php','_self');
                }
            }
            setInterval(function(){ countdown(); },1000);
        </script>
    </body>
</html>