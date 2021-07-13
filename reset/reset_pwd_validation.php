<?php
include '../dataconnection.php';
session_start();
if(isset($_POST['new_password_submit_btn_blur']))
{
    $password_valid = $_POST["password_valid"];
    if($password_valid === "" || $password_valid == null)
    {
        $message = "*Please fill in this field";
        $error_code = 1;
        $returnArr = [$message,$error_code];    
        echo json_encode($returnArr);
    }
    else
    {
        $message = "";
        $error_code = 0;
        $returnArr = [$message,$error_code];    
        echo json_encode($returnArr);
    }
}

if(isset($_POST['new_password_submit_btn_keyup']))
{
    $keypassword_valid = $_POST["keypassword_valid"];
    $validation = 3;
    $a = $b = $c = $d = $e = $f = 3;
   
    if(preg_match('#[0-9]#', $keypassword_valid) === 1)
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

    if(preg_match("/[A-Z]/", $keypassword_valid) === 1)
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

    if(preg_match("/[a-z]/", $keypassword_valid) === 1)
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

    if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $keypassword_valid) === 1)
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

    if(strlen($keypassword_valid) >= 12 && strlen($keypassword_valid) <= 20)
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

    if($keypassword_valid === "" || $keypassword_valid == null)
    {
        $isnull = 1;
    }
    else
    {
        $isnull = 0;
    }

    if($a == 0 || $b == 0 || $c == 0 || $d == 0 || $e == 0)
        $validation = 0;
    else
        $validation = 1;
    
    //create an object to store all value
    $returnArr = [$length_valid,$number_valid,$capital_valid,$letter_valid,$special_valid,$validation,$length_icon,$number_icon,$capital_icon,$letter_icon,$special_icon,$isnull];    
    echo json_encode($returnArr);
}

/* confirm pass*/
if(isset($_POST['new_cpassword_submit_btn']))
{
    $password_valid = $_POST["password_valid"];
    $cpassword_valid = $_POST["cpassword_valid"];
    if($cpassword_valid === "" || $cpassword_valid == null)
    {
        $message = "*Please fill in this field";
        $error_code = 1;
        //create an object to store all value
        $returnArr = [$message,$error_code];    
        echo json_encode($returnArr);
    }
    else
    {
        if($cpassword_valid === $password_valid)
        {
            $message = "";
            $error_code = 0;
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
        else
        {
            $message = "*Password does not match";
            $error_code = 1;
            //create an object to store all value
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
    }
}

/* alert message and update password */
if(isset($_POST['change_password_submit_btn']))
{
    $new_password = $_POST['new_pwd'];
    $cfm_password = $_POST['cfm_pwd'];
    // $new_password_validation = $_POST['new_password_error_blur'];
    $new_pw = md5($new_password);
    $email = $_SESSION['cust_mail'];
    $execute = mysqli_query($connect, "select * from customer where Cust_Email = '$email'");

    //to get old password
    $old_pass_query = mysqli_query($connect, "select * from customer where Cust_Email = '$email'");
    $old_pass_run = mysqli_fetch_assoc($old_pass_query);
    $old_pass = $old_pass_run['Cust_Password'];

    if(mysqli_num_rows($execute) == 1)
    { 
        // if($new_password_validation == 0)
        // {
            if(strcmp($new_pw,$old_pass)==0)
            {
                $error_code = 1;
                $display = 0;
                $returnArr = [$display,$error_code];    
                echo json_encode($returnArr);
            }
            else
            {
                $change_pass = "update customer set Cust_Password = '$new_pw', Reset_Vkey = NULL where Cust_Email = '$email'";
                mysqli_query($connect,$change_pass);
                
                $error_code = 0;
                $display = 1;
                $returnArr = [$display,$error_code];  
                echo json_encode($returnArr);
            }
        // }
        // else
        // {
        //     $error_code = 1;
        //     $display = 0;
        //     $message = "";
        //     $returnArr = [$message,$display,$error_code];    
        //     echo json_encode($returnArr);
        // }
    }
    else
    {
        $error_code = 1;
        $display = 1;
        $message = "The password you enter is incorrect.";
        $returnArr = ['fail'];    
        echo json_encode($returnArr);
    }
}
?>