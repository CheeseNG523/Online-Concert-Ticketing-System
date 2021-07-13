<?php include 'header_sidebar.php';
    include 'dataconnection.php';
    if(isset($_GET['view']))
	{
        $id = $_GET['id'];
        $result =  "select *, DATE_FORMAT(A.Purchase_Date, '%d-%m-%Y %T') as 'Purchase_Date' from purchase A, customer B, s_merchandise C, merchandise D, purchase_address E where 
        A.Purchase_ID=C.Purchase_ID and A.Purchase_ID = E.Purchase_ID and A.Cust_ID = B.Cust_ID and C.Cust_ID = A.Cust_ID and 
        C.Merchandise_ID = D.Merchandise_ID and A.Card_verify=1 and A.Purchase_ID = '$id' group by C.S_Merchandise_ID";
		$result_run = mysqli_query($connect,$result);
        $row = mysqli_fetch_assoc($result_run);
        $total = 0;

        $purchase_query="select * from purchase A, s_merchandise C, merchandise D, purchase_address E where 
        A.Purchase_ID=C.Purchase_ID and A.Purchase_ID = E.Purchase_ID and C.Cust_ID = A.Cust_ID and 
        C.Merchandise_ID = D.Merchandise_ID and A.Card_verify=1 and A.Purchase_ID='$id' group by C.S_Merchandise_ID";
        $purchase_search = mysqli_query($connect, $purchase_query);
	}
?>
<script src="js/profile_form.js"></script>
    <div class="page_position">
        <div class="position_left">
            <label>Order - Merchandise</label>
        </div>
        <div class="position_right">
            <a rel="tab" href="dashboard.php">
                <span class="material-icons">dashboard</span><span class="icon_txt">Home</span>
            </a>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <a rel="tab" href="order.php">Order - Concert</a>
            <label><span class="material-icons direction_arr">keyboard_arrow_right</span></label>
            <label class="current_direction">View Order - Concert</label>
        </div>
    </div>
    <div class="page_position">
    <div class="page_form">
        <div class='back-to-prev' onclick="history.back()"><span class="material-icons">arrow_back_ios</span>Back</div>         
        <form action="" class="update_venue_form" method="post" autocomplete="off">
        <div class="container" style="padding:45px;">
            <div class="page">
                <div class="title">View Order - Merchandise</div>
                <div class="txt_field">
                    <label>Order <span>#OID <?php echo $row['Purchase_ID']?></span></label>
                </div>
                <div class="txt_field" style="">
                    <label>Order placed by <span><?php echo $row['Cust_Lname']." ".$row['Cust_Fname']?></span></label>
                </div>
                <div class="txt_field" style=" margin:20px 0 30px 0;">
                    <label>Order Time: <span><?php echo $row['Purchase_Date'];?></span></label>
                </div>
                <div class="txt_field">
                    <label>Status: <span><?php 
                    if($row['Purchase_Status']==1)
                        echo "To Ship";
                    else if($row['Purchase_Status']==2)
                        echo "To Receive";
                    else if($row['Purchase_Status']==3)
                        echo "Completed";
                    ?></span></label>
                </div>
                <div class="txt_field">
                    <label>Delivery To: <br><span><?php echo $row['Purch_Address'];?>
                    <br><?php echo $row['Purch_Postcode'];?>, <?php echo $row['Purch_City']?><br><?php echo $row['Purch_State'];?></span></label>
                </div>
            <table id="concert_active" class="table_container merch" style="margin-top:80px; background:white; box-shadow: 0 0 5px 0 #ccc;">
                <thead>
                <tr class="header">
                    <td colspan="3">Detail</td>
                </tr>
                <tr class="header-bar">
                    <th width=25% style="text-align:center;">Product</th>
                    <th width=25% style="text-align:center;">Price (RM)</th>
                    <th width=25% style="text-align:center;">Quantity</th>
                    <th width=25% style="text-align:center;">Subtotal (RM)</th>
                </tr>
                </thead>
                <tbody class="table_content" id="table_row">
                <?php
                $total_weight = 0;
                $sub_total=0;
                $pay =0;
                $shipping =0;
                while($purchase_result = mysqli_fetch_assoc($purchase_search))
                {
                    echo "<tr>";
                        echo "<td style='text-align: left;'><img class='item-image' src='" .$purchase_result['Merchandise_Image']."'style='vertical-align: middle;height: auto;width: 25%; float:left;'><p>".$purchase_result['Merchandise_Name'] . "</p></td>";
                        echo "<td>RM ". number_format($purchase_result['Merchandise_ListPrice'],2,'.','') . "</td>";
                        echo "<td>" . $purchase_result['S_Merchandise_Qty'] . "</td>";
                        echo "<td>RM " . number_format($purchase_result['Merchandise_ListPrice']*$purchase_result['S_Merchandise_Qty'],2,'.','') . "</td>";
                    echo "</tr>";
                    $sub_total += number_format($purchase_result['Merchandise_ListPrice']*$purchase_result['S_Merchandise_Qty'],2,'.','');
                    $total_weight += number_format($purchase_result['Merchandise_Weight']*$purchase_result['S_Merchandise_Qty'],2,'.','');
                }
                $shipping += 4.00;
                if($total_weight>3)
                    $shipping += ($total_weight - 3)*2.00;

                $pay = $sub_total + $shipping;
                echo '<tr>';
                echo '<td colspan=3 style="padding: 15px !important; text-align:right; border-bottom:none;">Shipping:</td>';
                echo '<td style="border:none; padding: 15px !important;">RM '.number_format($shipping,2,'.','').'</td>';
                echo '</tr><tr>';
                echo '<td colspan=3 style="padding: 15px !important; text-align:right">Total:</td><input type="text" name="total_price" value="'.$pay.'" hidden>';
                echo '<td style="padding: 15px !important; font-weight:700; text-decoration:underline">RM '.number_format($pay,2,'.','').'</td>';
                ?>
                </tbody>
            </table>
            <?php
        $check_status = mysqli_query($connect,"select A.Purchase_Status from purchase A, s_merchandise B where A.Purchase_ID = B.Purchase_ID and A.Purchase_ID = '$id'");
        $check_status_run = mysqli_fetch_assoc($check_status);
        if($check_status_run['Purchase_Status'] == 3)
        {
            $comment_query = mysqli_query($connect,"select A.Rating_Star, A.Rating_Comment, A.Rating_Image, E.Cust_ID, E.Cust_Lname, E.Cust_Fname, E.Cust_Image, E.Cust_Gender, 
            C.Merchandise_Name, B.s_merchandise_qty from rating A, s_merchandise B, merchandise C, purchase D, customer E where E.Cust_ID and A.Cust_ID and D.Purchase_ID = B.Purchase_ID 
            and D.Cust_ID = E.Cust_ID and A.Cust_ID = E.Cust_ID and A.S_Merchandise_ID = B.S_Merchandise_ID and C.Merchandise_ID = B.Merchandise_ID and D.Card_verify=1 
            and D.Purchase_ID = '$id'");

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
                    echo "<div class='item-detail' style='padding-left: 8px;'>".$rating_detail['Merchandise_Name']." x ".$rating_detail['s_merchandise_qty']."</div>";
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