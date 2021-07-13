<?php include 'header_sidebar.php';
    include 'dataconnection.php';
?>
<script src="js/profile_form.js"></script>
<script src="js/ckeditor/ckeditor.js"></script>
    <div class="page_position">
        <div class="position_left">
            <label>Singer</label>
        </div>
        <div class="position_right">
            <a rel="tab" href="dashboard.php">
                <span class="material-icons">dashboard</span><span class="icon_txt">Home</span>
            </a>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">People</label>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <a rel="tab" href="singer.php">Singer</a>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">Add Singer</label>
        </div>
    </div>
    <div class="page_position">
    <div class="page_form">      
    <div class='back-to-prev' onclick="history.back()"><span class="material-icons">arrow_back_ios</span>Back</div>        
        <form action="" class="add_singer_form" method="post" autocomplete="off">
        <div class="container" style="padding:45px;">
            <div class="page">
                <div class="title">Add Singer</div>
                <div>
                    <div class="txt_field" style="float:left;width:38%">
                        <input type="text" class="checking_singer_name" name="singer_name">
                        <label>Singer Name</label>
                        <label class="error_singer_name" style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="float:left; width:58%; margin-left:4%">
                        <select class="checking_singer_cate" name="singer_cate">
                            <option selected hidden></option>
                            <?php
                            $result = mysqli_query($connect,"select * from category where category_unable = 0 group by Category_Name");
                            while($result_run = mysqli_fetch_assoc($result))
                            {
                                ?>
                                <option value="<?php echo $result_run['Category_ID'];?>"><?php echo $result_run['Category_Name'];?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <label>Singer Category</label>
                        <label class="error_singer_cate" style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0;" ></label>
                    </div>
                </div>
                <div style="clear:both; float:left; width:38%; ">
                    <div style="float:left; width:100%;">
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
                            <label id="custom-btn-short" for="default-btn-short">Upload Singer Image</label>
                            <input id="default-btn-short" name="file" type="file" hidden>
                        </div>
                    </div>
                </div>
                <div style="float:left; width:58%; margin: 0 0 0 4%;">
                    <div class="txt_field" style="clear:both; margin-top:0">
                        <textarea rows="16" cols="50" class="checking_SDescrip" style="resize: none; padding:9px;" id="ckeditor" name="singer_desc"></textarea>
                        <label>Singer Description</label>
                    </div>
                </div>
                <div class="button_field">
                    <button class="singer_add_submit_btn" type="button">Add Singer</button>
                    <button class="singer_cancelbtn" type="button" onclick="window.history.back()" style="background-color:#f44336">Cancel</button>
                </div>
            </div>
        </div>
        </form>
    </div>
    </div>
<script>
    CKEDITOR.replace('ckeditor', {
      width: '100%',
      height: '293px',
      resize_enabled: false,
    });

        const preimg_short = document.querySelector(".preimg-short");
        const wrapper_short = document.querySelector(".wrapper-short");
        const fileName_short = document.querySelector(".file-name-short");
        const defaultBtn_short = document.querySelector("#default-btn-short");
        const customBtn_short = document.querySelector("#custom-btn-short");
        const cancelBtn_short = document.querySelector("#cancel-btn-short i");
        const img_short = document.querySelector(".preimg-short");

        let regExp = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;

        defaultBtn_short.addEventListener("change", function(){
            const file = this.files[0];
            var fileInput =  document.getElementById('default-btn-short'); 
              
            var filePath = fileInput.value; 
            // Allowing file type 
            var allowedExtensions =  /(\.jpg|\.jpeg|\.png|\.gif)$/i; 
              
            if (!allowedExtensions.exec(filePath))
            { 
                img_short.src = "";
                wrapper_short.classList.remove("active");
                preimg_short.style.display = "none";
                $('.error_shortimg').text("*Invalid file format");
                fileInput.value = "";
                return false; 
            }
            else if(file)
            {
                const reader = new FileReader();
                reader.onload = function(){
                    const result = reader.result;
                    img_short.src = result;
                    wrapper_short.classList.add("active");
                    preimg_short.style.display = "block";
                }

                cancelBtn_short.addEventListener("click", function(){
                    img_short.src = "";
                    wrapper_short.classList.remove("active");
                    preimg_short.style.display = "none";
                    $('.error_shortimg').text("");
                    fileInput.value = "";
                });
                reader.readAsDataURL(file);
            }
            if(this.value){
                let valueStore = this.value.match(regExp);
                fileName_short.textContent = valueStore;
            }
        });
</script>
<?php //if($_GET['rel']!='tab'){ echo "</div>";} ?>
<?php include('footer.php'); ?>