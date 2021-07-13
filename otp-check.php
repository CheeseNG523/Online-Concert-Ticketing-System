<?php
session_start();
include "dataconnection.php";

if(isset($_POST['otp_btn']))
{
    $cust_id = $_SESSION['custID'];
    $purchase_id = $_SESSION['purchaseID'];

    $otp_verify_query = "UPDATE purchase SET Card_verify=1 WHERE Purchase_ID = $purchase_id";
    $otp_verify = mysqli_query($connect, $otp_verify_query);

    echo json_encode($otp_verify);
}

if(isset($_POST['otp_btn_merch']))
{
    $cust_id = $_SESSION['custID'];
    $entered_otp = $_POST['otp_num'];
    $sent_otp = $_SESSION['otp_verify'];
    $payment_id = $_POST['payment_id'];

    if($entered_otp==$sent_otp)
    {
        $otp_verify_query = "UPDATE purchase SET Card_verify=1, Purchase_Status = 1 WHERE Card_OTP=$sent_otp and Purchase_ID = '$payment_id'";
        $otp_verify = mysqli_query($connect, $otp_verify_query);

        $deduct_qty = mysqli_query($connect,"select C.Merchandise_ID, B.S_Merchandise_Qty from purchase A, s_merchandise B, merchandise C where 
        A.Purchase_ID = B.Purchase_ID and B.Merchandise_ID = C.Merchandise_ID and A.Purchase_ID = '$payment_id' and A.Card_verify = 1");
        while($run = mysqli_fetch_assoc($deduct_qty))
        {
            $id = $run['Merchandise_ID'];
            $qty = $run['S_Merchandise_Qty'];

            mysqli_query($connect,"update merchandise set Merchandise_Stock = (Merchandise_Stock-'$qty') where Merchandise_ID = '$id'");
        }

        echo json_encode($otp_verify);
    }
    else
    {
        echo json_encode(false);
    }
}

if(isset($_POST['savedefault']))
{
    $address = $_POST['full-address'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $postcode = $_POST['postcode'];
    $email = $_SESSION['email'];

    $query = mysqli_query($connect,"update customer set Cust_Address = '$address', Cust_State = '$state', Cust_City = '$city', Cust_Postcode = '$postcode' where Cust_Email = '$email'");
    echo json_encode($query);
}
?>