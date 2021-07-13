<?php 
	session_start();
	include "dataconnection.php";
	
	$search_name = $_GET['q']; 
	$query = "SELECT * FROM singer WHERE Singer_Name LIKE '%{$search_name}%'";
	$search = mysqli_query($connect, $query);

	$past = mysqli_query($connect,"select * from concert A, singer B where A.Singer_ID = B.Singer_ID and A.Concert_Status = 3 
	and A.Concert_Unable = 0 and B.Singer_Name = '$search_name' order by A.Concert_StartDate desc");

	$current = mysqli_query($connect,"select * from concert A, singer B where A.Singer_ID = B.Singer_ID and (A.Concert_Status = 1 or A.Concert_Status = 2) 
	and A.Concert_Unable = 0 and B.Singer_Name = '$search_name' order by A.Concert_Status desc, A.Concert_StartDate desc");
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $search_name; ?></title>
    <link rel="stylesheet" href="head-foot3.css">
    <link rel="stylesheet" href="search/search1.css">
    <link rel="stylesheet" href="product_result.css">
    <link rel="stylesheet" href="tnc_privacy.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>
.singer-info_container {
    display: block;
    margin: 20px 160px;
	padding: 20px 30px;
	box-shadow: 0px 0px 32px 4px rgba(0,0,0,0.15);
	border-radius: 8px;
	min-height: 317px;
}

.singer-info_container img {
    max-width: 180px; 
    max-height: 250px;
    float: left;
	margin-right: 30px;
	margin-top: 30px;
}

.singer-details {
    overflow: hidden;
    max-width: 1100px;
	margin-bottom: 60px;
	text-align: justify;
	padding: 0px 10px;
    font-family: 'Quicksand', sans-serif; 
}

.content .title {
    font-size: 18px;
    font-weight: 700;
    color: #333333;
    margin-bottom: 10px;
}

.list-container-title{
    margin: 0 160px;
    font-size: 25px;
    font-weight: 600;
    font-family: 'Quicksand', sans-serif;
}

.card.active .image img {
    opacity: 0.6;
    transform: scale(1.1);
}
</style>
</head>
<?php include "header.php"; ?>
	<div class="button">
		<a href="index.php">Home</a>
		<a href="aboutus.php">About Us</a>
		<a href="concert.php">Concert</a>
		<a href="merchandise.php">Merchandise</a>
		<a href="singer.php" class="active" disabled>Singer</a>
	</div>
  </div>
</div>

<!-- Search bar -->
<div id="searchUsers" class="instant-search" style="width: 1200px;">
	<div class="instant-search__input-container">
	    <form name="searchForm" action="" method="get" style="margin-bottom: -10px;">
	        <input class="instant-search__input" onKeyUp="showResult(this.value)" type="text" name="search" spellcheck="false" autocomplete="off" placeholder="Search for other singer">
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
		xmlhttp.open("GET", "search/singer-livesearch.php?q=" + str, true);
		xmlhttp.send();
	}
</script>

<div class="singer-info_container">
	<?php 
		while($result = mysqli_fetch_assoc($search))
		{
			echo "<img src='" . str_replace("../", "", $result['Singer_Image']) . "'>";
    		echo "<div class='singer-details'>";
			echo "<h1>" . $result['Singer_Name'] . "</h1>";
			if($result['Singer_Desc']==NULL || $result['Singer_Desc']=="")
			{
				echo "<h2>Sorry...We don't have any information of this singer yet.</h2>";
			}
			else
			{
				echo "<p>" . $result['Singer_Desc'] . "</p>";
			}
			echo "<p><i>Source: Wikipedia</i></p></div>";
			?>
			<span class='list-container-title' style="margin: 0;">Upcoming Concert</span>
			<div class="concert-list-container" style="margin: 0;">
				<?php
				if(mysqli_num_rows($current))
				{
					while($result_current = mysqli_fetch_assoc($current))
					{
						echo "<div class='card c" . $result_current['Concert_ID'] . "'>";
							echo "<div class='image'>";
								echo "<img src='" . str_replace("../", "", $result_current['Concert_Ver_Image']) . "'>";
								if($result_current['Concert_Status']==1)
								{
									echo "<div class='disabled-item' style='top: -300px;left: 67px;'><label class='disabled-word'>Upcoming</label></div>";
								}
							echo "</div>";
							echo "<div class='content'>";
								echo "<div class='title'>" . $result_current['Concert_Name'] . "</div>"; 
								echo "<div class='read_more'>";
									echo "<a href='result_concert.php?q=" . $result_current['Concert_Name'] . "' target='_self'>Read more</a>";
								echo "</div>";
							echo "</div>";
						echo "</div>";
						?>
						<script>
							//hover function
							$('.c<?php echo $result_current['Concert_ID']; ?>').hover(function(){
								if($(this).hasClass('active'))
								{
									$('.c<?php echo $result_current['Concert_ID']; ?>').removeClass("active");
								}
								else
								{
									$('.c<?php echo $result_current['Concert_ID']; ?>').addClass("active");
								}
							});
						</script>
						<?php
					}
				}
				else
				{
					echo "<img src='images/cart/no_order.jpg' style='display: block; width:60%; max-width: 60%;'>";
                    echo "<div style='text-align: center;'><h2>No Upcoming Concert</h2></div>";
				}
				?>
			</div>

			<span class='list-container-title' style="margin: 0;">Past Concert</span>
			<div class="concert-list-container" style="margin: 0;">
				<?php
				if(mysqli_num_rows($past))
				{
					while($result_past = mysqli_fetch_assoc($past))
					{
						echo "<div class='card c" . $result_past['Concert_ID'] . "'>";
							echo "<div class='image'>";
								echo "<img src='" . str_replace("../", "", $result_past['Concert_Ver_Image']) . "'>";
								if($result_past['Concert_Status']==3)
								{
									echo "<div class='disabled-item' style='top: -285px;left: 85px;'><label class='disabled-word'>Ended</label></div>";
								}
							echo "</div>";
							echo "<div class='content'>";
								echo "<div class='title'>" . $result_past['Concert_Name'] . "</div>"; 
								echo "<div class='read_more'>";
									echo "<a href='result_concert.php?q=" . $result_past['Concert_Name'] . "' target='_self'>Read more</a>";
								echo "</div>";
							echo "</div>";
						echo "</div>";
						?>
						<script>
							//hover function
							$('.c<?php echo $result_past['Concert_ID']; ?>').hover(function(){
								if($(this).hasClass('active'))
								{
									$('.c<?php echo $result_past['Concert_ID']; ?>').removeClass("active");
								}
								else
								{
									$('.c<?php echo $result_past['Concert_ID']; ?>').addClass("active");
								}
							});
						</script>
						<?php
					}
				}
				else
				{
					echo "<img src='images/cart/no_order.jpg' style='display: block; width:60%; max-width: 60%;'>";
                    echo "<div style='text-align: center;'><h2>No Past Concert</h2></div>";
				}
				?>
			</div>
			<?php
		}
	?>
</div>

<?php include "footer.php"; ?>