$(document).ready(function(){
    /**
     * CHANGE PROFILE PICTURE STARTS
     */
    const img = document.querySelector(".preimg");
    const wrapper = document.querySelector(".wrapper");
    const preimg = document.querySelector(".preimg");
    const fileName = document.querySelector(".file-name");
    const defaultBtn = document.querySelector("#default-btn");
    // const customBtn = document.querySelector("#custom-btn");
    const cancelBtn = document.querySelector("#cancel-btn i");
    // const page_img = document.querySelector(".profile_image");
    let regExp = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;

    var pic_modal = document.getElementById("Pic_Modal");
    var change_img_form = document.querySelector('.change_img');

    $('.prof_pic').on('click', function(){
        pic_modal.style.display = "block";
    })

    //When user clicks cancel button, close the modal
    $('.cancelbtn').on('click', function()
    {
        pic_modal.style.display = "none";
        change_img_form.reset();
        img.src = "";
        img.style.display = "none";
        wrapper.classList.remove("active");
    })

    // When the user clicks on <span> (x), close the modal
    $('.close').on('click', function(){
        pic_modal.style.display = "none";
        change_img_form.reset();
        img.src = "";
        img.style.display = "none";
        wrapper.classList.remove("active");
    })

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == pic_modal) {
            pic_modal.style.display = "none";
            change_img_form.reset();
            img.src = "";
            wrapper.classList.remove("active");
            preimg.style.display = "none";
            $(".img_alert").css("opacity","0");
        }
    }

    //preview img
    defaultBtn.addEventListener("change", function(){
        const file = this.files[0];
        if(file)
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

    //upload profile pic
    $(".img_submit").click(function(){
        Swal.fire({
            icon: "warning",
            title: "Update Profile",
            text: 'Are you sure you want to update your profile?',
            showCancelButton: true,
            confirmButtonText: `Yes`,
            denyButtonText: `No`,
            
        }).then((result) => {
            if (result.isConfirmed)
            {
                var img_location  = document.getElementById('default-btn');
                var img_location_path = img_location.value;
                if(img_location_path == "" || img_location_path == null)
                {
                    $('.error_locationimg').text("*No file selected");
                    Swal.fire({
                        title:'Oops!', 
                        text:'No file selected', 
                        icon:'error',
                    });
                }
                else
                {
                    const defaultBtn = document.querySelector("#default-btn");
                    var property = defaultBtn.files[0];
                    var formData = new FormData();
                    formData.append("file",property);
                    $.ajax({
                        type: "POST",
                        url: "cust_profile_validation.php",
                        data: formData,
                        cache: false,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function(respone)
                        {
                            if(respone)
                            {
                                Swal.fire({
                                    title:'Successfully!', 
                                    text:'Profile has been updated.', 
                                    icon:'success',
                                    didClose: () => 
                                    location.reload()
                                });
                            }
                            else
                            {
                                Swal.fire({
                                    title:'Oops! Something went wrong...', 
                                    text:'Please try again later', 
                                    icon:'error',
                                    didClose: () => window.scrollTo(0,0)});
                            }
                        },
                        error: function()
                        {
                            Swal.fire({
                                title:'Oops! Something went wrong...', 
                                text:'Please try again later', 
                                icon:'error',
                                didClose: () => window.scrollTo(0,0)});
                        }
                    });
                }
            }
        });
    });

    /**
     * CHANGE PROFILE PICTURE ENDS 
     * 
     * UPDATE USER PROFILE STARTS
     */

    var cust_fname = $('.cust_fname').val();
    var cust_lname = $('.cust_lname').val();
    var cust_gender = $('.cust_gender').val();
    var cust_ph_num = $('.cust_phone').val();
    var cust_address = $('.cust_address').val();
    var cust_postcode = $('.cust_postcode').val();
    var cust_state = $('.cust_state').val();
    var cust_city = $('.cust_city').val();
    var a, b, c, d, e, f, g; //for validation

    //get current value of every field and alert user when input wrong
    //FIRST NAME
    $('.cust_fname').on('change keyup', function(){ 
        cust_fname = $('.cust_fname').val(); 
    
        if(cust_fname == "" || cust_fname == null)
            $('.cust_fname').css('background-color', "rgba(191, 63, 63, 0.5)");
        else
            $('.cust_fname').css('background-color', "rgba(63, 191, 191, 0.2)");
    })

    //LAST NAME
    $('.cust_lname').on('change keyup', function(){ 
        cust_lname = $('.cust_lname').val(); 
    
        if(cust_lname == "" || cust_lname == null)
            $('.cust_lname').css('background-color', "rgba(191, 63, 63, 0.5)");
        else
            $('.cust_lname').css('background-color', "rgba(63, 191, 191, 0.2)");
    })

    //GENDER - only male or female to choose, no change of background color and validation
    $('.cust_gender').on('change', function(){ cust_gender = $('.cust_gender').val(); })

    //PHONE NUMBER
    $('.cust_phone').on('change keyup', function(){ 
        cust_ph_num = $('.cust_phone').val(); 

        if(cust_ph_num === "" || cust_ph_num == null)
        {
            c = 2;
            $('.cust_phone').css('background-color', "rgba(191, 63, 63, 0.5)");
        }
        else if(cust_ph_num.includes("+60") == true || cust_ph_num.length > 13)
        {
            c = 1;
            $('.cust_phone').css('background-color', "rgba(191, 63, 63, 0.5)");
        }
        else
        {
            c = 0;
            $('.cust_phone').css('background-color', "rgba(63, 191, 191, 0.2)");
        }
    })

    //ADDRESS
    $('.cust_address').on('change keyup', function(){ 
        cust_address = $('.cust_address').val(); 

        if(cust_address === "" || cust_address == null)
            $('.cust_address').css('background-color', "rgba(191, 63, 63, 0.5)");
        else
            $('.cust_address').css('background-color', "rgba(63, 191, 191, 0.2)");
    })

    //POSTCODE
    $('.cust_postcode').on('change keyup', function(){ 
        cust_postcode = $('.cust_postcode').val(); 
        
        if(cust_postcode === "" || cust_address == null)
            $('.cust_postcode').css('background-color', "rgba(191, 63, 63, 0.5)");
        else if(cust_postcode.length != 5)
            $('.cust_postcode').css('background-color', "rgba(191, 63, 63, 0.5)");
        else
            $('.cust_postcode').css('background-color', "rgba(63, 191, 191, 0.2)");
    })

    //STATE
    $('.cust_state').on('change', function(){ 
        cust_state = $('.cust_state').val();

        if(cust_state == null)
            $('.cust_state').css('background-color', "rgba(191, 63, 63, 0.5)");
        else
            $('.cust_state').css('background-color', "rgba(63, 191, 191, 0.2)");
    })

    //CITY
    $('.cust_city').on('change keyup', function(){ 
        cust_city = $('.cust_city').val(); 
    
        if(cust_city === "" || cust_city == null)
            $('.cust_city').css('background-color', "rgba(191, 63, 63, 0.5)");
        else
            $('.cust_city').css('background-color', "rgba(63, 191, 191, 0.2)");
    })

    //when button is clicked
    $('.edit_submit_btn').on('click', function(event){
        event.preventDefault();
        
        //first name
        if(cust_fname == "" || cust_fname == null)
        {
            a = 1;
            $('.cust_fname').css('background-color', "rgba(191, 63, 63, 0.5)");
        }
        else
        {
            a = 0;
            $('.cust_fname').css('background-color', "rgba(63, 191, 191, 0.2)");
        }

        //last name
        if(cust_lname == "" || cust_lname == null)
        {
            b = 1;
            $('.cust_lname').css('background-color', "rgba(191, 63, 63, 0.5)");
        }
        else
        {
            b = 0;
            $('.cust_lname').css('background-color', "rgba(63, 191, 191, 0.2)");
        }
        
        //phone number
        if(cust_ph_num === "" || cust_ph_num == null)
        {
            c = 2;
            $('.cust_phone').css('background-color', "rgba(191, 63, 63, 0.5)");
        }
        else if(cust_ph_num.includes("+60") == true || cust_ph_num.length > 13)
        {
            c = 1;
            $('.cust_phone').css('background-color', "rgba(191, 63, 63, 0.5)");
        }
        else
        {
            c = 0;
            $('.cust_phone').css('background-color', "rgba(63, 191, 191, 0.2)");
        }
        
        //address
        if(cust_address === "" || cust_address == null)
        {
            d = 1;
            $('.cust_address').css('background-color', "rgba(191, 63, 63, 0.5)");
        }
        else
        {
            d = 0;
            $('.cust_address').css('background-color', "rgba(63, 191, 191, 0.2)");
        }

        //postcode
        if(cust_postcode === "" || cust_address == null)
        {
            e = 2;
            $('.cust_postcode').css('background-color', "rgba(191, 63, 63, 0.5)");
        }
        else if(cust_postcode.length != 5)
        {
            e = 1;
            $('.cust_postcode').css('background-color', "rgba(191, 63, 63, 0.5)");
        }
        else
        {
            e = 0;
            $('.cust_postcode').css('background-color', "rgba(63, 191, 191, 0.2)");
        }

        //state
        if(cust_state == null)
        {
            f = 1;
            $('.cust_state').css('background-color', "rgba(191, 63, 63, 0.5)");
        }
        else
        {
            f = 0;
            $('.cust_state').css('background-color', "rgba(63, 191, 191, 0.2)");
        }

        //city
        if(cust_city === "" || cust_city == null)
        {
            g = 1;
            $('.cust_city').css('background-color', "rgba(191, 63, 63, 0.5)");
        }
        else
        {
            g = 0;
            $('.cust_city').css('background-color', "rgba(63, 191, 191, 0.2)");
        }

        //if everything correct, proceed submission
        if(a==0 && b==0 && c==0 && d==0 && e==0 && f==0 && g==0)
        {
            $.ajax({
                type: "POST",
                url: "cust_profile_validation.php",
                dataType: 'json',
                data: {
                    "profile_btn": 1,
                    "C_fname": cust_fname,
                    "C_lname": cust_lname,
                    "C_gender": cust_gender,
                    "C_phone_num": cust_ph_num,
                    "C_address": cust_address,
                    "C_postcode": cust_postcode,
                    "C_state": cust_state,
                    "C_city": cust_city,
                },
                success: function(respone){
                    console.log(respone);
                    Swal.fire({
                        icon:'success',
                        title:'Successful!',
                        text:'Profile updated successfully',
                        didClose: () => window.scrollTo(0,0)});
                },
                error: function(){
                    Swal.fire({
                        title:'Oops...', 
                        text:'Please try again later', 
                        icon:'error',
                        didClose: () => window.scrollTo(0,0)});
                }
            });
        }
        else if(a==1 || b==1 || c==2 || d==1 || e==2 || f==1 || g==1)
        {
            // console.log("wrong");
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please fill in all the required field'
            })
        }
        else if(c==1)
        {
            //console.log("phone num salah");
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Invalid Phone Number'
            })
        }
        else if(e==1)
        {
            //console.log("postcode salah");
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Invalid Postcode'
            })
        }
    })

    /**
     * UPDATE USER PROFILE ENDS
     * 
     * CHANGE PASSWORD STARTS
     */

    var old_password = $('.current_pass').val();
    var new_password = $('.new_pass').val();
    var conf_new_pass = $('.confirm_new_pass').val();
    var new_password_fail_validate = 1;
    var new_password_null = 1;

    //check old password
    $('.current_pass').on('keyup blur', function(){
        old_password = $('.current_pass').val();
        new_password = $('.new_pass').val();

        if(old_password == null || old_password == "")
        {
            $('.current_pass').css('background-color', "rgba(191, 63, 63, 0.5)");
        }
        else if(new_password == old_password)
        {
            $('.new_pass').css('background-color', "rgba(191, 63, 63, 0.5)");
        }
        else
        {
            $('.new_pass').css('background-color', "rgba(63, 191, 191, 0.2)");
            $('.current_pass').css('background-color', "rgba(63, 191, 191, 0.2)");
        }
    });

    //check confirm new password
    $('.confirm_new_pass').on('keyup blur', function(){
        conf_new_pass = $('.confirm_new_pass').val();

        if(conf_new_pass == null || conf_new_pass == "")
        {
            $('.confirm_new_pass').css('background-color', "rgba(191, 63, 63, 0.5)");
        }
        else if(conf_new_pass != new_password)
        {
            $('.confirm_new_pass').css('background-color', "rgba(191, 63, 63, 0.5)");
        }
        else
        {
            $('.confirm_new_pass').css('background-color', "rgba(63, 191, 191, 0.2)");
            $('.confirm_new_pass').css('background-color', "rgba(63, 191, 191, 0.2)");
        }
    });

    //new pass
    $('.new_pass').on('keyup blur', function(){
        new_password = $('.new_pass').val();
        old_password = $('.current_pass').val();
        conf_new_pass = $('.confirm_new_pass').val();

        //change everything to original if no value entered
        if(new_password == null || new_password == "")
        {
            $('.new_pass').css('background-color', "rgba(191, 63, 63, 0.5)");
            $('.length').css("color","rgba(255, 0, 0, 0.8)");
            $('.number').css("color","rgba(255, 0, 0, 0.8)");
            $('.capital').css("color","rgba(255, 0, 0, 0.8)");
            $('.letter').css("color","rgba(255, 0, 0, 0.8)");
            $('.special').css("color","rgba(255, 0, 0, 0.8)");
            $('.checked_icon1').css("display","none");
            $('.cancel_icon1').css("display","inline-block");
            $('.checked_icon2').css("display","none");
            $('.cancel_icon2').css("display","inline-block");
            $('.checked_icon3').css("display","none");
            $('.cancel_icon3').css("display","inline-block");
            $('.checked_icon4').css("display","none");
            $('.cancel_icon4').css("display","inline-block");
            $('.checked_icon5').css("display","none");
            $('.cancel_icon5').css("display","inline-block");
        }
        else
        {
            $.ajax({
                type: "POST",
                url: "cust_profile_validation.php",
                dataType: 'json',
                data: {
                    "new_pass_keyup": 1,
                    "c_new_pass": new_password,
                },
                success: function(respone)
                {
                    $('.length').css("color",respone[0]);
                    $('.number').css("color",respone[1]);
                    $('.capital').css("color",respone[2]);
                    $('.letter').css("color",respone[3]);
                    $('.special').css("color",respone[4]);

                    //change all validate to red when password is not entered
                    if(respone[11] == 1)
                    {
                        $('.length').css("color","rgba(255, 0, 0, 0.8)");
                        $('.number').css("color","rgba(255, 0, 0, 0.8)");
                        $('.capital').css("color","rgba(255, 0, 0, 0.8)");
                        $('.letter').css("color","rgba(255, 0, 0, 0.8)");
                        $('.special').css("color","rgba(255, 0, 0, 0.8)");
                        $('.checked_icon1').css("display","none");
                        $('.cancel_icon1').css("display","inline-block");
                        $('.checked_icon2').css("display","none");
                        $('.cancel_icon2').css("display","inline-block");
                        $('.checked_icon3').css("display","none");
                        $('.cancel_icon3').css("display","inline-block");
                        $('.checked_icon4').css("display","none");
                        $('.cancel_icon4').css("display","inline-block");
                        $('.checked_icon5').css("display","none");
                        $('.cancel_icon5').css("display","inline-block");
                    }
                    else
                    {
                        if(respone[6] === 1)
                        {
                            $('.checked_icon1').css("display","inline-block");
                            $('.cancel_icon1').css("display","none");
                        }
                        else
                        {
                            $('.checked_icon1').css("display","none");
                            $('.cancel_icon1').css("display","inline-block");
                        }
        
                        if(respone[7] === 1)
                        {
                            $('.checked_icon2').css("display","inline-block");
                            $('.cancel_icon2').css("display","none");
                        }
                        else
                        {
                            $('.checked_icon2').css("display","none");
                            $('.cancel_icon2').css("display","inline-block");
                        }
                        if(respone[8] === 1)
                        {
                            $('.checked_icon3').css("display","inline-block");
                            $('.cancel_icon3').css("display","none");
                        }
                        else
                        {
                            $('.checked_icon3').css("display","none");
                            $('.cancel_icon3').css("display","inline-block");
                        }
        
                        if(respone[9] === 1)
                        {
                            $('.checked_icon4').css("display","inline-block");
                            $('.cancel_icon4').css("display","none");
                        }
                        else
                        {
                            $('.checked_icon4').css("display","none");
                            $('.cancel_icon4').css("display","inline-block");
                        }
        
                        if(respone[10] === 1)
                        {
                            $('.checked_icon5').css("display","inline-block");
                            $('.cancel_icon5').css("display","none");
                        }
                        else
                        {
                            $('.checked_icon5').css("display","none");
                            $('.cancel_icon5').css("display","inline-block");
                        }
                    }
                    
                    new_password_fail_validate = respone[5];
                    new_password_null = respone[11];
                    // if(new_password_error_keyup_null == 0)
                    //     $('.error-npass').text("");
                    // else
                    //     $('.error-npass').text("*Invalid password format");
                }
            });

            if(new_password == old_password)
            {
                $('.new_pass').css('background-color', "rgba(191, 63, 63, 0.5)");
                $('.confirm_new_pass').css('background-color', "rgba(63, 191, 191, 0.2)");
            }
            else if(conf_new_pass != new_password)
            {
                $('.confirm_new_pass').css('background-color', "rgba(191, 63, 63, 0.5)");
            }
            else if(new_password_fail_validate == 1)
            {
                $('.new_pass').css('background-color', "rgba(191, 63, 63, 0.5)");
                $('.confirm_new_pass').css('background-color', "rgba(63, 191, 191, 0.2)");
            }
            else
            {
                $('.new_pass').css('background-color', "rgba(63, 191, 191, 0.2)");
                $('.confirm_new_pass').css('background-color', "rgba(63, 191, 191, 0.2)");
            }
        }
    });

    //SUBMISSION
    $('.pass_edit_submit_btn').on('click', function(event){
        event.preventDefault();
        new_password = $('.new_pass').val();
        old_password = $('.current_pass').val();
        conf_new_pass = $('.confirm_new_pass').val();

        Swal.fire({
            icon: "warning",
            title: "Change Password",
            text: 'Are you sure you want to change your password?',
            showCancelButton: true,
            confirmButtonText: `Yes`,
            denyButtonText: `No`,
            
        }).then((result) => {
            if(result.isConfirmed)
            {
                if(new_password_null == 1 || old_password == null || old_password == "")
                {
                    // console.log("new password takde");
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please fill in all the field.', 
                        icon:'error',
                        didClose: () => window.scrollTo(0,0)});
                }
                else if(conf_new_pass == null || conf_new_pass == "")
                {
                    // console.log("confirm password takde");
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please confirm your new password.', 
                        icon:'error',
                        didClose: () => window.scrollTo(0,0)});
                }
                else if(old_password == new_password)
                {
                    // console.log("pass lama sama dgn yg baru");
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please make sure your new password cannot be same with your current password.', 
                        icon:'error',
                        didClose: () => window.scrollTo(0,0)});
                }
                else if(conf_new_pass != new_password)
                {
                    //console.log("confirm pass salah");
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please confirm your password correctly.', 
                        icon:'error',
                        didClose: () => window.scrollTo(0,0)});
                }
                else if(new_password_fail_validate == 1)
                {
                    //console.log("new password salah format "+new_password_fail_validate);
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please make sure password format is correct.', 
                        icon:'error',
                        didClose: () => window.scrollTo(0,0)});
                }
                else
                {
                    new_password = $('.new_pass').val();
                    old_password = $('.current_pass').val();

                    $.ajax({
                        type: "POST",
                        url: "cust_profile_validation.php",
                        data: {
                            "update_new_pass": 1,
                            "cust_new_pass": new_password,
                            "cust_old_pass": old_password,
                        },
                        success: function(respone)
                        {
                            //console.log(respone[0]);
                            if(respone==1)
                            {
                                Swal.fire({
                                    title:'Oops!', 
                                    text:'Your current password is not matched', 
                                    icon:'error',
                                    didClose: () => window.scrollTo(0,0)});
                            }
                            else
                            {
                                Swal.fire({
                                    title:'Successful!', 
                                    text:'Please login again to continue.', 
                                    icon:'success',
                                    didClose: () => window.open("login.php", "_self")});
                            }
                        },
                        error: function()
                        {
                            Swal.fire({
                                title:'Oops! Something went wrong...', 
                                text:'Please try again later', 
                                icon:'error',
                                didClose: () => window.scrollTo(0,0)});
                        }
                    });
                }
            }
            else
            {
                Swal.fire({
                    title:'No changes are made', 
                    icon:'info',
                }).then((result) => {
                    location.reload();
                });
            }
        });
    });
    /**
     * CHANGE PASSWORD ENDS
     */
});