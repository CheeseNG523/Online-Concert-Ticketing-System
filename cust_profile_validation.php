<?php
session_start();
include "dataconnection.php";

/**
 * CHECKOUT OTP STARTS
 */

// if(isset($_POST['otp_btn']))
// {
//     $cust_id = $_SESSION['custID'];
//     $entered_otp = $_POST['otp_num'];
//     $sent_otp = $_SESSION['otp_verify'];

//     if($entered_otp==$sent_otp)
//     {
//         $otp_verify_query = "UPDATE purchase SET Card_verify=1 WHERE Card_OTP=$entered_otp";
//         $otp_verify = mysqli_query($connect, $otp_verify_query);

//         echo json_encode($otp_verify);
//     }
//     else
//     {
//         echo json_encode(false);
//     }
// }

/**
 * CHECKOUT OTP ENDS
 * 
 * SAVING ADDRESS STARTS
 */

// if(isset($_POST['savedefault']))
// {
//     $address = $_POST['full-address'];
//     $state = $_POST['state'];
//     $city = $_POST['city'];
//     $postcode = $_POST['postcode'];
//     $email = $_POST['cust_email'];

//     $query = mysqli_query($connect,"UPDATE customer SET Cust_Address = '$address', Cust_State = '$state', Cust_City = '$city', Cust_Postcode = '$postcode' WHERE Cust_Email = '$email'");
    
//     echo json_encode($query);
// }

/**
 * SAVING ADDRESS ENDS
 * 
 * CHANGE USER PROFILE PICTURE STARTS
 */

if(isset($_FILES['file']['name']))
{
    //Get file name
    $filename = $_FILES['file']['name'];

    $test = explode(".",$_FILES['file']['name']);
    $extension = end($test);
    $name = rand(100,999).'.'.$extension;
    $savelocation = 'images/customer/'.pathinfo($filename,PATHINFO_FILENAME).'_'.$name;
    $location = '../images/customer/'.pathinfo($filename,PATHINFO_FILENAME).'_'.$name;

    $img_extensions = strtolower(pathinfo($savelocation,PATHINFO_EXTENSION));

    $extensions_arr = array("jpg","jpeg","png","gif");

    $cust_email =  $_SESSION['email'];

    $current_img_path = mysqli_query($connect,"select * from customer where Cust_Email = '$cust_email' and Cust_Image is not null");
    $row = mysqli_fetch_assoc($current_img_path);
    if(mysqli_num_rows($current_img_path)>0)
    {
        $current_img = $row['Cust_Image'];
    }

    if(in_array($img_extensions,$extensions_arr))
    {
        if(move_uploaded_file($_FILES['file']["tmp_name"],$savelocation))
        {
            if(mysqli_num_rows($current_img_path)>0)
            {
                if(file_exists(str_replace("../", "", $current_img)))
                    unlink(str_replace("../", "", $current_img));
            }

            $run = mysqli_query($connect,"update customer set Cust_Image = '$location' where Cust_Email = '$cust_email'"); 

            echo json_encode($run);
        }
        else
        { 
            echo json_encode(false);
        }
    }
    else
    {
        echo json_encode(false);
    }
}

/**
 * CHANGE USER PROFILE PICTURE ENDS
 * 
 * UPDATE USER INFO STARTS
 */

if(isset($_POST['profile_btn']))
{
    $email = $_SESSION['email'];
    $C_FName = $_POST['C_fname'];
    $C_LName = $_POST['C_lname'];
    $C_Gender = $_POST['C_gender'];
    $C_PhoneNum = $_POST['C_phone_num'];
    $C_Address = $_POST['C_address'];
    $C_Postcode = $_POST['C_postcode'];
    $C_State = $_POST['C_state'];
    $C_City = $_POST['C_city'];

    $update_query = "UPDATE customer SET Cust_Fname = '$C_FName', Cust_Lname = '$C_LName', 
    Cust_Gender = '$C_Gender', Cust_Cont_Num = '$C_PhoneNum', Cust_Address = '$C_Address', 
    Cust_Postcode = $C_Postcode, Cust_State = '$C_State', Cust_City = '$C_City' WHERE Cust_Email = '$email'";
    $update = mysqli_query($connect, $update_query);

    echo json_encode($update);
}

/**
 * UPDATE USER INFO ENDS
 * 
 * CHANGE PASSWORD VALIDATION STARTS
 */

if(isset($_POST['new_pass_keyup']))
{
    $cust_new_pass = $_POST["c_new_pass"];
    $validation = 3;
    $a = $b = $c = $d = $e = $f = 3;
   
    if(preg_match('#[0-9]#', $cust_new_pass) === 1)
    {
        $number_valid = "rgb(0, 204, 0)";
        $a = 1;
        $number_icon = 1;
    }
    else
    {
        $number_valid = "rgba(255, 0, 0, 0.8)";
        $a = 0;
        $number_icon = 0;
    }

    if(preg_match("/[A-Z]/", $cust_new_pass) === 1)
    {
          $capital_valid = "rgb(0, 204, 0)";
          $b = 1;
          $capital_icon = 1;
    }
    else
    {
        $capital_valid = "rgba(255, 0, 0, 0.8)";
        $b = 0;
        $capital_icon = 0;
    }

    if(preg_match("/[a-z]/", $cust_new_pass) === 1)
    {
        $letter_valid = "rgb(0, 204, 0)";
        $c = 1;
        $letter_icon = 1;
    }
    else
    {
        $letter_valid = "rgba(255, 0, 0, 0.8)";
        $c = 0;
        $letter_icon = 0;
    }

    if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $cust_new_pass) === 1)
    {
        $special_valid = "rgb(0, 204, 0)";
        $d = 1;
        $special_icon = 1;
    }
    else
    {
        $special_valid = "rgba(255, 0, 0, 0.8)";
        $d = 0;
        $special_icon = 0;
    }

    if(strlen($cust_new_pass) >= 12 && strlen($cust_new_pass) <= 20)
    {
        $length_valid = "rgb(0, 204, 0)";
        $e = 1;
        $length_icon = 1;
    }   
    else
    {
        $length_valid = "rgba(255, 0, 0, 0.8)";
        $e = 0;
        $length_icon = 0;
    }

    if($cust_new_pass === "" || $cust_new_pass == null)
    {
        $isnull = 1;
    }
    else
    {
        $isnull = 0;
    }

    if($a == 1 && $b == 1 && $c == 1 && $d == 1 && $e == 1)
    {
        $validation = 0;
    }
    else 
    {
        $validation = 1;
    }
    
    //create an object to store all value
    $returnArr = [$length_valid, $number_valid, $capital_valid, $letter_valid, $special_valid, $validation, $length_icon, $number_icon, $capital_icon, $letter_icon, $special_icon, $isnull];    
    
    echo json_encode($returnArr);
}

/**
 * CHANGE PASSWORD VALIDATION ENDS
 * 
 * NEW PASSWORD UPDATE CHECK STARTS
 */

if(isset($_POST['update_new_pass']))
{
    $email = $_SESSION['email'];
    $C_new_password = $_POST['cust_new_pass'];
    $C_current_password = $_POST['cust_old_pass'];
    $encrypt_new_password = md5($C_new_password);
    $encrypt_old_password = md5($C_current_password);

    $check_query = "SELECT * FROM customer WHERE Cust_Email = '$email'";
    $check_run = mysqli_query($connect, $check_query);
    $check_fetch = mysqli_fetch_assoc($check_run);
    $cust_old_pass = $check_fetch['Cust_Password'];
    $proceed_change_pass = 1;

    //check if current password is correct
    if($cust_old_pass != $encrypt_old_password)
    {
        $proceed_change_pass = 1;
    }
    else
    {
        $update_password_query = "UPDATE customer SET Cust_Password = '$encrypt_new_password' WHERE Cust_Email = '$email'";
        $password = mysqli_query($connect, $update_password_query);
        $proceed_change_pass = 0;
    }

    echo json_encode($proceed_change_pass);
}

/**
 * NEW PASSWORD UPDATE CHECK ENDS
 */

?>