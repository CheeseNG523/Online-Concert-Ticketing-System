<?php include 'header_sidebar.php'; 
    if($row['Admin_Gender']=="M")
        $gender = "Male";
    else if($row['Admin_Gender']=="F")
        $gender = "Female";
    else
        $gender = "Other";


  
    function hideEmailAddress($email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            list($first, $last) = explode('@', $email);
            $first = str_replace(substr($first, '3'), str_repeat('*', strlen($first)-3), $first);
            $hideEmailAddress = $first.'@'.$last;
            return $hideEmailAddress;
        }
    }
           
    $admin_email = $row['Admin_Email'];
?>
    <script src="js/profile_form.js"></script>
    <div class="page_position">
        <div class="position_left">
            <label>My Profile</label>
        </div>
        <div class="position_right">
            <a rel="tab" href="#">
				<span class="material-icons">dashboard</span><span class="icon_txt">Home</span>
			</a>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">My Profile</label>
        </div>
    </div>
    <div class="profile_container">
        <div class="profile-header" style="float:left;">
            <div class="image">
                <img src="<?php echo $admin_img; ?>" style="float:left;" width="50%" height="50%" class="profile_image" alt="">
            </div>
            <div class="nametag">
                <label class="user_name" style="color:#2e3849"><?php echo $admin_name; ?></label>
                <label style="font-size:14px; font-weight:500;" class="user_position"><?php echo $admin_position; ?></label>     
            </div>
        </div>
        <div class="profile-header" style="float:left;">
            <div class="profile-info">
                <label><span class="material-icons info">mail_outline</span><?php echo hideEmailAddress($admin_email); ?></label>
                <label><span class="material-icons info">stay_primary_portrait</span><?php echo $row['Admin_Contact']; ?></label>
                <label><span class="material-icons info">perm_identity</span><?php echo $gender; ?></label>
            </div>
        </div>
        <div class="profile-header" style="float:left; border:0;">
            <div class="setting-button">
                <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Change Email</button>
                <button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Change Password</button>
                <button data-backdrop="static" data-keyboard="false" onclick="document.getElementById('id03').style.display='block'" style="width:auto;">Change Profile</button>
                <!--Container Change Email-->
                <div id="id01" class="modal">       
                    <form class="modal-content animate change_email" action="" method="post" autocomplete="off">
                        <!--close button-->
                        <div class="imgcontainer">
                            <span onclick="clearEmail()" class="close" title="Close">&times;</span>
                        </div>

                        <div class="container">
                            <div class="page">
                                <div class="title">Change Email</div>
                                    <div class="alert email_alert">
                                        <span class="material-icons email_alert_icon" style="vertical-align: middle; font-size: 20px;"></span>
                                        <label class="change_email_alert"></label>
                                    </div>
                                    <div class="txt_field" style="clear:both; margin-top: 20px;">
                                        <input type="email" id="user_email" name="admin_current_email" class="checking_email">
                                        <label>Current Email</label>
                                        <label class="error_email" style="color: red; clear:both; top: 35px; font-size: 10px; padding: 0;"></label>
                                    </div>
                                    <div class="txt_field" style="clear:both; margin-top: 20px;">
                                        <input type="email" id="user_new_email" name="admin_new_email" class="checking_new_email">
                                        <label>New Email</label>
                                        <label class="error_new_email" style="color: red; clear:both; top: 35px; font-size: 10px; padding: 0;"></label>
                                    </div>
                                    <div class="txt_field">
                                        <input id="cpw" type="password" name="user_cpass" class="checking_cpassword" maxlength="20" style="border-radius: 5px 0 0 5px; border-right: transparent;">
                                        <div class="password_visible">
                                            <input type="checkbox" onclick="showcpw()" tabindex="-1" name="admin_password">
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
                                    <div class="button_field">
                                        <button class="email_submit" name="email_submit_btn" type="button" style="background-color:#4caf50">Change Email</button>
                                        <button type="button" onclick="clearEmail()" class="cancelbtn" style="background-color:#f44336">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!--Container Change Password-->
                <div id="id02" class="modal">
                    <form class="modal-content animate change_pass" action="" method="post" autocomplete="off">
                        <!--close button-->
                        <div class="imgcontainer">
                            <span onclick="clearPW()" class="close" title="Close Modal">&times;</span>
                        </div>

                        <div class="container">
                            <div class="page">
                                <div class="title">Change Password</div>
                                <div class="alert password_alert" style="margin: 10px 0;">
                                    <span class="material-icons password_alert_icon" style="vertical-align: middle; font-size: 20px;"></span>
                                    <label class="change_password_alert"></label>
                                </div>
                                <div class="txt_field">
                                    <input id="old_pw" type="password" name="old_admin_pass" class="checking_old_password" maxlength="20">
                                    <div class="password_visible">
                                        <input type="checkbox" onclick="showoldpw()" tabindex="-1">
                                        <div class="icon-box1">
                                            <span class="material-icons">visibility</span>
                                        </div>
                                        <div class="icon-box2">
                                            <span class="material-icons">visibility_off</span>
                                        </div>
                                    </div>
                                    <label>Old Password</label>
                                    <label class="error_old_password" style="color: red; clear:both; top: 35px; font-size: 10px; padding: 0;" ></label>
                                </div>
                                <div class="txt_field">
                                <input id="new_pw" type="password" name="admin_new_pass" class="checking_new_password" maxlength="20">
                                    <div class="password_visible">
                                        <input type="checkbox" onclick="shownewpw()" tabindex="-1">
                                        <div class="icon-box1">
                                            <span class="material-icons">visibility</span>
                                        </div>
                                        <div class="icon-box2">
                                            <span class="material-icons">visibility_off</span>
                                        </div>
                                    </div>
                                    <label>New Password</label>
                                    <label class="error_new_password" style="color: red; clear:both; top: 35px; font-size: 10px; padding: 0;" ></label>
                                </div>
                                <div class="txt_field">
                                    <input id="new_cpw" type="password" name="admin_new_cpass" class="checking_new_cpassword" maxlength="20">
                                    <div class="password_visible">
                                        <input type="checkbox" onclick="shownewcpw()" tabindex="-1">
                                        <div class="icon-box1">
                                            <span class="material-icons">visibility</span>
                                        </div>
                                        <div class="icon-box2">
                                            <span class="material-icons">visibility_off</span>
                                        </div>
                                    </div>
                                    <label>Confirm New Password</label>
                                    <label class="error_new_cpassword" style="color: red; clear:both; top: 35px; font-size: 10px; padding: 0;" ></label>
                                </div>
                                <div class="button_field">
                                    <button class="pass_submit" name="pass_submit_btn" type="button" style="background-color:#4caf50">Change Password</button>
                                    <button type="button" onclick="clearPW()" class="cancelbtn" style="background-color:#f44336">Cancel</button>
                                </div>
                                <div id="message" class="tooltiptext">
                                    <label style="color:white">Password must contain the following:</label>
                                    <label style="color:rgba(255, 0, 0, 0.8)" class="letter"><span class="material-icons cancel_icon4">cancel</span><span class="material-icons checked_icon4" style="display:none">check_circle</span>A lowercase letter</label>
                                    <label style="color:rgba(255, 0, 0, 0.8)" class="capital"><span class="material-icons cancel_icon3">cancel</span><span class="material-icons checked_icon3" style="display:none">check_circle</span>A capital (uppercase) letter</label>
                                    <label style="color:rgba(255, 0, 0, 0.8)" class="number"><span class="material-icons cancel_icon2" >cancel</span><span class="material-icons checked_icon2" style="display:none">check_circle</span>A number</label>
                                    <label style="color:rgba(255, 0, 0, 0.8)" class="special"><span class="material-icons cancel_icon5">cancel</span><span class="material-icons checked_icon5" style="display:none">check_circle</span>A special characters</label>
                                    <label style="color:rgba(255, 0, 0, 0.8)" class="length"><span class="material-icons cancel_icon1">cancel</span><span class="material-icons checked_icon1" style="display:none">check_circle</span>12-20 characters</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!--Container Change img-->
                <div id="id03" class="modal" style="padding-top:40px; overflow: hidden">
                    
                    <form class="modal-content animate change_img" action="" method="post" autocomplete="off">
                        <!--close button-->
                        <div class="imgcontainer">
                            <span onclick="clearImg()" class="close" title="Close Modal">&times;</span>
                        </div>

                        <div class="container">
                            <div class="page" style="margin-top: 25px">
                                <div class="wrapper">
                                    <div class="image">
                                        <img class="preimg" src="" alt="">
                                    </div>
                                    <div class="img-content" style="margin: 0 auto;">
                                    <div class="icon">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                    </div>
                                    <div class="text">No file chosen, yet!</div>
                                    <label class="error_locationimg" style="color: red; clear:both; font-size: 13px; padding: 0; font-weight:600"></label>
                                    </div>
                                    <div id="cancel-btn">
                                        <i class="fas fa-times"></i>
                                    </div>
                                    <div class="file-name">
                                        File name here
                                    </div>
                                </div>
                                <label id="custom-btn" style="margin: 10px 0" for="default-btn">Choose a file</label>
                                <input id="default-btn" name="file" type="file" hidden>
                                <div class="button_field">
                                    <button class="img_submit" name="img_submit_btn" type="button" style="background-color:#4caf50">Upload</button>
                                    <button type="button" onclick="clearImg()" class="cancelbtn" style="background-color:#f44336">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        //form element for reset form
        var change_email_form = document.querySelector('.change_email');
        var change_pass_form = document.querySelector('.change_pass');
        var change_img_form = document.querySelector('.change_img');

        //change profile img element
        const chooseImgBtn = document.querySelector("#custom-btn");
        const preimg = document.querySelector(".preimg");
        const wrapper = document.querySelector(".wrapper");
        const fileName = document.querySelector(".file-name");
        const defaultBtn = document.querySelector("#default-btn");
        const customBtn = document.querySelector("#custom-btn");
        const cancelBtn = document.querySelector("#cancel-btn i");
        const img = document.querySelector(".preimg");
        const page_img = document.querySelector(".profile_image");
        let regExp = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;


        // Get the modal
        var email_modal = document.getElementById('id01');
        var password_modal = document.getElementById('id02');
        var img_modal = document.getElementById('id03');

        //show password function
        function showcpw(){
            var x = document.getElementById("cpw");
            if(x.type === "password")
                x.type = "text";
            else
                x.type = "password";
        }
        function showoldpw(){
            var x = document.getElementById("old_pw");
            if(x.type === "password")
                x.type = "text";
            else
                x.type = "password";
        }
        function shownewpw(){
            var x = document.getElementById("new_pw");
            if(x.type === "password")
                x.type = "text";
            else
                x.type = "password";
        }
        function shownewcpw(){
            var x = document.getElementById("new_cpw");
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

        var myInput = document.getElementById("new_pw");
        // When the user clicks on the password field, show the message box
        myInput.onfocus = function() {
            document.getElementById("message").style.display = "block";
        }

        // When the user clicks outside of the password field, hide the message box
        myInput.onblur = function() {
            document.getElementById("message").style.display = "none";
        }

        defaultBtn.addEventListener("change", function(){
            const file = this.files[0];
            var fileInput =  document.getElementById('default-btn'); 
            var filePath = fileInput.value; 
            // Allowing file type 
            var allowedExtensions =  /(\.jpg|\.jpeg|\.png|\.gif)$/i; 
              
            if (!allowedExtensions.exec(filePath))
            { 
                img.src = "";
                wrapper.classList.remove("active");
                preimg.style.display = "none";
                $('.error_locationimg').text("*Invalid file format");
                fileInput.value = "";
                return false;
            }
            else if(file)
            {
                const reader = new FileReader();
                reader.onload = function(){
                    const result = reader.result;
                    img.src = result;
                    wrapper.classList.add("active");
                    preimg.style.display = "block";
                }

                cancelBtn.addEventListener("click", function(){
                    img.src = "";
                    wrapper.classList.remove("active");
                    preimg.style.display = "none";
                });
                reader.readAsDataURL(file);
            }
            if(this.value){
                let valueStore = this.value.match(regExp);
                fileName.textContent = valueStore;
            }
        });

        function clearEmail()
        {
            var email_alert_dis = document.querySelector(".email_alert");
            document.getElementById('id01').style.display='none';
            var a = document.getElementById("cpw");
            a.type = "password";
            email_modal.style.display = "none";
            change_email_form.reset();
            $('.error_email').text("");
            $('.error_new_email').text("");
            $('.error_cpassword').text("");
            email_alert_dis.style.opacity = "0";
        }

        function clearPW()
        {
            document.getElementById('id02').style.display='none';
            var x = document.getElementById("old_pw");
            var y = document.getElementById("new_pw");
            var z = document.getElementById("new_cpw");
            x.type = "password";
            y.type = "password";
            z.type = "password";
            var pass_alert_dis = document.querySelector(".password_alert");
            password_modal.style.display = "none";
            pass_alert_dis.style.opacity = "0";
            change_pass_form.reset();
            $('#message .length').css("color","rgba(255, 0, 0, 0.8)");
            $('#message .number').css("color","rgba(255, 0, 0, 0.8)");
            $('#message .capital').css("color","rgba(255, 0, 0, 0.8)");
            $('#message .letter').css("color","rgba(255, 0, 0, 0.8)");
            $('#message .special').css("color","rgba(255, 0, 0, 0.8)");
            $('#message .checked_icon1').css("display","inline-block");
            $('#message .cancel_icon1').css("display","none");
            $('#message .checked_icon1').css("display","none");
            $('#message .cancel_icon1').css("display","inline-block");
            $('#message .checked_icon2').css("display","inline-block");
            $('#message .cancel_icon2').css("display","none");
            $('#message .checked_icon2').css("display","none");
            $('#message .cancel_icon2').css("display","inline-block");
            $('#message .checked_icon3').css("display","none");
            $('#message .cancel_icon3').css("display","inline-block");
            $('#message .checked_icon4').css("display","none");
            $('#message .cancel_icon4').css("display","inline-block");
            $('#message .checked_icon5').css("display","none");
            $('#message .cancel_icon5').css("display","inline-block");
        }

        function clearImg()
        {
            document.getElementById('id03').style.display='none';
            img_modal.style.display = "none";
            change_img_form.reset();
            img.src = "";
            wrapper.classList.remove("active");
            preimg.style.display = "none";
        }
    </script>
<?php //if($_GET['rel']!='tab'){ echo "</div>";} ?>
<?php include('footer.php'); ?>