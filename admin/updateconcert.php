<?php include 'header_sidebar.php';
    include 'dataconnection.php';
    if(isset($_GET['edit']))
	{
        $concert_id = $_GET['id'];
        $result = "select *,
                  DATE_FORMAT(Concert_StartDate, '%Y-%m-%dT%H:%i') as CSDate,
                  DATE_FORMAT(Session_StartDate, '%Y-%m-%dT%H:%i') as SSDate,
                  DATE_FORMAT(Session_EndDate, '%Y-%m-%dT%H:%i') as SEDate 
                  from concert where Concert_ID = '$concert_id'";
		$result_run = mysqli_query($connect,$result);
        $row = mysqli_fetch_assoc($result_run);

        $venue_id = $row['Venue_ID'];
        $ticket_price_list = mysqli_query($connect,"select * from ticket_price where Concert_ID = '$concert_id' and Venue_ID = '$venue_id' and ticket_price_unable = 0 order by Price desc");

        $shortextension = pathinfo($row['Concert_Ver_Image'],PATHINFO_BASENAME);

        $longextension = pathinfo($row['Concert_Hor_Image'],PATHINFO_BASENAME);

        $locationextension = pathinfo($row['Seat_Image'],PATHINFO_BASENAME);

        $venue_list = mysqli_query($connect,"select * from venue");
        $singer_list = mysqli_query($connect,"select * from singer");
        $organizer_list = mysqli_query($connect,"select * from organizer");
	}
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
            <label class="current_direction">Update Concert</label>
        </div>
    </div>
    <div class="page_position">
    <div class="page_form">              
    <div class='back-to-prev' onclick="history.back()"><span class="material-icons">arrow_back_ios</span>Back</div>
        <form class="concert_update_form" action="" method="post" autocomplete="off">
        <div class="container" style="padding:45px;">
            <div class="page">
                <div class="title">Update Concert</div>
                <input class="concert_id" name="concert_id" type="text" value="<?php echo $concert_id; ?>"  hidden>
                <div style="float:left; width:38%;">
                    <div class="page">
                        <div class="wrapper-short active">
                            <div class="image-short">
                                <img class="preimg-short" src="<?php echo $row['Concert_Ver_Image']; ?>" alt="" style="display: block;">
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
                                <?php echo $shortextension; ?>
                            </div>
                        </div>
                        <label id="custom-btn-short" for="default-btn-short">Upload Concert Vertical Image</label>
                        <input id="default-btn-short" name="file" type="file" hidden>
                    </div>
                </div>
                <div style="float:left; width:58%; margin-left: 4%; margin-bottom:20px;">
                    <div class="page">
                        <div class="wrapper-long active">
                            <div class="image-long">
                                <img class="preimg-long" src="<?php echo $row['Concert_Hor_Image']; ?>" alt="" style="display: block;">
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
                                <?php echo $longextension; ?>
                            </div>
                        </div>
                        <label id="custom-btn-long" for="default-btn-long">Upload Concert Horizontal Image</label>
                        <input id="default-btn-long" name="file" type="file" hidden>
                    </div>
                </div>
                <div style="clear:both; float:left; width:38%; ">
                    <div style="float:left; width:100%;">
                        <div class="page">
                            <div class="wrapper-location active">
                                <div class="image-location">
                                    <img class="preimg-location" src="<?php echo $row['Seat_Image']; ?>" alt="" style="display: block;">
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
                                    <?php echo $locationextension; ?>
                                </div>
                            </div>
                            <label id="custom-btn-location" for="default-btn-location">Upload Seat Map</label>
                            <input id="default-btn-location" name="file" type="file" hidden>
                        </div>
                    </div>
                </div>
                <div style="float:left; width:58%; margin-left: 4%;">
                    <div class="txt_field" style="clear:both; margin-bottom:0; margin-top:0;">
                        <textarea type="text" class="checking_update_concert_name" style="padding:10px; resize: none;" name="concert_name"><?php echo $row['Concert_Name']; ?></textarea>
                        <label>Concert Name</label>
                        <label class="error_concert_name" style="color: red; clear:both; top: 60px; font-size: 11px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="clear:both;">
                        <textarea rows="16" cols="50" class="checking_CDescrip" style="resize: none; padding:9px" id="ckeditor" name="concert_desc"><?php echo $row['Concert_Description']; ?></textarea>
                        <label>Concert Description</label>
                    </div>
                </div>
                <div style="clear:both;">
                    <div class="txt_field" style="width:48.5%; float:left; margin-bottom:0;  margin-top:0;">
                        <input id="concert_CSDate" value="<?php echo $row['CSDate']; ?>" onkeydown="return false" type="datetime-local" name="concert_SDate" class="checking_CSDate">
                        <label>Concert Start Date</label>
                        <label class="error_CSDate" style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="width:22.75%; float:left; margin-bottom:0; margin-left: 3%; margin-top:0;">
                        <select class="checking_CSinger" name="concert_singer">
                            <option hidden selected disable></option>
                            <?php
                            while($singer_row=mysqli_fetch_assoc($singer_list))
                            {
                                if($row['Singer_ID']==$singer_row["Singer_ID"])
                                {
                                    ?>
                                    <option selected value="<?php echo $singer_row["Singer_ID"]; ?>"><?php echo $singer_row["Singer_Name"]; ?></option>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <option value="<?php echo $singer_row["Singer_ID"]; ?>"><?php echo $singer_row["Singer_Name"]; ?></option>
                                    <?php
                                }

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
                                if($row['Organizer_ID']==$organizer_row["Organizer_ID"])
                                {
                                    ?>
                                        <option selected value="<?php echo $organizer_row["Organizer_ID"]; ?>"><?php echo $organizer_row["Organizer_Name"]; ?></option>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                        <option value="<?php echo $organizer_row["Organizer_ID"]; ?>"><?php echo $organizer_row["Organizer_Name"]; ?></option>
                                    <?php
                                }
                                
                            }
                            ?>
                        </select>
                        <label>Organizer</label>
                        <label class="error_COrganizer" style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="width:22.75%; clear:both; float:left;">
                        <input value="<?php echo $row["SSDate"];?>" onkeydown="return false" id="concert_SSDate" type="datetime-local" name="session_SDate" class="checking_SSDate">
                        <label>Session Start Date</label>
                        <label class="error_SSDate" style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="width:22.75%; float:left; margin-left: 3%;">
                        <input value="<?php echo $row["SEDate"];?>" onkeydown="return false" id="concert_SEDate" type="datetime-local" name="session_EDate" class="checking_SEDate">
                        <label>Session End Date</label>
                        <label class="error_SEDate" style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="float:left; width:22.75%; margin-left: 3%;">
                        <select class="checking_CVenue" name="concert_venue">
                            <option hidden selected disable></option>
                            <?php
                            while($venue_row=mysqli_fetch_assoc($venue_list))
                            {
                                if($row['Venue_ID']==$venue_row["Venue_ID"])
                                {
                                    ?>
                                        <option selected value="<?php echo $venue_row["Venue_ID"]; ?>"><?php echo $venue_row["Venue_Name"]; ?></option>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                        <option value="<?php echo $venue_row["Venue_ID"]; ?>"><?php echo $venue_row["Venue_Name"]; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <label>Venue</label>
                        <label class="error_CVenue" style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="width:22.75%; float:left; margin-left: 3%;">
                        <select class="checking_CStatus" name="concert_status">
                        <?php
                            if($row['Concert_Status']==0)
                            {
                                ?>
                                    <option selected value="0">Saved</option>
                                    <option value="1">Upcoming</option>
                                    <option value="2">Ongoing</option>
                                    <option value="3">Ended</option>
                                <?php
                            }
                            else if($row['Concert_Status']==1)
                            {
                                ?>
                                    <option value="0">Saved</option>
                                    <option selected value="1">Upcoming</option>
                                    <option value="2">Ongoing</option>
                                    <option value="3">Ended</option>
                                <?php
                            }
                            else if($row['Concert_Status']==2)
                            {
                                ?>
                                    <option value="0">Saved</option>
                                    <option value="1">Upcoming</option>
                                    <option selected value="2">Ongoing</option>
                                    <option value="3">Ended</option>
                                <?php
                            }
                            else if($row['Concert_Status']==3)
                            {
                                ?>
                                    <option value="0">Saved</option>
                                    <option value="1">Upcoming</option>
                                    <option value="2">Ongoing</option>
                                    <option selected value="3">Ended</option>
                                <?php
                            }
                        ?>
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
                            <?php
                            while($tp_row=mysqli_fetch_assoc($ticket_price_list))
                            {
                                ?>
                                    <tr>
                                    <td hidden><input type="text" class="price-id" name="price_id[]" value="<?php echo $tp_row['Price_ID'];?>"></td>
                                    <td hidden><input type="text" class="id-is-del" name="price_id_del[]"></td>
                                    <td><input value="<?php echo $tp_row['Price_Area']; ?>" class="area_name" type="text" name="area_name[]"><label style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0; font-weight: bold; opacity:0;">*Please fill in the field</label></td>
                                    <td><input value="<?php echo $tp_row['Price']; ?>" class="area_price" type="number" name="area_price[]"><label style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0; font-weight: bold; opacity:0;">*Please fill in the field</label></td>
                                    <td><input value="<?php echo $tp_row['Seat_No']; ?>" class="numberOfseat" type="text" name="numberOfseat[]" onkeypress="return event.charCode >= 48 && event.charCode <= 57"><label style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0; font-weight: bold; opacity:0;">*Please fill in the field</label></td>
                                    <td  style="text-align: center;"><button type="button" class="del-row-btn row-btn" name="remove-row"><span class="material-icons" style="padding: 3px;">remove</span></button></td></tr>
                                <?php
                            }
                            ?>
                    </tbody>
                </table>

                <div class="button_field">
                    <button disabled="disabled" class="concert_update_submit_btn" type="button">Update Concert</button>
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

    CKEDITOR.instances.ckeditor.on('key', function(e) {
        $('.concert_update_submit_btn').prop("disabled","");
    });

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
        
        $('.concert_update_form').keyup(function()
        {   
            $('.concert_update_submit_btn').prop("disabled","");
        });

        $('.concert_update_form').change(function()
        {   
            $('.concert_update_submit_btn').prop("disabled","");
        });

        $('.table_container').focusin(function()
        {   
            $('.concert_update_submit_btn').prop("disabled","");
        });

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
                reader.readAsDataURL(file);
            }
            if(this.value){
                let valueStore = this.value.match(regExp);
                fileName_location.textContent = valueStore;
            }
        });

        cancelBtn.addEventListener("click", function(){
            img.src = "";
            wrapper.classList.remove("active");
            preimg.style.display = "none";
            $('.error_shortimg').text("");
            $('.concert_update_submit_btn').prop("disabled","");
            if(typeof fileInput!== 'undefined')
                fileInput.value = "";
        });

        cancelBtn_long.addEventListener("click", function(){
            img_long.src = "";
            wrapper_long.classList.remove("active");
            preimg_long.style.display = "none";
            $('.error_longimg').text("");
            $('.concert_update_submit_btn').prop("disabled","");
            if(typeof fileInput!=='undefined')
                fileInput.value = "";
        });

        cancelBtn_location.addEventListener("click", function(){
            img_location.src = "";
            wrapper_location.classList.remove("active");
            preimg_location.style.display = "none";
            $('.error_locationimg').text("");
            $('.concert_update_submit_btn').prop("disabled","");
            if(typeof fileInput!=='undefined')
                fileInput.value = "";
        });
</script>
<?php //if($_GET['rel']!='tab'){ echo "</div>";} ?>
<?php include('footer.php'); ?>