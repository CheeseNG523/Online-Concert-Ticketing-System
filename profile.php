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
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://kit.fontawesome.com/14a3a3f38a.js" crossorigin="anonymous"></script>
    <script src="profile_validation.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="head-foot3.css">
    <link rel="stylesheet" href="cust_profile3.css">
    <link rel="stylesheet" href="profile-sidebar1.css">
    <link rel="stylesheet" href="tnc_privacy.css">
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
        <a href='#' class='active'><i class='material-icons'>portrait</i>My profile</a><br>
        <a href='edit_profile.php'><i class='material-icons'>edit</i>Edit profile</a><br>
        <a href='change_password.php'><i class='material-icons'>lock</i>Change password</a><br>
        <a href='history-ticket.php'><i class='material-icons'>history</i>History</a>
    </div>

    <div class="main-container">
        <div class='main-title' style='padding: 0 10px;'>
            <h1>My Profile</h1>
        </div>
        
        <!-- 1st row -->
        <div class='label'>
            <p>First Name</p>
        </div>
        <div class='details'>
            <?php echo "<p>" . $cust_details['Cust_Fname'] . "</p>"; ?>
        </div>
        <div class='label'>
            <p>Gender</p>
        </div>
        <div class='details'>
            <?php
            // gender
            if($cust_details['Cust_Gender']=='M')
                echo "<p>Male</p>";
            else
                echo "<p>Female</p>";
            ?>
        </div>

        <!-- 2nd row -->
        <div class='label'>
            <p>Last Name</p>
        </div>
        <div class='details'>
            <?php echo "<p>" . $cust_details['Cust_Lname'] . "</p>"; ?>
        </div>
        <div class='label'>
            <p>Address</p>
        </div>
        <div class='details'>
            <?php
            // address
            if($cust_details['Cust_Address']==NULL)
                echo "<p style='color: lightgrey;'>No address added yet</p>";
            else
                echo "<p>" . $cust_details['Cust_Address'] . "</p>";
            ?>
        </div>

        <!-- 3rd row -->
        <div class='label'>
            <p>Phone Number</p>
        </div>
        <div class='details'>
            <?php echo "<p>" . $cust_details['Cust_Cont_Num'] . "</p>"; ?>
        </div>
        <div class='label'>
            <p>Postcode</p>
        </div>
        <div class='details'>
            <?php
            // postcode
            if($cust_details['Cust_Postcode']==NULL)
                echo "<p style='color: lightgrey;'>No postcode added yet</p>";
            else
                echo "<p>" . $cust_details['Cust_Postcode'] . "</p>";
            ?>
        </div>

        <!-- 4th row -->
        <div class='label'>
            <p>Email Address</p>
        </div>
        <div class='details'>
            <?php echo "<p>" . $cust_details['Cust_Email'] . "</p>"; ?>
        </div>
        <div class='label'>
            <p>State</p>
        </div>
        <div class='details'>
            <?php
            // state
            if($cust_details['Cust_State']==NULL)
                echo "<p style='color: lightgrey;'>No state added yet</p>";
            else
                echo "<p>" . $cust_details['Cust_State'] . "</p>";
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
                echo "<p style='color: lightgrey;'>No City added yet</p>";
            else
                echo "<p>" . $cust_details['Cust_City'] . "</p>";
            ?>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>