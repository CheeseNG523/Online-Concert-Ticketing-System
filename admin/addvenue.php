<?php include 'header_sidebar.php';
    include 'dataconnection.php';
?>
<script src="js/profile_form.js"></script>
<script src="js/ckeditor/ckeditor.js"></script>
    <div class="page_position">
        <div class="position_left">
            <label>Venue</label>
        </div>
        <div class="position_right">
            <a rel="tab" href="dashboard.php">
                <span class="material-icons">dashboard</span><span class="icon_txt">Home</span>
            </a>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">Product</label>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <a rel="tab" href="venue.php">Venue</a>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">Add Venue</label>
        </div>
    </div>
    <div class="page_position">
    <div class="page_form">        
    <div class='back-to-prev' onclick="history.back()"><span class="material-icons">arrow_back_ios</span>Back</div>      
        <form action="" class="add_venue_form" method="post" autocomplete="off">
        <div class="container" style="padding:45px;">
            <div class="page">
                <div class="title">Add Venue</div>
                <div class="alert password_alert">
                    <span class="material-icons password_alert_icon" style="vertical-align: middle; font-size: 20px;"></span>
                    <label class="change_password_alert"></label>
                </div>
                <div style="clear:both; float:left; width:38%; ">
                    <div style="float:left; width:100%;">
                        <div class="page">
                            <div class="wrapper-location">
                                <div class="image-location">
                                    <img class="preimg-location" src="" alt="">
                                </div>
                                <div class="img-content-location" style="margin: 0 auto;">
                                    <div class="icon">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                    </div>
                                    <div class="text">No file chosen, yet!</div>
                                    <label class="error_locationimg" style="color: red; clear:both; font-size: 13px; padding: 0; font-weight:600"></label>
                                </div>
                                <div id="cancel-btn-location">
                                    <i class="fas fa-times"></i>
                                </div>
                                <div class="file-name-location">
                                    File name here
                                </div>
                            </div>
                            <label id="custom-btn-location" for="default-btn-location">Upload Venue Image</label>
                            <input id="default-btn-location" name="file" type="file" hidden>
                        </div>
                    </div>
                </div>
                <div style="float:left; width:58%; margin-left: 4%;">
                    <div class="txt_field" style="clear:both; margin-bottom:0; margin-top:0;">
                        <textarea type="text" class="checking_venue_name" style="padding:10px; resize: none;" name="venue_name"></textarea>
                        <label>Venue Name</label>
                        <label class="error_venue_name" style="color: red; clear:both; top: 60px; font-size: 11px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="clear:both;">
                        <textarea rows="16" cols="50" class="checking_VDescrip" style="resize: none; padding:9px" id="ckeditor" name="concert_desc"></textarea>
                        <label>Venue Description</label>
                    </div>
                </div>

                <div class="txt_field" style="clear:both; margin-bottom:0; margin-top:0;">
                    <select class="checking_VState" name="venue_state">
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
                    <label>Venue State</label>
                    <label class="error_VState" style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0;" ></label>
                </div>
                <div class="txt_field" style="clear:both;">
                    <textarea type="text" class="checking_venue_location" style="padding:10px; resize: none;" name="venue_location"></textarea>
                    <label>Venue Location Link</label>
                    <label class="error_venue_location" style="color: red; clear:both; top: 60px; font-size: 11px; padding: 0;" ></label>
                </div>
                <div class="txt_field" style="clear:both;">
                    <textarea type="text" class="checking_venue_iframe" style="padding:10px; resize: none;" name="venue_iframe"></textarea>
                    <label>Venue Location Iframe</label>
                    <label class="error_venue_iframe" style="color: red; clear:both; top: 60px; font-size: 11px; padding: 0;" ></label>
                </div>
                <div class="button_field">
                    <button class="venue_add_submit_btn" type="button">Add Venue</button>
                    <button class="venue_cancelbtn" type="button" onclick="window.history.back()" style="background-color:#f44336">Cancel</button>
                </div>
            </div>
        </div>
        </form>
    </div>
    </div>
<script>
    CKEDITOR.replace('ckeditor', {
      width: '100%',
      resize_enabled: false,
    });

        const preimg_location = document.querySelector(".preimg-location");
        const wrapper_location = document.querySelector(".wrapper-location");
        const fileName_location = document.querySelector(".file-name-location");
        const defaultBtn_location = document.querySelector("#default-btn-location");
        const customBtn_location = document.querySelector("#custom-btn-location");
        const cancelBtn_location = document.querySelector("#cancel-btn-location i");
        const img_location = document.querySelector(".preimg-location");

        let regExp = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;

        defaultBtn_location.addEventListener("change", function(){
            const file = this.files[0];
            var fileInput =  document.getElementById('default-btn-location'); 
              
            var filePath = fileInput.value; 
            // Allowing file type 
            var allowedExtensions =  /(\.jpg|\.jpeg|\.png|\.gif)$/i; 
              
            if (!allowedExtensions.exec(filePath))
            { 
                img_location.src = "";
                wrapper_location.classList.remove("active");
                preimg_location.style.display = "none";
                $('.error_locationimg').text("*Invalid file format");
                fileInput.value = "";
                return false; 
            }
            else if(file)
            {
                const reader = new FileReader();
                reader.onload = function(){
                    const result = reader.result;
                    img_location.src = result;
                    wrapper_location.classList.add("active");
                    preimg_location.style.display = "block";
                }

                cancelBtn_location.addEventListener("click", function(){
                    img_location.src = "";
                    wrapper_location.classList.remove("active");
                    preimg_location.style.display = "none";
                    $('.error_locationimg').text("");
                    fileInput.value = "";
                });
                reader.readAsDataURL(file);
            }
            if(this.value){
                let valueStore = this.value.match(regExp);
                fileName_location.textContent = valueStore;
            }
        });
</script>
<?php //if($_GET['rel']!='tab'){ echo "</div>";} ?>
<?php include('footer.php'); ?>