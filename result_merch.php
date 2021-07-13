<?php 
	session_start();
	include "dataconnection.php";

	if(isset($_SESSION['email']))
	{
		$email = $_SESSION['email'];
		$cust_query = mysqli_query($connect,"select Cust_ID from customer where Cust_Email = '$email'");
		$cust_row = mysqli_fetch_assoc($cust_query);
	}

	$search_name = $_GET['q']; 
	$_SESSION['ticket_name'] = $search_name;

	$query = "SELECT A.Merchandise_ID, A.Merchandise_Name, A.Merchandise_ListPrice, A.Merchandise_Description, A.Merchandise_Stock, A.Merchandise_Status, A.Merchandise_Image, B.Concert_Name, C.Singer_Name FROM merchandise A, concert B, singer C where A.Concert_ID = B.Concert_ID and B.Singer_ID = C.Singer_ID and Merchandise_Name = '$search_name'";
	$search = mysqli_query($connect, $query);

	//rating count
	$rating_info = mysqli_query($connect,"select round(avg(A.Rating_Star),1) as 'star', count(A.Rating_ID) as 'comment'
	from rating A, s_merchandise B, merchandise C, purchase D where D.Purchase_ID = B.Purchase_ID and A.S_Merchandise_ID = B.S_Merchandise_ID 
	and C.Merchandise_ID = B.Merchandise_ID and D.Card_verify=1 and C.Merchandise_Name = '$search_name'");
	$rating = mysqli_fetch_assoc($rating_info);

	//sold count
	$sold_query = mysqli_query($connect, "select sum(s_merchandise.S_Merchandise_Qty) as 'sold' 
	from merchandise, s_merchandise, purchase 
	where Merchandise_Name = '$search_name' 
	and merchandise.Merchandise_ID = s_merchandise.Merchandise_ID
	and purchase.Purchase_ID = s_merchandise.Purchase_ID
	and purchase.Card_verify = 1");
	$sold = mysqli_fetch_assoc($sold_query);

	//comment detail
	$all_comment_query = mysqli_query($connect,"select A.Rating_Star, A.Rating_Comment, A.Rating_Image, E.Cust_Lname, E.Cust_Fname, E.Cust_Image, E.Cust_Gender 
	from rating A, s_merchandise B, merchandise C, purchase D, customer E where E.Cust_ID and A.Cust_ID and D.Purchase_ID = B.Purchase_ID and D.Cust_ID = E.Cust_ID 
	and A.Cust_ID = E.Cust_ID and A.S_Merchandise_ID = B.S_Merchandise_ID and C.Merchandise_ID = B.Merchandise_ID and D.Card_verify=1 
	and C.Merchandise_Name = '$search_name' order by A.Rating_ID desc");
	
	$star1_comment_query = mysqli_query($connect,"select A.Rating_Star, A.Rating_Comment, A.Rating_Image, E.Cust_Lname, E.Cust_Fname, E.Cust_Image, E.Cust_Gender 
	from rating A, s_merchandise B, merchandise C, purchase D, customer E where E.Cust_ID and A.Cust_ID and D.Purchase_ID = B.Purchase_ID and D.Cust_ID = E.Cust_ID 
	and A.Cust_ID = E.Cust_ID and A.S_Merchandise_ID = B.S_Merchandise_ID and C.Merchandise_ID = B.Merchandise_ID and D.Card_verify=1 
	and C.Merchandise_Name = '$search_name' and A.Rating_Star = 1 order by A.Rating_ID desc");

	$star2_comment_query = mysqli_query($connect,"select A.Rating_Star, A.Rating_Comment, A.Rating_Image, E.Cust_Lname, E.Cust_Fname, E.Cust_Image, E.Cust_Gender 
	from rating A, s_merchandise B, merchandise C, purchase D, customer E where E.Cust_ID and A.Cust_ID and D.Purchase_ID = B.Purchase_ID and D.Cust_ID = E.Cust_ID 
	and A.Cust_ID = E.Cust_ID and A.S_Merchandise_ID = B.S_Merchandise_ID and C.Merchandise_ID = B.Merchandise_ID and D.Card_verify=1 
	and C.Merchandise_Name = '$search_name' and A.Rating_Star = 2 order by A.Rating_ID desc");

	$star3_comment_query = mysqli_query($connect,"select A.Rating_Star, A.Rating_Comment, A.Rating_Image, E.Cust_Lname, E.Cust_Fname, E.Cust_Image, E.Cust_Gender 
	from rating A, s_merchandise B, merchandise C, purchase D, customer E where E.Cust_ID and A.Cust_ID and D.Purchase_ID = B.Purchase_ID and D.Cust_ID = E.Cust_ID 
	and A.Cust_ID = E.Cust_ID and A.S_Merchandise_ID = B.S_Merchandise_ID and C.Merchandise_ID = B.Merchandise_ID and D.Card_verify=1 
	and C.Merchandise_Name = '$search_name' and A.Rating_Star = 3 order by A.Rating_ID desc");

	$star4_comment_query = mysqli_query($connect,"select A.Rating_Star, A.Rating_Comment, A.Rating_Image, E.Cust_Lname, E.Cust_Fname, E.Cust_Image, E.Cust_Gender 
	from rating A, s_merchandise B, merchandise C, purchase D, customer E where E.Cust_ID and A.Cust_ID and D.Purchase_ID = B.Purchase_ID and D.Cust_ID = E.Cust_ID 
	and A.Cust_ID = E.Cust_ID and A.S_Merchandise_ID = B.S_Merchandise_ID and C.Merchandise_ID = B.Merchandise_ID and D.Card_verify=1 
	and C.Merchandise_Name = '$search_name' and A.Rating_Star = 4 order by A.Rating_ID desc");

	$star5_comment_query = mysqli_query($connect,"select A.Rating_Star, A.Rating_Comment, A.Rating_Image, E.Cust_Lname, E.Cust_Fname, E.Cust_Image, E.Cust_Gender 
	from rating A, s_merchandise B, merchandise C, purchase D, customer E where E.Cust_ID and A.Cust_ID and D.Purchase_ID = B.Purchase_ID and D.Cust_ID = E.Cust_ID 
	and A.Cust_ID = E.Cust_ID and A.S_Merchandise_ID = B.S_Merchandise_ID and C.Merchandise_ID = B.Merchandise_ID and D.Card_verify=1 
	and C.Merchandise_Name = '$search_name' and A.Rating_Star = 5 order by A.Rating_ID desc");

	function hideName($cust_Name, $name_length)
	{
		$hide_symbol = '';
		for($i=0; $i<$name_length; $i++)
			$hide_symbol .= '*';
		$hidden_cust_name = $hide_symbol.substr($cust_Name, $name_length);
		
		return $hidden_cust_name;
	}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $search_name; ?></title>
	<link rel="stylesheet" href="head-foot3.css">
	<link rel="stylesheet" href="profile-sidebar1.css">
    <link rel="stylesheet" href="search/search1.css">
    <link rel="stylesheet" href="tnc_privacy.css">
    <link rel="stylesheet" href="product_result.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=ZCOOL+XiaoWei&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<style>
.display-none{
	display: none;
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
		<a href="concert.php">Concert</a>
		<a href="merchandise.php" class="active" disabled>Merchandise</a>
		<a href="singer.php">Singer</a>
	</div>
  </div>
</div>

<!--Go to top button-->
<a id="toTopBtn"><i class="material-icons" style="font-size: 45px;">keyboard_arrow_up</i></a>

<script>
	//Scroll to top button
	$(window).scroll(function() 
	{
		var height = $(window).scrollTop();

		//if page height is over 300px, show button
		if(height > 300)
		{
			$('#toTopBtn').fadeIn();
		}
		else
		{
			$('#toTopBtn').fadeOut();
		}
	});

	$(document).ready(function() 
	{
		$("#toTopBtn").click(function(event)
		{
			event.preventDefault();
			$('html, body').animate({scrollTop: 0}, 'slow');
			return false;
		});
	});
</script>

<!-- Search bar -->
<div id="searchUsers" class="instant-search" style="width: 1200px;">
	<div class="instant-search__input-container">
	    <form name="searchForm" action="" method="get" style="margin-bottom: -10px;">
	        <input class="instant-search__input" onKeyUp="showResult(this.value)" type="text" name="search" spellcheck="false" autocomplete="off" placeholder="Search for more merchandise">
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
		xmlhttp.open("GET", "search/merch-livesearch.php?q=" + str, true);
		xmlhttp.send();
	}
</script>

<div class="merch-info_container">
	<?php 
		$result = mysqli_fetch_assoc($search);
		echo "<input class='merch_id' type='text' value='".$result['Merchandise_ID']."'hidden>";
		echo "<div class='merch-details_left'>";
		if($result['Merchandise_Stock']==0)
		{
			echo "<img src='" . str_replace("../", "", $result['Merchandise_Image']) . "' style='filter: brightness(0.8);border-radius: 60px;'>";
			echo "<div class='disabled-item'><label class='disabled-word'>Sold Out</label></div>";
		}
		else if($result['Merchandise_Status']!=1)
		{
			echo "<img src='" . str_replace("../", "", $result['Merchandise_Image']) . "' style='filter: brightness(0.8);border-radius: 60px;'>";
			echo "<div class='disabled-item' style='top: -255px; left: 125px;'><label class='disabled-word'>Not Available</label></div>";
		}
		else
		{
			echo "<img src='" . str_replace("../", "", $result['Merchandise_Image']) . "'>";
		}
		echo "</div>";
		echo "<div class='merch-details_right'>";
		echo "<p style='font-weight: 800; font-size: 22pt; margin: 0px;'>" . $result['Merchandise_Name'] . "</p>";
		echo "<div class='rating-info'>";
		$n = $rating['star'];
		$whole = floor($n);
		$fraction = $n - $whole; // remainder
		echo "<div class='rating'>";
		if(mysqli_num_rows($rating_info))
			echo "<span class='rating-text'>".$n."</span>";
		else
			echo "<span>No Rating</span>";
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
		echo "</div>";
		echo "<div class='num-rating'><span class='rating-text'>".$rating['comment']."</span> Ratings</div>";
		echo "<div class='item-sold'><span class='rating-text'>";
		if($sold['sold'] == null || $sold['sold'] == "")
		{
			echo "0</span> sold</div>";
		}
		else
		{
			echo $sold['sold'] . "</span> sold</div>";
		} 
		echo "</div>";
		if($result['Merchandise_Description']==NULL || $result['Merchandise_Description']=="")
		{
			echo "<div class='merch-desc'>Sorry...This merchandise don't have any description now.</div>";
		}
		else
		{
			echo "<div class='merch-desc'>" . $result['Merchandise_Description'] . "</div>";
		}
		echo "<hr style='border:0px; border-top:1px solid lightgray;'>";
		echo "<div class='price_qty'>Price</div>";
		echo "<p style='font-weight: 600; font-size: 18pt; margin: 0px 0px 10px 0px; font-family:Helvetica; color:#3f89e7'>RM ".$result['Merchandise_ListPrice'] . "</p>";
		echo "<div class='price_qty'>Quantity</div>";
		echo "<div class='qty_container'>";
			echo "<div class='qty-btn remove-qty' style='border-radius: 2px 0 0 2px;'> <label class='material-icons'>remove</label> </div>";
			echo "<input class='qty' type='number' value='1'>";
			echo "<div class='qty-btn add-qty' style='border-radius: 0 2px 2px 0;'><label class='material-icons'>add</label></div>";
		echo "</div>";

		if(!isset($_SESSION['email']))
		{
			echo "<a href='login.php' style='margin-right: 10px;'><label class='material-icons' style='vertical-align: middle; margin-right:10px;'>add_shopping_cart</label>Add to Cart</a>";
			echo "<a href='login.php'>Buy Now</a>";
		}
		else if($result['Merchandise_Stock']==0 || $result['Merchandise_Status']!=1)
		{
			echo "<button class='cart-btn' disabled='disabled'><label class='material-icons' style='vertical-align: middle; margin-right:10px;'>add_shopping_cart</label>Add to Cart</button>";
			echo "<button href='#' disabled='disabled'>Buy Now</button>";
		}
		else
		{
			echo "<button class='cart-btn'><label class='material-icons' style='vertical-align: middle; margin-right:10px;'>add_shopping_cart</label>Add to Cart</button>";
			echo "<button class='buy-now-btn'>Buy Now</button>";
		}
		echo "</div>";

		
		echo "<div class='comment'><span class='comment_title'>Merchandise Rating</span>";
		?>
        <div class="status-container">
			<div class="rating-result">
				<div class="rating">
				<?php 
				if($n != "")
					echo "<span class='rating-text'>".$n."</span>";
				else
					echo "<span class='rating-text'>0.0</span>";
				?> 
				out of 5
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
			<div style="margin-top: 3%; overflow-x: auto; width: 82%;">
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
        </div>
		<?php
		if(mysqli_num_rows($all_comment_query)>0)
		{
			echo "<div class='rating-all display-none' style='display:block'>";
			if(mysqli_num_rows($all_comment_query)>0)
			{
				while($rating_detail = mysqli_fetch_assoc($all_comment_query))
				{
					//to encrypt customer name
					$cust_Name = $rating_detail['Cust_Fname'];
					$name_length = strlen($cust_Name); //get name length

					echo "<div class='rating-container'>";
					echo "<div class='cust-img'>";
					if($rating_detail['Cust_Image'] == "")
					{
						if($rating_detail['Cust_Gender'] == "M")
							echo "<img src='images/customer/male_profile.png'>";
						else
							echo "<img src='images/customer/female_profile.png'>";
					}
					else
						echo "<img src='".str_replace("../", "", $rating_detail['Cust_Image'])."'>";
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
					$cust_Name = $star1_rating_detail['Cust_Fname'];
					$name_length = strlen($cust_Name); //get name length

					echo "<div class='rating-container'>";
					echo "<div class='cust-img'>";
					if($star1_rating_detail['Cust_Image'] == "")
					{
						if($star1_rating_detail['Cust_Gender'] == "Male")
							echo "<img src='images/customer/female_profile.png'>";
						else
							echo "<img src='images/customer/male_profile.png'>";
					}
						echo "<img src='".str_replace("../", "", $star1_rating_detail['Cust_Image'])."'>";
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
					$cust_Name = $star2_rating_detail['Cust_Fname'];
					$name_length = strlen($cust_Name); //get name length

					echo "<div class='rating-container'>";
					echo "<div class='cust-img'>";
					if($star2_rating_detail['Cust_Image'] == "")
					{
						if($star2_rating_detail['Cust_Gender'] == "Male")
							echo "<img src='images/customer/female_profile.png'>";
						else
							echo "<img src='images/customer/male_profile.png'>";
					}
						echo "<img src='".str_replace("../", "", $star2_rating_detail['Cust_Image'])."'>";
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
					$cust_Name = $star3_rating_detail['Cust_Fname'];
					$name_length = strlen($cust_Name); //get name length

					echo "<div class='rating-container'>";
					echo "<div class='cust-img'>";
					if($star3_rating_detail['Cust_Image'] == "")
					{
						if($star3_rating_detail['Cust_Gender'] == "Male")
							echo "<img src='images/customer/female_profile.png'>";
						else
							echo "<img src='images/customer/male_profile.png'>";
					}
						echo "<img src='".str_replace("../", "", $star3_rating_detail['Cust_Image'])."'>";
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
					$cust_Name = $star4_rating_detail['Cust_Fname'];
					$name_length = strlen($cust_Name); //get name length

					echo "<div class='rating-container'>";
					echo "<div class='cust-img'>";
					if($star4_rating_detail['Cust_Image'] == "")
					{
						if($star4_rating_detail['Cust_Gender'] == "Male")
							echo "<img src='images/customer/female_profile.png'>";
						else
							echo "<img src='images/customer/male_profile.png'>";
					}
						echo "<img src='".str_replace("../", "", $star4_rating_detail['Cust_Image'])."'>";
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
					$cust_Name = $star5_rating_detail['Cust_Fname'];
					$name_length = strlen($cust_Name); //get name length

					echo "<div class='rating-container'>";
					echo "<div class='cust-img'>";
					if($star5_rating_detail['Cust_Image'] == "")
					{
						if($star5_rating_detail['Cust_Gender'] == "Male")
							echo "<img src='images/customer/female_profile.png'>";
						else
							echo "<img src='images/customer/male_profile.png'>";
					}
						echo "<img src='".str_replace("../", "", $star5_rating_detail['Cust_Image'])."'>";
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
        </form>
    </div>
</div>

<script>
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
	
	$('.preimg').on('click', function(){
		$('#Pic_Modal2').css('display','block');
		var presrc = $(this).attr('src');
		$('.preimg-preview').attr('src',presrc);
	})
	
	$('.preview-close-btn').on('click',function(){
		$('#Pic_Modal2').css('display','none');
	})
	$(document).ready(function(){

		$('.remove-qty').on('click',function(){
			var current = $('.qty').val();
			if(current > 1)
			{
				var new_val = current - 1;
				$('.qty').val(new_val);
			}
		});

		$('.add-qty').on('click',function(){
			var current = parseInt($('.qty').val());
			var stock = parseInt(<?php echo json_encode($result['Merchandise_Stock']);?>);
			if(stock > current && current < 10)
			{
				var new_val = current + 1;
				$('.qty').val(new_val);
			}
		});

		$('.qty').keyup(function(){
			var current = $('.qty').val();
			var stock = parseInt(<?php echo json_encode($result['Merchandise_Stock']);?>);
			if(current != '' && current < 1)
				$('.qty').val(1);
			else if(current != '' && current < stock && stock >= 10)
				$('.qty').val(10);
			else if(current != '' && current > stock)
				$('.qty').val(stock);
		});

		$('.cart-btn').on('click',function(){
			var qty = $('.qty').val();
			var id = $('.merch_id').val();
			var cust_id = <?php if(isset($cust_row['Cust_ID']))echo json_encode($cust_row['Cust_ID']); else echo -1; ?>;
			$.ajax({
				type: "POST",
				url: "ajax_form.php",
				dataType: 'json',
				data: {
						"add_cart": 1,
						"qty": qty,
						"id": id,
						"cust": cust_id
				},
				success: function(respone){
					console.log(respone);
					if(respone == true || respone[0] == 1)
					{
						Swal.fire({
							icon: 'success',
							title: 'The item has been add into cart',
							showConfirmButton: false,
							timer: 2000,
							didClose: () => location.reload()
						});
					}
					else
					{
						if(respone[1]==0)
						{
							Swal.fire({
								icon: 'error',
								title:'Oops!', 
								text:'The item is out of stock', 
								showConfirmButton: false,
								timer: 2000,
								didClose: () => location.reload()
							});
						}
						else if(respone[1]==2)
						{
							Swal.fire({
								icon: 'error',
								title:'Oops!', 
								text:'You only can added 10 quantity for each item', 
								showConfirmButton: false,
								timer: 2000,
								didClose: () => location.reload()
							});
						}
						else if(respone[1]==3)
						{
							Swal.fire({
								icon: 'error',
								title:'Oops!', 
								text:'You have reached the maximum quantity available for this item', 
								showConfirmButton: false,
								timer: 2000,
								didClose: () => location.reload()
							});
						}
						else
						{
							Swal.fire({
								icon: 'error',
								title:'Oops!', 
								text:'The item is not available', 
								showConfirmButton: false,
								timer: 2000,
								didClose: () => location.reload()
							});
						}
					}
				},
				error: function(respone){
					console.log(respone);
				}
			});
		});

		$('.buy-now-btn').on("click",function(){
			var qty = $('.qty').val();
			var id = $('.merch_id').val();
			var cust_id = <?php if(isset($cust_row['Cust_ID']))echo json_encode($cust_row['Cust_ID']);else echo -1; ?>;
			$.ajax({
				type: "POST",
				url: "ajax_form.php",
				dataType: 'json',
				data: {
						"add_cart": 1,
						"qty": qty,
						"id": id,
						"cust": cust_id
				},
				success: function(respone){
					console.log(respone);
					if(respone == true || respone[0] == 1)
					{
						Swal.fire({
							icon: 'success',
							title: 'The item has been add into cart',
							showConfirmButton: false,
							timer: 2000,
							didClose: () => window.open('cart.php?merchid='+id,'_self')
						});
					}
					else
					{
						if(respone[1]==0)
						{
							Swal.fire({
								icon: 'error',
								title:'Oops!', 
								text:'The item is out of stock', 
								showConfirmButton: false,
								timer: 2000,
								didClose: () => location.reload()
							});
						}
						else if(respone[1]==2)
						{
							Swal.fire({
								icon: 'error',
								title:'Oops!', 
								text:'You only can added 10 quantity for each item', 
								showConfirmButton: false,
								timer: 2000,
								didClose: () => location.reload()
							});
						}
						else if(respone[1]==3)
						{
							window.open('cart.php?merchid='+id,'_self');
						}
						else
						{
							Swal.fire({
								icon: 'error',
								title:'Oops!', 
								text:'The item is not available', 
								showConfirmButton: false,
								timer: 2000,
								didClose: () => location.reload()
							});
						}
					}
				},
				error: function(respone){
					console.log(respone);
				}
			});
		})
	});
</script>

<?php include "footer.php"; ?>