<?php
    session_start();
    include "dataconnection.php";

    if(!isset($_SESSION['email']))
    {
        header("location: login.php");
    }
    else if(isset($_GET['view']))
    {
        $purchase_id = $_GET['id'];
        $email = $_SESSION['email'];
        
        $purchase_query="select * from purchase A, customer B, s_merchandise C, merchandise D, purchase_address E where 
        A.Purchase_ID=C.Purchase_ID and A.Purchase_ID = E.Purchase_ID and A.Cust_ID = B.Cust_ID and C.Cust_ID = A.Cust_ID and 
        C.Merchandise_ID = D.Merchandise_ID and A.Card_verify=1 and A.Purchase_ID='$purchase_id' and B.Cust_Email='$email' group by C.S_Merchandise_ID";
        //search for all details
        // select C.Concert_Name, C.Concert_StartDate, G.Organizer_Name, F.Venue_Name, E.Price_Area, E.Price, D.S_Ticket_Qty 
        // from purchase A, concert C, s_ticket D, ticket_price E, venue F, organizer G 
        // where A.Purchase_ID = D.Purchase_ID 
        // and D.PriceID = E.Price_ID 
        // and C.Venue_ID = F.Venue_ID 
        // and C.Organizer_ID = G.Organizer_ID 
        // and A.Purchase_ID = 1 
        // group by E.Price_Area
        $purchase_search = mysqli_query($connect, $purchase_query);
        $purchase_info = mysqli_query($connect, $purchase_query);
        $run = mysqli_fetch_assoc($purchase_info);
        $info = array();
        $info = ["Purchase_ID"=>$run['Purchase_ID'],"Purchase_Date"=>$run['Purchase_Date'],"Cust_Name"=>($run['Cust_Lname'].' '.$run['Cust_Fname']),"Card_Number"=>$run['Card_Number'],"Purch_Address"=>$run['Purch_Address'],"Purch_State"=>$run['Purch_State'],"Purch_City"=>$run['Purch_City'],"Purch_Postcode"=>$run['Purch_Postcode']];
        function hideCardNum($card_no)
        {
            $hidden_card_no = '**** **** ****'.substr($card_no, 14);
            
            return $hidden_card_no;
        }

        //pass to pdf
        $_SESSION['purchase_info'] = $info;
        $merchandise_info= mysqli_query($connect, "SELECT D.Merchandise_Image, D.Merchandise_Name, D.Merchandise_ListPrice, C.S_Merchandise_Qty, D.Merchandise_Weight from purchase A, customer B, s_merchandise C, merchandise D, purchase_address E where A.Purchase_ID=C.Purchase_ID 
        and A.Purchase_ID = E.Purchase_ID 
        and A.Cust_ID = B.Cust_ID 
        and C.Cust_ID = A.Cust_ID 
        and C.Merchandise_ID = D.Merchandise_ID 
        and A.Card_verify=1 
        and A.Purchase_ID='$purchase_id' 
        and B.Cust_Email='$email' group by C.S_Merchandise_ID");
        $merchandise_array = array();
        while($merchandise_row = mysqli_fetch_assoc($merchandise_info))
        {
            $merchandise_array[] = $merchandise_row;
        }
        $_SESSION['merchandise_info'] = $merchandise_array;
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
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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

table{
    background-color: transparent;
    border-collapse: collapse;
    border: 1px solid #f2f2f2;
    margin-bottom: 50px;
    font-family: 'Quicksand', sans-serif;
    width: 100%;
}


table thead .table-title{
	border: 1px solid #f2f2f2;
}

table thead .table-title th{
	padding: 5px;
}

table thead td{
	font-size: 20px;
	padding: 10px;
    border: 1px solid #f2f2f2;
    text-align: left;
}

table tbody .item-image{
	height: auto;
    vertical-align: middle;
	width: 25%;
	margin: 10px 0;
	margin-right: 15px;
}

table tbody tr td{
	border-bottom: 1px solid #f2f2f2;
	font-weight: 600;
}

table tbody td{
	text-align: center;
}

table tbody .merch-row{
	text-align: left;
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
		<a href="merchandise.php" >Merchandise</a>
		<a href="singer.php">Singer</a>
	</div>
  </div>
</div>

<div class='checkout-container'>
    <?php 
        $card_no = $info['Card_Number'];
        echo "<img src='images/header_footer/logo.png'>";
        echo "<h1>Payment Receipt #" . $info['Purchase_ID'] . "</h1>";
        echo "<p><i>Placed on " . date_format(date_create($info['Purchase_Date']), "d M Y, H:i:s") . "</i></p><br>";
        echo "<p><i>Delivery To:</i></p>";
        echo "<p><i>".$info['Purch_Address']."</i></p>";
        echo "<p><i>".$info['Purch_Postcode'].", ".$info['Purch_City']."</i></p>";
        echo "<p><i>".$info['Purch_State']."</i></p>";
        echo '<table width=100%>';
        echo '<thead><tr>';
        echo '<tr class="table-title">';
        echo '<th width=25%>Product</td>';
        echo '<th width=25%>Price</th>';
        echo '<th width=25%>Quantity</th>';
        echo '<th width=25%>Subtotal</th>';
        echo '</tr>';
        echo '</thead><tbody>';
        $total_weight = 0;
        $sub_total=0;
        $pay =0;
        $shipping =0;
        while($purchase_result = mysqli_fetch_assoc($purchase_search))
        {
            echo "<tr>";
                echo "<td style='text-align: left;'><img class='item-image' style='float:left' src='" .str_replace("../", "",$purchase_result['Merchandise_Image'])."'><p>".$purchase_result['Merchandise_Name'] . "</p></td>";
                echo "<td>RM ". number_format($purchase_result['Merchandise_ListPrice'],2,'.','') . "</td>";
                echo "<td>" . $purchase_result['S_Merchandise_Qty'] . "</td>";
                echo "<td>RM " . number_format($purchase_result['Merchandise_ListPrice']*$purchase_result['S_Merchandise_Qty'],2,'.','') . "</td>";
            echo "</tr>";
            $sub_total += number_format($purchase_result['Merchandise_ListPrice']*$purchase_result['S_Merchandise_Qty'],2,'.','');
            $total_weight += number_format($purchase_result['Merchandise_Weight']*$purchase_result['S_Merchandise_Qty'],2,'.','');
        }
        $shipping += 4.66;
        if($total_weight>3)
        {
            $i=0;
            while(($total_weight-3) > $i)
            {
                $i++;
                $shipping += 0.85;
            }
        }

        $pay = $sub_total + $shipping;
        echo '<tr>';
        echo '<td colspan=3 style="border:none; text-align:right">Shipping:</td>';
        echo '<td style="border:none; padding:10px 0;">RM '.number_format($shipping,2,'.','').'</td>';
        echo '</tr><tr>';
        echo '<td colspan=3 style=" text-align:right">Total:</td><input type="text" name="total_price" value="'.$pay.'" hidden>';
        echo '<td style="font-weight:700; text-decoration:underline">RM '.number_format($pay,2,'.','').'</td>';
        echo '</tbody></table>';
        echo "<p><i>Payment made by: " . $info['Cust_Name']. "</i></p>";
        echo "<p><i>Payment made through: " . hideCardNum($card_no) . "</i></p>";
        ?>
        <p style='font-size: 12px; margin: 40px 0 20px;'>**All receipt can be viewed at profile page as well.</p>
        <a class='action_button' href='merch_receiptpdf.php' target="_blank"><i class='material-icons'>picture_as_pdf</i>Print receipt</a>
        <a class='action_button' href='index.php'><i class='material-icons'>home</i>Home</a>
        <?php
    ?>
</div>

<?php include "footer.php"; ?>