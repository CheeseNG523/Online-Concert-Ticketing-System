<?php include 'header_sidebar.php';
    include 'dataconnection.php';
    if(isset($_GET['view']))
	{
        $venue_id = $_GET['id'];
        $result = "select * from venue where Venue_ID = '$venue_id'";
		$result_run = mysqli_query($connect,$result);
        $row = mysqli_fetch_assoc($result_run);

        $locationextension = pathinfo($row['Venue_Image'],PATHINFO_BASENAME);
	}
?>
<script src="js/profile_form.js"></script>
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
            <label class="current_direction">View Venue</label>
        </div>
    </div>
    <div class="page_position">
    <div class="page_form">          
        <div class='back-to-prev' onclick="history.back()"><span class="material-icons">arrow_back_ios</span>Back</div>    
        <form action="" class="update_venue_form" method="post" autocomplete="off">
        <input hidden type="text" value="<?php echo $venue_id;?>" name="venue_ID" class="venue_id">
        <div class="container" style="padding:45px;">
            <div class="page">
                <div class="title">View Venue</div>
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
                                <div class="file-name-location">
                                    <?php echo $locationextension;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="float:left; width:58%; margin-left: 4%;">
                    <div class="txt_field" style="clear:both; margin-bottom:0; margin-top:0;">
                        <textarea readonly type="text" class="checking_venue_name" style="padding:10px; resize: none;" name="venue_name"><?php echo $row['Venue_Name']?></textarea>
                        <label>Venue Name</label>
                        <label class="error_venue_name" style="color: red; clear:both; top: 60px; font-size: 11px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="clear:both;">
                        <div class="view_desc" style="height:246px; padding:10px 10px 0 10px;">
                            <?php echo $row['Venue_Description']?>
                        </div>
                        <label>Venue Description</label>
                    </div>
                </div>

                <div class="txt_field" style="clear:both; margin-bottom:0; margin-top:0;">
                    <input readonly type='text' class="checking_VState" name="venue_state" value="<?php echo $row['Venue_State']; ?>">
                    <label>Venue State</label>
                    <label class="error_VState" style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0;" ></label>
                </div>
                <div class="txt_field" style="clear:both;">
                    <textarea readonly type="text" class="checking_venue_location" style="padding:10px; resize: none;" name="venue_location"><?php echo $row['Venue_Location']?></textarea>
                    <label>Venue Location Link</label>
                    <label class="error_venue_location" style="color: red; clear:both; top: 60px; font-size: 11px; padding: 0;" ></label>
                </div>
                <div class="txt_field" style="clear:both;">
                    <textarea readonly type="text" class="checking_venue_iframe" style="padding:10px; resize: none;" name="venue_iframe"><?php echo $row['Venue_iframe']?></textarea>
                    <label>Venue Location Iframe</label>
                    <label class="error_venue_iframe" style="color: red; clear:both; top: 60px; font-size: 11px; padding: 0;" ></label>
                </div>
            <table id="tableA" class="table_container" style="background:white; box-shadow: 0 0 5px 0 #ccc;">
                <thead>
                <tr class="header">
                    <td colspan="3">Current Active</td>
                </tr>
                <tr class="header-bar">
                    <th width=10%>ID</th>
                    <th width=40%>Name</th>
                    <th width=10%>Status</th>
                    <th width=20%>Action</th>
                </tr>
                </thead>
                <tbody class="table_content" id="table_row">
                    <?php
                    $count = "select * from concert where Venue_ID='$venue_id' and Concert_Status > '0' and Concert_Status < '3' and Concert_unable = 0";
                    $count_run = mysqli_query($connect,$count);
                
                    while($count_result = mysqli_fetch_assoc($count_run))
                    {
                        ?>
                        <tr>
                            <td><?php echo "C".$count_result['Concert_ID']; ?></td>
                            <td><?php echo $count_result['Concert_Name']; ?></td>
                            <td>
                                <?php
                                    if($count_result['Concert_Status']==0)
                                    {
                                        ?>
                                            Saved
                                        <?php
                                    }
                                    else if($count_result['Concert_Status']==1)
                                    {
                                        ?>
                                            Upcoming
                                        <?php
                                    }
                                    else if($count_result['Concert_Status']==2)
                                    {
                                        ?>
                                            Ongoing
                                        <?php
                                    }
                                    else if($count_result['Concert_Status']==3)
                                    {
                                        ?>
                                            Ended
                                        <?php
                                    }
                                ?>
                            </td>
                            <td class="action_button">
                                <a rel="tab" href="viewconcert.php?view&id=<?php echo $count_result['Concert_ID']?>" title="View" style="float:left;"><span class="material-icons">visibility</span></a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
                <div class="button_field" style="margin-top: 30px;">
                    <button class="venue_cancelbtn" type="button" onclick="window.history.back()" style="background-color:#f44336">Back</button>
                </div>
            </div>
        </div>
        </form>
    </div>
    </div>
<script>
    $(document).ready(function(){
        $('#tableA').DataTable({
            "pagingType": "full_numbers"
        });

    });
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