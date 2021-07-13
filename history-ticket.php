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

    $all_tic = mysqli_query($connect,"select * from purchase A, customer B, s_ticket C, ticket_price D, concert E 
    where E.Concert_ID = D.Concert_ID and C.PriceID = D.Price_ID and C.Purchase_ID = A.Purchase_ID and A.Cust_ID = B.Cust_ID and A.Card_verify = 1 
    and E.Concert_Status != 0 and B.Cust_ID = '$Cust_ID' GROUP BY A.Purchase_ID order by A.Purchase_Date desc");
    
    $ongoing_tic = mysqli_query($connect,"select * from purchase A, customer B, s_ticket C, ticket_price D, concert E 
    where E.Concert_ID = D.Concert_ID and C.PriceID = D.Price_ID and C.Purchase_ID = A.Purchase_ID and A.Cust_ID = B.Cust_ID and A.Card_verify = 1 
    and E.Concert_Status != 0 and E.Concert_Status != 3 and B.Cust_ID = '$Cust_ID' GROUP BY A.Purchase_ID order by A.Purchase_Date desc");

    $completed_tic = mysqli_query($connect,"select * from purchase A, customer B, s_ticket C, ticket_price D, concert E 
    where E.Concert_ID = D.Concert_ID and C.PriceID = D.Price_ID and C.Purchase_ID = A.Purchase_ID and A.Cust_ID = B.Cust_ID and A.Card_verify = 1 
    and E.Concert_Status != 0 and E.Concert_Status = 3 and B.Cust_ID = '$Cust_ID' GROUP BY A.Purchase_ID order by A.Purchase_Date desc");

    $get_all_ticket = mysqli_num_rows($all_tic);
    $get_ongoing_ticket = mysqli_num_rows($ongoing_tic);
    $get_completed_ticket = mysqli_num_rows($completed_tic);
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

<?php include "profile-sidebar.php"; ?>
        <a href='profile.php'><i class='material-icons'>portrait</i>My profile</a><br>
        <a href='edit_profile.php'><i class='material-icons'>edit</i>Edit profile</a><br>
        <a href='change_password.php'><i class='material-icons'>lock</i>Change password</a><br>
        <a href='#' class='active'><i class='material-icons'>history</i>History</a><br>
        <a href='#' class='sub-menu-bar concert_ticket active'><i class='material-icons'>confirmation_number</i>Ticket</a><br>
        <a href='history-merch.php' class='sub-menu-bar merchandise_tab'><i class='material-icons'>local_mall</i>Merchandise</a>
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

        <!-- all history of concert ticket -->
        <div class="ticket-container history-item-container">
            <h3>Concert Ticket</h3>
            <?php
            if($get_all_ticket != 0)
            {
                echo "<div class='status-container'>";
                    echo "<div class='status-conatiner-bar active left ticket-all'>";
                        echo "All (" . $get_all_ticket . ")";
                    echo "</div>";
                    echo "<div class='status-conatiner-bar left ticket-paid'>";
                        echo "Upcoming (" . $get_ongoing_ticket . ")";
                    echo "</div>";
                    echo "<div class='status-conatiner-bar right ticket-completed'>";
                        echo "Past (" . $get_completed_ticket . ")";
                    echo "</div>";
                echo "</div>";
                
                //all tickets details
                echo "<div class='all-ticket-list'>";
                while($all_ticket = mysqli_fetch_assoc($all_tic))
                {
                    //get all ticket details
                    $purchaseID = $all_ticket['Purchase_ID'];
                    $area_query = "SELECT * FROM purchase, s_ticket, customer, ticket_price WHERE purchase.Purchase_ID = $purchaseID 
                    AND s_ticket.Purchase_ID = purchase.Purchase_ID AND customer.Cust_ID = $Cust_ID AND purchase.Cust_ID = customer.Cust_ID AND ticket_price.Price_ID = s_ticket.PriceID";
                    $area_run = mysqli_query($connect, $area_query);
                    $area_count = mysqli_num_rows($area_run);

                    //concert status
                    if($all_ticket['Concert_Status'] != 3)
                    {
                        $concert_status = "Upcoming";
                    }
                    else
                    {
                        $concert_status = "Past";
                    }

                    echo "<div class='product-tab'>";
                        echo "<span class='concert-order-id'>Order #" . $all_ticket['Purchase_ID'] . "<span class='concert_order_status'><i> " . $concert_status . "</i></span></span>";
                        echo "<div class='purchase-date'>Purchase at: " . date_format(date_create($all_ticket['Purchase_Date'] ), "d M Y, H:i"). "</div>";
                        echo "<hr style='border: 0px; border-top: 1px solid lightgray;'>";
                        echo "<div class='preview_container'>";
                            echo '<div style="grid-column: 1/2;"><img style="width: 100%;" src="'.str_replace("../", "", $all_ticket["Concert_Ver_Image"]).'"></div>';
                            echo "<div style='display:grid; grid-template-rows: repeat(" . ($area_count+1) . ", 0.2fr) auto; line-height: 1.2; font-size: 22px;'>";
                            echo "<p style='margin-top:0;'>" . $all_ticket['Concert_Name'] . "</p>";
                            
                            //display details group by price area
                            while($area_result = mysqli_fetch_array($area_run))
                            {
                                echo "<div style='font-size: 0.7em;'>" . $area_result['Price_Area'] . " * " . $area_result['S_Ticket_Qty'] . "</div>";
                                $total_price = $area_result['Total_Price'];
                            }
                            echo "<div class='order_total_price'><span style='font-size:15px;'>Total:</span> <b>RM " . $total_price . "</b></div>";
                            echo "</div>";
                        echo "</div>";
                        if($concert_status == "Past")
                        {
                            $checking_query = mysqli_query($connect,"select * from rating where Ticket_Purchase_ID = '$purchaseID'");
                            if(mysqli_num_rows($checking_query))
                            echo "<a class='rate_view_btn' href='rating-concert.php?view=".$all_ticket['Purchase_ID']."' style='margin-left: 10px;'>View Rating</a>";
                            else
                            echo "<a class='rate_view_btn' href='rating-concert.php?id=".$all_ticket['Purchase_ID']."' style='margin-left: 10px;'>Write Review</a>";
                        }
                        echo "<a class='rate_view_btn' href='payment_out.php?id=".$all_ticket['Purchase_ID']."'>Order Details</a>";
                    echo "</div>";
                }
                echo "</div>";

                //ongoing tickets details
                echo "<div class='ongoing-ticket-list' style='display:none;'>";
                if($get_ongoing_ticket != 0)
                {
                    while($ongoing_ticket = mysqli_fetch_assoc($ongoing_tic))
                    {
                        //get ongoing ticket details
                        $purchaseID = $ongoing_ticket['Purchase_ID'];
                        $area_query = "SELECT * FROM purchase, s_ticket, customer, ticket_price WHERE purchase.Purchase_ID = $purchaseID 
                        AND s_ticket.Purchase_ID = purchase.Purchase_ID AND customer.Cust_ID = $Cust_ID AND purchase.Cust_ID = customer.Cust_ID AND ticket_price.Price_ID = s_ticket.PriceID";
                        $area_run = mysqli_query($connect, $area_query);
                        $area_count = mysqli_num_rows($area_run);

                        echo "<div class='product-tab'>";
                            echo "<span class='concert-order-id'>Order #" . $ongoing_ticket['Purchase_ID'] . "</span>";
                            echo "<div class='purchase-date'>Purchase at: " . date_format(date_create($ongoing_ticket['Purchase_Date'] ), "d M Y, H:i"). "</div>";
                            echo "<hr style='border: 0px; border-top: 1px solid lightgray;'>";
                            echo "<div class='preview_container'>";
                                echo '<div style="grid-column: 1/2;"><img style="width: 100%;" src="'.str_replace("../", "", $ongoing_ticket["Concert_Ver_Image"]).'"></div>';
                                echo "<div style='display:grid; grid-template-rows: repeat(" . ($area_count+1) . ", 0.2fr) auto; line-height: 1.2; font-size: 22px;'>";
                                echo "<p style='margin-top:0;'>" . $ongoing_ticket['Concert_Name'] . "</p>";
                                
                                //display details group by price area
                                while($area_result = mysqli_fetch_array($area_run))
                                {
                                    echo "<div style='font-size: 0.7em;'>" . $area_result['Price_Area'] . " * " . $area_result['S_Ticket_Qty'] . "</div>";
                                    $total_price = $area_result['Total_Price'];
                                }
                                echo "<div class='order_total_price'><span style='font-size:15px;'>Total:</span>  <b>RM " . $total_price . "</b></div>";
                                echo "</div>";
                            echo "</div>";
                            echo "<a class='rate_view_btn' href='payment_out.php?id=".$ongoing_ticket['Purchase_ID']."'>Order Details</a>";
                        echo "</div>";
                    }
                }
                else
                {
                    echo "<img src='images/cart/no_order.jpg' style='display: block; margin: auto; width:60%;'>";
                    echo "<div style='text-align: center;'><h2>No Result Found</h2></div>";
                }
                echo "</div>";

                //completed tickets details
                echo "<div class='completed-ticket-list' style='display:none;'>";
                if($get_completed_ticket != 0)
                {
                    while($completed_ticket = mysqli_fetch_assoc($completed_tic))
                    {
                        //get ongoing ticket details
                        $purchaseID = $completed_ticket['Purchase_ID'];
                        $area_query = "SELECT * FROM purchase, s_ticket, customer, ticket_price WHERE purchase.Purchase_ID = $purchaseID 
                        AND s_ticket.Purchase_ID = purchase.Purchase_ID AND customer.Cust_ID = $Cust_ID AND purchase.Cust_ID = customer.Cust_ID AND ticket_price.Price_ID = s_ticket.PriceID";
                        $area_run = mysqli_query($connect, $area_query);
                        $area_count = mysqli_num_rows($area_run);

                        echo "<div class='product-tab'>";
                            echo "<span class='concert-order-id'>Order #" . $completed_ticket['Purchase_ID'] . "</span>";
                            echo "<div class='purchase-date'>Purchase at: " . date_format(date_create($completed_ticket['Purchase_Date'] ), "d M Y, H:i"). "</div>";
                            echo "<hr style='border: 0px; border-top: 1px solid lightgray;'>";
                            echo "<div class='preview_container'>";
                                echo '<div style="grid-column: 1/2;"><img style="width: 100%;" src="'.str_replace("../", "", $completed_ticket["Concert_Ver_Image"]).'"></div>';
                                echo "<div style='display:grid; grid-template-rows: repeat(" . ($area_count+1) . ", 0.2fr) auto; line-height: 1.2; font-size: 22px;'>";
                                echo "<p style='margin-top:0;'>" . $completed_ticket['Concert_Name'] . "</p>";
                                
                                //display details group by price area
                                while($area_result = mysqli_fetch_array($area_run))
                                {
                                    echo "<div style='font-size: 0.7em;'>" . $area_result['Price_Area'] . " * " . $area_result['S_Ticket_Qty'] . "</div>";
                                    $total_price = $area_result['Total_Price'];
                                }
                                echo "<div class='order_total_price'><span style='font-size:15px;'>Total:</span>  <b>RM " . $total_price . "</b></div>";
                                echo "</div>";
                            echo "</div>";
                            $checking_query = mysqli_query($connect,"select * from rating where Ticket_Purchase_ID = '$purchaseID'");
                            if(mysqli_num_rows($checking_query))
                                echo "<a class='rate_view_btn' href='rating-concert.php?view=".$completed_ticket['Purchase_ID']."' style='margin-left: 10px;'>View Rating</a>";
                            else
                                echo "<a class='rate_view_btn' href='rating-concert.php?id=".$completed_ticket['Purchase_ID']."' style='margin-left: 10px;'>Write Review</a>";
                            echo "<a class='rate_view_btn' href='payment_out.php?id=".$completed_ticket['Purchase_ID']."'>Order Details</a>";
                        echo "</div>";
                    }
                }
                else
                {
                    echo "<img src='images/cart/no_order.jpg' style='display: block; margin: auto; width:60%;'>";
                    echo "<div style='text-align: center;'><h2>No Result Found</h2></div>";
                }
                echo "</div>";
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

<script>
    $('.concert_ticket').on('click', function(){
        $('.ticket-container').css('display', 'block');
        $('.merchandise-container').css('display', 'none');
    })

    $('.merchandise_tab').on('click', function(){
        $('.ticket-container').css('display', 'none');
        $('.merchandise-container').css('display', 'block');
    })

    $(".ticket-all").on('click', function(){
        $('.ticket-all').addClass("active");
        $('.ticket-paid').removeClass("active");
        $('.ticket-completed').removeClass("active");
        $('.all-ticket-list').css("display","block");
        $(".ongoing-ticket-list").css("display","none");
        $(".completed-ticket-list").css("display","none");
    })

    $(".ticket-paid").on('click', function(){
        $('.ticket-all').removeClass("active");
        $('.ticket-paid').addClass("active");
        $('.ticket-completed').removeClass("active");
        $('.all-ticket-list').css("display","none");
        $(".ongoing-ticket-list").css("display","block");
        $(".completed-ticket-list").css("display","none");
    })

    $(".ticket-completed").on('click', function(){
        $('.ticket-all').removeClass("active");
        $('.ticket-paid').removeClass("active");
        $('.ticket-completed').addClass("active");
        $('.all-ticket-list').css("display","none");
        $(".ongoing-ticket-list").css("display","none");
        $(".completed-ticket-list").css("display","block");
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