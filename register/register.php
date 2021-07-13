<?php
    session_start();
    include '../dataconnection.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <title>Register</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src='https://www.google.com/recaptcha/api.js' async defer ></script>
        <script src="js/cleave.js"></script>
        <script src="js/cleave-phone.my.js"></script>
        <script src="js/register_validation.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="step-row">
                <div id="progress-bar"></div>
                <div class="step-block"><small>Step 1</small></div>
                <div class="step-block"><small>Step 2</small></div>
                <div class="step-block"><small>Step 3</small></div>
                <div class="step-block"><small>Step 4</small></div>
            </div>
           <div class="form-outer">
               <form id="form_submit" action="" method="POST" autocomplete="off">
                   <div class="page firstpage">
                       <div class="title">CREATE ACCOUNT</div>
                            <div class="txt_field" style="width:45%; float:left;">
                                <input type="text" id="user_fname" name="user_fname" class="checking_fname textinput">
                                <label>First Name</label>
                                <label class="error_fname" style="color: red; clear:both; top: 35px; font-size: 10px; padding: 0;" ></label>
                            </div>
                            <div class="txt_field" style="width:45%; float:left; margin-left: 10%;">
                                <input type="text" id="user_lname" name="user_lname" class="checking_lname textinput">
                                <label>Last Name</label>
                                <label class="error_lname" style="color: red; clear:both; top: 35px; font-size: 10px; padding: 0;" ></label>
                            </div>
                            <div class="txt_field" style="clear:both;">
                                <input type="email" id="user_email" name="user_email" class="checking_email">
                                <label>Email</label>
                                <label class="error_email" style="color: red; clear:both; top: 35px; font-size: 10px; padding: 0;" ></label>
                            </div>
                            <div class="txt_field">
                                <input id="pw" type="password" name="user_pass" class="checking_password" maxlength="20">
                                <div class="password_visible">
                                    <input type="checkbox" onclick="showpw()" tabindex="-1">
                                    <div class="icon-box1">
                                        <span class="material-icons">visibility</span>
                                    </div>
                                    <div class="icon-box2">
                                        <span class="material-icons">visibility_off</span>
                                    </div>
                                </div>
                                <label>Password</label>
                                <label class="error_password" style="color: red; clear:both; top: 35px; font-size: 10px; padding: 0;" ></label>
                            </div>
                            <div class="txt_field">
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
                                <label>Confirm Password</label>
                                <label class="error_cpassword" style="color: red; clear:both; top: 35px; font-size: 10px; padding: 0;" ></label>
                            </div>
                            <div class="button_field">
                                <button class="nextBtn" name="email_validation" onkeydown="return false">Next</button>
                            </div>
                   </div>

                   <div class="page">
                        <div class="title">
                        <span id="user_name"></span>, welcome to Concerta
                        </div>
                        <div class="title">Personal Information</div>
                        <div class="txt_field">
                            <select id="select-country" readonly disabled style="width:20%; float:left; border-radius: 5px 0 0 5px; border-right: transparent;">
                                <option value="MY" disabled hidden selected>MY</option>
                            </select>
                            <input type="text" name="user_phone" id="user_phone"style="width:80%; float:left; border-radius:0px 5px 5px 0;" class="checking_phone" maxlength="13">
                            <label>Phone Number</label>
                            <label class="error_phone" style="color: red; clear:both; top: 35px; font-size: 10px; padding: 0;"></label>
                        </div>
                        <div class="txt_field">
                            <select name="user_gender" id="user_gender" style="clear:both;" class="checking_gender">
                                <option value="" disabled hidden selected></option>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                            <label>Gender</label>
                            <label class="error_gender" style="color: red; clear:both; top: 35px; font-size: 10px; padding: 0;" ></label>
                        </div>
                        <!--<div class="txt_field">
                            <input type="date" name="user_dob" max="2003-12-31" id="user_dob" onkeydown="return false" class="checking_dob">
                            <label>Date of Birth</label>
                            <label class="error_dob" style="color: red; clear:both; top: 35px; font-size: 10px; padding: 0;" ></label>
                        </div>-->
                        <div class="button_field" style="margin-top: 21%;">
                            <button class="prev-1 prev" onkeydown="return false">Previous</button>
                            <button class="next-1 next" onkeydown="return false">Next</button>
                        </div>
                    </div>

                   <div class="page">
                        <div class="title">Add new address?</div>
                        <br><br><br>
                        <div class="title_sub">Address will be use for shipping address.</div>
                        <div class="button_field" style="margin-top: 56%;">
                            <button class="prev-2 prev" onkeydown="return false">Previous</button>
                            <button class="later-1 prev" onkeydown="return false">Later</button>
                            <button class="next-2 next" onkeydown="return false">Next</button>
                        </div>
                   </div>

                   <div class="page">
                        <div class="title">Add new address</div>
                        <div class="title_sub">Address will be use for shipping address.</div>
                        <div class="txt_field">
                            <input type="text" name="address" id="address" class="checking_address textinput">
                            <label>Address</label>
                            <label class="error_address" style="color: red; clear:both; top: 35px; font-size: 10px; padding: 0;" ></label>
                        </div>
                        <div class="txt_field" style="top: -10%; width:45%; float:left;">
                            <select name="user_state" class="checking_state" id="state">
                                <option value="" hidden selected></option>
                                <option value="Johor">Johor</option>
                                <option value="Kedah">Kedah</option>
                                <option value="Kelantan">Kelantan</option>
                                <option value="Kuala Lumpur">Kuala Lumpur</option>
                                <option value="Labuan">Labuan</option>
                                <option value="Melaka">Melaka</option>
                                <option value="Negeri Sembilan">Negeri Sembilan</option>
                                <option value="Pahang">Pahang</option>
                                <option value="Perak">Perak</option>
                                <option value="Perlis">Perlis</option>
                                <option value="Penang">Penang</option>
                                <option value="Sabah">Sabah</option>
                                <option value="Sarawak">Sarawak</option>
                                <option value="Selangor">Selangor</option>
                                <option value="Terengganu">Terengganu</option>
                            </select>
                            <label>State</label>
                            <label class="error_state" style="color: red; clear:both; top: 35px; font-size: 10px; padding: 0;" ></label>
                        </div>
                        <div class="txt_field" style="top: -10%; width:45%; float:left; margin-left: 10%;">
                            <input type="text" name="city" id="city" class="checking_city textinput">
                            <label>City</label>
                            <label class="error_city" style="color: red; clear:both; top: 35px; font-size: 10px; padding: 0;" ></label>
                        </div>
                        <div class="txt_field" style="top: -10%; width:45%; clear:both;">
                            <input type="text" name="pcode" id="postcode" class="checking_postcode textinput" maxlength="5">
                            <label>Postcode</label>
                            <label class="error_postcode" style="color: red; clear:both; top: 35px; font-size: 10px; padding: 0;" ></label>
                        </div>
                        <div class="button_field" style="margin-top: 13%;">
                            <button class="prev-3 prev" onkeydown="return false">Previous</button>
                            <button class="next-3 next" onkeydown="return false">Next</button>
                        </div>
                   </div>

                   <div class="page">
                        <div class="title">Almost Done</div>
                        <input type='text' name="skip-step" hidden readonly class='skip-step'>
                        <div class="title_sub">To confirm your request, please check the box to let us know you're human.<br>(Sorry, no robots allowed.)</div>
                        <div class="txt_field">
                            <!-- RECAPTCHA -->
                            <div style="margin-left: auto; margin-right: auto;" class="g-recaptcha" data-sitekey="6Le3c_cZAAAAAC5YQjECjEfxTDINw6lVWewCjbEz" data-callback="verifyCaptcha"> </div>
                            <label class="error_captcha" style="color: red; clear:both; top: 80px; font-size: 10px; padding: 0; font-weight: 700;" ></label>
                        </div>
                        <div class="button_field" style="margin-top: 35%;">
                            <button class="prev-4 prev" onkeydown="return false">Previous</button>
                            <button type="type" class="submit">Submit</button>
                        </div>
                    </div>

                    <!--<div class="page">
                        <div class="title">Account Created!!</div>
                        <div class="title_sub">An email has been sent to <span id="user_email"></span>. Please follow the link in this email message to verify your account.</div>
                        <div class="button_field" style="margin-top: 20%;">
                        <button href="#">Login Now</button>
                        </div>
                   </div>-->
               </form>
            </div>      
        </div>
        <div id="message" class="tooltiptext">
            <label style="color:white">Password must contain the following:</label>
            <label style="color:rgba(255, 0, 0, 0.8)" class="letter"><span class="material-icons cancel_icon4">cancel</span><span class="material-icons checked_icon4" style="display:none">check_circle</span>A lowercase letter</label>
            <label style="color:rgba(255, 0, 0, 0.8)" class="capital"><span class="material-icons cancel_icon3">cancel</span><span class="material-icons checked_icon3" style="display:none">check_circle</span>A capital (uppercase) letter</label>
            <label style="color:rgba(255, 0, 0, 0.8)" class="number"><span class="material-icons cancel_icon2" >cancel</span><span class="material-icons checked_icon2" style="display:none">check_circle</span>A number</label>
            <label style="color:rgba(255, 0, 0, 0.8)" class="special"><span class="material-icons cancel_icon5">cancel</span><span class="material-icons checked_icon5" style="display:none">check_circle</span>A special characters</label>
            <label style="color:rgba(255, 0, 0, 0.8)" class="length"><span class="material-icons cancel_icon1">cancel</span><span class="material-icons checked_icon1" style="display:none">check_circle</span>12-20 characters</label>
        </div>
           <script>
                const slidePage = document.querySelector(".firstpage");
                const firstNextBtn = document.querySelector(".nextBtn");
                const prevBtn1 = document.querySelector(".prev-1");
                const nextBtn1 = document.querySelector(".next-1");
                const prevBtn2 = document.querySelector(".prev-2");
                const nextBtn2 = document.querySelector(".next-2");
                const prevBtn3 = document.querySelector(".prev-3");
                const prevBtn4 = document.querySelector(".prev-4");
                const nextBtn3 = document.querySelector(".next-3");
                const laterBtn = document.querySelector(".later-1");
                const submitBtn = document.querySelector(".submit");

                var progress = document.getElementById("progress-bar");
                

                //page 1 element
                var fname = document.getElementById("user_fname");
                var lname = document.getElementById("user_lname");
                var user_email = document.getElementById("user_email");
                var pw = document.getElementById("pw");
                var cpw = document.getElementById("cpw");

                //page 2 element
                var user_phone = document.getElementById("user_phone");
                var user_gender = document.getElementById("user_gender");
                //var user_dob = document.getElementById("user_dob");

                //page 4 element
                var address = document.getElementById("address");
                var state = document.getElementById("state");
                var city = document.getElementById("city");
                var postcode = document.getElementById("postcode");

                //password validation
                var pw_valid=  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,20}$/;

                //value from php validation
                var fname_error;
                var lname_error;
                var email_error;
                //var password_error;
                var cpassword_error;

                //contain number validation
                var hasNumber = /\d/;

                //to know user skip address page
                //default to 3 as blank
                var skippage = 3;

                //page validation
                function page1validation(){
                    var a, b, c, d, e;
                    if(fname.value === "" || fname.value == null)
                    {
                        $('.error_fname').text("*Please fill in this field");
                        a = 1;
                    }
                    else if(fname_error == 1)
                        a = 1;
                    else
                        a = 0;
                    
                    if(lname.value === "" || lname.value == null)
                    {
                        $('.error_lname').text("*Please fill in this field");
                        b = 1;
                    }
                    else if(lname_error == 1)
                    {
                        b = 1;
                    }
                    else
                        b = 0;

                    if(user_email.value === "" || user_email.value == null)
                    {
                        $('.error_email').text("*Please fill in this field");
                        c = 1;
                    }
                    else if(email_error == 1)
                        c = 1;
                    else
                        c = 0;

                    if(pw.value === "" || pw.value == null)
                    {
                        $('.error_password').text("*Please fill in this field");
                        d = 1;
                    }
                    else if(password_error_blur == 1)
                    {
                        d = 1;
                    }
                    else
                    {
                        d = 0;
                    }
                    
                    if(cpw.value === "" || cpw.value == null)
                    {
                        $('.error_cpassword').text("*Please fill in this field");
                        e = 1;
                    }
                    else if(cpassword_error == 1)
                        e = 1;
                    else
                        e = 0;

                    if(a==1||b==1||c==1||d==1||e==1)
                        return false;

                    return true;
                }

                function page2validation()
                {
                    var a, b;
                    if(user_phone.value === "" || user_phone.value == null)
                    {
                        $('.error_phone').text("*Please fill in this field");
                        a = 1;
                    }
                    else if(phone_error == 1)
                        a = 1;
                    else
                        a = 0;

                    if(user_gender.value === "" || user_gender.value == null)
                    {
                        $('.error_gender').text("*Please fill in this field");
                        b = 1;
                    }
                    else if(gender_error == 1)
                        b = 1;
                    else
                        b = 0;
                    
                    /*if(user_dob.value === "" || user_dob.value == null)
                    {
                        $('.error_dob').text("*Please fill in this field");
                        validation = 1;
                    }
                    else if(dob_error == 1)
                        validation = 1;
                    else
                        validation = 0;*/

                    if(a==1||b==1)
                        return false;

                    return true;
                }

                function page3validation()
                {
                    var a, b, c, d;
                    if(address.value === "" || address.value == null)
                    {
                        $('.error_address').text("*Please fill in this field");
                        a = 1;
                    }
                    else if(address_error == 1)
                        a = 1;
                    else
                        a = 0;
                    
                    if(state.value === "" || state.value == null)
                    {
                        $('.error_state').text("*Please fill in this field");
                        b = 1;
                    }
                    else if(state_error == 1)
                        b = 1;
                    else
                        b = 0;

                    if(city.value === "" || city.value == null)
                    {
                        $('.error_city').text("*Please fill in this field");
                        c = 1;
                    }
                    else if(city_error == 1)
                        c = 1;
                    else
                        c = 0;
                    
                    if(postcode.value === "" || postcode.value == null)
                    {
                        $('.error_postcode').text("*Please fill in this field");
                        d = 1;
                    }
                    else if(postcode_error == 1)
                        d = 1;
                    else
                        d = 0;
                    
                    if(a==1||b==1||c==1||d==1)
                        return false;

                    return true;
                }

                function verifyCaptcha()
                {
                    $('.error_captcha').text("");
                }
                //end of page validation
                
                submitBtn.addEventListener("click", function(event){
                    var response = grecaptcha.getResponse();
                    event.preventDefault();
                    console.log(response.length)
                    if(response.length == 0)
                    {
                        event.preventDefault();
                        $('.error_captcha').text("*This field is required");
                        return false;
                    }
                    else
                    {
                        var x = document.getElementById('form_submit');
                        var formData = new FormData(x);
                        formData.append("submit_btn",1);
                        $.ajax({
                            type: "POST",
                            url: "register_validation.php",
                            dataType: 'json',
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,
                            beforeSend: function() {
                                Swal.fire({
                                    title:'Please wait...', 
                                    text:'Sending an email.', 
                                    didOpen: () => {
                                        Swal.showLoading()
                                    }
                                });
                            },
                            success:function(data)
                            {
                                window.open('registered_success.php','_self');
                            }
                        });
                    }
                });

                firstNextBtn.addEventListener("click",function(event){
                    if(page1validation())
                        next1(event);
                    else
                        event.preventDefault();
                });

                nextBtn1.addEventListener("click",function(event){
                    if(page2validation())
                        next2(event);
                    else
                        event.preventDefault();
                });

                laterBtn.addEventListener("click",function(event){
                    event.preventDefault();
                    slidePage.style.marginLeft = "-80%";
                    progress.style.width = "400px";
                    skippage = 1;
                    $('.skip-step').val(1);
                });

                nextBtn2.addEventListener("click",function(event){
                    event.preventDefault();
                    slidePage.style.marginLeft = "-60%";
                    skippage = 0;
                });

                nextBtn3.addEventListener("click",function(event){
                    if(page3validation())
                    {
                        $('.skip-step').val(0);
                        next3(event);
                    }
                    else
                        event.preventDefault();
                });

                prevBtn1.addEventListener("click",function(event){
                    back1(event);
                });

                prevBtn2.addEventListener("click",function(event){
                    event.preventDefault();
                    slidePage.style.marginLeft = "-20%";
                    progress.style.width = "200px";
                });

                prevBtn3.addEventListener("click",function(event){
                    event.preventDefault();
                    slidePage.style.marginLeft = "-40%";
                });

                prevBtn4.addEventListener("click",function(){
                    if(skippage === 1)
                        back4(event);
                    else if(skippage === 0)
                        back5(event);
                });

                function next1(event){
                    event.preventDefault();
                    slidePage.style.marginLeft = "-20%";
                    progress.style.width = "200px";
                    document.getElementById("user_name").innerHTML = lname.value;
                }

                function next2(event){
                    event.preventDefault();
                    slidePage.style.marginLeft = "-40%";
                    progress.style.width = "300px";
                }

                function next3(event){
                    event.preventDefault();
                    slidePage.style.marginLeft = "-80%";
                    progress.style.width = "400px";
                }

                function back1(event){
                    event.preventDefault();
                    slidePage.style.marginLeft = "0%";
                    progress.style.width = "100px";
                }

                //if user skip address page
                function back4(event){
                    event.preventDefault();
                    slidePage.style.marginLeft = "-40%";
                    progress.style.width = "300px";
                }

                //if user does not skip address page
                function back5(event){
                    event.preventDefault();
                    slidePage.style.marginLeft = "-60%";
                    progress.style.width = "300px";
                }

                //show password
                function showcpw(){
                    var x = document.getElementById("cpw");
                    if(x.type === "password")
                        x.type = "text";
                    else
                        x.type = "password";
                }

                function showpw(){
                    var x = document.getElementById("pw");
                    if(x.type === "password")
                        x.type = "text";
                    else
                        x.type = "password";
                }

                var myInput = document.getElementById("pw");
                // When the user clicks on the password field, show the message box
                myInput.onfocus = function() {
                    document.getElementById("message").style.display = "block";
                }

                // When the user clicks outside of the password field, hide the message box
                myInput.onblur = function() {
                    document.getElementById("message").style.display = "none";
                }
           </script>
           <script>
                var cleave = new Cleave('#user_phone',{
                    phone:true,
                    phoneRegionCode: 'MY'
                });
            </script>
    </body>
</html>