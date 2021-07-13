<?php
    session_start();
	include "dataconnection.php";
	 
    $query = "SELECT * FROM merchandise WHERE Merchandise_unable = 0 and Merchandise_Status = 1 ORDER BY Merchandise_Name";
    $search = mysqli_query($connect, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>List of Merchandise</title>
    <link rel="stylesheet" href="head-foot3.css">
    <link rel="stylesheet" href="search/search1.css">
    <link rel="stylesheet" href="tnc_privacy.css">
    <link rel="stylesheet" href="product_result.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
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
		<a href="#" class="active" disabled style='pointer-events: none;'>Merchandise</a>
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

<div class="list-container">
    <?php
        while($result = mysqli_fetch_assoc($search))
        {
            echo "<div class='card c" . $result['Merchandise_ID'] . "'>";
                echo "<div class='image'>";
                echo "<img src='" . str_replace("../", "", $result['Merchandise_Image']) . "'>";
                    if($result['Merchandise_Stock']==0)
                    {
                        echo "<div class='disabled-item'><label class='disabled-word'>Sold Out</label></div>";
                    }
                    else if($result['Merchandise_Status']!=1)
                    {
                        echo "<div class='disabled-item' style='top: -255px; left: 125px;'><label class='disabled-word'>Not Available</label></div>";
                    }
                echo "</div>";
                echo "<div class='content'>";
                    echo "<div class='title'>" . $result['Merchandise_Name'] . "</div>"; 
                    echo "<div class='read_more'>";
                        echo "<a href='result_merch.php?q=" . $result['Merchandise_Name'] . "' target='_self'>Read more</a>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
            ?>
            <script>
                //hover function
                $('.c<?php echo $result['Merchandise_ID']; ?>').hover(function(){
                    if($(this).hasClass('active'))
                    {
                        $('.c<?php echo $result['Merchandise_ID']; ?>').removeClass("active");
                    }
                    else
                    {
                        $('.c<?php echo $result['Merchandise_ID']; ?>').addClass("active");
                    }
                });
            </script>
            <?php
        }
    ?>
</div>

<?php include "footer.php"; ?>