<?php
    session_start();
    include '..\dataconnection.php';
    $alert_display = 0;
    $alert_display_con = "";
    if(isset($_POST['submit_btn']))
    {
        $email = $_POST['user_email'];
        $password = $_POST['user_cpass'];

        $pw = md5($password);

        $login_query = "select * from admin where admin_email = '$email' and admin_password = '$pw'";
        $login_query_run = mysqli_query($connect,$login_query);
        $row = mysqli_fetch_assoc($login_query_run);
        if(mysqli_num_rows($login_query_run) == 1)
        {
            if($row['Admin_unable']==1)
            {
                $alert_display = 1;
                $alert_display_con = "This account has been banned.";
            }
            else if($row['Admin_Verify']==1)
            {
                $_SESSION['admin_email']=$row['Admin_Email'];
                header("location:../index.php");
                exit;
            }
            else if($row['Admin_Verify']==0)
            {
                $alert_display = 1;
                $alert_display_con = "This account is not verify. Check your email.";
            }
            else
            {
                $alert_display = 1;
                $alert_display_con = "Something when wrong. Please try again later.";
            }
        }
        else
        {
            $alert_display = 1;
            $alert_display_con = "The email or the password you enter is incorrect.";
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <title>Concerta Admin</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/login.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src='https://www.google.com/recaptcha/api.js' async defer ></script>
        <script src="../js/login_validation.js"></script>
    </head>
    <body>
        <div class="container">
           <div class="form-outer">
               <form action="#" method="POST" autocomplete="off">
                    <div class="page">
                        <img src="../../images/header_footer/logo_admin.png" width="80%" style="margin: 0 auto; padding: 30px 0 10px 0;">
                        <div class="alert">
                            <span class="material-icons" style="vertical-align: middle; font-size: 20px;">error</span>
                            <label><?php echo $alert_display_con;?></label>
                        </div>
                            <div class="txt_field" style="clear:both; margin-top: 20px;">
                                <i class="material-icons" style="font-size: 32px; color:#3f89e7;">person</i>
                                <input type="email" id="user_email" name="user_email" class="checking_email">
                                <label>Email</label>
                                <label class="error_email" style="color: red; clear:both; top: 35px; font-size: 10px; padding: 0;"></label>
                            </div>
                            <div class="txt_field">
                                <i class="material-icons" style="font-size: 32px; color:#3f89e7;">lock</i>
                                <input id="cpw" type="password" name="user_cpass" class="checking_cpassword" maxlength="20">
                                <div class="password_visible">
                                    <input type="checkbox" onclick="showcpw()" tabindex="-1">
                                    <div class="icon-box1">
                                        <span class="material-icons">visibility</span>
                                    </div>
                                    <div class="icon-box2">
                                        <span class="material-icons">visibility_off</span>
                                    </div>
                                </div>
                                <label>Password</label>
                                <label class="error_cpassword" style="color: red; clear:both; top: 35px; font-size: 10px; padding: 0;" ></label>
                            </div>
                            <div class="txt_field">
                                <!-- RECAPTCHA -->
                                <div class="g-recaptcha" data-sitekey="6Ldf2FAaAAAAAIDST7wQ1m0aVQxAlhIpbxWDkQxO" data-callback="verifyCaptcha" style="transform:scale(1.02);-webkit-transform:scale(1.02);transform-origin:0 0;-webkit-transform-origin:0 0; margin-left: auto; margin-right: auto;"> </div>
                                <label class="error_captcha" style="color: red; clear:both; top: 80px; font-size: 10px; padding: 0; left: 15px; font-weight: 700;" ></label>
                            </div>
                            <div class="button_field">
                                <button class="submit" name="submit_btn" type="submit">Log in</button>
                            </div>
                   </div>
               </form>
            </div>      
        </div>
        <script>
        const submitBtn = document.querySelector(".submit");

        //page element
        var user_email = document.getElementById("user_email");
        var pw = document.getElementById("cpw");

        //page validation
        function validation()
        {
            var a, b;
            if(user_email.value === "" || user_email.value == null)
            {
                $('.error_email').text("*Please fill in this field");
                a = 1;
            }
            else if(email_error == 1)
                a = 1;
            else
                a = 0;
            
            if(pw.value === "" || pw.value == null)
            {
                $('.error_cpassword').text("*Please fill in this field");
                b = 1;
            }
            else if(password_error_blur == 1)
            {
                b = 1;
            }
            else
            {
                b = 0;
            }

            if(a==1||b==1) 
                return false;
            
            return true;
        }
            
        //captcha validation
        function verifyCaptcha()
        {
            $('.error_captcha').text("");
        }
                
        submitBtn.addEventListener("click", function(event){
            var a,b;
            var response = grecaptcha.getResponse();
            console.log(response.length)
            if(response.length == 0)
            {
                event.preventDefault();
                $('.error_captcha').text("*This field is required");
                a = 1;
            }
            else
                a = 0;

            if(validation())
                b = 0;
            else
                b = 1;
                
            if(a==1||b==1)
                return false;
                
            return true;
        });

        //show password function
        function showcpw(){
                var x = document.getElementById("cpw");
                if(x.type === "password")
                    x.type = "text";
                else
                    x.type = "password";
        }

        //close alert box function
        /*
        const alert = document.querySelector(".alert");
        const closebtn = document.querySelector(".closebtn");
        closebtn.addEventListener("click",function(event){
            alert.style.opacity = "0";
            setTimeout(function(){ alert.style.display = "none"; }, 600);
        });*/

        //alert box
        var alert_display = <?php echo $alert_display; ?>;
        const alert_dis = document.querySelector(".alert");
        if(alert_display == 1)
            alert_dis.style.opacity = "1";
        else
            alert_dis.style.opacity = "0";

        </script>
    </body>
</html>