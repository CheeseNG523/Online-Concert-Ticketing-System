<body id="body">
<div class="top">
  <div class="top-content">
	<div class="title">
		<img src="images/header_footer/logo.png" style="width:50%;">
	</div>
	<div class="top-right">
		<div class='header_tooltip' style='float:left;'>
			<a href="cart.php"><i class="material-icons" style="font-size: 25px; vertical-align: middle; padding: 3px 0;">shopping_cart</i></a>
			<span class='header_tooltiptext' style='margin-left:-4.625em;'>Shopping cart</span>
		</div>

		<div class="line"></div>
	<?php
	if(!isset($_SESSION['email']))
	{
	?>
		<div class='header_tooltip' style='float:left;'>
			<button onclick="window.open('login.php','_self')" class="dropbtn">
				<span class="material-icons">account_circle</span>
			</button>
			<span class='header_tooltiptext' style='margin-left:-50px;'>Log in</span>
		</div>
	<?php
	}
	else
	{
		$email = $_SESSION['email'];
		$query = mysqli_query($connect,"select * from customer where Cust_Email = '$email'");
		$run = mysqli_fetch_assoc($query);
		$cust_name = $run['Cust_Fname']." ".$run['Cust_Lname'];
	?>
		<div class='header_tooltip' style='float:left;'>
			<button onclick="myFunction()" class="dropbtn">
				<?php 
				if($run['Cust_Image']==NULL)
				{
					if($run['Cust_Gender']=='M')
					{
						echo "<img src='images/customer/male_profile.png' width='50%' height='50%' class='drop_profile_image' alt=''>";
					}
					else
					{
						echo "<img src='images/customer/female_profile.png' width='50%' height='50%' class='drop_profile_image' alt=''>";
					}
				}
				else
				{
					echo "<img src='" . str_replace("../", "", $run['Cust_Image']) . "' width='50%' height='50%' class='drop_profile_image' alt=''>";
				} 
				?>
				<span>Hi, <?php echo $run['Cust_Lname']; ?></span>
			</button>
			<!-- <a href="profile.php"><span class="material-icons">person</span></a>
			<span class='header_tooltiptext' style='margin-left:-3.0625em;'>Profile</span> -->
		</div>

		<div id="myDropdown" class="dropdown-content">
		<center>
			<?php 
			if($run['Cust_Image']==NULL)
			{
				if($run['Cust_Gender']=='M')
				{
					echo "<img src='images/customer/male_profile.png' width='50%' height='50%' class='drop_profile_image' alt=''>";
				}
				else
				{
					echo "<img src='images/customer/female_profile.png' width='50%' height='50%' class='drop_profile_image' alt=''>";
				}
			}
			else
			{
				echo "<img src='" . str_replace("../", "", $run['Cust_Image']) . "' width='50%' height='50%' class='drop_profile_image' alt=''>";
			} 
			?>
			<label class="user_name"><?php echo $cust_name; ?></label>
		</center>
		<a href="profile.php" style="text-align: center; float:left;"><span class="material-icons">person</span><span class="icon_txt">My Profile</span></a>
		<a href="logout.php" style="text-align: center; float:left;"><span class="material-icons">login</span><span class="icon_txt">Log Out</span></a>
		</div>
	<?php
	}?>
		<!-- <div class="line"></div>

		<div class='header_tooltip'>

				// echo "<a href='login.php' style='margin-left: 9px;'><span class='material-icons'>login</span></a>";
				// echo "<span class='header_tooltiptext' style='margin-left:-2.8125em;'>Login</span>";

				
				// echo "<a href='logout.php' style='margin-left: 9px;'><span class='material-icons'>login</span></a>";
				// echo "<span class='header_tooltiptext' style='margin-left:-3.125em;'>Logout</span>";
		</div> -->
	</div>
<script>
	var header_modal = document.getElementById('myDropdown');

	/* When the user clicks on the button, 
	toggle between hiding and showing the dropdown content */
	function myFunction() 
	{
		document.getElementById("myDropdown").classList.toggle("show");
	}

	
	window.addEventListener("click", function(event)
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
	})
</script>