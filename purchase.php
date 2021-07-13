<?php
    session_start();
    include "dataconnection.php";
    $ticket_id = $_GET['id']; 
    $_SESSION['ticket'] = $ticket_id;

    if(!isset($_SESSION['email']))
    {
        header("location: login.php");
    }
    else
    {
        $email = $_SESSION['email'];
        if(isset($_SESSION['area_name']) || isset($_SESSION['ticket_qty']))
        {
            header("Refresh:0");
            unset($_SESSION['area_name']);
            unset($_SESSION['ticket_qty']);
            $area_name = $_SESSION['area_name'];
            $ticket_qty = $_SESSION['ticket_qty'];
        }
        else
        {
            $area_name = "";
            $ticket_qty = 0;
        }
        $email_query = "SELECT * FROM customer WHERE Cust_Email = '$email'";
        $email_search = mysqli_query($connect, $email_query);

        //to get details including seat map from database
        $concert_query = "SELECT * FROM venue, concert
        WHERE concert.Concert_ID = $ticket_id
        AND concert.Venue_ID = venue.Venue_ID";
        $concert_search = mysqli_query($connect, $concert_query);

        //to get the price of each area
        $ticket_query = "SELECT * FROM concert, ticket_price, venue
        WHERE ticket_price.Concert_ID = $ticket_id
        AND concert.Concert_ID = $ticket_id
        AND ticket_price.Venue_ID = venue.Venue_ID
        AND ticket_price.ticket_price_unable = 0";
        $ticket_search = mysqli_query($connect, $ticket_query);
    }
?>
<!DOCTYPE html>
<html>
<head>
<title>Purchase</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="head-foot3.css">
	<link rel="stylesheet" href="tnc_privacy.css">
	<link rel="stylesheet" href="product_result.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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

<div class="buy-container">
    <?php
    while($result=mysqli_fetch_assoc($concert_search))
    {
        echo "<div class='buy-detail'>";
        echo "<img src='" . str_replace("../", "", $result['Venue_Image']) . "' style='float: left;'>";
        echo "<p style='font-size: 28px;'>" . $result['Concert_Name'] . "</p>";
        echo "<i class='material-icons'>event</i><span>" . date_format(date_create($result['Concert_StartDate']), "d M Y, H:i") . " GMT+8</span>";
        echo "<br><i class='material-icons'>location_on</i><a href='" . $result['Venue_Location'] . "' style='text-decoration: none; color: black;' target='_blank'>" . $result['Venue_Name'] . "</a>";
        echo "<h5 style='font-weight: normal;'><i>*All the concert will be free seating within the area</i></h5>";
        echo "</div>";
        echo "<img src='" . str_replace("../", "", $result['Seat_Image']) . "'>";
    }
    ?>
    <div class="price_table" style='text-align: left;'>
    <?php
        if(mysqli_num_rows($ticket_search) != 0)
        {
        ?>
            <table style='text-align: center;'>
                <tr>
                    <th>Area</th>
                    <th>Price</th>
                    <th>Remaining</th>
                    <th>Quantity</th>
                </tr>
        <?php
            while($ticket_result=mysqli_fetch_assoc($ticket_search))
            {
                $ticketID = $ticket_result['Price_ID'];
                //to get current ticket amount
                $count_ticket_query = "SELECT (C.Seat_No - sum(B.S_Ticket_Qty)) AS 'ticket-left' FROM purchase A, s_ticket B, ticket_price C, concert D WHERE A.Purchase_ID = B.Purchase_ID 
                AND B.PriceID = C.Price_ID 
                AND D.Concert_ID = C.Concert_ID 
                AND A.Card_verify = 1 
                AND C.Price_ID = $ticketID";
                $count_ticket_run = mysqli_query($connect, $count_ticket_query);
                $count_ticket = mysqli_fetch_assoc($count_ticket_run);
                $current_left = $count_ticket['ticket-left'];

                echo "<tr>";
                    echo "<td id='area_name'>" . $ticket_result['Price_Area'] . "</td>";
                    echo "<td>RM " . $ticket_result['Price'] . "</td>";
                    if($current_left==null)
                    {
                        echo "<td>" . $ticket_result['Seat_No'] . " left</td>";
                        echo "<td>";
                            echo "<select class='ticket_qty' style='outline: none;'>";
                                echo "<option selected='selected'>0</option>";
                                echo "<option value='1'>1</option>";
                                echo "<option value='2'>2</option>";
                                echo "<option value='3'>3</option>";
                                echo "<option value='4'>4</option>";
                                echo "<option value='5'>5</option>";
                                echo "<option value='6'>6</option>";
                            echo "</select>";
                        echo "</td>"; 
                    }
                    else if($current_left==0)
                    {
                        echo "<td style='color:red;'>Sold Out</td>";
                        echo "<td>";
                            echo "<select class='ticket_qty' style='outline: none;' disabled>";
                                echo "<option selected='selected'>0</option>";
                            echo "</select>";
                        echo "</td>";  
                    }
                    else
                    {
                        echo "<td>" . $current_left . " left</td>";
                        echo "<td>";
                            echo "<select class='ticket_qty' style='outline: none;'>";
                                echo "<option selected='selected'>0</option>";
                                echo "<option value='1'>1</option>";
                                echo "<option value='2'>2</option>";
                                echo "<option value='3'>3</option>";
                                echo "<option value='4'>4</option>";
                                echo "<option value='5'>5</option>";
                                echo "<option value='6'>6</option>";
                            echo "</select>";
                        echo "</td>";  
                    }
                echo "</tr>";
            }
            ?>
            </table>
            </div>
        <button class="checkout">Check Out</button>
        <?php
        }
        else
        {
            echo "<div style='text-align: center; font-family: Poppins, sans-serif;'><h2>No Ticket Yet</h2></div>";
            echo "</div>";
        }  
        ?>
</div>

<script>
$(document).ready(function()
{
    $('.checkout').on('click', function(event)
    {
        event.preventDefault();
        //create array to store every areaname and quantity that user selected
        var area_name = new Array();
        var qty = new Array();

        $('.ticket_qty').each(function()
        {
            //only if the ticket quantity is not 0, push the value into array
            if($(this).val()>0)
            {
                //search for concert area name
                var findrow = $(this).closest("tr");
                var find_areaname = findrow.contents().filter("#area_name");
                
                //push value into array
                area_name.push($(find_areaname).text());
                qty.push($(this).val());

                // console.log("Area name: "+area_name);
                // console.log("Quantity: "+qty);

                // $.post("script_that_receives_value.php", {name: area_name, ticket_qty: qty});
            }
        });
        
        //if array does not exist, is not an array, or is empty
        if(!Array.isArray(qty) || !qty.length)
        {
            Swal.fire({
                title:'Oops...', 
                text:'Please select a ticket.', 
                icon:'error',
                didClose: () => window.scrollTo(0,0)});
        }
        else
        {
            $.ajax({
                type: "POST",
                url: "script_that_receives_value.php",
                dataType: 'json',
                data: {
                    "concert_ticket_btn": 1,
                    "name": area_name,
                    "ticket_qty": qty,
                },
                success: function(response)
                {
                    Swal.fire({
                        icon:'success',
                        title:'Your selected ticket is available!',
                        didClose: () => window.open("checkout.php", "_self")});//go to checkout page
                },
                error: function()
                {
                    Swal.fire({
                        title:'Oops...', 
                        text:'Please try again later', 
                        icon:'error',
                        didClose: () => window.scrollTo(0,0)});
                }
            });
        }
        
    });
});
</script>

<?php include "footer.php"; ?>