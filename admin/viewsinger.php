<?php include 'header_sidebar.php';
    include 'dataconnection.php';
    $id = $_GET['id'];
    $result = "select * from singer where Singer_ID = '$id'";
    $result_run = mysqli_query($connect,$result);
    $row = mysqli_fetch_assoc($result_run);

    $locationextension = pathinfo($row['Singer_Image'],PATHINFO_BASENAME);
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
            <label class="current_direction">View Singer</label>
        </div>
    </div>
    <div class="page_position">
    <div class="page_form">        
        <div class='back-to-prev' onclick="history.back()"><span class="material-icons">arrow_back_ios</span>Back</div>     
        <form action="" class="update_singer_form" method="post" autocomplete="off">
        <div class="container" style="padding:45px;">
            <div class="page">
                <div class="title">View Singer</div>
                <div>
                    <input class="singer_id" type="text" name="id" hidden value="<?php echo $row['Singer_ID'];?>">
                    <div class="txt_field" style="float:left;width:38%">
                        <input readonly type="text" class="checking_singer_name" name="singer_name" value="<?php echo $row['Singer_Name']?>">
                        <label>Singer Name</label>
                        <label class="error_singer_name" style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0;" ></label>
                    </div>
                    <div class="txt_field" style="float:left; width:58%; margin-left:4%">
                            <?php
                            $result = mysqli_query($connect,"select * from category where category_unable = 0 group by Category_Name");
                            while($result_run = mysqli_fetch_assoc($result))
                            {
                                if($row['Category_ID'] == $result_run['Category_ID'])
                                {
                                ?>
                                <input type="text" value="<?php echo $result_run['Category_Name'];?>" readonly>
                                <?php
                                }
                            }
                            ?>
                        <label>Singer Category</label>
                        <label class="error_singer_cate" style="color: red; clear:both; top: 35px; font-size: 11px; padding: 0;" ></label>
                    </div>
                </div>
                <div style="clear:both; float:left; width:38%; ">
                    <div style="float:left; width:100%;">
                        <div class="page">
                            <div class="wrapper-short active">
                                <div class="image-short">
                                    <img class="preimg-short" src="<?php echo $row['Singer_Image']?>" style="display: block;" alt="">
                                </div>
                                <div class="file-name-short">
                                    <?php echo $locationextension;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="float:left; width:58%; margin: 0 0 0 4%;">
                    <div class="txt_field" style="clear:both; margin-top:0">
                    <div class="view_desc" style="height:345px; padding:10px 10px 0 10px;">
                            <?php echo $row['Singer_Desc']?>
                        </div>
                        <label>Singer Description</label>
                    </div>
                </div>
                <div class="button_field">
                    <button class="singer_cancelbtn" type="button" onclick="window.history.back()" style="background-color:#f44336">Back</button>
                </div>
            </div>
        </div>
        </form>
    </div>
    </div>
<?php //if($_GET['rel']!='tab'){ echo "</div>";} ?>
<?php include('footer.php'); ?>