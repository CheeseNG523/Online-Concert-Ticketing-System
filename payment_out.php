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
        $purchase_id = $_GET['id'];

        //search for purchase details
        $purchase_query = "SELECT * FROM purchase, s_ticket, ticket_price, concert, customer 
        WHERE purchase.Purchase_ID = $purchase_id 
        AND s_ticket.Purchase_ID = $purchase_id
        AND ticket_price.Price_ID = s_ticket.PriceID
        AND concert.Concert_ID = ticket_price.Concert_ID
        AND customer.Cust_ID = purchase.Cust_ID
        AND purchase.Card_verify = 1";
        $purchase_search = mysqli_query($connect, $purchase_query);

        //get ticket details
        $s_ticket_count = mysqli_num_rows($purchase_search);
        $area_id = array();
        $area_price = array();
        $area_name = array();
        $ticket_qty = array();
        $i = 0;

        $s_ticket_run = mysqli_query($connect, $purchase_query);
        while($s_ticket_result = mysqli_fetch_assoc($s_ticket_run))
        {
            $area_id[$i] = $s_ticket_result['PriceID'];
            $ticket_qty[$i] = $s_ticket_result['S_Ticket_Qty'];
            $area_name[$i] = $s_ticket_result['Price_Area'];
            $area_price[$i] = $s_ticket_result['Price'];
            $i++;
        }
        // select C.Concert_Name, C.Concert_StartDate, G.Organizer_Name, F.Venue_Name, E.Price_Area, E.Price, D.S_Ticket_Qty 
        // from purchase A, concert C, s_ticket D, ticket_price E, venue F, organizer G 
        // where A.Purchase_ID = D.Purchase_ID 
        // and D.PriceID = E.Price_ID 
        // and C.Venue_ID = F.Venue_ID 
        // and C.Organizer_ID = G.Organizer_ID 
        // and A.Purchase_ID = 1 
        // group by E.Price_Area

        function hideCardNum($card_no)
        {
            $hidden_card_no = '**** **** ****'.substr($card_no, 14);
            
            return $hidden_card_no;
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
<title>Receipt</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="head-foot3.css">
	<link rel="stylesheet" href="tnc_privacy.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<style>
.checkout-container {
    display: block;
    margin: 20px 160px;
	padding: 20px 20px;
	border: 1px solid black;
	min-height: 375px;
	overflow: hidden;
}

.checkout-container img {
    width: 300px;
    height: 100px;
}

.checkout-container i {
    color: rgb(115, 115, 115);
}

.ticket_details {
    width: 100%;
    border-collapse: collapse;
    text-align: center;
    margin-top: 50px;
    margin-bottom: 40px;
}

.ticket_details th, td {
    border: 1px solid #cccccc;
    padding: 10px;
}

.ticket_details td {
    background-color: rgb(230, 247, 255);
}

.ticket_details th {
    background-color: #3f89e7;
    color: white;
}

.action_button {
    display: inline-block; 
    padding: 5px 10px; 
    background: #3f89e7; 
    text-decoration: none; 
    color: white; 
    border-radius: 8px; 
    width: fit-content;
    margin-right: 10px;
    cursor: pointer;
}

.action_button:hover {
    background: rgb(190,190,255);
    transition-duration: 0.4s;
}

.action_button i {
    color: white; 
    vertical-align: middle; 
    margin-right: 5px;
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

<div class='checkout-container'>
    <?php 
        $purchase_result = mysqli_fetch_assoc($purchase_search);
        $card_no = $purchase_result['Card_Number'];
        echo "<img src='images/header_footer/logo.png'>";
        echo "<h1>Payment Receipt #" . $purchase_result['Purchase_ID'] . "</h1>";
        echo "<p><i>Placed on " . date_format(date_create($purchase_result['Purchase_Date']), "d M Y, H:i:s") . "</i></p>";
        ?>
        <table class='ticket_details'>
            <tr>
                <th>Concert Name</th>
                <th>Area</th>
                <th>Quantity</th>
                <th>Price per ticket (RM)</th>
                <th>Amount (RM)</th>
            </tr>
        <?php
            echo "<tr>";
                echo "<td rowspan='$s_ticket_count' style='text-align: left;'>" . $purchase_result['Concert_Name'] . "</td>";
                echo "<td>" . $area_name[0] . "</td>";
                echo "<td>" . $ticket_qty[0] . "</td>";
                echo "<td>" . number_format($area_price[0], 2) . "</td>";
                echo "<td>" . number_format(($ticket_qty[0] * $area_price[0]), 2)  . "</td>";
            echo "</tr>";
            if($s_ticket_count>1)
            {
                for($j=1; $j<$s_ticket_count; $j++)
                {
                    echo "<tr>";
                    echo "<td>" . $area_name[$j] . "</td>";
                    echo "<td>" . $ticket_qty[$j] . "</td>";
                    echo "<td>" . number_format($area_price[$j], 2) . "</td>";
                    echo "<td>" . number_format(($ticket_qty[$j] * $area_price[$j]), 2)  . "</td>";
                    echo "</tr>";
                }
            }

            echo "<tr>";
                echo "<td colspan='3' style='background-color: #3f89e7; border-right:1px solid #3f89e7;'></td>";
                echo "<th>Total</th>";
                echo "<td>" . $purchase_result['Total_Price'] . "</td>";
            echo "</tr>";
        echo "</table>";
        echo "<p><i>Payment made by: " . $purchase_result['Cust_Lname'] . " " . $purchase_result['Cust_Fname'] . "</i></p>";
        echo "<p><i>Payment made through: " . hideCardNum($card_no) . "</i></p>";
        ?>
        <p style='font-size: 12px; margin: 40px 0 20px;'>**All receipt can be viewed at profile page as well.</p>
        <a class='action_button' href='receiptpdf.php' target="_blank"><i class='material-icons'>picture_as_pdf</i>Print receipt</a>
        <a class='action_button' href='ticketpdf.php' target="_blank"><i class='material-icons'>picture_as_pdf</i>Print ticket</a>
        <a class='action_button' href='index.php'><i class='material-icons'>home</i>Home</a>
        <?php
        //pass to pdf
        $_SESSION['email'] = $email;
        $_SESSION['cardno'] = $card_no;
        $_SESSION['Purchase_ID'] = $purchase_result['Purchase_ID'];
        $_SESSION['time'] = $purchase_result['Purchase_Date'];
        $_SESSION['concert'] = $purchase_result['Concert_Name'];
        $_SESSION['areaname'] = $area_name;
        $_SESSION['areaprice'] = $area_price;
        $_SESSION['qty'] = $ticket_qty;
        $_SESSION['fname'] = $purchase_result['Cust_Fname'];
        $_SESSION['lname'] = $purchase_result['Cust_Lname']; 
    ?>
</div>

<?php include "footer.php"; ?>