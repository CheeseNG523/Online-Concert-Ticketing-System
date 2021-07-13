<?php include 'header_sidebar.php';
    include 'dataconnection.php';
    if(isset($_GET['view']))
	{
        $id = $_GET['id'];
        $result =  "select A.Purchase_ID, DATE_FORMAT(Purchase_Date, '%d-%m-%Y %T') as 'Purchase_Date', Concert_StartDate, Concert_Name, Concert_Hor_Image, 
        Cust_Fname, Cust_Lname, Venue_Name from purchase A, s_ticket B, concert C, ticket_price D, customer E, venue F WHERE B.Purchase_ID = A.Purchase_ID 
        and B.PriceID = D.Price_ID and D.Concert_ID = C.Concert_ID and A.Cust_ID = E.Cust_ID and D.Venue_ID = F.Venue_ID and A.Purchase_ID = '$id' 
        order by Purchase_Date desc";
		$result_run = mysqli_query($connect,$result);
        $row = mysqli_fetch_assoc($result_run);

        $locationextension = pathinfo($row['Concert_Hor_Image'],PATHINFO_BASENAME);
        $total = 0;
	}
?>
<script src="js/profile_form.js"></script>
    <div class="page_position">
        <div class="position_left">
            <label>Order - Ticket</label>
        </div>
        <div class="position_right">
            <a rel="tab" href="dashboard.php">
                <span class="material-icons">dashboard</span><span class="icon_txt">Home</span>
            </a>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <a rel="tab" href="order.php">Order - Concert</a>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">View Order - Ticket</label>
        </div>
    </div>
    <div class="page_position">
    <div class="page_form">              
        <div class='back-to-prev' onclick="history.back()"><span class="material-icons">arrow_back_ios</span>Back</div>
        <form action="" class="update_venue_form" method="post" autocomplete="off">
        <div class="container" style="padding:45px;">
            <div class="page">
                <div class="title">View Order - Ticket</div>
                <div class="txt_field" style="clear:both; margin-bottom:0; margin-top:0;">
                    <label>Order <span>#OID <?php echo $row['Purchase_ID']?></span></label>
                </div>
                <div class="txt_field" style="clear:both;">
                    <label>Order placed by <span><?php echo $row['Cust_Lname']." ".$row['Cust_Fname']?></span></label>
                </div>
                <div class="txt_field" style="clear:both; margin:20px 0 30px 0;">
                    <label>Order Time: <span><?php echo $row['Purchase_Date'];?></span></label>
                </div>
                <div style="clear:both; float:left; width:58%; margin-bottom: 50px;">
                    <div style="float:left; width:100%;">
                        <div class="page">
                            <div class="wrapper-long active">
                                <div class="image-long">
                                    <img class="preimg-long" src="<?php echo $row['Concert_Hor_Image']; ?>" style="display: block;" alt="">
                                </div>
                                <div class="img-content-long" style="margin: 0 auto;">
                                    <div class="icon">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                    </div>
                                    <div class="text">No file chosen, yet!</div>
                                    <label class="error_longimg" style="color: red; clear:both; font-size: 13px; padding: 0; font-weight:600"></label>
                                </div>
                                <div class="file-name-long">
                                    <?php echo $locationextension;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="float:left; width:38%; margin-left: 4%; margin-bottom:10%">
                    <div class="txt_field" style="clear:both; margin-bottom:50px; margin-top:0;">
                        <label><?php echo $row['Concert_Name']; ?></label>
                    </div>
                    <div class="txt_field" style="clear:both; margin-bottom:50px; margin-top:50px;">
                        <label><span class="material-icons">location_on </span><?php echo $row['Venue_Name']; ?></label>
                    </div>
                    <div class="txt_field" style="clear:both; margin-bottom:50px; margin-top:50px;">
                        <label><span class="material-icons">event </span><?php echo date_format(date_create($row['Concert_StartDate']), "d-m-Y H:i:s"); ?></label>
                    </div>
                </div>

            <table id="concert_active" class="table_container" style="background:white; box-shadow: 0 0 5px 0 #ccc;">
                <thead>
                <tr class="header">
                    <td colspan="3">Detail</td>
                </tr>
                <tr class="header-bar">
                    <th width=25% style="text-align:center;">Area</th>
                    <th width=25% style="text-align:center;">Area Price (RM)</th>
                    <th width=25% style="text-align:center;">Quantity</th>
                    <th width=25% style="text-align:center;">Total (RM)</th>
                </tr>
                </thead>
                <tbody class="table_content" id="table_row">
                    <?php
                    $result2 = "select A.Purchase_ID, Price_Area, Price, S_Ticket_Qty, (S_Ticket_Qty*Price)as Sub_Total_Price from purchase A, s_ticket B, concert C, ticket_price D, customer E, venue F WHERE B.Purchase_ID = A.Purchase_ID and B.PriceID = D.Price_ID and D.Concert_ID = C.Concert_ID and A.Cust_ID = E.Cust_ID and D.Venue_ID = F.Venue_ID and A.Purchase_ID = '$id' order by Price desc";
                    $result2_run = mysqli_query($connect,$result2);
                    while($row_run = mysqli_fetch_assoc($result2_run))
                    {
                    ?>
                        <tr style="text-align:center;">
                            <td><?php echo $row_run['Price_Area']; ?></td>
                            <td><?php echo $row_run['Price']; ?></td>
                            <td><?php echo $row_run['S_Ticket_Qty']; ?></td>
                            <td><?php echo $row_run['Sub_Total_Price']; ?></td>
                        </tr>
                    <?php
                        $total += $row_run['Sub_Total_Price'];
                    }
                    ?>
                    <tr class="header-bar">
                        <td colspan="3">Total: RM</td>
                        <td style="text-align:center"><?php echo number_format((float)$total, 2, '.', ''); ?></td>
                    </tr>
                </tbody>
            </table>
            <?php
        $check_status = mysqli_query($connect,"select D.Concert_Status from purchase A, s_ticket B, ticket_price C, concert D where A.Purchase_ID = B.Purchase_ID
        and B.PriceID = C.Price_ID and C.Concert_ID = D.Concert_ID and A.Purchase_ID = '$id'");
        $check_status_run = mysqli_fetch_assoc($check_status);
        if($check_status_run['Concert_Status'] == 3)
        {
            $comment_query = mysqli_query($connect,"select A.Rating_Star, A.Rating_Comment, A.Rating_Image, E.Cust_ID, E.Cust_Lname, E.Cust_Fname, 
            E.Cust_Image, E.Cust_Gender from rating A, s_ticket B, ticket_price C, purchase D, customer E, concert F where A.Ticket_Purchase_ID = D.Purchase_ID 
            and B.Purchase_ID = D.Purchase_ID and B.PriceID = C.Price_ID and E.Cust_ID = D.Cust_ID and A.Cust_ID = E.Cust_ID and F.Concert_ID = C.Concert_ID 
            and D.Purchase_ID = '$id' group by D.Purchase_ID ");

            echo "<div class='comment'><span class='comment_title'>Rating</span>";
            if(mysqli_num_rows($comment_query)>0)
            {
                while($rating_detail = mysqli_fetch_assoc($comment_query))
                {
                    //to encrypt customer name
                    $cust_Name = $rating_detail['Cust_Fname']." ".$rating_detail['Cust_Lname'];
                    $name_length = strlen($cust_Name); //get name length

                    echo "<div class='rating-container'>";
                    echo "<div class='cust-img'>";
                    if($rating_detail['Cust_Image'] == "")
                    {
                        if($rating_detail['Cust_Gender'] == "Male")
                            echo "<img src='../images/customer/female_profile.png'>";
                        else
                            echo "<img src='../images/customer/male_profile.png'>";
                    }
                        echo "<img src='".$rating_detail['Cust_Image']."'>";
                    echo "</div>";
                    echo "<div class='cust-name-star'>";
                    echo "<div class='cust-name'><a href='viewcustomer.php?view&id=".$rating_detail['Cust_ID']."'>". $cust_Name . "</a></div>";
                    if($rating_detail['Rating_Star']==1)
                    {
                        echo '<span class="material-icons star-icon disBtn">star</span>';
                        echo '<span class="material-icons star-icon disBtn">star_border</span>';
                        echo '<span class="material-icons star-icon disBtn">star_border</span>';
                        echo '<span class="material-icons star-icon disBtn">star_border</span>';
                        echo '<span class="material-icons star-icon disBtn">star_border</span>';
                    }
                    else if($rating_detail['Rating_Star']==2)
                    {
                        echo '<span class="material-icons star-icon disBtn">star</span>';
                        echo '<span class="material-icons star-icon disBtn">star</span>';
                        echo '<span class="material-icons star-icon disBtn">star_border</span>';
                        echo '<span class="material-icons star-icon disBtn">star_border</span>';
                        echo '<span class="material-icons star-icon disBtn">star_border</span>';
                    }
                    else if($rating_detail['Rating_Star']==3)
                    {
                        echo '<span class="material-icons star-icon disBtn">star</span>';
                        echo '<span class="material-icons star-icon disBtn">star</span>';
                        echo '<span class="material-icons star-icon disBtn">star</span>';
                        echo '<span class="material-icons star-icon disBtn">star_border</span>';
                        echo '<span class="material-icons star-icon disBtn">star_border</span>';
                    }
                    else if($rating_detail['Rating_Star']==4)
                    {
                        echo '<span class="material-icons star-icon disBtn">star</span>';
                        echo '<span class="material-icons star-icon disBtn">star</span>';
                        echo '<span class="material-icons star-icon disBtn">star</span>';
                        echo '<span class="material-icons star-icon disBtn">star</span>';
                        echo '<span class="material-icons star-icon disBtn">star_border</span>';
                    }
                    else if($rating_detail['Rating_Star']==5)
                    {
                        echo '<span class="material-icons star-icon disBtn">star</span>';
                        echo '<span class="material-icons star-icon disBtn">star</span>';
                        echo '<span class="material-icons star-icon disBtn">star</span>';
                        echo '<span class="material-icons star-icon disBtn">star</span>';
                        echo '<span class="material-icons star-icon disBtn">star</span>';
                    }
                    echo "</div>";
                    if($rating_detail['Rating_Comment'] != "")
                    {
                        echo "<div class='cust-comment'>";
                        echo $rating_detail['Rating_Comment'];
                        echo "</div>";
                    }
                    if($rating_detail['Rating_Image'] != "")
                    {
                        echo "<div class='cust-rating-img'>";
                        echo '<img class="preimg" src="'.$rating_detail['Rating_Image'].'" alt="">';
                        echo "</div>";
                    }
                    echo "</div>";
                }
            }
            else
            {
                echo "<div style='text-align:center; font-size: 1.125em;'><span class='material-icons' style='font-size: 4.375em; color:lightgray;'>sms</span><br>No Review Yet</div>";
            }
            echo "</div>";
        }
	?>
                <div class="button_field" style="margin-top: 30px;">
                    <button class="venue_cancelbtn" type="button" onclick="window.history.back()" style="background-color:#f44336">Back</button>
                </div>
            </div>
        </div>
        </form>
    </div>
    </div>
<div class='preimg-admin'>
	<div id="Pic_Modal2" class="pic-modal">
    <!-- Preview Picture -->
    <div class="pic-modal-content">
        <span class="close preview-close-btn" title="Close Modal" style='margin-left: 5px; margin-top: -10px;'>&times;</span>
        <div class="form-container">
            <div class="page">
                <div class="wrapper">
                    <div class="image">
                        <img style="display: block;" class="preimg-preview" src="" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
$('.preimg').on('click', function(){
    $('#Pic_Modal2').css('display','block');
    var presrc = $(this).attr('src');
    $('.preimg-preview').attr('src',presrc);
})

$('.preview-close-btn').on('click',function(){
    $('#Pic_Modal2').css('display','none');
})
</script>
<?php //if($_GET['rel']!='tab'){ echo "</div>";} ?>
<?php include('footer.php'); ?>