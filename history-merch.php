<?php
    session_start();
	include "dataconnection.php";
    
    if(!isset($_SESSION['email']))
    {
        header("location: login.php");
    }
    else
    {
        $email = $_SESSION['email'];
        $email_query = "SELECT * FROM customer WHERE Cust_Email = '$email'";
        $email_search = mysqli_query($connect, $email_query);
        $cust_details = mysqli_fetch_assoc($email_search);
        $Cust_ID = $cust_details['Cust_ID'];
    }

    $all_merch = mysqli_query($connect,"select * from purchase A, customer B, s_merchandise C, merchandise D where 
    A.Purchase_ID = C.Purchase_ID and A.Cust_ID = B.Cust_ID and C.Cust_ID = B.Cust_ID and C.Merchandise_ID = D.Merchandise_ID and A.Card_verify = 1 
    and B.Cust_ID = '$Cust_ID'  group by A.Purchase_ID order by A.Purchase_Date desc");

    $ship_merch = mysqli_query($connect,"select * from purchase A, customer B, s_merchandise C, merchandise D where 
    A.Purchase_ID = C.Purchase_ID and A.Cust_ID = B.Cust_ID and C.Cust_ID = B.Cust_ID and C.Merchandise_ID = D.Merchandise_ID and A.Card_verify = 1 
    and A.Purchase_Status = 1 and B.Cust_ID = '$Cust_ID'  group by A.Purchase_ID order by A.Purchase_Date desc");

    $received_merch = mysqli_query($connect,"select * from purchase A, customer B, s_merchandise C, merchandise D where 
    A.Purchase_ID = C.Purchase_ID and A.Cust_ID = B.Cust_ID and C.Cust_ID = B.Cust_ID and C.Merchandise_ID = D.Merchandise_ID and A.Card_verify = 1 
    and A.Purchase_Status = 2 and B.Cust_ID = '$Cust_ID'  group by A.Purchase_ID order by A.Purchase_Date desc");

    $completed_merch = mysqli_query($connect,"select * from purchase A, customer B, s_merchandise C, merchandise D where 
    A.Purchase_ID = C.Purchase_ID and A.Cust_ID = B.Cust_ID and C.Cust_ID = B.Cust_ID and C.Merchandise_ID = D.Merchandise_ID and A.Card_verify = 1 
    and A.Purchase_Status = 3 and B.Cust_ID = '$Cust_ID'  group by A.Purchase_ID order by A.Purchase_Date desc");

    $get_all_merch = mysqli_num_rows($all_merch);
    $get_ship_merch = mysqli_num_rows($ship_merch);
    $get_received_merch = mysqli_num_rows($received_merch);
    $get_completed_merch = mysqli_num_rows($completed_merch);
?>
<!DOCTYPE html>
<html>
<head>
<title>My profile</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://kit.fontawesome.com/14a3a3f38a.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <script src="profile_validation.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="head-foot3.css">
    <link rel="stylesheet" href="cust_profile3.css">
    <link rel="stylesheet" href="profile-sidebar1.css">
    <link rel="stylesheet" href="tnc_privacy.css">
    <link rel="stylesheet" href="history.css">
<style>

.history-item-container .status-container .status-conatiner-bar{
    width: 22%;
}

</style>
</head>
<?php include "header.php"; ?>
	<div class="button">
		<a href="index.php">Home</a>
		<a href="aboutus.php">About Us</a>
		<a href="concert.php">Concert</a>
		<a href="merchandise.php">Merchandise</a>
		<a href="singer.php">Singer</a>
	</div>
  </div>
</div>

<!--Go to top button-->
<a id="toTopBtn"><i class="material-icons" style="font-size: 45px;">keyboard_arrow_up</i></a>

<script>
	//Scroll to top button
	$(window).scroll(function() 
	{
		var height = $(window).scrollTop();

		//if page height is over 500px, show button
		if(height > 500)
		{
			$('#toTopBtn').fadeIn();
		}
		else
		{
			$('#toTopBtn').fadeOut();
		}
	});

	$(document).ready(function() 
	{
		$("#toTopBtn").click(function(event)
		{
			event.preventDefault();
			$('html, body').animate({scrollTop: 0}, 'slow');
			return false;
		});
	});
</script>

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
                echo "<img class='prof_pic' style='margin:auto;' src='" . str_replace("../", "", $cust_details['Cust_Image']) . "'>";
            }
            echo "<span class='tooltiptext'>Change profile picture</span></div>";
            echo "<p>" . $cust_details['Cust_Lname'] . " " . $cust_details['Cust_Fname'] . "</p>"; 
        ?>
        <!-- Change Profile Picture Modal -->
		<div id="Pic_Modal" class="pic-modal">
            <!-- Form to upload picture -->
            <div class="pic-modal-content">
                <form name='change_pic' class='change_img' action='' method='post' autocomplete='off'>
                <span onclick="clearImg()" class="close" title="Close Modal" style='margin-left: 5px; margin-top: -10px;'>&times;</span>
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
                            <button type="button" onclick="clearImg()" class="cancelbtn" style="margin-right: 0;">Cancel</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>

        <a href='profile.php'><i class='material-icons'>portrait</i>My profile</a><br>
        <a href='edit_profile.php'><i class='material-icons'>edit</i>Edit profile</a><br>
        <a href='change_password.php'><i class='material-icons'>lock</i>Change password</a><br>
        <a href='#' class='active'><i class='material-icons'>history</i>History</a><br>
        <a href='history-ticket.php' class='sub-menu-bar concert_ticket'><i class='material-icons'>confirmation_number</i>Ticket</a><br>
        <a href='#' class='sub-menu-bar merchandise_tab active'><i class='material-icons'>local_mall</i>Merchandise</a>
    </div>

    <div class="history-container">
        <div class='main-title' style='padding: 0;'>
            <h1>Order History</h1>
        </div>

        <!-- <div class='product-tab concert_ticket'>
            <span>Concert Ticket</span>
            <i class="material-icons" style='float:right; margin-top: 5px;'>arrow_forward</i>
        </div>
        <div class="product-tab merchandise_tab">
            <span>Merchandise</span>
            <i class="material-icons" style='float:right; margin-top: 5px;'>arrow_forward</i>
        </div> -->

        <!-- all history of merchandise -->
        <div class="merchandise-container history-item-container">
        <h3>Merchandise</h3>
        <?php
        if($get_all_merch != 0)
        {
        ?>
            <div class="status-container">
                <div class="status-conatiner-bar active left merch-all">
                    All (<?php echo $get_all_merch?>)
                </div>
                <div class="status-conatiner-bar left merch-ship">
                    To Ship (<?php echo $get_ship_merch?>)
                </div>
                <div class="status-conatiner-bar left merch-received">
                    To Received (<?php echo $get_received_merch?>)
                </div>
                <div class="status-conatiner-bar right merch-completed">
                    Completed (<?php echo $get_completed_merch?>)
                </div>
            </div>
            <div class="all-merch-list">
        <?php
            while($all_merch_run = mysqli_fetch_assoc($all_merch))
            {
                $purchase_ID = $all_merch_run['Purchase_ID'];
                $all_merch_item = mysqli_query($connect,"select D.Merchandise_Image, D.Merchandise_Name, D.Merchandise_ListPrice, C.S_Merchandise_Qty, 
                A.Purchase_ID from purchase A, customer B, s_merchandise C, merchandise D where A.Purchase_ID = C.Purchase_ID and A.Cust_ID = B.Cust_ID and 
                C.Cust_ID = B.Cust_ID and C.Merchandise_ID = D.Merchandise_ID and A.Purchase_ID = '$purchase_ID'");
                $count=1;
                $completed = 0;
                $viewmore = 0;

                echo "<div class='product-tab'>";
                echo "<span>Order #" . $all_merch_run['Purchase_ID']."</span>";
                if($all_merch_run['Purchase_Status']==1)
                    echo "<span class='item-status' style='color: gray;'><i>To Ship</i></span>";
                else if($all_merch_run['Purchase_Status']==2)
                    echo "<span class='item-status' style='color: gray;'><i>To Received</i></span>";
                else if($all_merch_run['Purchase_Status']==3)
                {
                    echo "<span class='item-status' style='color: gray;'><i>Completed</i></span>";
                    $completed = 1;
                }

                echo "<div class='item-purchase-time'>Purchase at: " . date_format(date_create($all_merch_run['Purchase_Date'] ), "d M Y, H:i"). "</div>";
                echo "<hr style='border: 0px; border-top: 1px solid lightgray;'>";
                while($all_merch_item_run = mysqli_fetch_assoc($all_merch_item))
                {
                    if($count>2)
                    {
                        $viewmore++;
                        echo "<div class='merch-item-detail hidden-item'>";
                        echo '<div class="item-image-info"><img src="'.str_replace("../", "", $all_merch_item_run['Merchandise_Image']).'">';
                        echo '<span>'.$all_merch_item_run['Merchandise_Name'].'<br>x '.$all_merch_item_run['S_Merchandise_Qty'].'</span>'.'<span class="item-price">RM '.$all_merch_item_run['Merchandise_ListPrice'].'</span>';
                        echo '</div>';
                        echo '</div>';
                    }
                    else
                    {
                        echo "<div class='merch-item-detail'>";
                        echo '<div class="item-image-info"><img src="'.str_replace("../", "", $all_merch_item_run['Merchandise_Image']).'">';
                        echo '<span>'.$all_merch_item_run['Merchandise_Name'].'<br>x '.$all_merch_item_run['S_Merchandise_Qty'].'</span>'.'<span class="item-price">RM '.$all_merch_item_run['Merchandise_ListPrice'].'</span>';
                        echo '</div>';
                        echo '</div>';
                    }
                    $count++;
                }
                if($viewmore>0)
                {
                    echo '<div class="merch-item-viewmore">View More('.$viewmore.')</div>';
                }
                echo "<span class='item-total'><label>Total: </label>RM ".$all_merch_run['Total_Price']."</span><br>";
                echo "<div class='item-detail-button'>";
                echo "<div class='item-detail-footer'>";
                if($completed == 1)
                {
                    $check_rating = mysqli_query($connect,"select A.Rating_ID from rating A, s_merchandise B, purchase C where A.S_Merchandise_ID = B.S_Merchandise_ID 
                    and C.Purchase_ID = B.Purchase_ID and C.Purchase_ID = '$purchase_ID'");
                    if(mysqli_num_rows($check_rating))
                    {
                        echo '<a class="rate_view_btn" href="rating-merch.php?view='.$all_merch_run['Purchase_ID'].'" style="margin-left: 10px;">View Rating</a>';
                    }
                    else
                        echo '<a class="rate_view_btn" href="rating-merch.php?id='.$all_merch_run['Purchase_ID'].'" style="margin-left: 10px;">Write Review</a>';
                }
                echo "<a class='rate_view_btn' href='merch_payment_out.php?view&id=".$purchase_ID."'>Order Details</a>";
                echo '</div>';
                echo "</div></div>";
            }
        }
        else
        {
            echo "<img src='images/cart/no_order.jpg' style='display: block; margin: auto; width:60%;'>";
            echo "<div style='text-align: center;'><h2>No Order Found</h2></div>";
        }   
        ?>
        </div>
        <div class="ship-merch-list" style="display:none;">
        <?php
        if($get_ship_merch != 0)
        {
            while($ship_merch_run = mysqli_fetch_assoc($ship_merch))
            {
                $purchase_ID = $ship_merch_run['Purchase_ID'];
                $ship_merch_item = mysqli_query($connect,"select D.Merchandise_Image, D.Merchandise_Name, D.Merchandise_ListPrice, C.S_Merchandise_Qty, 
                A.Purchase_ID from purchase A, customer B, s_merchandise C, merchandise D where A.Purchase_ID = C.Purchase_ID and A.Cust_ID = B.Cust_ID and 
                C.Cust_ID = B.Cust_ID and C.Merchandise_ID = D.Merchandise_ID and A.Purchase_ID = '$purchase_ID'");
                $count=1;
                $completed = 0;
                $viewmore = 0;

                echo "<div class='product-tab'>";
                echo "<span>Order #" . $ship_merch_run['Purchase_ID']."</span>";

                echo "<div class='item-purchase-time'>Purchase at: " . date_format(date_create($ship_merch_run['Purchase_Date'] ), "d M Y, H:i"). "</div>";
                echo "<hr style='border: 0px; border-top: 1px solid lightgray;'>";

                while($ship_merch_item_run = mysqli_fetch_assoc($ship_merch_item))
                {
                    if($count>2)
                    {
                        $viewmore++;
                        echo "<div class='merch-item-detail hidden-item'>";
                        echo '<div class="item-image-info"><img src="'.str_replace("../", "", $ship_merch_item_run['Merchandise_Image']).'">';
                        echo '<span>'.$ship_merch_item_run['Merchandise_Name'].'<br>x '.$ship_merch_item_run['S_Merchandise_Qty'].'</span>'.'<span class="item-price">RM '.$ship_merch_item_run['Merchandise_ListPrice'].'</span>';
                        echo '</div>';
                        echo '</div>';
                    }
                    else
                    {
                        echo "<div class='merch-item-detail'>";
                        echo '<div class="item-image-info"><img src="'.str_replace("../", "", $ship_merch_item_run['Merchandise_Image']).'">';
                        echo '<span>'.$ship_merch_item_run['Merchandise_Name'].'<br>x '.$ship_merch_item_run['S_Merchandise_Qty'].'</span>'.'<span class="item-price">RM '.$ship_merch_item_run['Merchandise_ListPrice'].'</span>';
                        echo '</div>';
                        echo '</div>';
                    }
                    $count++;
                }
                if($viewmore>0)
                {
                    echo '<div class="merch-item-viewmore">View More('.$viewmore.')</div>';
                }
                echo "<span class='item-total'><label>Total: </label>RM ".$ship_merch_run['Total_Price']."</span><br>";
                echo "<div class='item-detail-footer'>";
                echo "<div class='item-detail-button'><a class='rate_view_btn' href='merch_payment_out.php?view&id=".$purchase_ID."'>Order Details</a>";
                echo '</div>';
                echo "</div></div>";
            }
        }
        else
        {
            echo "<img src='images/cart/no_order.jpg' style='display: block; margin: auto; width:60%;'>";
            echo "<div style='text-align: center;'><h2>No Order Found</h2></div>";
        }  
        ?>
        </div>
        <div class="received-merch-list" style="display:none;">
        <?php
        if($get_received_merch != 0)
        {
            while($received_merch_run = mysqli_fetch_assoc($received_merch))
            {
                $purchase_ID = $received_merch_run['Purchase_ID'];
                $received_merch_item = mysqli_query($connect,"select D.Merchandise_Image, D.Merchandise_Name, D.Merchandise_ListPrice, C.S_Merchandise_Qty, 
                A.Purchase_ID from purchase A, customer B, s_merchandise C, merchandise D where A.Purchase_ID = C.Purchase_ID and A.Cust_ID = B.Cust_ID and 
                C.Cust_ID = B.Cust_ID and C.Merchandise_ID = D.Merchandise_ID and A.Purchase_ID = '$purchase_ID'");
                $count=1;
                $completed = 0;
                $viewmore = 0;

                echo "<div class='product-tab'>";
                echo "<span>Order #" . $received_merch_run['Purchase_ID']."</span>";

                echo "<div class='item-purchase-time'>Purchase at: " . date_format(date_create($received_merch_run['Purchase_Date'] ), "d M Y, H:i"). "</div>";
                echo "<hr style='border: 0px; border-top: 1px solid lightgray;'>";

                while($received_merch_item_run = mysqli_fetch_assoc($received_merch_item))
                {
                    if($count>2)
                    {
                        $viewmore++;
                        echo "<div class='merch-item-detail hidden-item'>";
                        echo '<div class="item-image-info"><img src="'.str_replace("../", "", $received_merch_item_run['Merchandise_Image']).'">';
                        echo '<span>'.$received_merch_item_run['Merchandise_Name'].'<br>x '.$received_merch_item_run['S_Merchandise_Qty'].'</span>'.'<span class="item-price">RM '.$received_merch_item_run['Merchandise_ListPrice'].'</span>';
                        echo '</div>';
                        echo '</div>';
                    }
                    else
                    {
                        echo "<div class='merch-item-detail'>";
                        echo '<div class="item-image-info"><img src="'.str_replace("../", "", $received_merch_item_run['Merchandise_Image']).'">';
                        echo '<span>'.$received_merch_item_run['Merchandise_Name'].'<br>x '.$received_merch_item_run['S_Merchandise_Qty'].'</span>'.'<span class="item-price">RM '.$received_merch_item_run['Merchandise_ListPrice'].'</span>';
                        echo '</div>';
                        echo '</div>';
                    }
                    $count++;
                }
                if($viewmore>0)
                {
                    echo '<div class="merch-item-viewmore">View More('.$viewmore.')</div>';
                }
                echo "<span class='item-total'><label>Total: </label>RM ".$received_merch_run['Total_Price']."</span><br>";
                echo "<div class='item-detail-footer'>";
                echo "<div class='item-detail-button'><a class='rate_view_btn' href='merch_payment_out.php?view&id=".$purchase_ID."'>Order Details</a>";
                echo '</div>';
                echo "</div></div>";
            }
        }
        else
        {
            echo "<img src='images/cart/no_order.jpg' style='display: block; margin: auto; width:60%;'>";
            echo "<div style='text-align: center;'><h2>No Order Found</h2></div>";
        }  
        ?>
        </div>
        <div class="completed-merch-list" style="display:none;">
        <?php
        if($get_completed_merch != 0)
        {
            while($completed_merch_run = mysqli_fetch_assoc($completed_merch))
            {
                $purchase_ID = $completed_merch_run['Purchase_ID'];
                $completed_merch_item = mysqli_query($connect,"select D.Merchandise_Image, D.Merchandise_Name, D.Merchandise_ListPrice, C.S_Merchandise_Qty, 
                A.Purchase_ID from purchase A, customer B, s_merchandise C, merchandise D where A.Purchase_ID = C.Purchase_ID and A.Cust_ID = B.Cust_ID and 
                C.Cust_ID = B.Cust_ID and C.Merchandise_ID = D.Merchandise_ID and A.Purchase_ID = '$purchase_ID'");
                $count=1;
                $completed = 1;
                $viewmore = 0;

                echo "<div class='product-tab'>";
                echo "<span>Order #" . $completed_merch_run['Purchase_ID']."</span>";
                
                echo "<div class='item-purchase-time'>Purchase at: " . date_format(date_create($completed_merch_run['Purchase_Date'] ), "d M Y, H:i"). "</div>";
                echo "<hr style='border: 0px; border-top: 1px solid lightgray;'>";

                while($completed_merch_item_run = mysqli_fetch_assoc($completed_merch_item))
                {
                    if($count>2)
                    {
                        $viewmore++;
                        echo "<div class='merch-item-detail hidden-item'>";
                        echo '<div class="item-image-info"><img src="'.str_replace("../", "", $completed_merch_item_run['Merchandise_Image']).'">';
                        echo '<span>'.$completed_merch_item_run['Merchandise_Name'].'<br>x '.$completed_merch_item_run['S_Merchandise_Qty'].'</span>'.'<span class="item-price">RM '.$completed_merch_item_run['Merchandise_ListPrice'].'</span>';
                        echo '</div>';
                        echo '</div>';
                    }
                    else
                    {
                        echo "<div class='merch-item-detail'>";
                        echo '<div class="item-image-info"><img src="'.str_replace("../", "", $completed_merch_item_run['Merchandise_Image']).'">';
                        echo '<span>'.$completed_merch_item_run['Merchandise_Name'].'<br>x '.$completed_merch_item_run['S_Merchandise_Qty'].'</span>'.'<span class="item-price">RM '.$completed_merch_item_run['Merchandise_ListPrice'].'</span>';
                        echo '</div>';
                        echo '</div>';
                    }
                    $count++;
                }
                if($viewmore>0)
                {
                    echo '<div class="merch-item-viewmore">View More('.$viewmore.')</div>';
                }
                echo "<span class='item-total'><label>Total: </label>RM ".$completed_merch_run['Total_Price']."</span><br>";
                echo "<div class='item-detail-button'>";
                echo "<div class='item-detail-footer'>";
                if($completed == 1)
                {
                    $check_rating = mysqli_query($connect,"select A.Rating_ID from rating A, s_merchandise B, purchase C where A.S_Merchandise_ID = B.S_Merchandise_ID 
                    and C.Purchase_ID = B.Purchase_ID and C.Purchase_ID = '$purchase_ID'");
                    if(mysqli_num_rows($check_rating))
                    {
                        echo '<a class="rate_view_btn" href="rating-merch.php?view='.$completed_merch_run['Purchase_ID'].'" style="margin-left: 10px;">View Rating</a>';
                    }
                    else
                        echo '<a class="rate_view_btn" href="rating-merch.php?id='.$completed_merch_run['Purchase_ID'].'" style="margin-left: 10px;">Write Review</a>';
                }
                echo "<a class='rate_view_btn' href='merch_payment_out.php?view&id=".$purchase_ID."'>Order Details</a>";
                echo '</div>';
                echo "</div></div>";
            }
        }
        else
        {
            echo "<img src='images/cart/no_order.jpg' style='display: block; margin: auto; width:60%;'>";
            echo "<div style='text-align: center;'><h2>No Order Found</h2></div>";
        }      
        ?>
        </div>
        </div>
    </div>    
</div>

<script>
    $(".merch-all").on('click', function(){
        $('.merch-all').addClass("active");
        $('.merch-ship').removeClass("active");
        $('.merch-received').removeClass("active");
        $('.merch-completed').removeClass("active");
        $('.all-merch-list').css("display","block");
        $('.received-merch-list').css("display","none");
        $(".ship-merch-list").css("display","none");
        $(".completed-merch-list").css("display","none");
    })

    $(".merch-ship").on('click', function(){
        $('.merch-all').removeClass("active");
        $('.merch-ship').addClass("active");
        $('.merch-received').removeClass("active");
        $('.merch-completed').removeClass("active");
        $('.all-merch-list').css("display","none");
        $('.received-merch-list').css("display","none");
        $(".ship-merch-list").css("display","block");
        $(".completed-merch-list").css("display","none");
    })

    $(".merch-received").on('click', function(){
        $('.merch-all').removeClass("active");
        $('.merch-ship').removeClass("active");
        $('.merch-received').addClass("active");
        $('.merch-completed').removeClass("active");
        $('.all-merch-list').css("display","none");
        $('.received-merch-list').css("display","block");
        $(".ship-merch-list").css("display","none");
        $(".completed-merch-list").css("display","none");
    })

    $(".merch-completed").on('click', function(){
        $('.merch-all').removeClass("active");
        $('.merch-ship').removeClass("active");
        $('.merch-received').removeClass("active");
        $('.merch-completed').addClass("active");
        $('.all-merch-list').css("display","none");
        $('.received-merch-list').css("display","none");
        $(".ship-merch-list").css("display","none");
        $(".completed-merch-list").css("display","block");
    })

    $('.merch-item-viewmore').on('click', function(){
        $(this).closest(".product-tab").contents().filter('.merch-item-detail').removeClass('hidden-item');
        $(this).css('display','none');
    })

    // $('.ticket_back_btn').on('click', function(){
    //     $('.concert_ticket').css('display', 'block');
    //     $('.merchandise_tab').css('display', 'block');
    //     $('.ticket-container').css('display', 'none');
    //     $('.merchandise-container').css('display', 'none');
    // })

    // $('.merch_back_btn').on('click', function(){
    //     $('.concert_ticket').css('display', 'block');
    //     $('.merchandise_tab').css('display', 'block');
    //     $('.ticket-container').css('display', 'none');
    //     $('.merchandise-container').css('display', 'none');
    // })
</script>

<?php include "footer.php"; ?>