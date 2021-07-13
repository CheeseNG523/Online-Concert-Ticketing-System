<?php include 'header_sidebar.php';
    include 'dataconnection.php';
    $active_result = mysqli_query($connect,"select * from concert where Concert_Unable = 0");
?>
<script src="js/profile_form.js"></script>
<script src="js/ckeditor/ckeditor.js"></script>
    <div class="page_position">
        <div class="position_left">
            <label>Merchandise</label>
        </div>
        <div class="position_right">
            <a rel="tab" href="dashboard.php">
                <span class="material-icons">dashboard</span><span class="icon_txt">Home</span>
            </a>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">Product</label>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <a rel="tab" href="merchandise.php">Merchandise</a>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">Add Merchandise</label>
        </div>
    </div>
    <div class="page_position">
    <div class="page_form">     
    <div class='back-to-prev' onclick="history.back()"><span class="material-icons">arrow_back_ios</span>Back</div>         
        <form action="" class="add_merch_form" method="post" autocomplete="off">
        <div class="container" style="padding:45px;">
            <div class="page">
                <div class="title" style="margin-bottom:30px">Add Merchandise</div>
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
                            <label id="custom-btn-location" for="default-btn-location">Upload Merchandise Image</label>
                            <input id="default-btn-location" name="file" type="file" hidden>
                        </div>
                    </div>
                </div>
                <div style="float:left; width:58%; margin-left: 4%;">
                    <div class="txt_field" style="clear:both; margin-bottom:0; margin-top:0;">
                        <textarea type="text" class="checking_merch_name" style="padding:10px; resize: none;" name="merch_name"></textarea>
                        <label>Merchandise Name</label>
                        <label class="error_merch_name" style="color: red; clear:both; top: 60px; font-size: 11px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="clear:both;">
                        <textarea rows="16" cols="50" class="checking_CDescrip" style="resize: none; padding:9px" id="ckeditor" name="merch_desc"></textarea>
                        <label>Merchandise Description</label>
                    </div>
                </div>
                <div style="clear:both;">
                    <div class="txt_field" style="width:30%; float:left; margin-bottom:0; margin-top:0;">
                        <input type="number" name="merch_price" class="checking_merch_price">
                        <label>Merchandise Price</label>
                        <label class="error_merch_price" style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="width:30%; float:left; margin-bottom:0; margin-left: 5%; margin-top:0;">
                        <input type="number" name="merch_lprice" class="checking_merch_lprice">
                        <label>Merchandise List Price</label>
                        <label class="error_merch_lprice" style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="width:30%; float:left; margin-bottom:0; margin-left: 5%; margin-top:0;">
                        <input type="number" name="merch_stock" class="checking_merch_stock" min="1" step="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                        <label>Merchandise Stock</label>
                        <label class="error_merch_stock" style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="clear:both; width:30%; float:left; margin-bottom:0;">
                        <input type="number" name="merch_weight" class="checking_merch_weight">
                        <label>Merchandise Weight</label>
                        <label class="error_merch_weight" style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="width:30%; float:left; margin-bottom:0;  margin-left: 5%;">
                        <select class="checking_concert" name="merch_concert">
                            <option hidden selected disable></option>
                            <?php
                            while($row=mysqli_fetch_assoc($active_result))
                            {
                                ?>
                                <option value="<?php echo $row["Concert_ID"]; ?>"><?php echo $row["Concert_Name"]; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <label>Concert</label>
                        <label class="error_concert" style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="width:30%; float:left; margin-bottom:30px; margin-left:5%">
                        <select class="checking_status" name="merch_status">
                            <option hidden selected disable></option>
                            <option value="0">Save</option>
                            <option value="1">On Shelf</option>
                        </select>
                        <label>Status</label>
                        <label class="error_status" style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0;" ></label>
                    </div>
                <div class="button_field" style="clear:both;">
                    <button class="merch_add_submit_btn" type="button">Add Merchandise</button>
                    <button class="merch_cancelbtn" type="button" onclick="window.history.back()" style="background-color:#f44336">Cancel</button>
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