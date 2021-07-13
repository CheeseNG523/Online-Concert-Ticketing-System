<?php
include '../../dataconnection.php';

/*if(isset($_POST['fname_submit_btn']))
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
}*/

if(isset($_POST['email_submit_btn']))
{
    $email = $_POST['emaill_id'];
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
            $message = "";
            $error_code = 0;
            $returnArr = [$message,$error_code];    
            echo json_encode($returnArr);
        }
}

/*if(isset($_POST['password_submit_btn_blur']))
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
}*/

if(isset($_POST['cpassword_submit_btn']))
{
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
        $message = "";
        $error_code = 0;
        $returnArr = [$message,$error_code];    
        echo json_encode($returnArr);
    }
}

/*if(isset($_POST['cpassword_submit_btn']))
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
}*/

/*if(isset($_POST['phone_submit_btn']))
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
}*/

/*if(isset($_POST['dob_submit_btn']))
{
    $dob_valid = $_POST["dob_valid"];
    if($dob_valid == null || $dob_valid === "")
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
}*/

/*if(isset($_POST['address_submit_btn']))
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
}*/

?>