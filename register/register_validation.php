<?php
include '../dataconnection.php';
session_start();

if(isset($_POST['fname_submit_btn']))
{
    $fname_valid = $_POST["fname_valid"];
    if($fname_valid == null || $fname_valid === "")
    {
        $message = "*Please fill in this field";
        $error_code = 1;
        //create an object to store all value
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

if(isset($_POST['lname_submit_btn']))
{
    $lname_valid = $_POST["lname_valid"];
    if($lname_valid == null || $lname_valid === "")
    {
        $message = "*Please fill in this field";
        $error_code = 1;
        //create an object to store all value
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

if(isset($_POST['email_submit_btn']))
{
    $email = $_POST['emaill_id'];
    $email_query = "select * from customer where cust_email = '$email'";
    //run sql code
    $email_query_run = mysqli_query($connect,$email_query);
        if($email == null || $email === "")
        {
            $message = "*Please fill in this field";
            $error_code = 1;
            //create an object to store all value
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
        else
        {
            if(strpos($email, "@") === false)
            {
                $message = "*Please include an '@' in the email address";
                $error_code = 1;
                $returnArr = [$message,$error_code];    
                echo json_encode($returnArr);
            }
            else
            {
                if(strncasecmp($email, "@",1) == 0)
                {
                    $message ="*Invalid email address";
                    $error_code = 1;
                    $returnArr = [$message,$error_code];    
                    echo json_encode($returnArr);
                }
                else
                {
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                    {
                        $message ="*Invalid email address";
                        $error_code = 1;
                        $returnArr = [$message,$error_code];    
                        echo json_encode($returnArr);
                    }
                    else
                    {
                        if(mysqli_num_rows($email_query_run)>0)
                        {
                            $message = "*Email Already Exists. Please try another";
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
                }
                
            }
            
        }
        
}

if(isset($_POST['password_submit_btn_blur']))
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

if(isset($_POST['password_submit_btn_keyup']))
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
    
if(isset($_POST['cpassword_submit_btn']))
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

if(isset($_POST['phone_submit_btn']))
{
    $phone_valid = $_POST["phone_valid"];
    if($phone_valid === "" || $phone_valid == null)
    {
        $message = "*Please fill in this field";
        $error_code = 1;
        //create an object to store all value
        $returnArr = [$message,$error_code];    
        echo json_encode($returnArr);
    }
    else
    {
        if(strncasecmp($phone_valid, "+60",1)==0 || $phone_valid > 13)
        {
            $message = "*Invalid format. E.g.:012 345 6789";
            $error_code = 1;
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
        else
        {
            $message = "";
            $error_code = 0;
            //create an object to store all value
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
    }
}

if(isset($_POST['gender_submit_btn']))
{
    $gender_valid = $_POST["gender_valid"];
    if($gender_valid == null || $gender_valid === "")
    {
        $message = "*Please fill in this field";
        $error_code = 1;
        //create an object to store all value
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

if(isset($_POST['address_submit_btn']))
{
    $address_valid = $_POST["address_valid"];
    if($address_valid == null || $address_valid === "")
    {
        $message = "*Please fill in this field";
        $error_code = 1;
        //create an object to store all value
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

if(isset($_POST['state_submit_btn']))
{
    $state_valid = $_POST["state_valid"];
    if($state_valid == null || $state_valid === "")
    {
        $message = "*Please fill in this field";
        $error_code = 1;
        //create an object to store all value
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

if(isset($_POST['city_submit_btn']))
{
    $city_valid = $_POST["city_valid"];
    
    if($city_valid == null || $city_valid === "")
    {
        $message = "*Please fill in this field";
        $error_code = 1;
        //create an object to store all value
        $returnArr = [$message,$error_code];    
        echo json_encode($returnArr);
    }
    else
    {
        if(preg_match('#[0-9]#', $city_valid) === 1)
        {
            $message = "*Should not include number";
            $error_code = 1;
            //create an object to store all value
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
}

if(isset($_POST['postcode_submit_btn']))
{
    $postcode_valid = $_POST["postcode_valid"];
    if($postcode_valid === "" || $postcode_valid == null)
    {
        $message = "*Please fill in this field";
        $error_code = 1;
        //create an object to store all value
        $returnArr = [$message,$error_code];    
        echo json_encode($returnArr);
    }
    else
    {
        if(!is_numeric($postcode_valid))
        {
            $message = "*Invalid format. E.g.: 99999";
            $error_code = 1;
            //create an object to store all value
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
        else
        {
            if(strlen($postcode_valid) != 5)
            {
                $message = "*Invalid format. E.g.: 99999";
                $error_code = 1;
                $returnArr = [$message,$error_code];    
                echo json_encode($returnArr);
            }
            else
            {
                $message = "";
                $error_code = 0;
                //create an object to store all value
                $returnArr = [$message,$error_code];    
                echo json_encode($returnArr);
            }
        }
        
    }
}

if(isset($_POST["submit_btn"]))
{
    $user_fname = $_POST["user_fname"];
    $user_lname = $_POST["user_lname"];
    $user_email = $_POST["user_email"];
    $user_pw = $_POST["user_pass"];
    $user_phone = $_POST["user_phone"];
    $user_gender = $_POST["user_gender"];
    //$user_dob = $_POST["user_dob"];
    $user_address = $_POST["address"];
    $user_city = $_POST["city"];
    $user_state = $_POST["user_state"];
    $user_postcode = $_POST["pcode"];

    $fname=mysqli_real_escape_string($connect,$user_fname);
    $lname=mysqli_real_escape_string($connect,$user_lname);
    $pass=mysqli_real_escape_string($connect,$user_pw);

    $password = md5($user_pw);

    $vkey = md5(time().$user_fname);
    
    $email_query = "select * from customer where Cust_Email = '$user_email'";
    //run sql code
    $email_query_run = mysqli_query($connect,$email_query);
    if(mysqli_num_rows($email_query_run) ==0)
    {
        $skip_step = $_POST['skip-step'];
        if($skip_step == 0)
        {
            mysqli_query($connect,"insert into customer
            (Cust_Fname, Cust_Lname, Cust_Email, Cust_Password, Cust_Cont_Num, Cust_Gender, Cust_Address, Cust_State, Cust_City, Cust_Postcode, vkey, Cust_RegisterDate) 
            VALUES
            ('$user_fname','$user_lname','$user_email','$password','$user_phone','$user_gender','$user_address','$user_state','$user_city','$user_postcode','$vkey',CURDATE());");
        }
        else if($skip_step == 1)
        {
            mysqli_query($connect,"insert into customer
            (Cust_Fname, Cust_Lname, Cust_Email, Cust_Password, Cust_Cont_Num, Cust_Gender, vkey, Cust_RegisterDate) 
            VALUES
            ('$user_fname','$user_lname','$user_email','$password','$user_phone','$user_gender','$vkey',CURDATE());");
        }

        $_SESSION['register_email'] = $user_email;

        $to = $user_email;
        $subject = "Concerta:: Email Verification";
        $message = "<p style='font-size: 20px;'>Click the button below to verify your account at concerta.</p>
        <a href='http://localhost/concerta/register/verify.php?vkey=$vkey' style='display: block; text-decoration: none; color: white; background-color: #3f89e7; border-radius: 8px; font-weight: 500; font-size: 17px; margin-top: 40px; width: 110px; padding: 10px 20px;'>Verify Account</a>";
        $headers = "From: concerta.my@gmail.com \r\n";
        $headers .= "MIME-Version: 1.0"."\r\n";
        $headers .= "Content-type:text/html;charset=UTP-8"."\r\n";

        mail($to,$subject,$message,$headers);
        
        echo json_encode('1');
    }
}

?>