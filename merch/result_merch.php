<?php 
	session_start();
	include "dataconnection.php";

	$email = $_SESSION['email'];
	$cust_query = mysqli_query($connect,"select Cust_ID from customer where Cust_Email = '$email'");
	$cust_row = mysqli_fetch_assoc($cust_query);

	$search_name = $_GET['q']; 
	$_SESSION['ticket_name'] = $search_name;

	$query = "SELECT A.Merchandise_ID, A.Merchandise_Name, A.Merchandise_ListPrice, A.Merchandise_Description, A.Merchandise_Stock, A.Merchandise_Status, A.Merchandise_Image, B.Concert_Name, C.Singer_Name FROM merchandise A, concert B, singer C where A.Concert_ID = B.Concert_ID and B.Singer_ID = C.Singer_ID and Merchandise_Name = '$search_name'";
	$search = mysqli_query($connect, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $search_name; ?></title>
	<link rel="stylesheet" href="head_foot3.css">
    <link rel="stylesheet" href="search/search1.css">
    <link rel="stylesheet" href="tnc_privacy.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<style>

.concert-info_container {
    display: block;
    margin: 20px 160px;
	padding: 20px 20px;
	border: 1px solid lightgrey;
	border-radius: 8px;
	min-height: 315px;
	overflow: hidden;
}

.concert-info_container img {
    min-width: 265px; 
    height: 400px;
}

.concert-details_left {
	float: left;
	font-family: 'Quicksand', sans-serif; 
	max-width: 270px; 
	font-weight: 500;
}

.concert-details_left a {
	text-decoration: none;
	color: black;
}

.concert-details_left i {
	vertical-align: middle;
	margin: 10px 5px;
	font-size: 20pt;
}

.concert-details_left .disabled-item{
	position: relative;
    top: -255px;
    left: 135px;
}

.concert-details_left .disabled-item .disabled-word{
	position: absolute;
    background: rgb(0,0,0,0.65);
    padding: 30px 25px;
    border-radius: 80px;
    color: white;
    font-weight: 600;
    font-size: 18px;
}

.concert-details_right {
	min-width: 700px;
	min-height: 600px;
	text-align: justify;
	line-height: 1.5;
	padding: 0px 20px;
	font-family: 'Quicksand', sans-serif; 
	top: 0;
	float: right;
}

.concert-details_right a {
	padding: 8px 12px;
	display: inline-block;
	margin-top: 20px;
	text-decoration: none;
	background-color: #3f89e7;
	border-radius: 4px;
	font-size: 14pt;
	color: white;
	font-weight: 600;
}

.concert-details_right a:hover {
	background-color: rgba(190,190,255,1);
	color: white;
	transition-duration: 0.4s;
}

.concert-details_right button:disabled,
.concert-details_right button:hover:disabled{
	padding: 9px 12px;
	display: inline-block;
	margin-top: 20px;
	text-decoration: none;
	background-color: #3f89e7;
	border-radius: 4px;
	font-size: 14pt;
	color: white;
	font-weight: 600;
	outline: none;
	border: 0;
	margin-right: 5%;
	cursor: not-allowed;
}

.concert-details_right button {
	padding: 9px 12px;
	display: inline-block;
	margin-top: 20px;
	text-decoration: none;
	background-color: #3f89e7;
	border-radius: 4px;
	font-size: 14pt;
	color: white;
	font-weight: 600;
	outline: none;
	border: 0;
	margin-right: 5%;
	cursor: pointer;
}

.concert-details_right button:hover {
	background-color: rgba(190,190,255,1);
	color: white;
	transition-duration: 0.4s;
}

.qty-btn{
	float: left;
    border: 1px solid #ccc;
	font-size: 0px;
	cursor: pointer;
	user-select:none;
}

.qty-btn label{
	padding: 5px;
	color: #464646;
	cursor: pointer;
	user-select:none;
}

input[type="number"]{
	outline: none;
    float: left;
	height: 32px;
	width: 45px;
    border: 0;
    border-top: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
	text-align: center;
	font-size: 12pt;
	color: #464646;
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
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
		<a href="merchandise.php" class="active" disabled>Merchandise</a>
		<a href="singer.php">Singer</a>
	</div>
  </div>
</div>

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

<div class="concert-info_container">
	<?php 
			$result = mysqli_fetch_assoc($search);
			echo "<input class='merch_id' type='text' value='".$result['Merchandise_ID']."'hidden>";
			echo "<div class='concert-details_left'>";
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
			echo "<div class='concert-details_right'>";
			echo "<p style='font-weight: 800; font-size: 22pt; margin: 0px;'>" . $result['Merchandise_Name'] . "</p>";
			echo "<p style='font-weight: 600; font-size: 18pt; margin: 0px; font-family:Helvetica; color:#3f89e7'>RM ".$result['Merchandise_ListPrice'] . "</p>";
			echo "<div class='qty-btn remove-qty' style='border-radius: 2px 0 0 2px;'><label class='material-icons'>remove</label></div>";
			echo "<input class='qty' type='number' value='1'>";
			echo "<div class='qty-btn add-qty' style='border-radius: 0 2px 2px 0;'><label class='material-icons'>add</label></div>";
			if($result['Merchandise_Description']==NULL || $result['Merchandise_Description']=="")
			{
				echo "<h2 style='clear:both;'>Sorry...This merchandise don't have any description now.</h2>";
			}
			else
			{
				echo "<p style='clear:both;'>" . $result['Merchandise_Description'] . "</p>";
			}
			if($result['Merchandise_Stock']==0 || $result['Merchandise_Status']!=1)
			{
				echo "<button class='cart-btn' disabled='disabled'><label class='material-icons' style='vertical-align: bottom;'>add_shopping_cart</label>Add to Cart</button>";
				echo "<button href='purchase.php?id=" . $result['Merchandise_ID'] . "' disabled='disabled'>Buy Now</button>";
			}
			else
			{
				echo "<button class='cart-btn'><label class='material-icons' style='vertical-align: bottom;'>add_shopping_cart</label>Add to Cart</button>";
				echo "<a href='purchase.php?id=" . $result['Merchandise_ID'] . "'>Buy Now</a>";
			}
			echo "</div>";
	?>
</div>

<script>
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
			var cust_id = <?php echo json_encode($cust_row['Cust_ID']); ?>;
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
	});
</script>

<?php include "footer.php"; ?>