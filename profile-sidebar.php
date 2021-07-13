<div class="profile-container">
    <div class="profile-sidebar">
    <div class='tooltip'>
        <?php 
            if($cust_details['Cust_Image']==NULL)
            {
                if($cust_details['Cust_Gender']=='M')
                {
                    echo "<img class='prof_pic' src='images/customer/male_profile.png'>";
                }
                else
                {
                    echo "<img class='prof_pic' src='images/customer/female_profile.png'>";
                }
            }
            else
            {
                echo "<img class='prof_pic' src='" . str_replace("../", "", $cust_details['Cust_Image']) . "'>";
            }
            echo "<span class='tooltiptext'>Change profile picture</span></div>";
            echo "<p>" . $cust_details['Cust_Lname'] . " " . $cust_details['Cust_Fname'] . "</p>"; 
        ?>
        <!-- Change Profile Picture Modal -->
		<div id="Pic_Modal" class="pic-modal">
            <!-- Form to upload picture -->
            <div class="pic-modal-content">
                <form name='change_pic' class='change_img' action='' method='post' autocomplete='off'>
                <span class="close" title="Close Modal" style='margin-left: 5px; margin-top: -10px;'>&times;</span>
                <div class="form-container">
                    <div class="page">
                        <div class="wrapper">
                            <div class="image">
                                <img class="preimg" src="" alt="">
                            </div>
                            <div class="img-content" style="margin: 0 auto;">
                            <div class="icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <div class="text">No file chosen, yet!</div>
                            <label class="error_locationimg" style="color: red; clear:both; font-size: 13px; padding: 0; font-weight:600"></label>
                            </div>
                            <div id="cancel-btn">
                                <i class="fas fa-times"></i>
                            </div>
                            <div class="file-name">
                                File name here
                            </div>
                        </div>
                        <label id="custom-btn" style="margin: 10px 0" for="default-btn">Choose your profile picture</label>
                        <input id="default-btn" name="file" type="file" hidden>
                        <div class="button_field">
                            <button class="img_submit" name="img_submit_btn" type="button" style="margin-left: 0;">Upload</button>
                            <button type="button" class="cancelbtn" style="margin-right: 0;">Cancel</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>