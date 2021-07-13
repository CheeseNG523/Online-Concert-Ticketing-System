<?php include 'header_sidebar.php';
    include 'dataconnection.php';
    if(isset($_GET['edit']))
	{
        $venue_id = $_GET['id'];
        $result = "select * from venue where Venue_ID = '$venue_id'";
		$result_run = mysqli_query($connect,$result);
        $row = mysqli_fetch_assoc($result_run);

        $locationextension = pathinfo($row['Venue_Image'],PATHINFO_BASENAME);
	}
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
            <label class="current_direction">Update Venue</label>
        </div>
    </div>
    <div class="page_position">
    <div class="page_form">              
    <div class='back-to-prev' onclick="history.back()"><span class="material-icons">arrow_back_ios</span>Back</div>
        <form action="" class="update_venue_form" method="post" autocomplete="off">
        <input hidden type="text" value="<?php echo $venue_id;?>" name="venue_ID" class="venue_id">
        <div class="container" style="padding:45px;">
            <div class="page">
                <div class="title">Update Venue</div>
                <div style="clear:both; float:left; width:38%; ">
                    <div style="float:left; width:100%;">
                        <div class="page">
                            <div class="wrapper-location active">
                                <div class="image-location">
                                    <img class="preimg-location" src="<?php echo $row['Venue_Image']; ?>" style="display: block;" alt="">
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
                                    <?php echo $locationextension;?>
                                </div>
                            </div>
                            <label id="custom-btn-location" for="default-btn-location">Upload Venue Image</label>
                            <input id="default-btn-location" name="file" type="file" hidden>
                        </div>
                    </div>
                </div>
                <div style="float:left; width:58%; margin-left: 4%;">
                    <div class="txt_field" style="clear:both; margin-bottom:0; margin-top:0;">
                        <textarea type="text" class="checking_update_venue_name" style="padding:10px; resize: none;" name="venue_name"><?php echo $row['Venue_Name']?></textarea>
                        <label>Venue Name</label>
                        <label class="error_venue_name" style="color: red; clear:both; top: 60px; font-size: 11px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="clear:both;">
                        <textarea rows="16" cols="50" class="checking_VDescrip" style="resize: none; padding:9px" id="ckeditor" name="venue_desc"><?php echo $row['Venue_Description']?></textarea>
                        <label>Venue Description</label>
                    </div>
                </div>

                <div class="txt_field" style="clear:both; margin-bottom:0; margin-top:0;">
                    <select class="checking_VState" name="venue_state">
                            <option value="Johor"
                            <?php 
                                if($row['Venue_State']=="Johor")
                                    echo "selected";
                             ?>
                            >Johor</option>
                            <option value="Kedah"
                            <?php 
                                if($row['Venue_State']=="Kedah")
                                    echo "selected";
                             ?>
                            >Kedah</option>
                            <option value="Kelantan"
                            <?php 
                                if($row['Venue_State']=="Kelantan")
                                    echo "selected";
                             ?>
                             >Kelantan</option>
                            <option value="Kuala Lumpur"
                            <?php 
                                if($row['Venue_State']=="Kuala Lumpur")
                                    echo "selected";
                             ?>
                             >Kuala Lumpur</option>
                            <option value="Labuan"
                            <?php 
                                if($row['Venue_State']=="Labuan")
                                    echo "selected";
                             ?>
                             >Labuan</option>
                            <option value="Melaka"
                            <?php 
                                if($row['Venue_State']=="Melaka")
                                    echo "selected";
                             ?>
                             >Melaka</option>
                            <option value="Negeri Sembilan"
                            <?php 
                                if($row['Venue_State']=="Negeri Sembilan")
                                    echo "selected";
                             ?>
                             >Negeri Sembilan</option>
                            <option value="Pahang"
                            <?php 
                                if($row['Venue_State']=="Pahang")
                                    echo "selected";
                             ?>
                             >Pahang</option>
                            <option value="Perak"
                            <?php 
                                if($row['Venue_State']=="Perak")
                                    echo "selected";
                             ?>
                             >Perak</option>
                            <option value="Perlis"
                            <?php 
                                if($row['Venue_State']=="Perlis")
                                    echo "selected";
                             ?>
                             >Perlis</option>
                            <option value="Penang"
                            <?php 
                                if($row['Venue_State']=="Penang")
                                    echo "selected";
                             ?>
                             >Penang</option>
                            <option value="Sabah"
                            <?php 
                                if($row['Venue_State']=="Sabah")
                                    echo "selected";
                             ?>
                             >Sabah</option>
                            <option value="Sarawak"
                            <?php 
                                if($row['Venue_State']=="Sarawak")
                                    echo "selected";
                             ?>
                             >Sarawak</option>
                            <option value="Selangor"
                            <?php 
                                if($row['Venue_State']=="Selangor")
                                    echo "selected";
                             ?>
                             >Selangor</option>
                            <option value="Terengganu"
                            <?php 
                                if($row['Venue_State']=="Terengganu")
                                    echo "selected";
                             ?>
                             >Terengganu</option>
                    </select>
                    <label>Venue State</label>
                    <label class="error_VState" style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0;" ></label>
                </div>
                <div class="txt_field" style="clear:both;">
                    <textarea type="text" class="checking_venue_location" style="padding:10px; resize: none;" name="venue_location"><?php echo $row['Venue_Location']?></textarea>
                    <label>Venue Location Link</label>
                    <label class="error_venue_location" style="color: red; clear:both; top: 60px; font-size: 11px; padding: 0;" ></label>
                </div>
                <div class="txt_field" style="clear:both;">
                    <textarea type="text" class="checking_venue_iframe" style="padding:10px; resize: none;" name="venue_iframe"><?php echo $row['Venue_iframe']?></textarea>
                    <label>Venue Location Iframe</label>
                    <label class="error_venue_iframe" style="color: red; clear:both; top: 60px; font-size: 11px; padding: 0;" ></label>
                </div>
                <div class="button_field">
                    <button class="venue_update_submit_btn" type="button" disabled="disabled">Update Venue</button>
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

    CKEDITOR.instances.ckeditor.on('key', function(e) {
        $('.venue_update_submit_btn').prop("disabled","");
    });

        const preimg_location = document.querySelector(".preimg-location");
        const wrapper_location = document.querySelector(".wrapper-location");
        const fileName_location = document.querySelector(".file-name-location");
        const defaultBtn_location = document.querySelector("#default-btn-location");
        const customBtn_location = document.querySelector("#custom-btn-location");
        const cancelBtn_location = document.querySelector("#cancel-btn-location i");
        const img_location = document.querySelector(".preimg-location");

        let regExp = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;
        
        $('.update_venue_form').keyup(function()
        {   
            $('.venue_update_submit_btn').prop("disabled","");
        });

        $('.update_venue_form').change(function()
        {   
            $('.venue_update_submit_btn').prop("disabled","");
        });

        $('#ckeditor').keyup(function()
        {   
            $('.venue_update_submit_btn').prop("disabled","");
        });

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
                reader.readAsDataURL(file);
            }
            if(this.value){
                let valueStore = this.value.match(regExp);
                fileName_location.textContent = valueStore;
            }
        });

        cancelBtn_location.addEventListener("click", function(){
            img_location.src = "";
            wrapper_location.classList.remove("active");
            preimg_location.style.display = "none";
            $('.error_locationimg').text("");
            $('.venue_update_submit_btn').prop("disabled","");
            if(typeof fileInput!=='undefined')
                fileInput.value = "";
        });
</script>
<?php //if($_GET['rel']!='tab'){ echo "</div>";} ?>
<?php include('footer.php'); ?>