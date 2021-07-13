$(document).ready(function (){
    //var password_error_keyup_null = 3;
    //var password_error_keyup = 3;
    /*$('.checking_fname').blur(function(){
        var fname_valid = $('.checking_fname').val();
        $.ajax({
            type: "POST",
            url: "../php/validation/login_validation.php",
            dataType: 'json',
            data: {
                    "fname_submit_btn": 1,
                    "fname_valid": fname_valid,
            },
            success: function(respone){
                $('.error_fname').text(respone[0]);
                fname_error = respone[1];
            }
        });
    });*/

    /*$('.checking_lname').blur(function(){
        var lname_valid = $('.checking_lname').val();
        $.ajax({
            type: "POST",
            url: "../php/validation/login_validation.php",
            dataType: 'json',
            data: {
                    "lname_submit_btn": 1,
                    "lname_valid": lname_valid,
            },
            success: function(respone){
                $('.error_lname').text(respone[0]);
                lname_error = respone[1];
            }
        });
    });*/

    $('.checking_email').keyup(function(){
        var emaill = $('.checking_email').val();
        $.ajax({
            type: "POST",
            url: "../php/validation/login_validation.php",
            dataType: 'json',
            data: {
                    "email_submit_btn": 1,
                    "emaill_id" : emaill,
            },
            success: function(respone){
                $('.error_email').text(respone[0]);
                email_error = respone[1];
            }
        });
    });

    $('.checking_email').blur(function(){
        var emaill = $('.checking_email').val();
        $.ajax({
            type: "POST",
            url: "../php/validation/login_validation.php",
            dataType: 'json',
            data: {
                    "email_submit_btn": 1,
                    "emaill_id" : emaill,
            },
            success: function(respone){
                $('.error_email').text(respone[0]);
                email_error = respone[1];
            }
        });
    });

    $('.checking_cpassword').keyup(function(){
        var cpassword_valid = $('.checking_cpassword').val();
        $.ajax({
            type: "POST",
            url: "../php/validation/login_validation.php",
            dataType: 'json',
            data: {
                    "cpassword_submit_btn": 1,
                    "cpassword_valid": cpassword_valid,
            },
            success: function(respone){
                $('.error_cpassword').text(respone[0]);
                cpassword_error = respone[1];
            }
        });
    });

    $('.checking_cpassword').blur(function(){
        var cpassword_valid = $('.checking_cpassword').val();
        $.ajax({
            type: "POST",
            url: "../php/validation/login_validation.php",
            dataType: 'json',
            data: {
                    "cpassword_submit_btn": 1,
                    "cpassword_valid": cpassword_valid,
            },
            success: function(respone){
                $('.error_cpassword').text(respone[0]);
                cpassword_error = respone[1];
            }
        });
    });

    /*$('.checking_phone').blur(function(){
        var phone_valid = $('.checking_phone').val();
        $.ajax({
            type: "POST",
            url: "../php/validation/login_validation.php",
            dataType: 'json',
            data: {
                    "phone_submit_btn": 1,
                    "phone_valid" : phone_valid,
            },
            success: function(respone){
                $('.error_phone').text(respone[0]);
                phone_error = respone[1];
            }
        });
    });*/

    /*$('.checking_gender').blur(function(){
        var fname_valid = $('.checking_gender').val();
        $.ajax({
            type: "POST",
            url: "../php/validation/login_validation.php",
            dataType: 'json',
            data: {
                    "gender_submit_btn": 1,
                    "gender_valid": fname_valid,
            },
            success: function(respone){
                $('.error_gender').text(respone[0]);
                gender_error = respone[1];
            }
        });
    });*/

    /*$('.checking_dob').blur(function(){
        var fname_valid = $('.checking_dob').val();
        $.ajax({
            type: "POST",
            url: "../php/validation/login_validation.php",
            dataType: 'json',
            data: {
                    "dob_submit_btn": 1,
                    "dob_valid": fname_valid,
            },
            success: function(respone){
                $('.error_dob').text(respone[0]);
                dob_error = respone[1];
            }
        });
    });*/

    /*$('.checking_address').blur(function(){
        var address_valid = $('.checking_address').val();
        $.ajax({
            type: "POST",
            url: "../php/validation/login_validation.php",
            dataType: 'json',
            data: {
                    "address_submit_btn": 1,
                    "address_valid": address_valid,
            },
            success: function(respone){
                $('.error_address').text(respone[0]);
                address_error = respone[1];
            }
        });
    });*/

    /*$('.checking_state').blur(function(){
        var state_valid = $('.checking_state').val();
        $.ajax({
            type: "POST",
            url: "../php/validation/login_validation.php",
            dataType: 'json',
            data: {
                    "state_submit_btn": 1,
                    "state_valid": state_valid,
            },
            success: function(respone){
                $('.error_state').text(respone[0]);
                state_error = respone[1];
            }
        });
    });*/

    /*$('.checking_city').blur(function(){
        var city_valid = $('.checking_city').val();
        $.ajax({
            type: "POST",
            url: "../php/validation/login_validation.php",
            dataType: 'json',
            data: {
                    "city_submit_btn": 1,
                    "city_valid": city_valid,
            },
            success: function(respone){
                $('.error_city').text(respone[0]);
                city_error = respone[1];
            }
        });
    });*/

    /*$('.checking_postcode').blur(function(){
        var postcode_valid = $('.checking_postcode').val();
        $.ajax({
            type: "POST",
            url: "../php/validation/login_validation.php",
            dataType: 'json',
            data: {
                    "postcode_submit_btn": 1,
                    "postcode_valid" : postcode_valid,
            },
            success: function(respone){
                $('.error_postcode').text(respone[0]);
                postcode_error = respone[1];
            }
        });
    });*/

    /*$('.checking_password').keyup(function(){
        var keypassword_valid = $('.checking_password').val();
        $.ajax({
            type: "POST",
            url: "../php/validation/login_validation.php",
            dataType: 'json',
            data: {
                    "password_submit_btn_keyup": 1,
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
                    password_error_keyup = respone[5];
                    password_error_keyup_null = respone[11];
            }
        });
    });*/

    /*$('.checking_password').blur(function(){
        var password_valid = $('.checking_password').val();
        //alert(password_valid);
        $.ajax({
            type: "POST",
            url: "../php/validation/login_validation.php",
            dataType: 'json',
            data: {
                    "password_submit_btn_blur": 1,
                    "password_valid": password_valid,
            },
            success: function(respone){
                if(password_error_keyup_null == 1)
                {
                    $('.error_password').text("*Please fill in this field");
                }
                else if(password_error_keyup == 0)
                {
                    $('.error_password').text("*Invalid password format");
                    password_error_blur = 1;
                }
                else
                {
                    $('.error_password').text(respone[0]);
                    password_error_blur = respone[1];
                }
            }
        });
    });*/
});