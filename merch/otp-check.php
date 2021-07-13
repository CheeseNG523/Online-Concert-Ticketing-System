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

    if($entered_otp==$sent_otp)
    {
        $otp_verify_query = "UPDATE purchase SET Card_verify=1, Purchase_Status = 1 WHERE Card_OTP=$sent_otp";
        $otp_verify = mysqli_query($connect, $otp_verify_query);

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