<?php include 'header_sidebar.php';
    include 'dataconnection.php';
    $active_result = mysqli_query($connect,"select * from concert where Concert_Status = 0");
    $venue_list = mysqli_query($connect,"select * from venue where Venue_Unable = 0");
    $singer_list = mysqli_query($connect,"select * from singer where Singer_unable = 0");
    $organizer_list = mysqli_query($connect,"select * from organizer where Organizer_unable = 0");

?>
<script src="js/profile_form.js"></script>
<script src="js/ckeditor/ckeditor.js"></script>
    <div class="page_position">
        <div class="position_left">
            <label>Concert</label>
        </div>
        <div class="position_right">
            <a rel="tab" href="dashboard.php">
                <span class="material-icons">dashboard</span><span class="icon_txt">Home</span>
            </a>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">Product</label>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <a rel="tab" href="concert.php">Concert</a>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">Add Concert</label>
        </div>
    </div>
    <div class="page_position">
    <div class="page_form">        
    <div class='back-to-prev' onclick="history.back()"><span class="material-icons">arrow_back_ios</span>Back</div>      
        <form action="" class="add_concert_form" method="post" autocomplete="off">
        <div class="container" style="padding:45px;">
            <div class="page">
                <div class="title">Add Concert</div>
                <div class="alert password_alert">
                    <span class="material-icons password_alert_icon" style="vertical-align: middle; font-size: 20px;"></span>
                    <label class="change_password_alert"></label>
                </div>
                <div style="float:left; width:38%;">
                    <div class="page">
                        <div class="wrapper-short">
                            <div class="image-short">
                                <img class="preimg-short" src="" alt="">
                            </div>
                            <div class="img-content-short" style="margin: 0 auto;">
                                <div class="icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <div class="text">No file chosen, yet!</div>
                                <label class="error_shortimg" style="color: red; clear:both; font-size: 13px; padding: 0; font-weight:600"></label>
                            </div>
                            <div id="cancel-btn-short">
                                <i class="fas fa-times"></i>
                            </div>
                            <div class="file-name-short">
                                File name here
                            </div>
                        </div>
                        <label id="custom-btn-short" for="default-btn-short">Upload Concert Vertical Image</label>
                        <input id="default-btn-short" name="file" type="file" hidden>
                    </div>
                </div>
                <div style="float:left; width:58%; margin-left: 4%; margin-bottom:20px;">
                    <div class="page">
                        <div class="wrapper-long">
                            <div class="image-long">
                                <img class="preimg-long" src="" alt="">
                            </div>
                            <div class="img-content-long" style="margin: 0 auto;">
                                <div class="icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <div class="text">No file chosen, yet!</div>
                                <label class="error_longimg" style="color: red; clear:both; font-size: 13px; padding: 0; font-weight:600"></label>
                            </div>
                            <div id="cancel-btn-long">
                                <i class="fas fa-times"></i>
                            </div>
                            <div class="file-name-long">
                                File name here
                            </div>
                        </div>
                        <label id="custom-btn-long" for="default-btn-long">Upload Concert Horizontal Image</label>
                        <input id="default-btn-long" name="file" type="file" hidden>
                    </div>
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
                            <label id="custom-btn-location" for="default-btn-location">Upload Seat Map</label>
                            <input id="default-btn-location" name="file" type="file" hidden>
                        </div>
                    </div>
                </div>
                <div style="float:left; width:58%; margin-left: 4%;">
                    <div class="txt_field" style="clear:both; margin-bottom:0; margin-top:0;">
                        <textarea type="text" class="checking_concert_name" style="padding:10px; resize: none;" name="concert_name"></textarea>
                        <label>Concert Name</label>
                        <label class="error_concert_name" style="color: red; clear:both; top: 60px; font-size: 11px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="clear:both;">
                        <textarea rows="16" cols="50" class="checking_CDescrip" style="resize: none; padding:9px" id="ckeditor" name="concert_desc"></textarea>
                        <label>Concert Description</label>
                    </div>
                </div>
                <div style="clear:both;">
                    <div class="txt_field" style="width:48.5%; float:left; margin-bottom:0;  margin-top:0;">
                        <input id="concert_CSDate" onkeydown="return false" type="datetime-local" name="concert_SDate" class="checking_CSDate">
                        <label>Concert Start Date</label>
                        <label class="error_CSDate" style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="width:22.75%; float:left; margin-bottom:0; margin-left: 3%; margin-top:0;">
                        <select class="checking_CSinger" name="concert_singer">
                            <option hidden selected disable></option>
                            <?php
                            while($singer_row=mysqli_fetch_assoc($singer_list))
                            {
                                ?>
                                <option value="<?php echo $singer_row["Singer_ID"]; ?>"><?php echo $singer_row["Singer_Name"]; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <label>Singer</label>
                        <label class="error_CSinger" style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="width:22.75%; float:left; margin-left: 3%; margin-bottom:0; margin-top:0;">
                        <select class="checking_COrganizer" name="concert_organizer">
                        <option hidden selected disable></option>
                            <?php
                            while($organizer_row=mysqli_fetch_assoc($organizer_list))
                            {
                                ?>
                                <option value="<?php echo $organizer_row["Organizer_ID"]; ?>"><?php echo $organizer_row["Organizer_Name"]; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <label>Organizer</label>
                        <label class="error_COrganizer" style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="width:22.75%; clear:both; float:left;">
                        <input onchange="setSdate()" onkeydown="return false" id="concert_SSDate" type="datetime-local" name="session_SDate" class="checking_SSDate">
                        <label>Session Start Date</label>
                        <label class="error_SSDate" style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="width:22.75%; float:left; margin-left: 3%;">
                        <input onkeydown="return false" id="concert_SEDate" type="datetime-local" name="session_EDate" class="checking_SEDate" disabled="disabled">
                        <label>Session End Date</label>
                        <label class="error_SEDate" style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="float:left; width:22.75%; margin-left: 3%;">
                        <select class="checking_CVenue" name="concert_venue">
                            <option hidden selected disable></option>
                            <?php
                            while($venue_row=mysqli_fetch_assoc($venue_list))
                            {
                                ?>
                                <option value="<?php echo $venue_row["Venue_ID"]; ?>"><?php echo $venue_row["Venue_Name"]; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <label>Venue</label>
                        <label class="error_CVenue" style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="width:22.75%; float:left; margin-left: 3%;">
                        <select class="checking_CStatus" name="concert_status">
                            <option hidden selected disable></option>
                            <option value="0">Saved</option>
                            <option value="1">Upcoming</option>
                        </select>
                        <label>Status</label>
                        <label class="error_CStatus" style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0;"></label>
                    </div>
                </div>
                <table class="table_container" style="background:white;">
                    <thead>
                        <tr class="header-bar">
                            <th width="30%">Area Name</th>
                            <th width="30%">Price(RM)</th>
                            <th width="30%">Number of Seat</th>
                            <th width="10%" style="text-align: center;"><button type="button" name="add-row" class="row-btn add-row-btn"><span class="material-icons">add</span></button></th>
                        </tr>
                    </thead>
                    <tbody class="table_content" id="table_row">
                        
                    </tbody>
                </table>
                
                <div class="button_field">
                    <button class="concert_add_submit_btn" type="button">Add Concert</button>
                    <button class="concert_cancelbtn" type="button" onclick="window.history.back()" style="background-color:#f44336">Cancel</button>
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

    function setSdate()
    {
        document.getElementById("concert_SEDate").min = $('#concert_SSDate').val();
        $('#concert_SEDate').prop("disabled","");
    }

        const preimg = document.querySelector(".preimg-short");
        const wrapper = document.querySelector(".wrapper-short");
        const fileName = document.querySelector(".file-name-short");
        const defaultBtn = document.querySelector("#default-btn-short");
        const customBtn = document.querySelector("#custom-btn-short");
        const cancelBtn = document.querySelector("#cancel-btn-short i");
        const img = document.querySelector(".preimg-short");

        const preimg_long = document.querySelector(".preimg-long");
        const wrapper_long = document.querySelector(".wrapper-long");
        const fileName_long = document.querySelector(".file-name-long");
        const defaultBtn_long = document.querySelector("#default-btn-long");
        const customBtn_long = document.querySelector("#custom-btn-long");
        const cancelBtn_long = document.querySelector("#cancel-btn-long i");
        const img_long = document.querySelector(".preimg-long");

        const preimg_location = document.querySelector(".preimg-location");
        const wrapper_location = document.querySelector(".wrapper-location");
        const fileName_location = document.querySelector(".file-name-location");
        const defaultBtn_location = document.querySelector("#default-btn-location");
        const customBtn_location = document.querySelector("#custom-btn-location");
        const cancelBtn_location = document.querySelector("#cancel-btn-location i");
        const img_location = document.querySelector(".preimg-location");

        let regExp = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;

        defaultBtn.addEventListener("change", function(){
            const file = this.files[0];
            var fileInput =  document.getElementById('default-btn-short'); 
              
            var filePath = fileInput.value; 
            // Allowing file type 
            var allowedExtensions =  /(\.jpg|\.jpeg|\.png|\.gif)$/i; 
              
            if (!allowedExtensions.exec(filePath))
            { 
                img.src = "";
                wrapper.classList.remove("active");
                preimg.style.display = "none";
                $('.error_shortimg').text("*Invalid file format");
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
                    $('.error_shortimg').text("");
                    fileInput.value = "";
                });
                reader.readAsDataURL(file);
            }
            if(this.value){
                let valueStore = this.value.match(regExp);
                fileName.textContent = valueStore;
            }
        });

        defaultBtn_long.addEventListener("change", function(){
            const file = this.files[0];
            var fileInput =  document.getElementById('default-btn-long'); 
              
            var filePath = fileInput.value; 
            // Allowing file type 
            var allowedExtensions =  /(\.jpg|\.jpeg|\.png|\.gif)$/i; 
              
            if (!allowedExtensions.exec(filePath))
            { 
                img_long.src = "";
                wrapper_long.classList.remove("active");
                preimg_long.style.display = "none";
                $('.error_longimg').text("*Invalid file format");
                fileInput.value = "";
                return false; 
            }
            else if(file)
            {
                const reader = new FileReader();
                reader.onload = function(){
                    const result = reader.result;
                    img_long.src = result;
                    wrapper_long.classList.add("active");
                    preimg_long.style.display = "block";
                }

                cancelBtn_long.addEventListener("click", function(){
                    img_long.src = "";
                    wrapper_long.classList.remove("active");
                    preimg_long.style.display = "none";
                    $('.error_longimg').text("");
                    fileInput.value = "";
                });
                reader.readAsDataURL(file);
            }
            if(this.value){
                let valueStore = this.value.match(regExp);
                fileName_long.textContent = valueStore;
            }
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