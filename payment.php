<?php
session_start();
include "dataconnection.php";

/**
 * CONCERT TICKET CHECKOUT STARTS
 */

if(isset($_POST['form_submitbtn']))
{
    $email = $_SESSION['email'];
    //get user id
    $cust_query = "SELECT Cust_ID FROM customer WHERE Cust_Email = '$email'";
    $cust_search = mysqli_query($connect, $cust_query);
    $cust_id = mysqli_fetch_assoc($cust_search);
    $id = $cust_id['Cust_ID'];
    $_SESSION['custID'] = $id;
    
    $card_holder_name = $_POST['card_holder_name'];
    $exp_month = $_POST['exp_month']; 
    $exp_year = $_POST['exp_year'];
    $card_num = $_POST['card_num'];
    $cvv = $_POST['cvv'];
    // $ticket_qty = $_SESSION['ticket_qty'];
    $total_price = $_SESSION['total'];
    // $area_id = $_SESSION['areaid'];

    date_default_timezone_set('Asia/Kuala_Lumpur');
    $current_date = date('Y-m-d H:i:s', time());

    $card_holder_name = mysqli_real_escape_string($connect, $card_holder_name);
    $otp = rand(100000, 999999);
    $_SESSION['otp_verify'] = $otp;

    //insert into purchase table
    $payment_query = "INSERT INTO purchase 
    (Total_Price, Purchase_Date, Card_Number, Card_Owner_Name, Card_Exp_Month, Card_Exp_Year, Card_CVV, Card_OTP, Cust_ID)
    VALUES
    ($total_price, '$current_date', '$card_num', '$card_holder_name', $exp_month, $exp_year, $cvv, $otp, $id)";
    $payment_insert = mysqli_query($connect, $payment_query);
    //to get latest purchase id inserted just now
    $purchase_id = mysqli_insert_id($connect);
    $_SESSION['purchaseID'] = $purchase_id;

    //update s_ticket table
    $s_ticket_ID = $_SESSION['s_ticket_id'];
    $s_ticket_count = count($s_ticket_ID);
    for($i=0; $i<$s_ticket_count; $i++)
    {
        $s_ticket_insert = mysqli_query($connect, "UPDATE s_ticket SET Purchase_ID = $purchase_id WHERE S_Ticket_ID = $s_ticket_ID[$i]");
    }

    if($payment_insert)
    {
        $to = $email;
        $subject = "Concerta:: Payment OTP";
        $message = "<h2>Verify your purchase</h2><p>Your One-Time-Password:</p><h3>$otp</h3>";
        $headers = "From: concerta.my@gmail.com \r\n";
        $headers .= "MIME-Version: 1.0"."\r\n";
        $headers .= "Content-type:text/html;charset=UTP-8"."\r\n";

        mail($to,$subject,$message,$headers);
        
        $returnArr = [$otp,$purchase_id,"Success"];
        echo json_encode($returnArr);
    }
    else
    {
        $returnArr = [$otp,"fail"];
        echo json_encode($returnArr);
    }
}

/**
 * CONCERT TICKET CHECKOUT ENDS
 * 
 * MERCHANDISE CHECKOUT STARTS
 */

if(isset($_POST['merch_form_submitbtn']))
{
    $email = $_SESSION['email'];
    //get user id
    $cust_query = "SELECT Cust_ID FROM customer WHERE Cust_Email = '$email'";
    $cust_search = mysqli_query($connect, $cust_query);
    $cust_id = mysqli_fetch_assoc($cust_search);
    $id = $cust_id['Cust_ID'];
    $_SESSION['custID'] = $id;
    
    $card_holder_name = $_POST['card_holder_name'];
    $exp_month = $_POST['exp_month']; 
    $exp_year = $_POST['exp_year'];
    $card_num = $_POST['card_num'];
    $cvv = $_POST['cvv'];

    $address = $_POST['full-address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postcode = $_POST['postcode'];
    $total_price = $_POST['total_price'];

    date_default_timezone_set('Asia/Kuala_Lumpur');
    $current_date = date('Y-m-d H:i:s', time());
    $_SESSION['time'] = $current_date;

    $card_holder_name = mysqli_real_escape_string($connect, $card_holder_name);
    $otp = rand(100000, 999999);
    $_SESSION['otp_verify'] = $otp;

    //insert into purchase table
    $payment_query = "INSERT INTO purchase 
    (Total_Price, Purchase_Date, Card_Number, Card_Owner_Name, Card_Exp_Month, Card_Exp_Year, Card_CVV, Card_OTP, Cust_ID)
    VALUES
    ($total_price, '$current_date', '$card_num', '$card_holder_name', $exp_month, $exp_year, $cvv, $otp, $id)";
    $payment_insert = mysqli_query($connect, $payment_query);
    $purchase_id = mysqli_insert_id($connect);
    //update purchase id to merchandise cart
    for($i=0; $i<count($_POST['item_id']); $i++)
    {
        $smerchid = $_POST['item_id'][$i];
        $query = "UPDATE s_merchandise SET Purchase_ID= '$purchase_id' WHERE S_Merchandise_ID = '$smerchid'";
        $s_merchandise_query = mysqli_query($connect,$query);
        $query2 = "select * from merchandise A, s_merchandise B where A.Merchandise_ID = B.Merchandise_ID and S_Merchandise_ID = '$smerchid'";
        $query2_run = mysqli_query($connect,$query2);
        $run = mysqli_fetch_assoc($query2_run);
        $s_merch_qty = $run['S_Merchandise_Qty'];
        $merch_id = $run['Merchandise_ID'];
        // $modify = mysqli_query($connect,"update merchandise set Merchandise_Stock = (Merchandise_Stock-'$s_merch_qty') where Merchandise_ID = '$merch_id'");
    }

    //add purchase address
    $query_address = "insert into purchase_address(Purch_Address, Purch_State, Purch_City, Purch_Postcode, Purchase_ID) VALUES ('$address','$state','$city','$postcode','$purchase_id')";
    $query_address_run = mysqli_query($connect,$query_address);

    if($payment_insert)
    {
        $to = $email;
        $subject = "Concerta:: Payment OTP";
        $message = "<h2>Verify your purchase</h2><p>Your One-Time-Password:</p><h3>$otp</h3>";
        $headers = "From: concerta.my@gmail.com \r\n";
        $headers .= "MIME-Version: 1.0"."\r\n";
        $headers .= "Content-type:text/html;charset=UTP-8"."\r\n";

        mail($to,$subject,$message,$headers);
        
        $returnArr = [$otp,"Success",$purchase_id];
        echo json_encode($returnArr);
    }
    else
    {
        $returnArr = [$otp,"fail",$purchase_id];
        echo json_encode($returnArr);
    }
}

/**
 * MERCHANDISE CHECKOUT ENDS
 */
?>