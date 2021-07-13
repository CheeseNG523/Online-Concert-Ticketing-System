$(document).ready(function (){
    var new_password_error_keyup_null = 3;
    var new_password_error_keyup = 3;

    //new pass
    $('.check-npass').keyup(function(){
        var keypassword_valid = $('.check-npass').val();
        $.ajax({
            type: "POST",
            url: "reset_pwd_validation.php",
            dataType: 'json',
            data: {
                    "new_password_submit_btn_keyup": 1,
                    "keypassword_valid": keypassword_valid,
            },
            success: function(respone){
                    $('.length').css("color",respone[0]);
                    $('.number').css("color",respone[1]);
                    $('.capital').css("color",respone[2]);
                    $('.letter').css("color",respone[3]);
                    $('.special').css("color",respone[4]);
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
                    new_password_error_keyup = respone[5];
                    new_password_error_keyup_null = respone[11];
                    if(new_password_error_keyup_null == 0)
                        $('.error-npass').text("");
                    // else
                    //     $('.error-npass').text("*Invalid password format");
            }
        });
    });

    $('.check-npass').blur(function(){
        var new_password_valid = $('.check-npass').val();
        //alert(password_valid);
        $.ajax({
            type: "POST",
            url: "reset_pwd_validation.php",
            dataType: 'json',
            data: {
                    "new_password_submit_btn_blur": 1,
                    "password_valid": new_password_valid,
            },
            success: function(respone){
                if(new_password_error_keyup_null == 1)
                {
                    $('.error-npass').text("*Please fill in this field");
                }
                else if(new_password_error_keyup == 0)
                {
                    $('.error-npass').text("*Invalid password format");
                    new_password_error_blur = 1;
                }
                else
                {
                    $('.error-npass').text(respone[0]);
                    new_password_error_blur = respone[1];
                }
            }
        });
    });

    //confirm pass
    $('.check-cpass').keyup(function(){
        var new_cpassword_valid = $('.check-cpass').val();
        var new_password_valid = $('.check-npass').val();
        $.ajax({
            type: "POST",
            url: "reset_pwd_validation.php",
            dataType: 'json',
            data: {
                    "new_cpassword_submit_btn": 1,
                    "cpassword_valid": new_cpassword_valid,
                    "password_valid": new_password_valid,
            },
            success: function(respone){
                $('.error-cpass').text(respone[0]);
                cpassword_error = respone[1];
            }
        });
    });

    $('.check-cpass').blur(function(){
        var new_cpassword_valid = $('.check-cpass').val();
        var new_password_valid = $('.check-npass').val();
        $.ajax({
            type: "POST",
            url: "reset_pwd_validation.php",
            dataType: 'json',
            data: {
                    "new_cpassword_submit_btn": 1,
                    "cpassword_valid": new_cpassword_valid,
                    "password_valid": new_password_valid,
            },
            success: function(respone){
                $('.error-cpass').text(respone[0]);
                cpassword_error = respone[1];
            }
        });
    });

    // /////////////admin part//////////////// //
    $('.sbbtn').on('click',function(){
        Swal.fire({
            icon: "warning",
            title: "Reset Password",
            text: 'Are you sure you want to reset your password?',
            showCancelButton: true,
            confirmButtonText: `Yes`,
            denyButtonText: `No`,
            
        }).then((result) => {
            if (result.isConfirmed)
            {
                if($('.check-npass').val() == "")
                    $('.error-npass').text("*Please fill in this field");
                
                if($('.check-cpass').val() == "")
                    $('.error-cpass').text("*Please fill in this field");

                if(typeof new_password_error_blur == 'undefined' || typeof cpassword_error == 'undefined')
                {
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please fill in all the field.', 
                        icon:'error',
                        onAfterClose: () => window.scrollTo(0,0)});
                }
                else if(new_password_error_blur == 1 || cpassword_error == 1)
                {
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please make sure data input is all valid.', 
                        icon:'error',
                    });
                }
                else if($('.check-cpass').val() == ""||$('.check-npass').val() == "")
                {
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please fill in all the field.', 
                        icon:'error',
                    });
                }
                else if($('.check-cpass').val() != $('.check-npass').val())
                {
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please make sure confirm password and new password are matched.', 
                        icon:'error',
                    });
                }
                else
                {
                    var form_data = $('.resetpwdfrm').serializeArray();
                    form_data.push({name: "change_password_submit_btn", value: 1});
                    $.ajax({
                        type: "POST",
                        url: "reset_pwd_validation.php",
                        data: form_data,
                        success: function(respone)
                        {
                            if(respone[3]==1)
                            {
                                Swal.fire({
                                    title:'Oops!', 
                                    text:'Your new password cannot same with current password.', 
                                    icon:'error',
                                    didClose: () => window.scrollTo(0,0)});
                            }
                            else
                            {
                                Swal.fire({
                                        title:'Successful!', 
                                        text:'Please login again to continue.', 
                                        icon:'success',
                                        didClose: () => 
                                        window.open("../login.php", "_self")});
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
});