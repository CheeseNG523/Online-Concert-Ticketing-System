$(document).ready(function (){
    var new_password_error_keyup_null = 3;
    var new_password_error_keyup = 3;
    var new_admin_password_error_keyup_null = 3;
    var new_admin_password_error_keyup = 3;

    //merchandise
    $('.checking_merch_name').keyup(function(){
        var text_valid = $('.checking_merch_name').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "check_merchandise_name": 1,
                    "text_valid": text_valid,
            },
            success: function(respone){
                $('.error_merch_name').text(respone[0]);
                merch_name_error = respone[1];
            }
        });
    });

    $('.checking_merch_name').blur(function(){
        var text_valid = $('.checking_merch_name').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "check_merchandise_name": 1,
                    "text_valid": text_valid,
            },
            success: function(respone){
                $('.error_merch_name').text(respone[0]);
                merch_name_error = respone[1];
            }
        });
    });

    $('.checking_update_merch_name').keyup(function(){
        var text_valid = $('.checking_update_merch_name').val();
        var id = $('.merch_id').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "check_update_merchandise_name": 1,
                    "text_valid": text_valid,
                    "id":id,
            },
            success: function(respone){
                $('.error_merch_name').text(respone[0]);
                merch_name_error = respone[1];
            }
        });
    });

    $('.checking_update_merch_name').blur(function(){
        var text_valid = $('.checking_update_merch_name').val();
        var id = $('.merch_id').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "check_update_merchandise_name": 1,
                    "text_valid": text_valid,
                    "id":id,
            },
            success: function(respone){
                $('.error_merch_name').text(respone[0]);
                merch_name_error = respone[1];
            }
        });
    });

    $('.checking_merch_price').keyup(function(){
        var text_valid = $('.checking_merch_price').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "text_submit_btn": 1,
                    "text_valid": text_valid,
            },
            success: function(respone){
                $('.error_merch_price').text(respone[0]);
                merch_price_error = respone[1];
            }
        });
    });

    $('.checking_merch_price').blur(function(){
        var text_valid = $('.checking_merch_price').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "text_submit_btn": 1,
                    "text_valid": text_valid,
            },
            success: function(respone){
                $('.error_merch_price').text(respone[0]);
                merch_price_error = respone[1];
            }
        });
    });

    $('.checking_merch_lprice').keyup(function(){
        var text_valid = $('.checking_merch_lprice').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "text_submit_btn": 1,
                    "text_valid": text_valid,
            },
            success: function(respone){
                $('.error_merch_lprice').text(respone[0]);
                merch_lprice_error = respone[1];
            }
        });
    });

    $('.checking_merch_lprice').blur(function(){
        var text_valid = $('.checking_merch_lprice').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "text_submit_btn": 1,
                    "text_valid": text_valid,
            },
            success: function(respone){
                $('.error_merch_lprice').text(respone[0]);
                merch_lprice_error = respone[1];
            }
        });
    });

    $('.checking_merch_stock').keyup(function(){
        var text_valid = $('.checking_merch_stock').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "text_submit_btn": 1,
                    "text_valid": text_valid,
            },
            success: function(respone){
                $('.error_merch_stock').text(respone[0]);
                merch_stock_error = respone[1];
            }
        });
    });

    $('.checking_merch_stock').blur(function(){
        var text_valid = $('.checking_merch_stock').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "text_submit_btn": 1,
                    "text_valid": text_valid,
            },
            success: function(respone){
                $('.error_merch_stock').text(respone[0]);
                merch_stock_error = respone[1];
            }
        });
    });

    $('.checking_merch_weight').keyup(function(){
        var text_valid = $('.checking_merch_weight').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "text_submit_btn": 1,
                    "text_valid": text_valid,
            },
            success: function(respone){
                $('.error_merch_weight').text(respone[0]);
                merch_weight_error = respone[1];
            }
        });
    });

    $('.checking_merch_weight').blur(function(){
        var text_valid = $('.checking_merch_weight').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "text_submit_btn": 1,
                    "text_valid": text_valid,
            },
            success: function(respone){
                $('.error_merch_weight').text(respone[0]);
                merch_weight_error = respone[1];
            }
        });
    });

    $('.checking_concert').blur(function(){
        var select_valid = $('.checking_concert').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "select_submit_btn": 1,
                    "select_valid": select_valid,
            },
            success: function(respone){
                $('.error_concert').text(respone[0]);
                merch_concert_error = respone[1];
            }
        });
    });

    $('.checking_concert').keyup(function(){
        var select_valid = $('.checking_concert').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "select_submit_btn": 1,
                    "select_valid": select_valid,
            },
            success: function(respone){
                $('.error_concert').text(respone[0]);
                merch_concert_error = respone[1];
            }
        });
    });

    $('.checking_status').blur(function(){
        var select_valid = $('.checking_status').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "select_submit_btn": 1,
                    "select_valid": select_valid,
            },
            success: function(respone){
                $('.error_status').text(respone[0]);
                merch_status_error = respone[1];
            }
        });
    });

    $('.checking_status').keyup(function(){
        var select_valid = $('.checking_status').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "select_submit_btn": 1,
                    "select_valid": select_valid,
            },
            success: function(respone){
                $('.error_status').text(respone[0]);
                merch_status_error = respone[1];
            }
        });
    });

    $(".merch_add_submit_btn").click(function(){
        var img_location  = document.getElementById('default-btn-location');
        var img_location_path = img_location.value;
        var a;
    
        Swal.fire({
            icon: "warning",
            title: "Save Merchandise",
            text: 'Are you sure you want to save this merchandise?',
            showCancelButton: true,
            confirmButtonText: `Yes`,
            denyButtonText: `No`,
            
        }).then((result) => {
            if (result.isConfirmed)
            {
                if(img_location_path == "" || img_location_path == null)
                {
                    a = 1;
                    $('.error_locationimg').text("*No file selected");
                }
                else
                {
                    a = 0;
                    $('.error_locationimg').text("");
                }

                if($('.checking_status').val() == "")
                    $('.error_status').text("*Please fill in this field");

                if($('.checking_concert').val() == "")
                    $('.error_concert').text("*Please fill in this field");

                if($('.checking_merch_stock').val() == "")
                    $('.error_merch_stock').text("*Please fill in this field");

                if($('.checking_merch_weight').val() == "")
                    $('.error_merch_weight').text("*Please fill in this field");

                if($('.checking_merch_lprice').val() == "")
                    $('.error_merch_lprice').text("*Please fill in this field");

                if($('.checking_merch_price').val() == "")
                    $('.error_merch_price').text("*Please fill in this field");

                if($('.checking_merch_name').val() == "")
                    $('.error_merch_name').text("*Please fill in this field");

                if(typeof merch_weight_error === "undefined" || typeof merch_name_error === "undefined" || typeof merch_price_error === "undefined" || typeof merch_lprice_error === "undefined" || typeof merch_stock_error === "undefined" || typeof merch_concert_error === "undefined" || typeof merch_status_error === "undefined")
                {
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please make sure data input is all valid.', 
                        icon:'error',
                        didClose: () => window.scrollTo(0,0)});
                }
                else if(a === 1 || merch_weight_error === 1 || merch_name_error === 1 || merch_price_error === 1 || merch_lprice_error === 1 ||  merch_stock_error === 1 || merch_concert_error === 1 || merch_status_error === 1)
                {
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please make sure data input is all valid.', 
                        icon:'error',
                        didClose: () => window.scrollTo(0,0)});
                }
                else
                {
                    var formData = new FormData();
                    const locationimg = document.querySelector("#default-btn-location");
                    var property = locationimg.files[0];
                    formData.append("files[]",property);

                    $.ajax({
                        type: "POST",
                        url: "php/validation/addMerchImg.php",
                        dataType: 'json',
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success:function(data)
                        {
                            var desc_data = CKEDITOR.instances.ckeditor.getData();
                            var form_data = $('.add_merch_form').serializeArray();
                            form_data.push({name: "locationimg", value: data[0]});
                            form_data.push({name: "add_merch_submitBtn", value: 1});
                            form_data.push({name: "desc_data", value: desc_data});
                            $.ajax({
                                type: "POST",
                                url: "php/validation/form_validation.php",
                                data: form_data,
                                success:function(respone)
                                {
                                    //alert(respone);
                                    if(respone)
                                    {
                                        Swal.fire({
                                        title:'Successfully!', 
                                        text:'A new merchandise has been added.', 
                                        icon:'success',
                                        didClose: () => 
                                        window.open("./merchandise.php", "_self")});
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
                                error: function ()
                                {
                                    Swal.fire({
                                    title:'Oops! Something went wrong...', 
                                    text:'Please try again later', 
                                    icon:'error',
                                    didClose: () => window.scrollTo(0,0)});
                                }
                            });
                        },
                        error: function ()
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
        })
    });

    $(".merch_update_submit_btn").click(function(){
        const imgLocation = document.querySelector(".preimg-location");
        var img_location  = document.getElementById('default-btn-location');
        var img_location_path = img_location.value;
        var a;
        var imgurl = /\.(jpeg|jpg|gif|png)$/;
    
        Swal.fire({
            icon: "warning",
            title: "Save Merchandise",
            text: 'Are you sure you want to save this merchandise?',
            showCancelButton: true,
            confirmButtonText: `Yes`,
            denyButtonText: `No`,
            
        }).then((result) => {
            if (result.isConfirmed)
            {
                if((imgLocation.src).match(imgurl) != null && img_location_path === "")
                {
                    a = 0;
                }
                else if(img_location_path === "" || img_location_path === null)
                {
                    a = 1;
                    $('.error_locationimg').text("*No file selected");
                }
                else
                {
                    a = 0;
                    $('.error_locationimg').text("");
                }

                if($('.checking_status').val() == "")
                    $('.error_status').text("*Please fill in this field");

                if($('.checking_concert').val() == "")
                    $('.error_concert').text("*Please fill in this field");

                if($('.checking_merch_stock').val() == "")
                    $('.error_merch_stock').text("*Please fill in this field");

                if($('.checking_merch_weight').val() == "")
                    $('.error_merch_weight').text("*Please fill in this field");

                if($('.checking_merch_lprice').val() == "")
                    $('.error_merch_lprice').text("*Please fill in this field");

                if($('.checking_merch_price').val() == "")
                    $('.error_merch_price').text("*Please fill in this field");

                if($('.checking_update_merch_name').val() == "")
                    $('.error_merch_name').text("*Please fill in this field");

                if($('.checking_status').val() == ""||$('.checking_concert').val() == ""||$('.checking_merch_stock').val() == ""||$('.checking_merch_weight').val() == ""||$('.checking_merch_lprice').val() == ""||$('.checking_merch_price').val() == ""||$('.checking_update_merch_name').val() == "")
                {
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please make sure data input is all valid.', 
                        icon:'error',
                        didClose: () => window.scrollTo(0,0)});
                }
                else if(a === 1)
                {
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please make sure data input is all valid.', 
                        icon:'error',
                        didClose: () => window.scrollTo(0,0)});
                }
                else
                {
                    var formData = new FormData();
                    const locationimg = document.querySelector("#default-btn-location");
                    var property = locationimg.files[0];
                    formData.append("files[]",property);
                    
                    $.ajax({
                        type: "POST",
                        url: "php/validation/addMerchImg.php",
                        dataType: 'json',
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success:function(data)
                        {
                            // console.log("done");
                            var desc_data = CKEDITOR.instances.ckeditor.getData();
                            var form_data = $('.update_merch_form').serializeArray();
                            form_data.push({name: "locationimg", value: data[0]});
                            form_data.push({name: "update_merch_submitBtn", value: 1});
                            form_data.push({name: "desc_data", value: desc_data});
                            $.ajax({
                                type: "POST",
                                url: "php/validation/form_validation.php",
                                data: form_data,
                                success:function(respone)
                                {
                                    // alert(respone);
                                    if(respone == 1)
                                    {
                                        Swal.fire({
                                        title:'Successfully!', 
                                        text:'The merchandise has been updated.', 
                                        icon:'success',
                                        didClose: () => 
                                        window.open("./merchandise.php", "_self")});
                                    }
                                    else if(respone == 0)
                                    {
                                        Swal.fire({
                                        title:'Oops! Something went wrong...', 
                                        text:'Please try again later', 
                                        icon:'error',
                                        didClose: () => window.scrollTo(0,0)});
                                    }
                                    else if(respone == 2)
                                    {
                                        Swal.fire({
                                        title:'Oops!', 
                                        text:'The stock could not be updated', 
                                        icon:'error',
                                        didClose: () => location.reload()});
                                    }
                                },
                                error: function ()
                                {
                                    Swal.fire({
                                    title:'Oops! Something went wrong...', 
                                    text:'Please try again later', 
                                    icon:'error',
                                    didClose: () => window.scrollTo(0,0)});
                                }
                            });
                        },
                        error: function ()
                        {
                            // console.log("notdone");
                            Swal.fire({
                                title:'Oops! Something went wrong...', 
                                text:'Please try again later', 
                                icon:'error',
                                didClose: () => window.scrollTo(0,0)});
                        }
                    
                    });
                }
            }
        })
    });

    //sales report
    $('.concert_table_content').change(function(){
        //alert("hi");
        var valid;
        var error=3;
        var i=0;
        $('.sales_concert_id').each(function(){
            if($(this).is(':checked'))
            {
                //if it is checked then return 1 and count
                valid = 1;
                i++;
            }
            else
            {
                valid = 0;
            }
        });

        //alert(valid);
        if(i > 0)
        {
            //if it is checked then no error = 0 --> able to generate
            error = 0;
        }
        else
        {
            //if nothing is checked then no error = 1 --> disabled to generate
            error = 1;
        }
        
        //alert(error);
        if(error == 1)
        {
            $('.concert_sales_btn').prop("disabled","disabled");
            $('.selected_number').text(i+" selected");
            $('.selected_number').css("color","rgb(214, 62, 62)");
        }
        else if(error == 0)
        {
            $('.concert_sales_btn').prop("disabled","");
            $('.selected_number').text(i+" selected");
            $('.selected_number').css("color","#6777ef");
        }
    });
    
    //profile
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
                        url: "php/validation/upload_img.php",
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
                        error: function(respone)
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

    $('.email_submit').on('click',function(){
        Swal.fire({
            icon: "warning",
            title: "Update Email",
            text: 'Are you sure you want to update your email?',
            showCancelButton: true,
            confirmButtonText: `Yes`,
            denyButtonText: `No`,
            
        }).then((result) => {
            if (result.isConfirmed)
            {
                if($('.checking_email').val() == "")
                    $('.error_email').text("*Please fill in this field");
                
                if($('.checking_new_email').val() == "")
                    $('.error_new_email').text("*Please fill in this field");

                if($('.checking_cpassword').val() == "")
                    $('.error_cpassword').text("*Please fill in this field");

                if(typeof email_error == 'undefined' ||typeof email_new_error == 'undefined' || typeof cpassword_error == 'undefined')
                {
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please make sure data input is all valid.', 
                        icon:'error',
                        didClose: () => window.scrollTo(0,0)});
                }
                else if(email_error == 1 || email_new_error == 1 || cpassword_error == 1)
                {
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please make sure data input is all valid.', 
                        icon:'error',
                        didClose: () => window.scrollTo(0,0)});
                }
                else if($('.checking_email').val() == ""||$('.checking_new_email').val() == ""||$('.checking_cpassword').val() == "")
                {
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please make sure data input is all valid.', 
                        icon:'error',
                        didClose: () => window.scrollTo(0,0)});
                }
                else if(cpassword_error == 3 || email_error == 3)
                {
                    const email_alert_dis = document.querySelector(".email_alert");
                    $('.email_alert_icon').text("error");
                    email_alert_dis.style.opacity = "1";
                    email_alert_dis.style.backgroundColor = "#f44336";
                    $('.change_email_alert').text("The email or the password you enter is incorrect.");
                    Swal.fire({
                        title:'Oops!', 
                        text:'The email or the password you enter is incorrect.', 
                        icon:'error',
                    });
                }
                else if(email_new_error == 3)
                {
                    $('.error_new_email').text("*This email has been registered");
                    Swal.fire({
                        title:'Oops!', 
                        text:'This email has been registered.', 
                        icon:'error',
                    });
                }
                else
                {
                    var form_data = $('.change_email').serializeArray();
                    form_data.push({name: "change_email_submitBtn", value: 1});
                    $.ajax({
                        type: "POST",
                        url: "php/validation/form_validation.php",
                        data: form_data,
                        beforeSend: function() {
                            Swal.fire({
                                title:'Please wait...', 
                                text:'Sending an email.', 
                                didOpen: () => {
                                    Swal.showLoading()
                                }
                            });
                        },
                        success: function(respone)
                        {
                            if(respone)
                            {
                                Swal.fire({
                                    title:'Successfully!', 
                                    text:'Please verify email to continue.', 
                                    icon:'success',
                                    didClose: () => 
                                    window.open("./php/admin_out.php", "_self")});
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

    $('.pass_submit').on('click',function(){
        Swal.fire({
            icon: "warning",
            title: "Update Password",
            text: 'Are you sure you want to update your password?',
            showCancelButton: true,
            confirmButtonText: `Yes`,
            denyButtonText: `No`,
            
        }).then((result) => {
            if (result.isConfirmed)
            {
                if($('.checking_old_password').val() == "")
                    $('.error_old_password').text("*Please fill in this field");
                
                if($('.checking_new_password').val() == "")
                    $('.error_new_password').text("*Please fill in this field");

                if($('.checking_new_cpassword').val() == "")
                    $('.error_new_cpassword').text("*Please fill in this field");

                if(typeof old_password_error == 'undefined' ||typeof new_password_error_blur == 'undefined' || typeof new_cpassword_error == 'undefined')
                {
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please make sure data input is all valid.', 
                        icon:'error',
                        didClose: () => window.scrollTo(0,0)});
                }
                else if(old_password_error == 1 || new_password_error_blur == 1 || new_cpassword_error == 1)
                {
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please make sure data input is all valid.', 
                        icon:'error',
                    });
                }
                else if($('.checking_new_cpassword').val() == ""||$('.checking_new_password').val() == ""||$('.checking_old_password').val() == "")
                {
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please make sure data input is all valid.', 
                        icon:'error',
                    });
                }
                else if(old_password_error == 3)
                {
                    const pass_alert_dis = document.querySelector(".password_alert");
                    $('.password_alert_icon').text("error");
                    pass_alert_dis.style.opacity = "1";
                    pass_alert_dis.style.backgroundColor = "#f44336";
                    $('.change_password_alert').text("The password you enter is incorrect.");
                    Swal.fire({
                        title:'Oops!', 
                        text:'The password you enter is incorrect.', 
                        icon:'error',
                    });
                }
                else if($('.checking_old_password').val() == $('.checking_new_cpassword').val())
                {
                    const pass_alert_dis = document.querySelector(".password_alert");
                    $('.password_alert_icon').text("error");
                    pass_alert_dis.style.opacity = "1";
                    pass_alert_dis.style.backgroundColor = "#f44336";
                    $('.change_password_alert').text("The new password could not be the same as curent password");
                    Swal.fire({
                        title:'Oops!', 
                        text:'The new password could not be the same as curent password', 
                        icon:'error',
                    });
                }
                else
                {
                    var form_data = $('.change_pass').serializeArray();
                    form_data.push({name: "change_password_submit_btn", value: 1});
                    $.ajax({
                        type: "POST",
                        url: "php/validation/form_validation.php",
                        data: form_data,
                        success: function(respone)
                        {
                            if(respone)
                            {
                                Swal.fire({
                                    title:'Successfully!', 
                                    text:'Please login again to continue.', 
                                    icon:'success',
                                    didClose: () => 
                                    window.open("./php/admin_out.php", "_self")});
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


    //add admin
    $('.checking_sadmin_gender').blur(function(){
        var select_valid = $('.checking_sadmin_gender').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "select_submit_btn": 1,
                    "select_valid": select_valid,
            },
            success: function(respone){
                $('.error_sadmin_gender').text(respone[0]);
                sadmin_gender_error = respone[1];
            }
        });
    });

    $('.checking_sadmin_gender').keyup(function(){
        var select_valid = $('.checking_sadmin_gender').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "select_submit_btn": 1,
                    "select_valid": select_valid,
            },
            success: function(respone){
                $('.error_sadmin_gender').text(respone[0]);
                sadmin_gender_error = respone[1];
            }
        });
    });

    $('.checking_sadmin_fname').keyup(function(){
        var text_valid = $('.checking_sadmin_fname').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "text_submit_btn": 1,
                    "text_valid": text_valid,
            },
            success: function(respone){
                $('.error_sadmin_fname').text(respone[0]);
                sadmin_fname_error = respone[1];
            }
        });
    });

    $('.checking_sadmin_fname').blur(function(){
        var text_valid = $('.checking_sadmin_fname').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "text_submit_btn": 1,
                    "text_valid": text_valid,
            },
            success: function(respone){
                $('.error_sadmin_fname').text(respone[0]);
                sadmin_fname_error = respone[1];
            }
        });
    });

    $('.checking_sadmin_lname').keyup(function(){
        var text_valid = $('.checking_sadmin_lname').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "text_submit_btn": 1,
                    "text_valid": text_valid,
            },
            success: function(respone){
                $('.error_sadmin_lname').text(respone[0]);
                sadmin_lname_error = respone[1];
            }
        });
    });

    $('.checking_sadmin_lname').blur(function(){
        var text_valid = $('.checking_sadmin_lname').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "text_submit_btn": 1,
                    "text_valid": text_valid,
            },
            success: function(respone){
                $('.error_sadmin_lname').text(respone[0]);
                sadmin_lname_error = respone[1];
            }
        });
    });

    $('.checking_sphone').keyup(function(){
        var text_valid = $('.checking_sphone').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "phone_submit_btn": 1,
                    "phone_valid": text_valid,
            },
            success: function(respone){
                $('.error_sadmin_phone').text(respone[0]);
                sadmin_phone_error = respone[1];
            }
        });
    });

    $('.checking_sphone').blur(function(){
        var text_valid = $('.checking_sphone').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "phone_submit_btn": 1,
                    "phone_valid": text_valid,
            },
            success: function(respone){
                $('.error_sadmin_phone').text(respone[0]);
                sadmin_phone_error = respone[1];
            }
        });
    });

    $('.checking_sadmin_email').keyup(function(){
        var emaill = $('.checking_sadmin_email').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "email_new_key_submit_btn": 1,
                    "emaill_id" : emaill,
            },
            success: function(respone){
                $('.error_sadmin_email').text(respone[0]);
                sadmin_email_error = respone[1];
            }
        });
    });

    $('.checking_sadmin_email').blur(function(){
        var emaill = $('.checking_sadmin_email').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "email_new_submit_btn": 1,
                    "emaill_id" : emaill,
            },
            success: function(respone){
                $('.error_sadmin_email').text(respone[0]);
                sadmin_email_error = respone[1];
            }
        });
    });

    $('.checking_sadmin_new_password').keyup(function(){
        var keypassword_valid = $('.checking_sadmin_new_password').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "new_password_submit_btn_keyup": 1,
                    "keypassword_valid": keypassword_valid,
            },
            success: function(respone){
                    $('#message .length').css("color",respone[0]);
                    $('#message .number').css("color",respone[1]);
                    $('#message .capital').css("color",respone[2]);
                    $('#message .letter').css("color",respone[3]);
                    $('#message .special').css("color",respone[4]);
                    if(respone[6] === 1)
                    {
                        $('#message .checked_icon1').css("display","inline-block");
                        $('#message .cancel_icon1').css("display","none");
                    }
                    else
                    {
                        $('#message .checked_icon1').css("display","none");
                        $('#message .cancel_icon1').css("display","inline-block");
                    }

                    if(respone[7] === 1)
                    {
                        $('#message .checked_icon2').css("display","inline-block");
                        $('#message .cancel_icon2').css("display","none");
                    }
                    else
                    {
                        $('#message .checked_icon2').css("display","none");
                        $('#message .cancel_icon2').css("display","inline-block");
                    }
                    if(respone[8] === 1)
                    {
                        $('#message .checked_icon3').css("display","inline-block");
                        $('#message .cancel_icon3').css("display","none");
                    }
                    else
                    {
                        $('#message .checked_icon3').css("display","none");
                        $('#message .cancel_icon3').css("display","inline-block");
                    }

                    if(respone[9] === 1)
                    {
                        $('#message .checked_icon4').css("display","inline-block");
                        $('#message .cancel_icon4').css("display","none");
                    }
                    else
                    {
                        $('#message .checked_icon4').css("display","none");
                        $('#message .cancel_icon4').css("display","inline-block");
                    }

                    if(respone[10] === 1)
                    {
                        $('#message .checked_icon5').css("display","inline-block");
                        $('#message .cancel_icon5').css("display","none");
                    }
                    else
                    {
                        $('#message .checked_icon5').css("display","none");
                        $('#message .cancel_icon5').css("display","inline-block");
                    }
                    new_sadmin_password_error_keyup = respone[5];
                    new_sadmin_password_error_keyup_null = respone[11];
                    if(new_sadmin_password_error_keyup_null == 0)
                        $('.error_sadmin_new_password').text("");
            }
        });
    });

    $('.checking_sadmin_new_password').blur(function(){
        var new_password_valid = $('.checking_sadmin_new_password').val();
        //alert(password_valid);
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "new_password_submit_btn_blur": 1,
                    "password_valid": new_password_valid,
            },
            success: function(respone){
                if(new_sadmin_password_error_keyup_null == 1)
                {
                    $('.error_sadmin_new_password').text("*Please fill in this field");
                }
                else if(new_sadmin_password_error_keyup == 0)
                {
                    $('.error_sadmin_new_password').text("*Invalid password format");
                    new_sadmin_password_error_blur = 1;
                }
                else
                {
                    $('.error_sadmin_new_password').text(respone[0]);
                    new_sadmin_password_error_blur = respone[1];
                }
            }
        });
    });

    $('.checking_admin_gender').blur(function(){
        var select_valid = $('.checking_admin_gender').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "select_submit_btn": 1,
                    "select_valid": select_valid,
            },
            success: function(respone){
                $('.error_admin_gender').text(respone[0]);
                admin_gender_error = respone[1];
            }
        });
    });

    $('.checking_admin_gender').keyup(function(){
        var select_valid = $('.checking_admin_gender').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "select_submit_btn": 1,
                    "select_valid": select_valid,
            },
            success: function(respone){
                $('.error_admin_gender').text(respone[0]);
                admin_gender_error = respone[1];
            }
        });
    });

    $('.checking_admin_fname').keyup(function(){
        var text_valid = $('.checking_admin_fname').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "text_submit_btn": 1,
                    "text_valid": text_valid,
            },
            success: function(respone){
                $('.error_admin_fname').text(respone[0]);
                admin_fname_error = respone[1];
            }
        });
    });

    $('.checking_admin_fname').blur(function(){
        var text_valid = $('.checking_admin_fname').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "text_submit_btn": 1,
                    "text_valid": text_valid,
            },
            success: function(respone){
                $('.error_admin_fname').text(respone[0]);
                admin_fname_error = respone[1];
            }
        });
    });

    $('.checking_admin_lname').keyup(function(){
        var text_valid = $('.checking_admin_lname').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "text_submit_btn": 1,
                    "text_valid": text_valid,
            },
            success: function(respone){
                $('.error_admin_lname').text(respone[0]);
                admin_lname_error = respone[1];
            }
        });
    });

    $('.checking_admin_lname').blur(function(){
        var text_valid = $('.checking_admin_lname').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "text_submit_btn": 1,
                    "text_valid": text_valid,
            },
            success: function(respone){
                $('.error_admin_lname').text(respone[0]);
                admin_lname_error = respone[1];
            }
        });
    });

    $('.checking_admin_phone').keyup(function(){
        var text_valid = $('.checking_admin_phone').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "phone_submit_btn": 1,
                    "phone_valid": text_valid,
            },
            success: function(respone){
                $('.error_admin_phone').text(respone[0]);
                admin_phone_error = respone[1];
            }
        });
    });

    $('.checking_admin_phone').blur(function(){
        var text_valid = $('.checking_admin_phone').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "phone_submit_btn": 1,
                    "phone_valid": text_valid,
            },
            success: function(respone){
                $('.error_admin_phone').text(respone[0]);
                admin_phone_error = respone[1];
            }
        });
    });

    $('.checking_admin_email').keyup(function(){
        var emaill = $('.checking_admin_email').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "email_new_key_submit_btn": 1,
                    "emaill_id" : emaill,
            },
            success: function(respone){
                $('.error_admin_email').text(respone[0]);
                admin_email_error = respone[1];
            }
        });
    });

    $('.checking_admin_email').blur(function(){
        var emaill = $('.checking_admin_email').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "email_new_submit_btn": 1,
                    "emaill_id" : emaill,
            },
            success: function(respone){
                $('.error_admin_email').text(respone[0]);
                admin_email_error = respone[1];
            }
        });
    });

    $('.checking_admin_new_password').keyup(function(){
        var keypassword_valid = $('.checking_admin_new_password').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "new_password_submit_btn_keyup": 1,
                    "keypassword_valid": keypassword_valid,
            },
            success: function(respone){
                $('#message1 .length').css("color",respone[0]);
                $('#message1 .number').css("color",respone[1]);
                $('#message1 .capital').css("color",respone[2]);
                $('#message1 .letter').css("color",respone[3]);
                $('#message1 .special').css("color",respone[4]);
                if(respone[6] === 1)
                {
                    $('#message1 .checked_icon1').css("display","inline-block");
                    $('#message1 .cancel_icon1').css("display","none");
                }
                else
                {
                    $('#message1 .checked_icon1').css("display","none");
                    $('#message1 .cancel_icon1').css("display","inline-block");
                }

                if(respone[7] === 1)
                {
                    $('#message1 .checked_icon2').css("display","inline-block");
                    $('#message1 .cancel_icon2').css("display","none");
                }
                else
                {
                    $('#message1 .checked_icon2').css("display","none");
                    $('#message1 .cancel_icon2').css("display","inline-block");
                }
                if(respone[8] === 1)
                {
                    $('#message1 .checked_icon3').css("display","inline-block");
                    $('#message1 .cancel_icon3').css("display","none");
                }
                else
                {
                    $('#message1 .checked_icon3').css("display","none");
                    $('#message1 .cancel_icon3').css("display","inline-block");
                }

                if(respone[9] === 1)
                {
                    $('#message1 .checked_icon4').css("display","inline-block");
                    $('#message1 .cancel_icon4').css("display","none");
                }
                else
                {
                    $('#message1 .checked_icon4').css("display","none");
                    $('#message1 .cancel_icon4').css("display","inline-block");
                }

                if(respone[10] === 1)
                {
                    $('#message1 .checked_icon5').css("display","inline-block");
                    $('#message1 .cancel_icon5').css("display","none");
                }
                else
                {
                    $('#message1 .checked_icon5').css("display","none");
                    $('#message1 .cancel_icon5').css("display","inline-block");
                }
                    new_admin_password_error_keyup = respone[5];
                    new_admin_password_error_keyup_null = respone[11];
                    if(new_admin_password_error_keyup_null == 0)
                        $('.error_admin_new_password').text("");
            }
        });
    });

    $('.checking_admin_new_password').blur(function(){
        var new_password_valid = $('.checking_admin_new_password').val();
        //alert(password_valid);
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "new_password_submit_btn_blur": 1,
                    "password_valid": new_password_valid,
            },
            success: function(respone){
                if(new_admin_password_error_keyup_null == 1)
                {
                    $('.error_admin_new_password').text("*Please fill in this field");
                }
                else if(new_admin_password_error_keyup == 0)
                {
                    $('.error_admin_new_password').text("*Invalid password format");
                    new_admin_password_error_blur = 1;
                }
                else
                {
                    $('.error_admin_new_password').text(respone[0]);
                    new_admin_password_error_blur = respone[1];
                }
            }
        });
    });

    $('.admin_submit_btn').on('click',function(){
        Swal.fire({
            icon: "warning",
            title: "Save Admin",
            text: 'Are you sure you want to save this admin?',
            showCancelButton: true,
            confirmButtonText: `Yes`,
            denyButtonText: `No`,
            
        }).then((result) => {
            if (result.isConfirmed)
            {
                if($('.checking_admin_fname').val() == "")
                        $('.error_admin_fname').text("*Please fill in this field");
                    
                if($('.checking_admin_lname').val() == "")
                    $('.error_admin_lname').text("*Please fill in this field");

                if($('.checking_admin_email').val() == "")
                    $('.error_admin_email').text("*Please fill in this field");

                if($('.checking_admin_phone').val() == "")
                    $('.error_admin_phone').text("*Please fill in this field");

                if($('.checking_admin_gender').val() == "")
                    $('.error_admin_gender').text("*Please fill in this field");

                if($('.checking_admin_new_password').val() == "")
                    $('.error_admin_new_password').text("*Please fill in this field");

                if(typeof admin_gender_error == 'undefined' ||typeof admin_email_error == 'undefined' || typeof admin_phone_error == 'undefined' || typeof admin_fname_error == 'undefined' ||typeof admin_lname_error == 'undefined' ||typeof new_admin_password_error_blur == 'undefined')
                {
                    if(typeof admin_email_error == 'undefined')
                        $('.error_admin_email').text("*Please fill in this field");
                    
                    if(typeof admin_phone_error == 'undefined')
                        $('.error_admin_phone').text("*Please fill in this field");

                    if(typeof admin_fname_error == 'undefined')
                        $('.error_admin_fname').text("*Please fill in this field");

                    if(typeof admin_lname_error == 'undefined')
                        $('.error_admin_lname').text("*Please fill in this field");

                    if(typeof new_admin_password_error_blur == 'undefined')
                        $('.error_admin_new_password').text("*Please fill in this field");

                    if(typeof admin_gender_error == 'undefined')
                        $('.error_admin_gender').text("*Please fill in this field");
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please make sure data input is all valid.', 
                        icon:'error',
                        didClose: () => window.scrollTo(0,0)});
                }
                else if(admin_email_error == 1 || admin_phone_error == 1 || admin_fname_error == 1 || admin_lname_error == 1 || new_admin_password_error_blur == 1)
                {
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please make sure data input is all valid.', 
                        icon:'error',
                        didClose: () => window.scrollTo(0,0)});
                }
                else if($('.checking_admin_new_password').val() == ""||$('.checking_admin_gender').val() == ""||$('.checking_admin_phone').val() == ""||$('.checking_admin_email').val() == ""||$('.checking_admin_fname').val() == "")
                {   
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please make sure data input is all valid.', 
                        icon:'error',
                        didClose: () => window.scrollTo(0,0)});
                }
                else if(admin_email_error == 3)
                {
                    $('.error_admin_email').text("*This email has been registered");
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please make sure data input is all valid.', 
                        icon:'error',
                        didClose: () => window.scrollTo(0,0)});
                }
                else
                {
                    var form_data = $('.add_admin').serializeArray();
                    form_data.push({name: "add_admin_submitBtn", value: 1});
                    $.ajax({
                        type: "POST",
                        url: "php/validation/form_validation.php",
                        data: form_data,
                        success: function(respone)
                        {
                            if(respone)
                            {
                                Swal.fire({
                                    title:'Successfully!', 
                                    text:'An admin has been added.', 
                                    icon:'success',
                                    didClose: () => 
                                    window.open("./admin.php", "_self")});
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

    $('.superadmin_submit_btn').on('click',function(){
        Swal.fire({
            icon: "warning",
            title: "Save Super Admin",
            text: 'Are you sure you want to save this super admin?',
            showCancelButton: true,
            confirmButtonText: `Yes`,
            denyButtonText: `No`,
            
        }).then((result) => {
            if (result.isConfirmed)
            {
                if($('.checking_sadmin_fname').val() == "")
                    $('.error_sadmin_fname').text("*Please fill in this field");
                
                if($('.checking_sadmin_lname').val() == "")
                    $('.error_sadmin_lname').text("*Please fill in this field");

                if($('.checking_sadmin_email').val() == "")
                    $('.error_sadmin_email').text("*Please fill in this field");

                if($('.checking_sphone').val() == "")
                    $('.error_sadmin_phone').text("*Please fill in this field");

                if($('.checking_sadmin_gender').val() == "")
                    $('.error_sadmin_gender').text("*Please fill in this field");

                if($('.checking_sadmin_new_password').val() == "")
                    $('.error_sadmin_new_password').text("*Please fill in this field");

                if(typeof sadmin_gender_error == 'undefined' ||typeof sadmin_email_error == 'undefined' || typeof sadmin_phone_error == 'undefined' || typeof sadmin_fname_error == 'undefined' ||typeof sadmin_lname_error == 'undefined' ||typeof new_sadmin_password_error_blur == 'undefined')
                {
                    if(typeof sadmin_email_error == 'undefined')
                        $('.error_sadmin_email').text("*Please fill in this field");
                    
                    if(typeof sadmin_phone_error == 'undefined')
                        $('.error_sadmin_phone').text("*Please fill in this field");

                    if(typeof sadmin_fname_error == 'undefined')
                        $('.error_sadmin_fname').text("*Please fill in this field");

                    if(typeof sadmin_lname_error == 'undefined')
                        $('.error_sadmin_lname').text("*Please fill in this field");

                    if(typeof new_sadmin_password_error_blur == 'undefined')
                        $('.error_sadmin_new_password').text("*Please fill in this field");

                    if(typeof sadmin_gender_error == 'undefined')
                        $('.error_sadmin_gender').text("*Please fill in this field");
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please make sure data input is all valid.', 
                        icon:'error',
                        didClose: () => window.scrollTo(0,0)});
                }
                else if(sadmin_email_error == 1 || sadmin_phone_error == 1 || sadmin_fname_error == 1 || sadmin_lname_error == 1 || new_sadmin_password_error_blur == 1)
                {
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please make sure data input is all valid.', 
                        icon:'error',
                        didClose: () => window.scrollTo(0,0)});
                }
                else if($('.checking_sadmin_new_password').val() == ""||$('.checking_sadmin_fname').val() == ""||$('.checking_sadmin_lname').val() == ""||$('.checking_sadmin_email').val() == ""||$('.checking_sphone').val() == ""||$('.checking_sadmin_gender').val() == "")
                {
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please make sure data input is all valid.', 
                        icon:'error',
                        didClose: () => window.scrollTo(0,0)});
                }
                else if(sadmin_email_error == 3)
                {
                    console.log(sadmin_email_error);
                    console.log(sadmin_gender_error);
                    console.log(sadmin_fname_error);
                    console.log(sadmin_lname_error);
                    console.log(sadmin_phone_error);
                    console.log(new_sadmin_password_error_blur);
                    $('.error_sadmin_email').text("*This email has been registered");
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please make sure data input is all valid.', 
                        icon:'error',
                        didClose: () => window.scrollTo(0,0)});
                }
                else
                {
                    var form_data = $('.add_super_admin').serializeArray();
                    form_data.push({name: "add_super_admin_submitBtn", value: 1});
                    $.ajax({
                        type: "POST",
                        url: "php/validation/form_validation.php",
                        data: form_data,
                        success: function(respone)
                        {
                            if(respone)
                            {
                                Swal.fire({
                                    title:'Successfully!', 
                                    text:'An super admin has been added.', 
                                    icon:'success',
                                    didClose: () => 
                                    window.open("./admin.php", "_self")});
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

    //admin venue
    $('.checking_update_venue_name').keyup(function(){
        var text_valid = $('.checking_update_venue_name').val();
        var id = $('.venue_id').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "check_update_venue_name": 1,
                    "text_valid": text_valid,
                    'id':id,
            },
            success: function(respone){
                $('.error_venue_name').text(respone[0]);
                venue_name_error = respone[1];
            }
        });
    });

    $('.checking_venue_name').keyup(function(){
        var text_valid = $('.checking_venue_name').val();
        var id = $('.venue_id').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "check_venue_name": 1,
                    "text_valid": text_valid,
                    'id':id,
            },
            success: function(respone){
                $('.error_venue_name').text(respone[0]);
                venue_name_error = respone[1];
            }
        });
    });

    $('.checking_venue_iframe').keyup(function(){
        var text_valid = $('.checking_venue_iframe').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "text_submit_btn": 1,
                    "text_valid": text_valid,
            },
            success: function(respone){
                $('.error_venue_iframe').text(respone[0]);
                venue_iframe_error = respone[1];
            }
        });
    });

    $('.checking_venue_iframe').blur(function(){
        var text_valid = $('.checking_venue_iframe').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "text_submit_btn": 1,
                    "text_valid": text_valid,
            },
            success: function(respone){
                $('.error_venue_iframe').text(respone[0]);
                venue_iframe_error = respone[1];
            }
        });
    });

    $('.checking_venue_location').keyup(function(){
        var text_valid = $('.checking_venue_location').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "text_submit_btn": 1,
                    "text_valid": text_valid,
            },
            success: function(respone){
                $('.error_venue_location').text(respone[0]);
                venue_location_error = respone[1];
            }
        });
    });

    $('.checking_VState').keyup(function(){
        var select_valid = $('.checking_VState').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "select_submit_btn": 1,
                    "select_valid": select_valid,
            },
            success: function(respone){
                $('.error_VState').text(respone[0]);
                VState_error = respone[1];
            }
        });
    });

    $('.checking_update_venue_name').blur(function(){
        var text_valid = $('.checking_update_venue_name').val();
        var id = $('.venue_id').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "check_update_venue_name": 1,
                    "text_valid": text_valid,
                    'id':id,
            },
            success: function(respone){
                $('.error_venue_name').text(respone[0]);
                venue_name_error = respone[1];
            }
        });
    });

    $('.checking_venue_name').blur(function(){
        var text_valid = $('.checking_venue_name').val();
        var id = $('.venue_id').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "check_venue_name": 1,
                    "text_valid": text_valid,
                    'id':id,
            },
            success: function(respone){
                $('.error_venue_name').text(respone[0]);
                venue_name_error = respone[1];
            }
        });
    });

    $('.checking_venue_location').blur(function(){
        var text_valid = $('.checking_venue_location').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "text_submit_btn": 1,
                    "text_valid": text_valid,
            },
            success: function(respone){
                $('.error_venue_location').text(respone[0]);
                venue_location_error = respone[1];
            }
        });
    });

    $('.checking_VState').blur(function(){
        var select_valid = $('.checking_VState').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "select_submit_btn": 1,
                    "select_valid": select_valid,
            },
            success: function(respone){
                $('.error_VState').text(respone[0]);
                VState_error = respone[1];
            }
        });
    });

    //admin concert
    $('.add-row-btn').on('click',function(){
        var html = '';
        html += '<tr>';
        html += '<td hidden><input type="text" class="price-id" name="price_id[]"></td>';
        html += '<td hidden><input type="text" class="id-is-del" name="price_id_del[]"></td>';
        html += '<td><input class="area_name" type="text" name="area_name[]"><label style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0; font-weight: bold; opacity:0;">*Please fill in the field</label></td>';
        html += '<td><input class="area_price" type="number" name="area_price[]"><label style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0; font-weight: bold; opacity:0;">*Please fill in the field</label></td>';
        html += '<td><input class="numberOfseat" type="text" name="numberOfseat[]" onkeypress="return event.charCode >= 48 && event.charCode <= 57"><label style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0; font-weight: bold; opacity:0;">*Please fill in the field</label></td>';
        html += '<td  style="text-align: center;"><button type="button" class="del-row-btn row-btn" name="remove-row"><span class="material-icons" style="padding: 3px;">remove</span></button></td></tr>';
        $('#table_row').append(html);
    });

    $(document).on('click','.del-row-btn',function(){
        //$(this).closest('tr').remove();
        var find = $(this).closest('tr');
        var row = find.contents().filter("td");
        row.contents().filter(".id-is-del").val("1");
        if(row.contents().filter(".price-id").val()==="")
        {
            find.remove();
        }
        else
        {
            find.css({"display": "none"});
        }
    });
    
    $('.table_content').keyup(function(){
        //alert("hi");
        $('.area_name').each(function(){
            //alert("name");
            //find <input>'s parent
            var find = $(this).closest("td");
            //filter out label in the parent "td"
            var row = find.contents().filter("label");
            $(this).keyup(function(){
                if($(this).val()!="")
                {
                    row.css({"opacity": "0"}); 
                }
                else
                {
                    row.css({"opacity": "1"});
                }
            });
        });
        $('.area_price').each(function(){
            //alert("name");
            //find <input>'s parent
            var find = $(this).closest("td");
            //filter out label in the parent "td"
            var row = find.contents().filter("label");
            $(this).keyup(function(){
                if($(this).val()!="")
                {
                    row.css({"opacity": "0"}); 
                }
                else
                {
                    row.css({"opacity": "1"});
                }
            });
        });
        $('.numberOfseat').each(function(){
            //alert("name");
            //find <input>'s parent
            var find = $(this).closest("td");
            //filter out label in the parent "td"
            var row = find.contents().filter("label");
            $(this).keyup(function(){
                if($(this).val()!="")
                {
                    row.css({"opacity": "0"}); 
                }
                else
                {
                    row.css({"opacity": "1"});
                }
            });
        });
    });

    $('.table_content').focusout(function(){
         //alert("hi");
         $('.area_name').each(function(){
            //alert("name");
            //find <input>'s parent
            var find = $(this).closest("td");
            //filter out label in the parent "td"
            var row = find.contents().filter("label");
            $(this).blur(function(){
                if($(this).val()=="")
                {
                    row.css({"opacity": "1"}); 
                }
                else
                {
                    row.css({"opacity": "0"});
                }
            });
        });
        $('.area_price').each(function(){
            //alert("name");
            //find <input>'s parent
            var find = $(this).closest("td");
            //filter out label in the parent "td"
            var row = find.contents().filter("label");
            $(this).blur(function(){
                if($(this).val()=="")
                {
                    row.css({"opacity": "1"}); 
                }
                else
                {
                    row.css({"opacity": "0"});
                }
            });
        });
        $('.numberOfseat').each(function(){
            //alert("name");
            //find <input>'s parent
            var find = $(this).closest("td");
            //filter out label in the parent "td"
            var row = find.contents().filter("label");
            $(this).blur(function(){
                if($(this).val()=="")
                {
                    row.css({"opacity": "1"}); 
                }
                else
                {
                    row.css({"opacity": "0"});
                }
            });
        });
        
    });

    $('.checking_update_concert_name').blur(function(){ //edit classname
        var text_valid = $('.checking_update_concert_name').val();//edit classname
        var id = $('.concert_id').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "check_update_concert_name": 1,
                    "text_valid": text_valid,
                    "id": id,
            },
            success: function(respone){
                $('.error_concert_name').text(respone[0]);//edit classname
                concert_name_error = respone[1];
            }
        });
    });

    $('.checking_update_concert_name').keyup(function(){
        var text_valid = $('.checking_update_concert_name').val();
        var id = $('.concert_id').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "check_update_concert_name": 1,
                    "text_valid": text_valid,
                    "id": id,
            },
            success: function(respone){
                $('.error_concert_name').text(respone[0]);
                concert_name_error = respone[1];
            }
        });
    });

    $('.checking_concert_name').blur(function(){ //edit classname
        var text_valid = $('.checking_concert_name').val();//edit classname
        var id = $('.concert_id').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "check_concert_name": 1,
                    "text_valid": text_valid,
                    "id": id,
            },
            success: function(respone){
                $('.error_concert_name').text(respone[0]);//edit classname
                concert_name_error = respone[1];
            }
        });
    });

    $('.checking_concert_name').keyup(function(){
        var text_valid = $('.checking_concert_name').val();
        var id = $('.concert_id').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "check_concert_name": 1,
                    "text_valid": text_valid,
                    "id": id,
            },
            success: function(respone){
                $('.error_concert_name').text(respone[0]);
                concert_name_error = respone[1];
            }
        });
    });

    $('.checking_CSDate').blur(function(){
        var concert_CSDate = document.getElementById("concert_CSDate").value;
        var concert_SSDate = document.getElementById("concert_SSDate").value;
        var concert_SEDate = document.getElementById("concert_SEDate").value;
        if(concert_CSDate == ""||concert_CSDate==null)
        {
            $('.error_CSDate').text("*Please fill in this field");
            CSDate_error = 1;
            console.log('CSD is null');
        }
        else
        {
            $('.error_CSDate').text("");
            //if SSD late than CSD
            if(concert_SSDate == "" || concert_SSDate == null)
            {
                CSDate_error = 0;
                console.log('SSD is null');
            }
            else if(Date.parse(concert_SSDate) > Date.parse(concert_CSDate))
            {
                CSDate_error = 0;
                $('.error_SSDate').text("*Value must early than concert starting date");
                SSDate_error = 1;
                console.log('SSD is late than CSD');
            }
            else
            {
                $('.error_SSDate').text("");
                SSDate_error = 0;
                console.log('SSD correct');
            }

            if(concert_SEDate == "" || concert_SEDate == null)
            {
                CSDate_error = 0;
                console.log('SED is null');
            }
            else if(Date.parse(concert_SEDate) > Date.parse(concert_CSDate))
            {
                $('.error_SEDate').text("*Value must early than concert starting date");
                SEDate_error = 1;
                console.log('SED is late than CSD');
            }
            else
            {
                $('.error_SEDate').text("");
                SEDate_error = 0;
                console.log('SED correct');
            }
        }
    });

    $('.checking_SSDate').blur(function(){
        var concert_CSDate = document.getElementById("concert_CSDate").value;
        var concert_SSDate = document.getElementById("concert_SSDate").value;
        var concert_SEDate = document.getElementById("concert_SEDate").value;
        if(concert_SSDate == ""||concert_SSDate==null)
        {
            $('.error_SSDate').text("*Please fill in this field");
            SSDate_error = 1;
            console.log('SSD is null');
        }
        else
        {
            $('.error_SSDate').text("");
            //if SSD late than CSD
            if(concert_CSDate == "" || concert_CSDate == null)
            {
                SSDate_error = 0;
                console.log('CSD is null');
            }
            else if(Date.parse(concert_SSDate) > Date.parse(concert_CSDate))
            {
                $('.error_SSDate').text("*Value must early than concert starting date");
                SSDate_error = 1;
                console.log('SSD is late than CSD');
            }
            else
            {
                $('.error_SSDate').text("");
                SSDate_error = 0;
                console.log('SSD correct');
            }

            if(concert_SEDate == "" || concert_SEDate == null)
            {
                SSDate_error = 0;
                console.log('SED is null');
            }
            else if(Date.parse(concert_SEDate) > Date.parse(concert_CSDate))
            {
                $('.error_SEDate').text("*Value must early than concert starting date");
                SEDate_error = 1;
                console.log('SED is late than CSD');
            }
            else if(Date.parse(concert_SEDate) < Date.parse(concert_SSDate))
            {
                $('.error_SEDate').text("*Value must late than session starting date");
                SEDate_error = 1;
                console.log('SED is ealry than SSD');
            }
            else
            {
                $('.error_SEDate').text("");
                SEDate_error = 0;
                console.log('SED correct');
            }
        }
    });

    $('.checking_SEDate').blur(function(){
        var concert_CSDate = document.getElementById("concert_CSDate").value;
        var concert_SSDate = document.getElementById("concert_SSDate").value;
        var concert_SEDate = document.getElementById("concert_SEDate").value;
        if(concert_SEDate == ""||concert_SEDate==null)
        {
            $('.error_SEDate').text("*Please fill in this field");
            SEDate_error = 1;
            console.log('SED is null');
        }
        else
        {
            $('.error_SEDate').text("");

            if(concert_CSDate == "" || concert_CSDate == null)
            {
                SSDate_error = 0;
                console.log('CSD is null');
            }
            else if(Date.parse(concert_SSDate) > Date.parse(concert_CSDate))
            {
                $('.error_SSDate').text("*Value must early than concert starting date");
                SSDate_error = 1;
                console.log('SSD is late than CSD');
            }
            else
            {
                $('.error_SSDate').text("");
                SSDate_error = 0;
                console.log('SSD correct');
            }
            
            if(Date.parse(concert_SEDate) > Date.parse(concert_CSDate))
            {
                $('.error_SEDate').text("*Value must early than concert starting date");
                SEDate_error = 1;
                console.log('SED is late than CSD');
            }
            else if(Date.parse(concert_SEDate) < Date.parse(concert_SSDate))
            {
                $('.error_SEDate').text("*Value must late than session starting date");
                SEDate_error = 1;
                console.log('SED is ealry than SSD');
            }
            else
            {
                $('.error_SEDate').text("");
                SEDate_error = 0;
                console.log('SED correct');
            }
        }
    });

    $('.checking_CSinger').keyup(function(){
        var select_valid = $('.checking_CSinger').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "select_submit_btn": 1,
                    "select_valid": select_valid,
            },
            success: function(respone){
                $('.error_CSinger').text(respone[0]);
                CSinger_error = respone[1];
            }
        });
    });

    $('.checking_CSinger').blur(function(){
        var select_valid = $('.checking_CSinger').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "select_submit_btn": 1,
                    "select_valid": select_valid,
            },
            success: function(respone){
                $('.error_CSinger').text(respone[0]);
                CSinger_error = respone[1];
            }
        });
    });

    $('.checking_COrganizer').blur(function(){
        var select_valid = $('.checking_COrganizer').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "select_submit_btn": 1,
                    "select_valid": select_valid,
            },
            success: function(respone){
                $('.error_COrganizer').text(respone[0]);
                COrganizer_error = respone[1];
            }
        });
    });

    $('.checking_COrganizer').keyup(function(){
        var select_valid = $('.checking_COrganizer').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "select_submit_btn": 1,
                    "select_valid": select_valid,
            },
            success: function(respone){
                $('.error_COrganizer').text(respone[0]);
                COrganizer_error = respone[1];
            }
        });
    });

    $('.checking_CVenue').blur(function(){
        var select_valid = $('.checking_CVenue').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "select_submit_btn": 1,
                    "select_valid": select_valid,
            },
            success: function(respone){
                $('.error_CVenue').text(respone[0]);
                CVenue_error = respone[1];
            }
        });
    });

    $('.checking_CVenue').keyup(function(){
        var select_valid = $('.checking_CVenue').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "select_submit_btn": 1,
                    "select_valid": select_valid,
            },
            success: function(respone){
                $('.error_CVenue').text(respone[0]);
                CVenue_error = respone[1];
            }
        });
    });

    $('.checking_CStatus').keyup(function(){
        var select_valid = $('.checking_CStatus').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "select_submit_btn": 1,
                    "select_valid": select_valid,
            },
            success: function(respone){
                $('.error_CStatus').text(respone[0]);
                CStatus_error = respone[1];
            }
        });
    });

    $('.checking_CStatus').blur(function(){
        var select_valid = $('.checking_CStatus').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "select_submit_btn": 1,
                    "select_valid": select_valid,
            },
            success: function(respone){
                $('.error_CStatus').text(respone[0]);
                CStatus_error = respone[1];
            }
        });
    });

    $('.checking_singer_cate').blur(function(){
        var select_valid = $('.checking_singer_cate').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "select_submit_btn": 1,
                    "select_valid": select_valid,
            },
            success: function(respone){
                $('.error_singer_cate').text(respone[0]);
                CStatus_error = respone[1];
            }
        });
    });

    $('.checking_singer_cate').blur(function(){
        var select_valid = $('.checking_singer_cate').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "select_submit_btn": 1,
                    "select_valid": select_valid,
            },
            success: function(respone){
                $('.error_singer_cate').text(respone[0]);
                SCate_error = respone[1];
            }
        });
    });

    $('.checking_singer_cate').keyup(function(){
        var select_valid = $('.checking_singer_cate').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "select_submit_btn": 1,
                    "select_valid": select_valid,
            },
            success: function(respone){
                $('.error_singer_cate').text(respone[0]);
                SCate_error = respone[1];
            }
        });
    });

    $('.checking_singer_name').keyup(function(){
        var text_valid = $('.checking_singer_name').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "checking_singer_name": 1,
                    "text_valid": text_valid,
            },
            success: function(respone){
                $('.error_singer_name').text(respone[0]);
                singer_name_error = respone[1];
            }
        });
    });

    $('.checking_singer_name').blur(function(){
        var text_valid = $('.checking_singer_name').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "checking_singer_name": 1,
                    "text_valid": text_valid,
            },
            success: function(respone){
                $('.error_singer_name').text(respone[0]);
                singer_name_error = respone[1];
            }
        });
    });

    $('.checking_updated_singer_name').keyup(function(){
        var text_valid = $('.checking_updated_singer_name').val();
        var id = $('.singer_id').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "checking_update_singer_name": 1,
                    "text_valid": text_valid,
                    "id": id,
            },
            success: function(respone){
                $('.error_singer_name').text(respone[0]);
                singer_name_error = respone[1];
            }
        });
    });

    $('.checking_updated_singer_name').blur(function(){
        var text_valid = $('.checking_updated_singer_name').val();
        var id = $('.singer_id').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "checking_update_singer_name": 1,
                    "text_valid": text_valid,
                    "id": id,
            },
            success: function(respone){
                $('.error_singer_name').text(respone[0]);
                singer_name_error = respone[1];
            }
        });
    });

    //Singer
    $(".singer_add_submit_btn").click(function(){
        const SName = document.querySelector(".checking_singer_name");
        const SCate = document.querySelector(".checking_singer_cate");
        var img_short  = document.getElementById('default-btn-short');
        var img_short_path = img_short.value;
        var a, b, d;
    
        Swal.fire({
            icon: "warning",
            title: "Save Singer",
            text: 'Are you sure you want to save this singer?',
            showCancelButton: true,
            confirmButtonText: `Yes`,
            denyButtonText: `No`,
            
        }).then((result) => {
            if (result.isConfirmed)
            {
                if(img_short_path == "" || img_short_path == null)
                {
                    d = 1;
                    $('.error_shortimg').text("*No file selected");
                }
                else
                {
                    d = 0;
                    $('.error_shortimg').text("");
                }

                if(SName.value == "" || SName.value == null)
                {
                    $('.error_singer_name').text("*Please fill in this field");
                    a = 1;
                }
                else if(singer_name_error == 1)
                    a = 1;
                else
                    a = 0;

                if(SCate.value == "" || SCate.value == null)
                {
                    $('.error_singer_cate').text("*Please fill in this field");
                    b = 1;
                }
                else if(SCate_error == 1)
                    b = 1;
                else
                    b = 0;

                if(a==1 || b==1 || d==1)
                {
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please make sure data input is all valid.', 
                        icon:'error',
                        didClose: () => window.scrollTo(0,0)});
                }
                else
                {
                    var formData = new FormData();
                    const shortimg = document.querySelector("#default-btn-short");
                    var property = shortimg.files[0];
                    formData.append("files[]",property);

                    $.ajax({
                        type: "POST",
                        url: "php/validation/addSingerImg.php",
                        dataType: 'json',
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success:function(data)
                        {
                            var desc_data = CKEDITOR.instances.ckeditor.getData();
                            var form_data = $('.add_singer_form').serializeArray();
                            form_data.push({name: "shortimg", value: data[0]});
                            form_data.push({name: "add_singer_submitBtn", value: 1});
                            form_data.push({name: "desc_data", value: desc_data});
                            $.ajax({
                                type: "POST",
                                url: "php/validation/form_validation.php",
                                data: form_data,
                                success:function(respone)
                                {
                                    if(respone[0])
                                    {
                                        Swal.fire({
                                        title:'Successfully!', 
                                        text:'A new singer has been added.', 
                                        icon:'success',
                                        didClose: () => 
                                        window.open("./singer.php", "_self")});
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
                                error: function ()
                                {
                                    Swal.fire({
                                    title:'Oops! Something went wrong...', 
                                    text:'Please try again later', 
                                    icon:'error',
                                    didClose: () => window.scrollTo(0,0)});
                                }
                            });
                        },
                        error: function ()
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
        })
    });

    $(".singer_update_submit_btn").click(function(){
        const SName = document.querySelector(".checking_updated_singer_name");
        const SCate = document.querySelector(".checking_singer_cate");
        const imgShort = document.querySelector(".preimg-short");
        var img_short  = document.getElementById('default-btn-short');
        var img_short_path = img_short.value;
        var a, b, d;
        var imgurl = /\.(jpeg|jpg|gif|png)$/;
    
        Swal.fire({
            icon: "warning",
            title: "Update Singer",
            text: 'Are you sure you want to update this singer?',
            showCancelButton: true,
            confirmButtonText: `Yes`,
            denyButtonText: `No`,
            
        }).then((result) => {
            if (result.isConfirmed)
            {
                if((imgShort.src).match(imgurl) != null && img_short_path === "")
                {
                    d = 0;
                }
                else if(img_short_path === "" || img_short_path === null)
                {
                    d = 1;
                    $('.error_shortimg').text("*No file selected");
                }
                else
                {
                    d = 0;
                    $('.error_shortimg').text("");
                }

                if(SName.value == "" || SName.value == null)
                {
                    $('.error_singer_name').text("*Please fill in this field");
                    a = 1;
                }
                else if(typeof singer_name_error == 'undefined')
                    a = 0;
                else if(singer_name_error == 1)
                    a = 1;
                else
                    a = 0;

                if(SCate.value == "" || SCate.value == null)
                {
                    $('.error_singer_cate').text("*Please fill in this field");
                    b = 1;
                }
                else if(typeof SCate_error == 'undefined')
                    b = 0;
                else if(SCate_error == 1)
                    b = 1;
                else
                    b = 0;

                if(a==1 || b==1 || d==1)
                {
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please make sure data input is all valid.', 
                        icon:'error',
                        didClose: () => window.scrollTo(0,0)});
                }
                else
                {
                    const shortimg = document.querySelector("#default-btn-short");
                    const SID = document.querySelector(".singer_id");
                    var formData = new FormData();
                    var property = shortimg.files[0];
                    formData.append("files[]",property);

                    formData.append("SID",SID.value);

                    $.ajax({
                        type: "POST",
                        url: "php/validation/addSingerImg.php",
                        dataType: 'json',
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success:function(data)
                        {
                            var desc_data = CKEDITOR.instances.ckeditor.getData();
                            var form_data = $('.update_singer_form').serializeArray();
                            form_data.push({name: "shortimg", value: data[0]});
                            form_data.push({name: "update_singer_submitBtn", value: 1});
                            form_data.push({name: "desc_data", value: desc_data});
                            //console.log(form_data);
                            $.ajax({
                                type: "POST",
                                url: "php/validation/form_validation.php",
                                data: form_data,
                                dataType: 'json',
                                success:function(respone)
                                {
                                    if(respone[0])
                                    {
                                        Swal.fire({
                                        title:'Successfully!', 
                                        text:'Singer has been updated.', 
                                        icon:'success',
                                        didClose: () => 
                                        window.open("./singer.php", "_self")});
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
                                error: function ()
                                {
                                    Swal.fire({
                                    title:'Oops! Something went wrong...', 
                                    text:'Please try again later', 
                                    icon:'error',
                                    didClose: () => window.scrollTo(0,0)});
                                }
                            });
                        },
                        error: function (respone)
                        {
                            console.log(respone);
                            Swal.fire({
                                title:'Oops! Something went wrong...', 
                                text:'Please try again later', 
                                icon:'error',
                                didClose: () => window.scrollTo(0,0)});
                        }
                    
                    });
                }
            }
        })
    });

    //Venue
    $(".venue_add_submit_btn").click(function(){
        const VName = document.querySelector(".checking_venue_name");
        const VState = document.querySelector(".checking_VState");
        const VLocation = document.querySelector(".checking_venue_location");
        const Viframe = document.querySelector(".checking_venue_iframe");
        var img_location  = document.getElementById('default-btn-location');
        var img_location_path = img_location.value;
        var a, b, c, d, e;
    
        Swal.fire({
            icon: "warning",
            title: "Save Venue",
            text: 'Are you sure you want to save this venue?',
            showCancelButton: true,
            confirmButtonText: `Yes`,
            denyButtonText: `No`,
            
        }).then((result) => {
            if (result.isConfirmed)
            {
                if(Viframe.value == "" || Viframe.value == null)
                {
                    $('.error_venue_iframe').text("*Please fill in this field");
                    e = 1;
                }
                else if(venue_iframe_error == 1)
                    e = 1;
                else
                    e = 0;

                if(img_location_path == "" || img_location_path == null)
                {
                    d = 1;
                    $('.error_locationimg').text("*No file selected");
                }
                else
                {
                    d = 0;
                    $('.error_locationimg').text("");
                }

                if(VName.value == "" || VName.value == null)
                {
                    $('.error_venue_name').text("*Please fill in this field");
                    a = 1;
                }
                else if(venue_name_error == 1)
                    a = 1;
                else
                    a = 0;

                if(VState.value == "" || VState.value == null)
                {
                    $('.error_VState').text("*Please fill in this field");
                    b = 1;
                }
                else if(VState_error == 1)
                    b = 1;
                else
                    b = 0;

                if(VLocation.value == "" || VLocation.value == null)
                {
                    $('.error_venue_location').text("*Please fill in this field");
                    c = 1;
                }
                else if(venue_location_error == 1)
                    c = 1;
                else
                    c = 0;
                

                if(a==1 || b==1 || c==1 || d==1 || e==1)
                {
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please make sure data input is all valid.', 
                        icon:'error',
                        didClose: () => window.scrollTo(0,0)});
                }
                else
                {
                    var formData = new FormData();
                    const locationimg = document.querySelector("#default-btn-location");
                    var property = locationimg.files[0];
                    formData.append("files[]",property);

                    $.ajax({
                        type: "POST",
                        url: "php/validation/addVenueImg.php",
                        dataType: 'json',
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success:function(data)
                        {
                            var desc_data = CKEDITOR.instances.ckeditor.getData();
                            var form_data = $('.add_venue_form').serializeArray();
                            form_data.push({name: "locationimg", value: data[0]});
                            form_data.push({name: "add_venue_submitBtn", value: 1});
                            form_data.push({name: "desc_data", value: desc_data});
                            $.ajax({
                                type: "POST",
                                url: "php/validation/form_validation.php",
                                data: form_data,
                                success:function(respone)
                                {
                                    //alert(respone);
                                    Swal.fire({
                                    title:'Successfully!', 
                                    text:'A new venue has been added.', 
                                    icon:'success',
                                    didClose: () => 
                                    window.open("./venue.php", "_self")});
                                    
                                },
                                error: function ()
                                {
                                    Swal.fire({
                                    title:'Oops! Something went wrong...', 
                                    text:'Please try again later', 
                                    icon:'error',
                                    didClose: () => window.scrollTo(0,0)});
                                }
                            });
                        },
                        error: function ()
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
        })
    });

    $(".venue_update_submit_btn").click(function(){
        const VName = document.querySelector(".checking_update_venue_name");
        const VState = document.querySelector(".checking_VState");
        const VLocation = document.querySelector(".checking_venue_location");
        const Viframe = document.querySelector(".checking_venue_iframe");
        const imgLocation = document.querySelector(".preimg-location");
        var img_location  = document.getElementById('default-btn-location');
        var img_location_path = img_location.value;
        var a, b, c, d, e;
        var imgurl = /\.(jpeg|jpg|gif|png)$/;
    
        Swal.fire({
            icon: "warning",
            title: "Update Venue",
            text: 'Are you sure you want to update this venue?',
            showCancelButton: true,
            confirmButtonText: `Yes`,
            denyButtonText: `No`,
            
        }).then((result) => {
            if (result.isConfirmed)
            {
                if(Viframe.value == "" || Viframe.value == null)
                {
                    $('.error_venue_iframe').text("*Please fill in this field");
                    e = 1;
                }
                else if(typeof venue_iframe_error == 'undefined')
                {
                    e = 0;
                }
                else if(venue_iframe_error == 1)
                    e = 1;
                else
                    e = 0;

                if((imgLocation.src).match(imgurl) != null && img_location_path === "")
                {
                    d = 0;
                }
                else if(img_location_path === "" || img_location_path === null)
                {
                    d = 1;
                    $('.error_locationimg').text("*No file selected");
                }
                else
                {
                    d = 0;
                    $('.error_locationimg').text("");
                }

                if(VName.value == "" || VName.value == null)
                {
                    $('.error_venue_name').text("*Please fill in this field");
                    a = 1;
                }
                else if(typeof venue_name_error == 'undefined')
                {
                    a = 0;
                }
                else if(venue_name_error == 1)
                    a = 1;
                else
                    a = 0;

                if(VState.value == "" || VState.value == null)
                {
                    $('.error_VState').text("*Please fill in this field");
                    b = 1;
                }
                else if(typeof VState_error == 'undefined')
                {
                    b = 0;
                }
                else if(VState_error == 1)
                    b = 1;
                else
                    b = 0;

                if(VLocation.value == "" || VLocation.value == null)
                {
                    $('.error_venue_location').text("*Please fill in this field");
                    c = 1;
                }
                else if(typeof venue_location_error == 'undefined')
                {
                    c = 0;
                }
                else if(venue_location_error == 1)
                    c = 1;
                else
                    c = 0;
                

                if(a==1 || b==1 || c==1 || d==1 || e==1)
                {
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please make sure data input is all valid.', 
                        icon:'error',
                        didClose: () => window.scrollTo(0,0)});
                }
                else
                {
                    const locationimg = document.querySelector("#default-btn-location");
                    const VID = document.querySelector(".venue_id");
                    var formData = new FormData();
                    var property = locationimg.files[0];
                    formData.append("files[]",property);

                    formData.append("VID",VID.value);

                    $.ajax({
                        type: "POST",
                        url: "php/validation/addVenueImg.php",
                        dataType: 'json',
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success:function(data)
                        {
                            var desc_data = CKEDITOR.instances.ckeditor.getData();
                            var form_data = $('.update_venue_form').serializeArray();
                            form_data.push({name: "locationimg", value: data[0]});
                            form_data.push({name: "update_venue_submitBtn", value: 1});
                            form_data.push({name: "desc_data", value: desc_data});
                            //console.log(form_data);
                            $.ajax({
                                type: "POST",
                                url: "php/validation/form_validation.php",
                                data: form_data,
                                dataType: 'json',
                                success:function(respone)
                                {
                                    //console.log(respone[0])
                                    //alert(respone);
                                    Swal.fire({
                                    title:'Successfully!', 
                                    text:'Venue has been updated.', 
                                    icon:'success',
                                    didClose: () => 
                                    window.open("./venue.php", "_self")
                                    });
                                },
                                error: function ()
                                {
                                    Swal.fire({
                                    title:'Oops! Something went wrong...', 
                                    text:'Please try again later', 
                                    icon:'error',
                                    didClose: () => window.scrollTo(0,0)});
                                }
                            });
                        },
                        error: function ()
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
        })
    });

    //Concert
    $(".concert_add_submit_btn").click(function(){
        const CName = document.querySelector(".checking_concert_name");
        const CSDate = document.querySelector(".checking_CSDate");
        const SSDate = document.querySelector(".checking_SSDate");
        const SEDate = document.querySelector(".checking_SEDate");
        const CSinger = document.querySelector(".checking_CSinger");
        const COrganizer = document.querySelector(".checking_COrganizer");
        const CVenue = document.querySelector(".checking_CVenue");
        const CStatus = document.querySelector(".checking_CStatus");
        var img_short = document.getElementById('default-btn-short');
        var img_short_path = img_short.value;
        var img_long  = document.getElementById('default-btn-long');
        var img_long_path = img_long.value;
        var img_location  = document.getElementById('default-btn-location');
        var img_location_path = img_location.value;
        var a, b, d, e, f, g, h, i, j, k, l, p, q, r;

    
        Swal.fire({
            icon: "warning",
            title: "Save Concert",
            text: 'Are you sure you want to save this concert?',
            showCancelButton: true,
            confirmButtonText: `Yes`,
            denyButtonText: `No`,
            
        }).then((result) => {
            $('.area_name').each(function(){
               //find <input>'s parent
               var find = $(this).closest("td");
                //filter out label in the parent "td"
               var row = find.contents().filter("label");
                if($(this).val()=="")
                {
                   row.css({"opacity": "1"}); 
                }
                else
                {
                    row.css({"opacity": "0"});
                }
            });
               $('.area_price').each(function(){
                   //find <input>'s parent
                   var find = $(this).closest("td");
                   //filter out label in the parent "td"
                   var row = find.contents().filter("label");
                       if($(this).val()=="")
                       {
                           row.css({"opacity": "1"});
                       }
                       else
                       {
                           row.css({"opacity": "0"});
                       }
               });
               $('.numberOfseat').each(function(){
                   //find <input>'s parent
                   var find = $(this).closest("td");
                   //filter out label in the parent "td"
                   var row = find.contents().filter("label");
                       if($(this).val()==="")
                       {
                           row.css({"opacity": "1"}); 
                       }
                       else
                       {
                           row.css({"opacity": "0"});
                       }
               });

            if (result.isConfirmed)
            {
                if(img_short_path == "" || img_short_path == null)
                {
                    j = 1;
                    $('.error_shortimg').text("*No file selected");
                }
                else
                {
                    j = 0;
                    $('.error_shortimg').text("");
                }

                if(img_long_path == "" || img_long_path == null)
                {
                    k = 1;
                    $('.error_longimg').text("*No file selected");
                }
                else
                {
                    k = 0;

                    $('.error_longimg').text("");
                }

                if(img_location_path == "" || img_location_path == null)
                {
                    l = 1;
                    $('.error_locationimg').text("*No file selected");
                }
                else
                {
                    l = 0;
                    $('.error_locationimg').text("");
                }

                if(CName.value == "" || CName.value == null)
                {
                    $('.error_concert_name').text("*Please fill in this field");
                    a = 1;
                }
                else if(concert_name_error == 1)
                    a = 1;
                else
                    a = 0;

                if(CSinger.value == "" || CSinger.value == null)
                {
                    $('.error_CSinger').text("*Please fill in this field");
                    f = 1;
                }
                else if(CSinger_error == 1)
                    f = 1;
                else
                    f = 0;

                if(COrganizer.value == "" || COrganizer.value == null)
                {
                    $('.error_COrganizer').text("*Please fill in this field");
                    g = 1;
                }
                else if(COrganizer_error == 1)
                    g = 1;
                else
                    g = 0;
                
                if(CVenue.value == "" || CVenue.value == null)
                {
                    $('.error_CVenue').text("*Please fill in this field");
                    h = 1;
                }
                else if(CVenue_error == 1)
                    h = 1;
                else
                    h = 0;

                if(CStatus.value == "" || CStatus.value == null)
                {
                    $('.error_CStatus').text("*Please fill in this field");
                    i = 1;
                }
                else if(CStatus_error == 1)
                    i = 1;
                else
                    i = 0;
                    
                if(CSDate.value == "" || CSDate.value == null)
                {
                    $('.error_CSDate').text("*Please fill in this field");
                    b = 1;
                }
                else if(CSDate_error == 1)
                    b = 1;

                if(SSDate.value == "" || SSDate.value == null)
                {
                    $('.error_SSDate').text("*Please fill in this field");
                    d = 1;
                }
                else if(SSDate_error == 1)
                    d = 1;
                else
                {
                    d = 0;
                    if(SEDate.value == "" || SEDate.value == null)
                    {
                        $('.error_SEDate').text("*Please fill in this field");
                        e = 1;
                    }
                    else if(SEDate_error == 1)
                        e = 1;
                    else
                        e = 0;
                }

                $('.area_name').each(function(){
                    if($(this).val()=="")
                    {
                        p = 1;
                        return false;
                    }
                    else
                    {
                        p = 0;
                    }
                });
                $('.area_price').each(function(){
                    if($(this).val()=="")
                    {
                        q = 1;
                        return false;
                    }
                    else
                    {
                        q = 0;
                    }

                });
                $('.numberOfseat').each(function(){
                    if($(this).val()==="")
                    {
                        r = 1;
                        return false;
                    }
                    else
                    {
                        r = 0;
                    }
                });
                if(a==1 || b==1 || d==1 || e==1 || f==1 || g==1 || h==1 || i==1 || k==1 || j==1 || l==1 || p==1 || q==1 || r==1)
                {
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please make sure data input is all valid.', 
                        icon:'error',
                        didClose: () => window.scrollTo(0,0)});
                }
                else
                {
                    const shortimg = document.querySelector("#default-btn-short");
                    var property = shortimg.files[0];
                    var formData = new FormData();
                    formData.append("files[]",property);

                    const longimg = document.querySelector("#default-btn-long");
                    var property = longimg.files[0];
                    formData.append("files[]",property);

                    const locationimg = document.querySelector("#default-btn-location");
                    var property = locationimg.files[0];
                    formData.append("files[]",property);

                    $.ajax({
                        type: "POST",
                        url: "php/validation/addConcertImg.php",
                        dataType: 'json',
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success:function(data)
                        {
                            var desc_data = CKEDITOR.instances.ckeditor.getData();
                            var form_data = $('.add_concert_form').serializeArray();
                            form_data.push({name: "shortimg", value: data[0]});
                            form_data.push({name: "longimg", value: data[1]});
                            form_data.push({name: "locationimg", value: data[2]});
                            form_data.push({name: "add_concert_submitBtn", value: 1});
                            form_data.push({name: "desc_data", value: desc_data});
                            $.ajax({
                                type: "POST",
                                url: "php/validation/form_validation.php",
                                data: form_data,
                                success:function(respone)
                                {
                                    console.log(respone);
                                    if(respone)
                                    {
                                        Swal.fire({
                                        title:'Successfully!', 
                                        text:'A new concert has been added.', 
                                        icon:'success',
                                        didClose: () => 
                                        window.open("./concert.php", "_self")});
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
                                error: function (respone)
                                {
                                    console.log(respone);
                                    Swal.fire({
                                    title:'Oops! Something went wrong...', 
                                    text:'Please try again later', 
                                    icon:'error',
                                    didClose: () => window.scrollTo(0,0)});
                                }
                            });
                        },
                        error: function ()
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
        })
    });

    $(".concert_update_submit_btn").click(function(){
        const CName = document.querySelector(".checking_update_concert_name");
        const CSDate = document.querySelector(".checking_CSDate");
        const SSDate = document.querySelector(".checking_SSDate");
        const SEDate = document.querySelector(".checking_SEDate");
        const CSinger = document.querySelector(".checking_CSinger");
        const COrganizer = document.querySelector(".checking_COrganizer");
        const CVenue = document.querySelector(".checking_CVenue");
        const CStatus = document.querySelector(".checking_CStatus");
        const CID = document.querySelector(".concert_id");
        const imgShort = document.querySelector(".preimg-short");
        const imgLong = document.querySelector(".preimg-long");
        const imgLocation = document.querySelector(".preimg-location");

        var img_short = document.getElementById('default-btn-short');
        var img_short_path = img_short.value;
        var img_long  = document.getElementById('default-btn-long');
        var img_long_path = img_long.value;
        var img_location  = document.getElementById('default-btn-location');
        var img_location_path = img_location.value;
        var a, b, d, e, f, g, h, i, j, k, l, p, q, r;
        
        var imgurl = /\.(jpeg|jpg|gif|png)$/;

        Swal.fire({
            icon: "warning",
            title: "Update Concert",
            text: 'Are you sure you want to update this concert?',
            showCancelButton: true,
            confirmButtonText: `Yes`,
            denyButtonText: `No`,
        }).then((result) => {
            if (result.isConfirmed)
            {
            $('.area_name').each(function(){
               //find <input>'s parent
               var find = $(this).closest("td");
                //filter out label in the parent "td"
               var row = find.contents().filter("label");
                if($(this).val()=="")
                {
                   row.css({"opacity": "1"}); 
                }
                else
                {
                    row.css({"opacity": "0"});
                }
            });
               $('.area_price').each(function(){
                   //find <input>'s parent
                   var find = $(this).closest("td");
                   //filter out label in the parent "td"
                   var row = find.contents().filter("label");
                       if($(this).val()=="")
                       {
                           row.css({"opacity": "1"});
                       }
                       else
                       {
                           row.css({"opacity": "0"});
                       }
               });
               $('.numberOfseat').each(function(){
                   //find <input>'s parent
                   var find = $(this).closest("td");
                   //filter out label in the parent "td"
                   var row = find.contents().filter("label");
                       if($(this).val()=="")
                       {
                           row.css({"opacity": "1"}); 
                       }
                       else
                       {
                           row.css({"opacity": "0"});
                       }
               });

                if((imgShort.src).match(imgurl) != null && img_short_path === "")
                {
                    j = 0;
                }
                else if(img_short_path === "" || img_short_path === null || imgShort.src == null)
                {
                    j = 1;
                    $('.error_shortimg').text("*No file selected");
                }
                else
                {
                    j = 0;
                    $('.error_shortimg').text("");
                }

                if((imgLong.src).match(imgurl) != null && img_long_path === "")
                {
                    k = 0;
                }
                else if(img_long_path === "" || img_long_path === null || imgLong.src==null)
                {
                    k = 1;
                    $('.error_longimg').text("*No file selected");
                }
                else
                {
                    k = 0;
                    $('.error_longimg').text("");
                }

                if((imgLocation.src).match(imgurl) != null && img_location_path === "")
                {
                    l = 0;
                }
                else if(img_location_path === "" || img_location_path === null ||imgLocation.src==null)
                {
                    l = 1;
                    $('.error_locationimg').text("*No file selected");
                }
                else
                {
                    l = 0;
                    $('.error_locationimg').text("");
                }

                if(CName.value == "" || CName.value == null)
                {
                    $('.error_concert_name').text("*Please fill in this field");
                    a = 1;
                }
                else if(typeof concert_name_error == 'undefined')
                {
                    a=0;
                }
                else if(concert_name_error == 1)
                    a = 1;
                else
                    a = 0;

                if(CSinger.value == "" || CSinger.value == null)
                {
                    $('.error_CSinger').text("*Please fill in this field");
                    f = 1;
                }
                else if(typeof CSinger_error == 'undefined')
                {
                    f=0;
                }
                else if(CSinger_error == 1)
                    f = 1;
                else
                    f = 0;

                if(COrganizer.value == "" || COrganizer.value == null)
                {
                    $('.error_COrganizer').text("*Please fill in this field");
                    g = 1;
                }
                else if(typeof COrganizer_error == 'undefined')
                {
                    g=0;
                }
                else if(COrganizer_error == 1)
                    g = 1;
                else
                    g = 0;
                
                if(CVenue.value == "" || CVenue.value == null)
                {
                    $('.error_CVenue').text("*Please fill in this field");
                    h = 1;
                }
                else if(typeof CVenue_error == 'undefined')
                {
                    h=0;
                }
                else if(CVenue_error == 1)
                    h = 1;
                else
                    h = 0;

                if(CStatus.value == "" || CStatus.value == null)
                {
                    $('.error_CStatus').text("*Please fill in this field");
                    i = 1;
                }
                else if(typeof CStatus_error == 'undefined')
                {
                    i=0;
                }
                else if(CStatus_error == 1)
                    i = 1;
                else
                    i = 0;
                    
                if(CSDate.value == "" || CSDate.value == null)
                {
                    $('.error_CSDate').text("*Please fill in this field");
                    b = 1;
                }
                else if(typeof CSDate_error == 'undefined')
                {
                    b=0;
                }
                else if(CSDate_error == 1)
                    b = 1;
                else
                {
                    b = 0;
                }

                if(SSDate.value == "" || SSDate.value == null)
                {
                    $('.error_SSDate').text("*Please fill in this field");
                    d = 1;
                }
                else if(typeof SSDate_error == 'undefined')
                {
                    d=0;
                    if(SEDate.value == "" || SEDate.value == null)
                    {
                        $('.error_SEDate').text("*Please fill in this field");
                        e = 1;
                    }
                    else if(typeof SEDate_error == 'undefined')
                    {
                        e=0;
                    }
                    else if(SEDate_error == 1)
                        e = 1;
                    else
                        e = 0;
                }
                else if(SSDate_error == 1)
                    d = 1;
                else
                {
                    d = 0;
                    if(SEDate.value == "" || SEDate.value == null)
                    {
                        $('.error_SEDate').text("*Please fill in this field");
                        e = 1;
                    }
                    else if(typeof SEDate_error == 'undefined')
                    {
                        e=0;
                    }
                    else if(SEDate_error == 1)
                        e = 1;
                    else
                        e = 0;
                }

                $('.area_name').each(function(){
                    if($(this).val()=="")
                    {
                        p = 1;
                        return false;
                    }
                    else
                    {
                        p = 0;
                    }
                });
                $('.area_price').each(function(){
                    if($(this).val()=="")
                    {
                        q = 1;
                        return false;
                    }
                    else
                    {
                        q = 0;
                    }

                });
                $('.numberOfseat').each(function(){
                    if($(this).val()==="")
                    {
                        r = 1;
                        return false;
                    }
                    else
                    {
                        r = 0;
                    }
                });

                if(a==1 || b==1 || d==1 || e==1 || f==1 || g==1 || h==1 || i==1 || k==1 || j==1 || l==1 || p==1 || q==1 || r==1)
                {
                    Swal.fire({
                        title:'Oops!', 
                        text:'Please make sure data input is all valid.', 
                        icon:'error',
                        didClose: () => window.scrollTo(0,0)});
                }
                else
                {
                    
                    const shortimg = document.querySelector("#default-btn-short");
                    var property = shortimg.files[0];
                    var formData = new FormData();
                    formData.append("files[0]",property);

                    const longimg = document.querySelector("#default-btn-long");
                    var property = longimg.files[0];
                    formData.append("files[1]",property);

                    const locationimg = document.querySelector("#default-btn-location");
                    var property = locationimg.files[0];
                    formData.append("files[2]",property);

                    formData.append("CID",CID.value);

                    $.ajax({
                        type: "POST",
                        url: "php/validation/addConcertImg.php",
                        dataType: 'json',
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success:function(data)
                        {
                            console.log(data[0]);
                            console.log(data[1]);
                            console.log(data[2]);
                            var desc_data = CKEDITOR.instances.ckeditor.getData();
                            var form_data = $('.concert_update_form').serializeArray();
                            form_data.push({name: "shortimg", value: data[0]});
                            form_data.push({name: "longimg", value: data[1]});
                            form_data.push({name: "locationimg", value: data[2]});
                            form_data.push({name: "update_concert_submitBtn", value: 1});
                            form_data.push({name: "desc_data", value: desc_data});
                            $.ajax({
                                type: "POST",
                                url: "php/validation/form_validation.php",
                                data:form_data,
                                success:function(respone)
                                {
                                    console.log(respone);
                                    if(respone)
                                    {    Swal.fire({
                                        title:'Successfully!', 
                                        text:'Concert has been updated.', 
                                        icon:'success',
                                        didClose: () => window.open("./concert.php", "_self")        
                                        });
                                    }
                                    else
                                    {
                                        console.log("salah1");
                                        Swal.fire({
                                            title:'Oops! Something went wrong...', 
                                            text:'Please try again later1', 
                                            icon:'error',
                                            didClose: () => window.scrollTo(0,0)
                                        });
                                    }
                                },
                                error: function ()
                                {
                                    console.log("salah");
                                    Swal.fire({
                                    title:'Oops! Something went wrong...', 
                                    text:'Please try again later1', 
                                    icon:'error',
                                    didClose: () => window.scrollTo(0,0)});
                                }
                            });
                        },
                    });
                }
            }
        })
    });
    //end of admin concert

    $('.checking_email').keyup(function(){
        var emaill = $('.checking_email').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
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
            url: "php/validation/form_validation.php",
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

    $('.checking_new_email').keyup(function(){
        var emaill = $('.checking_new_email').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "email_new_key_submit_btn": 1,
                    "emaill_id" : emaill,
            },
            success: function(respone){
                $('.error_new_email').text(respone[0]);
                email_new_error = respone[1];
            }
        });
    });

    $('.checking_new_email').blur(function(){
        var emaill = $('.checking_new_email').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "email_new_submit_btn": 1,
                    "emaill_id" : emaill,
            },
            success: function(respone){
                $('.error_new_email').text(respone[0]);
                email_new_error = respone[1];
            }
        });
    });

    $('.checking_cpassword').keyup(function(){
        var cpassword_valid = $('.checking_cpassword').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
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
            url: "php/validation/form_validation.php",
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

    //158 158
    $('.checking_gender').blur(function(){
        var fname_valid = $('.checking_gender').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
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
    });

    $('.checking_new_password').keyup(function(){
        var keypassword_valid = $('.checking_new_password').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
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
                        $('.error_new_password').text("");
            }
        });
        var new_cpassword_valid = $('.checking_new_cpassword').val();
        var new_password_valid = $('.checking_new_password').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "new_cpassword_submit_btn": 1,
                    "cpassword_valid": new_cpassword_valid,
                    "password_valid": new_password_valid,
            },
            success: function(respone){
                new_cpassword_error = respone[1];
            }
        });
    });

    $('.checking_new_password').blur(function(){
        var new_password_valid = $('.checking_new_password').val();
        //alert(password_valid);
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "new_password_submit_btn_blur": 1,
                    "password_valid": new_password_valid,
            },
            success: function(respone){
                if(new_password_error_keyup_null == 1)
                {
                    $('.error_new_password').text("*Please fill in this field");
                }
                else if(new_password_error_keyup == 0)
                {
                    $('.error_new_password').text("*Invalid password format");
                    new_password_error_blur = 1;
                }
                else
                {
                    $('.error_new_password').text(respone[0]);
                    new_password_error_blur = respone[1];
                }
            }
        });
        var new_cpassword_valid = $('.checking_new_cpassword').val();
        var new_password_valid = $('.checking_new_password').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "new_cpassword_submit_btn": 1,
                    "cpassword_valid": new_cpassword_valid,
                    "password_valid": new_password_valid,
            },
            success: function(respone){
                new_cpassword_error = respone[1];
            }
        });
    });

    $('.checking_new_cpassword').keyup(function(){
        var new_cpassword_valid = $('.checking_new_cpassword').val();
        var new_password_valid = $('.checking_new_password').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "new_cpassword_submit_btn": 1,
                    "cpassword_valid": new_cpassword_valid,
                    "password_valid": new_password_valid,
            },
            success: function(respone){
                $('.error_new_cpassword').text(respone[0]);
                new_cpassword_error = respone[1];
            }
        });
    });

    $('.checking_new_cpassword').blur(function(){
        var new_cpassword_valid = $('.checking_new_cpassword').val();
        var new_password_valid = $('.checking_new_password').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "new_cpassword_submit_btn": 1,
                    "cpassword_valid": new_cpassword_valid,
                    "password_valid": new_password_valid,
            },
            success: function(respone){
                $('.error_new_cpassword').text(respone[0]);
                new_cpassword_error = respone[1];
            }
        });
    });

    //old
    $('.checking_old_password').keyup(function(){
        var old_password_valid = $('.checking_old_password').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "old_password_submit_btn": 1,
                    "old_password_valid": old_password_valid,
            },
            success: function(respone){
                $('.error_old_password').text(respone[0]);
                old_password_error = respone[1];
            }
        });
    });

    $('.checking_old_password').blur(function(){
        var old_password_valid = $('.checking_old_password').val();
        $.ajax({
            type: "POST",
            url: "php/validation/form_validation.php",
            dataType: 'json',
            data: {
                    "old_password_submit_btn": 1,
                    "old_password_valid": old_password_valid,
            },
            success: function(respone){
                $('.error_old_password').text(respone[0]);
                old_password_error = respone[1];
            }
        });
    });
});