<?php
    session_start();
    include 'dataconnection.php';
    if(!isset($_SESSION['admin_email']))
    {
        header("location: login\login.php");
    }
    else
    {
        $admin_email= $_SESSION['admin_email'];
        $result=mysqli_query($connect,"select * from admin where admin_email='$admin_email'");
        $row=mysqli_fetch_assoc($result);
        $admin_name = $row['Admin_Fname']." ".$row['Admin_Lname'];
        if($row['Admin_imgDir'] === "" || $row['Admin_imgDir'] == null)
        {
            if($row['Admin_Gender']=="M")
                $admin_img = "../images/profile/male_profile.png";
            else
                $admin_img = "../images/profile/female_profile.png";
        }
        else
            $admin_img = $row['Admin_imgDir'];

        $admin_pri = $row['Admin_PRI'];
        if($admin_pri == 1)
            $admin_position = "Super Admin";
        else if($admin_pri == 2)
            $admin_position = "Admin";
        else
            $admin_position = "Unknow";
    }
    /*ini_set("error_reporting", 1);
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    if($_GET['rel']!='tab'){*/
?>
<!DOCTYPE html>
<head>
    <title>Concerta Admin</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://kit.fontawesome.com/14a3a3f38a.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

    <!--Chart JS-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2/dist/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2/dist/Chart.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2/dist/Chart.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2/dist/Chart.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="js/cleave.js"></script>
    <script src="js/cleave-phone.my.js"></script>
    <link rel="stylesheet" href="css/changeimg.css">
    <link rel="stylesheet" href="css/profile_form.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/table.css">
    <link rel="stylesheet" href="css/query_table.css">
    <link rel="stylesheet" href="css/rating.css">

    <!--<script>
		$(function(){
			$("a[rel='tab']").click(function(e){
				pageurl = $(this).attr('href');
				$.ajax({url:pageurl+'?rel=tab',success: function(data){
					$('.content').html(data);
				}});
				if(pageurl!=window.location){
					window.history.pushState({path:pageurl},'',pageurl);	
				}
				return false;  
			});
		});
		$(window).bind('popstate', function() {
			$.ajax({url:location.pathname+'?rel=tab',success: function(data){
				$('.content').html(data);
			}});
		});
    </script>-->
    <style>
        .pic-modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 999; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.pic-modal-content {
  background-color: #fefefe;
  margin: 5% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  border-radius: 8px;
  width: 30%; /* Could be more or less, depending on screen size */
  text-align: left;
  box-sizing: content-box; /* So the width will be 100% + 17px */
}

.pic-modal-content .wrapper img {
    object-fit: cover;
    display: none;
}

.pic-modal-content .wrapper img{
    height: 100%;
    width: 100%;
}

.pic-modal-content .wrapper {
    position: relative;
    height: 350px;
    width: 100%;
    border-radius: 10px;
    background: #fff;
    border: 2px dashed #c2cdda;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
  }

.pic-modal-content .wrapper .active {
    border: none;
}

.pic-modal-content .wrapper .image {
    position: absolute;
    height: 100%;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}
    </style>
</head>
<body onload=display_ct();>
        <input type="checkbox" id="minimize">
        <!--header-->
        <header>
            <label for="minimize">
                <span class="material-icons minimize_btn">menu</span>
            </label>
            <div class="left_area" style="margin-top:-8px;">
                <img src="../images/header_footer/logo_admin_white.png" height="45px"  width="220px" alert="">
                <!--<h3>Concerta <span>Admin</span></h3>-->
            </div>
            <div class="right_row">
                <button onclick="myFunction()" class="dropbtn">
                    <img src="<?php echo $admin_img; ?>" width="50%" height="50%" class="drop_profile_image" alt="">
                    <span><?php echo $admin_name; ?></span>
                </button>
            </div>
            <div class="top_right_row">
                <label id='ct'></label>
            </div>
            <div id="myDropdown" class="dropdown-content">
                <center>
                    <img src="<?php echo $admin_img; ?>" width="50%" height="50%" alt="">
                    <label class="user_name"><?php echo $admin_name; ?></label>
                    <label style="font-size:13px;" cass="user_position"><?php echo $admin_position; ?></label>
                </center>
                <a rel="tab" href="profile.php" style="text-align: center; float:left"><span class="material-icons">person</span><span class="icon_txt">My Profile</span></a>
                <a href="./php/admin_out.php" style="float:left;"><span class="material-icons">login</span><span class="icon_txt">Log Out</span></a>
            </div>
        </header>
        
        <!--header end-->

        <!--sidebar-->
        <div class="sidebar">
            <center>
                <img src="<?php echo $admin_img; ?>" width="50%" height="50%" class="profile_image" alt="">
                <label class="user_name"><?php echo $admin_name; ?></label>
                <label style="font-size:12px;" cass="user_position"><?php echo $admin_position; ?></label>
            </center>
            <div class="sidebar-menu">
				<div class="item">
					<a rel="tab" href="dashboard.php" class="menu-btn">
						<span class="material-icons">dashboard</span><span class="icon_txt">Dashboard</span>
					</a>
				</div>
				<div class="item" id="people">
					<a href="#people" class="menu-btn">
						<span class="material-icons">groups</span><span class="icon_txt">People</span><span class="material-icons expand">expand_more</span>
					</a>
					<div class="sub-menu">
                        <?php
                        if($admin_pri == 1)
                            echo '<a rel="tab" href="admin.php" class="sub-list"><span class="material-icons">people_alt</span><span class="icon_txt">Admin</span></a>';
                        ?>
                        <a rel="tab" href="customer.php" class="sub-list"><span class="material-icons">assignment_ind</span><span class="icon_txt">Customer</span></a>
                        <a rel="tab" href="organizer.php" class="sub-list"><span class="material-icons">business</span><span class="icon_txt">Organizer</span></a>
                        <a rel="tab" href="singer.php" class="sub-list"><span class="material-icons">audiotrack</span><span class="icon_txt">Singer</span></a>
					</div>
				</div>
				<div class="item" id="product">
					<a href="#product" class="menu-btn">
						<span class="material-icons">category</span><span class="icon_txt">Product</span><span class="material-icons expand">expand_more</span>
					</a>
					<div class="sub-menu">
						<a rel="tab" href="concert.php" class="sub-list"><span class="material-icons">music_video</span><span class="icon_txt">Concert</span></a>
                        <a rel="tab" href="merchandise.php" class="sub-list"><span class="material-icons">local_activity</span><span class="icon_txt">Merchandise</span></a>
                        <a rel="tab" href="venue.php" class="sub-list"><span class="material-icons">place</span><span class="icon_txt">Venue</span></a>
					</div>
				</div>
				<div class="item" id="order">
                    <a href="#order" class="menu-btn">
						<span class="material-icons">list_alt</span><span class="icon_txt">Order</span><span class="material-icons expand">expand_more</span>
                    </a>
                    <div class="sub-menu">
                        <a rel="tab" href="order.php" class="sub-list"><span class="material-icons">confirmation_number</span><span class="icon_txt">Ticket</span></a>
                        <a rel="tab" href="merch_order.php" class="sub-list"><span class="material-icons">local_mall</span><span class="icon_txt">Merchandise</span></a>
                    </div>

				</div>
				<div class="item">
					<a rel="tab" href="salesreport.php" class="menu-btn">
						<span class="material-icons">leaderboard</span><span class="icon_txt">Sales Report</span>
					</a>
				</div>
			</div>
        </div>
            <!--sidebar end-->

    <script>
        /* When the user clicks on the button, 
        toggle between hiding and showing the dropdown content */
        function myFunction() 
        {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        
        window.onclick = function(event)
        {
            // Close the profile dropdown if the user clicks outside of it
            if (!event.target.matches('.dropbtn')&&!event.target.matches('.dropbtn img')&&!event.target.matches('.dropbtn span'))
            {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) 
                {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show'))
                    {
                        openDropdown.classList.remove('show');
                    }
                }
            }
            /*
            // When the user clicks anywhere outside of the modal, close it
            if (event.target == email_modal)
            {
                var a = document.getElementById("cpw");
                a.type = "password";
                email_modal.style.display = "none";
                change_email_form.reset();
                $('.error_email').text("");
                $('.error_new_email').text("");
                $('.error_cpassword').text("");
                email_alert_dis.style.opacity = "0";
            }
            if (event.target == password_modal) {
                var x = document.getElementById("old_pw");
                var y = document.getElementById("new_pw");
                var z = document.getElementById("new_cpw");
                x.type = "password";
                y.type = "password";
                z.type = "password";
                password_modal.style.display = "none";
                password_alert_dis.style.opacity = "0";
                change_pass_form.reset();
                $('.error_old_password').text("");
                $('.error_new_password').text("");
                $('.error_new_cpassword').text("");
            }*/
        }

        //time display
        function display_c()
        {
            var refresh=0; // Refresh rate in milli seconds
            mytime=setTimeout('display_ct()',refresh)
        }

        function display_ct()
        {
            var x = new Date()
            document.getElementById('ct').innerHTML = x;
            display_c();
        }
    </script>

    <div class="content">
<?php //} ?>