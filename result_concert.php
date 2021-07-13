<?php 
	session_start();
	include "dataconnection.php";
	
	$search_name = $_GET['q']; 
	$_SESSION['ticket_name'] = $search_name;

	$query = "SELECT * FROM concert, singer, venue, organizer 
	WHERE concert.Concert_Name = '$search_name' 
	AND concert.Singer_ID = singer.Singer_ID
	AND concert.Venue_ID = venue.Venue_ID
	AND concert.Organizer_ID = organizer.Organizer_ID";
	$search = mysqli_query($connect, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $search_name; ?></title>
	<link rel="stylesheet" href="profile-sidebar1.css">
	<link rel="stylesheet" href="head-foot3.css">
    <link rel="stylesheet" href="search/search1.css">
    <link rel="stylesheet" href="tnc_privacy.css">
    <link rel="stylesheet" href="product_result.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

	<style>
		.concert_link:hover {
			transition-duration: 0.3s;
			color: #3f89e7;
		}

		button:disabled{
			cursor: not-allowed;
			background: #3f89e7;
			padding: 10px 25px;
			outline: none;
			border: none;
			font-size: 20px;
			color: #fff;
			font-weight: 500;
			border-radius: 5px;
		}

		.display-none{
			display: none;
		}

		.comment {
			float: left;
			width: 100%;
			margin-top: 20px;
		}

		.comment .status-container{
			width: 100%;
			height: 100%;
			overflow-x: auto;
			white-space: nowrap;
			margin: 20px 0;
			background-color: white;
		}

		.comment .status-container .rating-result{
			float: left;
			cursor: default;
			color: #ff8d00;
			padding: 20px;
		}

		.comment .status-container .rating-result .rating{
			color: #ff8d00;
			font-weight: 500;
			font-size: 25px;
		}

		.comment .status-container .rating-result .star{
			margin: 10px 0;
		}

		.comment .status-container .rating-result .star span{
			margin-right: 5px;
		}

		.comment .status-container .rating-result .rating span{
			font-size: 35px;
		}

		.comment .status-container .status-conatiner-bar{
			margin: 10px 10px;
			width: 12%;
			font-size: 15px;
			padding: 10px;
			padding-bottom: 7px;
			text-align: center;
			border-bottom: 3px solid transparent;
			font-weight: 500;
			border: 1px solid #ccc;
		}

		.comment .status-container .status-conatiner-bar:hover{
			border: 1px solid rgb(119, 119, 255);
		}

		.comment .status-container .left{
			float: left;
		}

		/* .comment .status-container .right{
			float: right;
		} */

		.comment .status-container .status-conatiner-bar:hover{
			color: rgb(119, 119, 255);
			cursor: pointer;
		}

		.comment .status-container .status-conatiner-bar:hover .category_tab {
			color: rgb(119, 119, 255);
		}

		.comment .status-container .active{
			color: rgb(119, 119, 255);
			border: 1px solid rgb(119, 119, 255);
			cursor: default;
		}

		.category_tab {
			color: black;
			font-size: 20px;
			vertical-align: bottom;
		}

		.active .category_tab {
			color: rgb(119, 119, 255);
		}
	</style>
</head>
<?php include "header.php"; ?>
	<div class="button">
		<a href="index.php">Home</a>
		<a href="aboutus.php">About Us</a>
		<a href="concert.php" class="active" disabled>Concert</a>
		<a href="merchandise.php">Merchandise</a>
		<a href="singer.php">Singer</a>
	</div>
  </div>
</div>

<!-- Search bar -->
<div id="searchUsers" class="instant-search" style="width: 1200px;">
	<div class="instant-search__input-container">
	    <form name="searchForm" action="" method="get" style="margin-bottom: -10px;">
	        <input class="instant-search__input" onKeyUp="showResult(this.value)" type="text" name="search" spellcheck="false" autocomplete="off" placeholder="Search for more concert">
	    </form>
	    <i class="material-icons instant-search__icon" style="font-size: 24px; line-height: 1.4;">search</i>
    </div>
    <div id="livesearch"></div>
</div>

<script>
//search bar function
	function showResult(str)
	{
		if(str.length==0)
		{
			document.getElementById("livesearch").innerHTML="";
			document.getElementById("livesearch").style.border="0px";
			return;
		}
	
		if(window.XMLHttpRequest)
		{
			xmlhttp = new XMLHttpRequest();
		}
		else
		{
			xmlhttp = new ActiveXobject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function()
		{
			if(xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
				document.getElementById("livesearch").style.border="0px solid red";
			}
		}
		xmlhttp.open("GET", "search/concert-livesearch.php?q=" + str, true);
		xmlhttp.send();
	}
</script>

<div class="concert-info_container">
	<?php 
		while($result = mysqli_fetch_assoc($search))
		{
			
			echo "<div class='concert-details_left'>";
			echo "<img src='" . str_replace("../", "", $result['Concert_Ver_Image']) . "'>";
			if($result['Concert_Status']==1)
				echo "<div class='disabled-item' style='top: -255px;left: 70px;'><label class='disabled-word'>Upcoming</label></div>";
			else if($result['Concert_Status']==3)
				echo "<div class='disabled-item' style='top: -255px;left: 86px;'><label class='disabled-word'>Ended</label></div>";
			echo "<br><i class='material-icons'>audiotrack</i><a class='concert_link' href='result_singer.php?q=" . $result['Singer_Name'] . "' target='_blank'>" . $result['Singer_Name'] . "</a>";
			echo "<br><i class='material-icons'>event</i>" . date_format(date_create($result['Concert_StartDate']), "D, d M Y, H:i") . " GMT+8";
			echo "<br><i class='material-icons'>location_on</i><a class='concert_link' href='" . $result['Venue_Location'] . "' target='_blank'>" . $result['Venue_Name'] . "</a>";
			echo "<br><i class='material-icons'>business</i><a class='concert_link' href='" . $result['Organizer_Link'] . "' target='_blank'>" . $result['Organizer_Name'] . "</a>";
			echo "</div>";
			echo "<div class='concert-details_right'>";
			echo "<p style='font-weight: 800; font-size: 22pt; margin: 0px;'>" . $result['Concert_Name'] . "</p>";
			if($result['Concert_Description']==NULL || $result['Concert_Description']=="")
			{
				echo "<h2>Sorry...This concert don't have any description now.</h2>";
			}
			else
			{
				echo "<p>" . $result['Concert_Description'] . "</p>";
			}
			if($result['Concert_Status']==1)
				echo "<button type='button' style='display:none;' disabled>Coming Soon</button>";
			else if($result['Concert_Status']==3)
				echo "<button type='button' disabled style='display:none'>Ended</button>";
			else
				echo "<a href='purchase.php?id=" . $result['Concert_ID'] . "'>Buy Now</a>";
			echo "</div>";

			if($result['Concert_Status']==3)
			{
				$rating_info = mysqli_query($connect,"select round(avg(A.Rating_Star),1) as 'star', count(A.Rating_ID) as 'comment' from rating A, purchase B, s_ticket C, 
				ticket_price D, concert E where A.Ticket_Purchase_ID = B.Purchase_ID and B.Purchase_ID = C.Purchase_ID and C.PriceID = D.Price_ID and 
				D.Concert_ID = E.Concert_ID and E.Concert_Name = '$search_name'");
				$rating = mysqli_fetch_assoc($rating_info);

				//comment detail
				$all_comment_query = mysqli_query($connect,"select A.Rating_Star, A.Rating_Comment, A.Rating_Image, E.Cust_ID, E.Cust_Lname, E.Cust_Fname, E.Cust_Image, 
				E.Cust_Gender from rating A, s_ticket B, ticket_price C, concert D, customer E, purchase F where A.Ticket_Purchase_ID = F.Purchase_ID and 
				B.Purchase_ID = F.Purchase_ID and B.PriceID = C.Price_ID and D.Concert_ID = C.Concert_ID and F.Card_verify=1 and 
				D.Concert_Name = '$search_name' group by F.Purchase_ID order by A.Rating_ID desc");

				$star1_comment_query = mysqli_query($connect,"select A.Rating_Star, A.Rating_Comment, A.Rating_Image, E.Cust_ID, E.Cust_Lname, E.Cust_Fname, E.Cust_Image, 
				E.Cust_Gender from rating A, s_ticket B, ticket_price C, concert D, customer E, purchase F where A.Ticket_Purchase_ID = F.Purchase_ID and 
				B.Purchase_ID = F.Purchase_ID and B.PriceID = C.Price_ID and D.Concert_ID = C.Concert_ID and F.Card_verify=1 and 
				D.Concert_Name = '$search_name' and A.Rating_Star = 1 group by F.Purchase_ID order by A.Rating_ID desc");

				$star2_comment_query = mysqli_query($connect,"select A.Rating_Star, A.Rating_Comment, A.Rating_Image, E.Cust_ID, E.Cust_Lname, E.Cust_Fname, E.Cust_Image, 
				E.Cust_Gender from rating A, s_ticket B, ticket_price C, concert D, customer E, purchase F where A.Ticket_Purchase_ID = F.Purchase_ID and 
				B.Purchase_ID = F.Purchase_ID and B.PriceID = C.Price_ID and D.Concert_ID = C.Concert_ID and F.Card_verify=1 and 
				D.Concert_Name = '$search_name' and A.Rating_Star = 2 group by F.Purchase_ID order by A.Rating_ID desc");

				$star3_comment_query = mysqli_query($connect,"select A.Rating_Star, A.Rating_Comment, A.Rating_Image, E.Cust_ID, E.Cust_Lname, E.Cust_Fname, E.Cust_Image, 
				E.Cust_Gender from rating A, s_ticket B, ticket_price C, concert D, customer E, purchase F where A.Ticket_Purchase_ID = F.Purchase_ID and 
				B.Purchase_ID = F.Purchase_ID and B.PriceID = C.Price_ID and D.Concert_ID = C.Concert_ID and F.Card_verify=1 and 
				D.Concert_Name = '$search_name' and A.Rating_Star = 3 group by F.Purchase_ID order by A.Rating_ID desc");

				$star4_comment_query = mysqli_query($connect,"select A.Rating_Star, A.Rating_Comment, A.Rating_Image, E.Cust_ID, E.Cust_Lname, E.Cust_Fname, E.Cust_Image, 
				E.Cust_Gender from rating A, s_ticket B, ticket_price C, concert D, customer E, purchase F where A.Ticket_Purchase_ID = F.Purchase_ID and 
				B.Purchase_ID = F.Purchase_ID and B.PriceID = C.Price_ID and D.Concert_ID = C.Concert_ID and F.Card_verify=1 and 
				D.Concert_Name = '$search_name' and A.Rating_Star = 4 group by F.Purchase_ID order by A.Rating_ID desc");

				$star5_comment_query = mysqli_query($connect,"select A.Rating_Star, A.Rating_Comment, A.Rating_Image, E.Cust_ID, E.Cust_Lname, E.Cust_Fname, E.Cust_Image, 
				E.Cust_Gender from rating A, s_ticket B, ticket_price C, concert D, customer E, purchase F where A.Ticket_Purchase_ID = F.Purchase_ID and 
				B.Purchase_ID = F.Purchase_ID and B.PriceID = C.Price_ID and D.Concert_ID = C.Concert_ID and F.Card_verify=1 and 
				D.Concert_Name = '$search_name' and A.Rating_Star = 5 group by F.Purchase_ID order by A.Rating_ID desc");

				$n = $rating['star'];
				$whole = floor($n);
				$fraction = $n - $whole; // remainder

				function hideName($cust_Name, $name_length)
				{
					$hide_symbol = '';
					for($i=0; $i<$name_length; $i++)
						$hide_symbol .= '*';
					$hidden_cust_name = $hide_symbol.substr($cust_Name, $name_length);
					
					return $hidden_cust_name;
				}

				echo "<div class='comment'><span class='comment_title'>Concert Review</span>";
				if(mysqli_num_rows($all_comment_query)>0)
				{
					?>
						<div class="status-container">
							<div class="rating-result">
								<div class="rating">
									<?php echo "<span class='rating-text'>".$n."</span>";?> out of 5
								</div>
								<div class="star">
								<?php
								for($i=0; $i<$whole; $i++)
								{
									echo '<span class="material-icons star-icon">star</span>';
								}
								if($fraction==0 || $fraction<0.5)
								{
									for($i=$whole; $i<5; $i++)
									{
										echo '<span class="material-icons star-icon">star_border</span>';
									}
								}
								else
								{
									echo '<span class="material-icons star-icon">star_half</span>';
									for($i=$whole+1; $i<5; $i++)
									{
										echo '<span class="material-icons star-icon">star_border</span>';
									}
								}
								?>
								</div>
							</div>
						<div style="margin-top: 3%;overflow-x: auto;width: 82%;">
						<div class="status-conatiner-bar active left merch-all">
							All(<?php echo mysqli_num_rows($all_comment_query)?>)
						</div>
						<div class="status-conatiner-bar left merch-star5">
							5 <span class="material-icons star-icon category_tab">star</span> (<?php echo mysqli_num_rows($star5_comment_query)?>)
						</div>
						<div class="status-conatiner-bar left merch-star4">
							4 <span class="material-icons star-icon category_tab">star</span> (<?php echo mysqli_num_rows($star4_comment_query)?>)
						</div>
						<div class="status-conatiner-bar left merch-star3">
							3 <span class="material-icons star-icon category_tab">star</span> (<?php echo mysqli_num_rows($star3_comment_query)?>)
						</div>
						<div class="status-conatiner-bar left merch-star2">
							2 <span class="material-icons star-icon category_tab">star</span> (<?php echo mysqli_num_rows($star2_comment_query)?>)
						</div>
						<div class="status-conatiner-bar left merch-star1">
							1 <span class="material-icons star-icon category_tab">star</span> (<?php echo mysqli_num_rows($star1_comment_query)?>)
						</div>
					</div>
				</div><?php
					echo "<div class='rating-all display-none' style='display:block'>";
					if(mysqli_num_rows($all_comment_query)>0)
					{
						while($rating_detail = mysqli_fetch_assoc($all_comment_query))
						{
							//to encrypt customer name
							$cust_Name = $rating_detail['Cust_Fname']." ".$rating_detail['Cust_Lname'];
							$name_length = strlen($cust_Name); //get name length
		
							echo "<div class='rating-container'>";
							echo "<div class='cust-img'>";
							if($rating_detail['Cust_Image'] == "")
							{
								if($rating_detail['Cust_Gender'] == "Female")
									echo "<img src='images/customer/female_profile.png'>";
								else
									echo "<img src='images/customer/male_profile.png'>";
							}
							else echo "<img src='".str_replace("../", "", $rating_detail['Cust_Image'])."'>";
							echo "</div>";
							echo "<div class='cust-name-star'>";
							echo "<div class='cust-name'>" . hideName($cust_Name, $name_length) . " " . $rating_detail['Cust_Lname'] . "</div>";
							if($rating_detail['Rating_Star']==1)
							{
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
							}
							else if($rating_detail['Rating_Star']==2)
							{
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
							}
							else if($rating_detail['Rating_Star']==3)
							{
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
							}
							else if($rating_detail['Rating_Star']==4)
							{
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
							}
							else if($rating_detail['Rating_Star']==5)
							{
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
							}
							echo "</div>";
							if($rating_detail['Rating_Comment'] != "")
							{
								echo "<div class='cust-comment'>";
								echo $rating_detail['Rating_Comment'];
								echo "</div>";
							}
							if($rating_detail['Rating_Image'] != "")
							{
								echo "<div class='cust-rating-img'>";
								echo '<img class="preimg" src="'.str_replace("../", "", $rating_detail['Rating_Image']).'" alt="">';
								echo "</div>";
							}
							echo "</div>";
						}
					}
					else
					{
						echo "<div style='text-align:center; font-size: 1.125em;'><span class='material-icons' style='font-size: 4.375em; color:lightgray;'>sms</span><br>No Review Yet</div>";
					}
					echo "</div>";
		
					echo "<div class='rating-star1 display-none'>";
					if(mysqli_num_rows($star1_comment_query)>0)
					{
						while($star1_rating_detail = mysqli_fetch_assoc($star1_comment_query))
						{
							//to encrypt customer name
							$cust_Name = $star1_rating_detail['Cust_Fname']." ".$star1_rating_detail['Cust_Lname'];
							$name_length = strlen($cust_Name); //get name length
		
							echo "<div class='rating-container'>";
							echo "<div class='cust-img'>";
							if($star1_rating_detail['Cust_Image'] == "")
							{
								if($star1_rating_detail['Cust_Gender'] == "Female")
									echo "<img src='images/customer/female_profile.png'>";
								else
									echo "<img src='images/customer/male_profile.png'>";
							}
							else echo "<img src='".str_replace("../", "", $star1_rating_detail['Cust_Image'])."'>";
							echo "</div>";
							echo "<div class='cust-name-star'>";
							echo "<div class='cust-name'>" . hideName($cust_Name, $name_length) . " " . $star1_rating_detail['Cust_Lname'] . "</div>";
							if($star1_rating_detail['Rating_Star']==1)
							{
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
							}
							else if($star1_rating_detail['Rating_Star']==2)
							{
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
							}
							else if($star1_rating_detail['Rating_Star']==3)
							{
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
							}
							else if($star1_rating_detail['Rating_Star']==4)
							{
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
							}
							else if($star1_rating_detail['Rating_Star']==5)
							{
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
							}
							echo "</div>";
							if($star1_rating_detail['Rating_Comment'] != "")
							{
								echo "<div class='cust-comment'>";
								echo $star1_rating_detail['Rating_Comment'];
								echo "</div>";
							}
							if($star1_rating_detail['Rating_Image'] != "")
							{
								echo "<div class='cust-rating-img'>";
								echo '<img class="preimg" src="'.str_replace("../", "", $star1_rating_detail['Rating_Image']).'" alt="">';
								echo "</div>";
							}
							echo "</div>";
						}
					}
					else
					{
						echo "<div style='text-align:center; font-size: 1.125em;'><span class='material-icons' style='font-size: 4.375em; color:lightgray;'>sms</span><br>No Review Yet</div>";
					}
					echo "</div>";
		
					echo "<div class='rating-star2 display-none'>";
					if(mysqli_num_rows($star2_comment_query)>0)
					{
						while($star2_rating_detail = mysqli_fetch_assoc($star2_comment_query))
						{
							//to encrypt customer name
							$cust_Name = $star2_rating_detail['Cust_Fname']." ".$star2_rating_detail['Cust_Lname'];
							$name_length = strlen($cust_Name); //get name length
		
							echo "<div class='rating-container'>";
							echo "<div class='cust-img'>";
							if($star2_rating_detail['Cust_Image'] == "")
							{
								if($star2_rating_detail['Cust_Gender'] == "Female")
									echo "<img src='images/customer/female_profile.png'>";
								else
									echo "<img src='images/customer/male_profile.png'>";
							}
							else echo "<img src='".str_replace("../", "", $star2_rating_detail['Cust_Image'])."'>";
							echo "</div>";
							echo "<div class='cust-name-star'>";
							echo "<div class='cust-name'>" . hideName($cust_Name, $name_length) . " " . $star2_rating_detail['Cust_Lname'] . "</div>";
							if($star2_rating_detail['Rating_Star']==1)
							{
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
							}
							else if($star2_rating_detail['Rating_Star']==2)
							{
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
							}
							else if($star2_rating_detail['Rating_Star']==3)
							{
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
							}
							else if($star2_rating_detail['Rating_Star']==4)
							{
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
							}
							else if($star2_rating_detail['Rating_Star']==5)
							{
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
							}
							echo "</div>";
							if($star2_rating_detail['Rating_Comment'] != "")
							{
								echo "<div class='cust-comment'>";
								echo $star2_rating_detail['Rating_Comment'];
								echo "</div>";
							}
							if($star2_rating_detail['Rating_Image'] != "")
							{
								echo "<div class='cust-rating-img'>";
								echo '<img class="preimg" src="'.str_replace("../", "", $star2_rating_detail['Rating_Image']).'" alt="">';
								echo "</div>";
							}
							echo "</div>";
						}
					}
					else
					{
						echo "<div style='text-align:center; font-size: 1.125em;'><span class='material-icons' style='font-size: 4.375em; color:lightgray;'>sms</span><br>No Review Yet</div>";
					}
					echo "</div>";
		
					echo "<div class='rating-star3 display-none'>";
					if(mysqli_num_rows($star3_comment_query)>0)
					{
						while($star3_rating_detail = mysqli_fetch_assoc($star3_comment_query))
						{
							//to encrypt customer name
							$cust_Name = $star3_rating_detail['Cust_Fname']." ".$star3_rating_detail['Cust_Lname'];
							$name_length = strlen($cust_Name); //get name length
		
							echo "<div class='rating-container'>";
							echo "<div class='cust-img'>";
							if($star3_rating_detail['Cust_Image'] == "")
							{
								if($star3_rating_detail['Cust_Gender'] == "Female")
									echo "<img src='images/customer/female_profile.png'>";
								else
									echo "<img src='images/customer/male_profile.png'>";
							}
							else echo "<img src='".str_replace("../", "", $star3_rating_detail['Cust_Image'])."'>";
							echo "</div>";
							echo "<div class='cust-name-star'>";
							echo "<div class='cust-name'>" . hideName($cust_Name, $name_length) . " " . $star3_rating_detail['Cust_Lname'] . "</div>";
							if($star3_rating_detail['Rating_Star']==1)
							{
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
							}
							else if($star3_rating_detail['Rating_Star']==2)
							{
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
							}
							else if($star3_rating_detail['Rating_Star']==3)
							{
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
							}
							else if($star3_rating_detail['Rating_Star']==4)
							{
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
							}
							else if($star3_rating_detail['Rating_Star']==5)
							{
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
							}
							echo "</div>";
							if($star3_rating_detail['Rating_Comment'] != "")
							{
								echo "<div class='cust-comment'>";
								echo $star3_rating_detail['Rating_Comment'];
								echo "</div>";
							}
							if($star3_rating_detail['Rating_Image'] != "")
							{
								echo "<div class='cust-rating-img'>";
								echo '<img class="preimg" src="'.str_replace("../", "", $star3_rating_detail['Rating_Image']).'" alt="">';
								echo "</div>";
							}
							echo "</div>";
						}
					}
					else
					{
						echo "<div style='text-align:center; font-size: 1.125em;'><span class='material-icons' style='font-size: 4.375em; color:lightgray;'>sms</span><br>No Review Yet</div>";
					}
					echo "</div>";
		
					echo "<div class='rating-star4 display-none'>";
					if(mysqli_num_rows($star4_comment_query)>0)
					{
						while($star4_rating_detail = mysqli_fetch_assoc($star4_comment_query))
						{
							//to encrypt customer name
							$cust_Name = $star4_rating_detail['Cust_Fname']." ".$star4_rating_detail['Cust_Lname'];
							$name_length = strlen($cust_Name); //get name length
		
							echo "<div class='rating-container'>";
							echo "<div class='cust-img'>";
							if($star4_rating_detail['Cust_Image'] == "")
							{
								if($star4_rating_detail['Cust_Gender'] == "Female")
									echo "<img src='images/customer/female_profile.png'>";
								else
									echo "<img src='images/customer/male_profile.png'>";
							}
							else echo "<img src='".str_replace("../", "", $star4_rating_detail['Cust_Image'])."'>";
							echo "</div>";
							echo "<div class='cust-name-star'>";
							echo "<div class='cust-name'>" . hideName($cust_Name, $name_length) . " " . $star4_rating_detail['Cust_Lname'] . "</div>";
							if($star4_rating_detail['Rating_Star']==1)
							{
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
							}
							else if($star4_rating_detail['Rating_Star']==2)
							{
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
							}
							else if($star4_rating_detail['Rating_Star']==3)
							{
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
							}
							else if($star4_rating_detail['Rating_Star']==4)
							{
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
							}
							else if($star4_rating_detail['Rating_Star']==5)
							{
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
							}
							echo "</div>";
							if($star4_rating_detail['Rating_Comment'] != "")
							{
								echo "<div class='cust-comment'>";
								echo $star4_rating_detail['Rating_Comment'];
								echo "</div>";
							}
							if($star4_rating_detail['Rating_Image'] != "")
							{
								echo "<div class='cust-rating-img'>";
								echo '<img class="preimg" src="'.str_replace("../", "", $star4_rating_detail['Rating_Image']).'" alt="">';
								echo "</div>";
							}
							echo "</div>";
						}
					}
					else
					{
						echo "<div style='text-align:center; font-size: 1.125em;'><span class='material-icons' style='font-size: 4.375em; color:lightgray;'>sms</span><br>No Review Yet</div>";
					}
					echo "</div>";
		
					echo "<div class='rating-star5 display-none'>";
					if(mysqli_num_rows($star5_comment_query)>0)
					{
						while($star5_rating_detail = mysqli_fetch_assoc($star5_comment_query))
						{
							//to encrypt customer name
							$cust_Name = $star5_rating_detail['Cust_Fname']." ".$star5_rating_detail['Cust_Lname'];
							$name_length = strlen($cust_Name); //get name length
		
							echo "<div class='rating-container'>";
							echo "<div class='cust-img'>";
							if($star5_rating_detail['Cust_Image'] == "")
							{
								if($star5_rating_detail['Cust_Gender'] == "Female")
									echo "<img src='images/customer/female_profile.png'>";
								else
									echo "<img src='images/customer/male_profile.png'>";
							}
							else echo "<img src='".str_replace("../", "", $star5_rating_detail['Cust_Image'])."'>";
							echo "</div>";
							echo "<div class='cust-name-star'>";
							echo "<div class='cust-name'>" . hideName($cust_Name, $name_length) . " " . $star5_rating_detail['Cust_Lname'] . "</div>";
							if($star5_rating_detail['Rating_Star']==1)
							{
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
							}
							else if($star5_rating_detail['Rating_Star']==2)
							{
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
							}
							else if($star5_rating_detail['Rating_Star']==3)
							{
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
							}
							else if($star5_rating_detail['Rating_Star']==4)
							{
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star_border</span>';
							}
							else if($star5_rating_detail['Rating_Star']==5)
							{
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
								echo '<span class="material-icons star-icon disBtn">star</span>';
							}
							echo "</div>";
							if($star5_rating_detail['Rating_Comment'] != "")
							{
								echo "<div class='cust-comment'>";
								echo $star5_rating_detail['Rating_Comment'];
								echo "</div>";
							}
							if($star5_rating_detail['Rating_Image'] != "")
							{
								echo "<div class='cust-rating-img'>";
								echo '<img class="preimg" src="'.str_replace("../", "", $star5_rating_detail['Rating_Image']).'" alt="">';
								echo "</div>";
							}
							echo "</div>";
						}
					}
					else
					{
						echo "<div style='text-align:center; font-size: 1.125em;'><span class='material-icons' style='font-size: 4.375em; color:lightgray;'>sms</span><br>No Review Yet</div>";
					}
					echo "</div>";
				}
				else
				{
					echo "<div style='text-align:center; font-size: 1.125em;'><span class='material-icons' style='font-size: 4.375em; color:lightgray;'>sms</span><br>No Review Yet</div>";
				}
				echo "</div>";
			}
		}
	?>
</div>

<div id="Pic_Modal2" class="pic-modal">
    <!-- Preview Picture -->
    <div class="pic-modal-content">
        <span class="close preview-close-btn" title="Close Modal" style='margin-left: 5px; margin-top: -10px;'>&times;</span>
        <div class="form-container">
            <div class="page">
                <div class="wrapper">
                    <div class="image">
                        <img style="display: block;" class="preimg-preview" src="" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$('.preimg').on('click', function(){
    $('#Pic_Modal2').css('display','block');
    var presrc = $(this).attr('src');
    $('.preimg-preview').attr('src',presrc);
})

$('.preview-close-btn').on('click',function(){
    $('#Pic_Modal2').css('display','none');
})

$(".merch-all").on('click', function(){
    $(".display-none").css("display","none");
    $('.status-conatiner-bar').removeClass("active");
    $(this).addClass("active");
    $('.rating-all').css("display","block");
})

$(".merch-star5").on('click', function(){
    $(".display-none").css("display","none");
    $('.status-conatiner-bar').removeClass("active");
    $(this).addClass("active");
    $('.rating-star5').css("display","block");
})

$(".merch-star4").on('click', function(){
    $(".display-none").css("display","none");
    $('.status-conatiner-bar').removeClass("active");
    $(this).addClass("active");
    $('.rating-star4').css("display","block");
})

$(".merch-star3").on('click', function(){
    $(".display-none").css("display","none");
    $('.status-conatiner-bar').removeClass("active");
    $(this).addClass("active");
    $('.rating-star3').css("display","block");
})

$(".merch-star2").on('click', function(){
    $(".display-none").css("display","none");
    $('.status-conatiner-bar').removeClass("active");
    $(this).addClass("active");
    $('.rating-star2').css("display","block");
})

$(".merch-star1").on('click', function(){
    $(".display-none").css("display","none");
    $('.status-conatiner-bar').removeClass("active");
    $(this).addClass("active");
    $('.rating-star1').css("display","block");
})
</script>
<?php include "footer.php"; ?>