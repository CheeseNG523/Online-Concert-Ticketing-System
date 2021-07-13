<?php 
include 'dataconnection.php';
include 'header_sidebar.php';
    $email = $_SESSION['admin_email'];
    $pri = mysqli_query($connect,"select Admin_PRI from admin where Admin_Email = '$email'");
    $admin_pri = mysqli_fetch_assoc($pri);
    if($admin_pri['Admin_PRI']!=1)
    {
        ?>
        <script>
        window.open("php/unauthorized.php","_self");
        </script>
        <?php
    }
    else
    {
        
        if(isset($_GET['view']))
        {
            $id = $_GET['id'];
            $result =  "select * from admin where Admin_ID='$id'";
            $result_run = mysqli_query($connect,$result);
            $row = mysqli_fetch_assoc($result_run);
        }
        
        function hideEmailAddress($email)
        {
            if(filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                list($first, $last) = explode('@', $email);
                $first = str_replace(substr($first, '3'), str_repeat('*', strlen($first)-3), $first);
                $hideEmailAddress = $first.'@'.$last;
                return $hideEmailAddress;
            }
        }
    }
?>
<script src="js/profile_form.js"></script>
    <div class="page_position">
        <div class="position_left">
            <label>Admin</label>
        </div>
        <div class="position_right">
            <a rel="tab" href="dashboard.php">
                <span class="material-icons">dashboard</span><span class="icon_txt">Home</span>
            </a>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">People</label>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <a rel="tab" href="admin.php">Admin</a>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">View Admin</label>
        </div>
    </div>
    <div class="page_position">
    <div class="page_form">
        <div class='back-to-prev' onclick="history.back()"><span class="material-icons">arrow_back_ios</span>Back</div>          
        <form action="" class="update_venue_form" method="post" autocomplete="off">
        <div class="container" style="padding:45px;">
            <div class="page">
                <div class="title">View Admin</div>
                <div class="profile_container">
                    <div class="profile-header" style="float:left; width:38%;">
                        <div class="image" style="float:left">
                            <img style="display: block;margin: auto;" width=50% height=50% class="profile_image"
                            src="<?php 
                            if($row['Admin_imgDir']=="")
                            {
                                if($row['Admin_Gender']=='F')
                                    echo "../images/profile/female_profile.png";
                                else if($row['Admin_Gender']=='M')
                                    echo "../images/profile/male_profile.png";
                            }
                            else
                                echo $row['Admin_imgDir'];
                            ?>" style="display: block;" alt="">
                        </div>
                        <div class="nametag" style="float:left;">
                            <label class="user_name" style="color:#2e3849"><?php echo $row['Admin_Fname']." ".$row['Admin_Lname']; ?></label>
                            <label style="font-size:14px; font-weight:500;" class="user_position"><?php 
                            if($row['Admin_PRI']==1)
                            {
                                echo "Super Admin";
                            }
                            else if($row['Admin_PRI']==2)
                            {
                                echo "Admin";
                            }
                            ?></label>     
                        </div>
                    </div>
                    <div class="profile-header" style="float:left; margin-left:4%; width:48%; border:0">
                        <div class="profile-info">
                            <label><span class="material-icons info">mail_outline</span><?php 
                            if($row['Admin_PRI']==1)
                                echo hideEmailAddress($row['Admin_Email']);
                            else
                                echo $row['Admin_Email'];
                            ?></label>
                            <label><span class="material-icons info">stay_primary_portrait</span><?php echo $row['Admin_Contact']; ?></label>
                            <label><span class="material-icons info">perm_identity</span><?php 
                            if($row['Admin_Gender']=='M')
                                echo 'Male';
                            else
                                echo 'Female';?></label>
                        </div>
                    </div>
                </div>
                <div class="button_field" style="clear:both;margin-top: 30px;">
                    <button type="button" onclick="window.open('./admin.php', '_self')" style="background-color:#f44336">Back</button>
                </div>
            </div>
        </div>
        </form>
    </div>
    </div>
<?php //if($_GET['rel']!='tab'){ echo "</div>";} ?>
<?php include('footer.php'); ?>