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
        $email_query = "SELECT * FROM customer WHERE Cust_Email = '$email'";
        $email_search = mysqli_query($connect, $email_query);
        $cust_details = mysqli_fetch_assoc($email_search);
    }
?>
<!DOCTYPE html>
<html>
<head>
<title>My profile</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://kit.fontawesome.com/14a3a3f38a.js" crossorigin="anonymous"></script>
    <script src="register/js/cleave.js"></script>
    <script src="register/js/cleave-phone.my.js"></script>
    <script src="profile_validation.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="head-foot3.css">
    <link rel="stylesheet" href="cust_profile3.css">
    <link rel="stylesheet" href="profile-sidebar1.css">
    <link rel="stylesheet" href="tnc_privacy.css">
<style>
.main-container input, textarea {
    outline: none;
    border: 1px solid transparent;
    border-radius: 8px;
    padding: 5px 8px;
    background-color: rgba(63, 191, 191, 0.2);
    font-family: 'Poppins', sans-serif;
    resize: none;
}

.main-container textarea {
    resize: vertical;
}

.main-container select {
    outline: none;
    border: 1px solid transparent;
    border-radius: 8px;
    padding: 5px 10px;
    background-color: rgba(63, 191, 191, 0.2);
    font-family: 'Poppins', sans-serif;
}

.main-container select:disabled, .main-container textarea:disabled, .main-container input:disabled {
    background-color: rgba(12, 38, 38, 0.3);
    color: grey;
}

input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
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

<?php include "profile-sidebar.php"; ?>
        <a href='profile.php'><i class='material-icons'>portrait</i>My profile</a><br>
        <a href='#' class='active'><i class='material-icons'>edit</i>Edit profile</a><br>
        <a href='change_password.php'><i class='material-icons'>lock</i>Change password</a><br>
        <a href='history-ticket.php'><i class='material-icons'>history</i>History</a>
    </div>

    <form class="main-container" action='' name='edit_form' method='post'>
        <div class='main-title' style='padding: 0 10px;'>
            <h1>Edit Profile</h1>
        </div>
        
        <!-- 1st row -->
        <div class='label'>
            <p>First Name</p>
        </div>
        <div class='details'>
            <input type='text' class='cust_fname' value='<?php echo $cust_details['Cust_Fname']; ?>'></input>
        </div>
        <div class='label'>
            <p>Gender</p>
        </div>
        <div class='details'>
            <select name='gender' class='cust_gender' form='edit_form'>
            <?php
            // gender
            if($cust_details['Cust_Gender']=='M')
            {
                echo "<option value='M' selected='selected'>Male</option>";
                echo "<option value='F'>Female</option>";
            }
            else if($cust_details['Cust_Gender']=='F')
            {
                echo "<option value='M'>Male</option>";
                echo "<option value='F' selected='selected'>Female</option>";
            }
            ?>
            </select>
        </div>

        <!-- 2nd row -->
        <div class='label'>
            <p>Last Name</p>
        </div>
        <div class='details'>
            <input type='text' class='cust_lname' value='<?php echo $cust_details['Cust_Lname']; ?>'></input>
        </div>
        <div class='label'>
            <p>Address</p>
        </div>
        <div class='details'>
            <?php
            // address
            if($cust_details['Cust_Address']==NULL)
                echo "<textarea cols='40' rows='5' class='cust_address' placeholder='Type your address'></textarea>";
            else
                echo "<textarea cols='40' rows='5' class='cust_address'>" . $cust_details['Cust_Address'] . "</textarea>";
            ?>
        </div>

        <!-- 3rd row -->
        <div class='label'>
            <p>Phone Number</p>
        </div>
        <div class='details'>
            <select id="select-country" readonly disabled style="width:22%; height: 75%; float:left; border-radius: 5px 0 0 5px; padding: 0px;">
                <option value="MY" disabled hidden selected>MY</option>
            </select>
            <input type='text' name='user_phone' style='border-radius: 0 5px 5px 0; position: absolute; width: 115px;' class='cust_phone' value='<?php echo $cust_details['Cust_Cont_Num']; ?>'></input>
        </div>
        <div class='label'>
            <p>Postcode</p>
        </div>
        <div class='details'>
            <?php
            // postcode
            if($cust_details['Cust_Postcode']==NULL)
                echo "<input type='text' id='cust_postcode' class='cust_postcode' maxlength='5' placeholder='Type your postcode'></input>";
            else
                echo "<input type='text' id='cust_postcode' class='cust_postcode' maxlength='5' value='" . $cust_details['Cust_Postcode'] . "'></input>";
            ?>
        </div>

        <!-- 4th row -->
        <div class='label'>
            <p>Email Address</p>
        </div>
        <div class='details'>
            <input type='text' disabled value='<?php echo $cust_details['Cust_Email']; ?>'></input>
        </div>
        <div class='label'>
            <p>State</p>
        </div>
        <div class='details'>
            <?php
            // state
            if($cust_details['Cust_State']==NULL)
            {
            ?>
                <select name="user_state" class="cust_state" id="state">
                    <option value="" hidden selected disabled></option>
                    <option value="Johor">Johor</option>
                    <option value="Kedah">Kedah</option>
                    <option value="Kelantan">Kelantan</option>
                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                    <option value="Labuan">Labuan</option>
                    <option value="Melaka">Melaka</option>
                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                    <option value="Pahang">Pahang</option>
                    <option value="Perak">Perak</option>
                    <option value="Perlis">Perlis</option>
                    <option value="Penang">Penang</option>
                    <option value="Sabah">Sabah</option>
                    <option value="Sarawak">Sarawak</option>
                    <option value="Selangor">Selangor</option>
                    <option value="Terengganu">Terengganu</option>
                </select>
            <?php
            }
            else
            {
                $state = $cust_details['Cust_State'];
            ?>
                <select name="user_state" class="cust_state" id="state">
                    <option value="Johor" <?php if($state=="Johor") echo "selected='selected'"; ?>>Johor</option>
                    <option value="Kedah" <?php if($state=="Kedah") echo "selected='selected'"; ?>>Kedah</option>
                    <option value="Kelantan" <?php if($state=="Kelantan") echo "selected='selected'"; ?>>Kelantan</option>
                    <option value="Kuala Lumpur" <?php if($state=="Kuala Lumpur") echo "selected='selected'"; ?>>Kuala Lumpur</option>
                    <option value="Labuan" <?php if($state=="Labuan") echo "selected='selected'"; ?>>Labuan</option>
                    <option value="Melaka" <?php if($state=="Melaka") echo "selected='selected'"; ?>>Melaka</option>
                    <option value="Negeri Sembilan" <?php if($state=="Negeri Sembilan") echo "selected='selected'"; ?>>Negeri Sembilan</option>
                    <option value="Pahang" <?php if($state=="Pahang") echo "selected='selected'"; ?>>Pahang</option>
                    <option value="Perak" <?php if($state=="Perak") echo "selected='selected'"; ?>>Perak</option>
                    <option value="Perlis" <?php if($state=="Perlis") echo "selected='selected'"; ?>>Perlis</option>
                    <option value="Penang" <?php if($state=="Penang") echo "selected='selected'"; ?>>Penang</option>
                    <option value="Sabah" <?php if($state=="Sabah") echo "selected='selected'"; ?>>Sabah</option>
                    <option value="Sarawak" <?php if($state=="Sarawak") echo "selected='selected'"; ?>>Sarawak</option>
                    <option value="Selangor" <?php if($state=="Selangor") echo "selected='selected'"; ?>>Selangor</option>
                    <option value="Terengganu" <?php if($state=="Terengganu") echo "selected='selected'"; ?>>Terengganu</option>
                </select>
            <?php
            }
            ?>
        </div>

        <!-- 5th row -->
        <div class='label'>
        </div>
        <div class='details'>
        </div>
        <div class='label '>
            <p>City</p>
        </div>
        <div class='details'>
            <?php
            // city
            if($cust_details['Cust_City']==NULL)
                echo "<input type='text' class='cust_city' placeholder='Type your city'></input>";
            else
                echo "<input type='text' class='cust_city' value='" . $cust_details['Cust_City'] . "'></input>";
            ?>
        </div>

        <!-- submit button -->
        <div class='label'>
            <input type='submit' value='Save Changes' name='submitbtn' class='edit_submit_btn'></input>
        </div>
    </form>
</div>

<script>
//format for phone number
var cleave = new Cleave('.cust_phone',{
    phone:true,
    phoneRegionCode: 'MY'
});

//only number for postcode
document.getElementById('cust_postcode').oninput = function() 
{
    //only allow user to enter number characters for postcode
    this.value = this.value.replace(/[^0-9]/g, '');
}
</script>

<?php include "footer.php"; ?>