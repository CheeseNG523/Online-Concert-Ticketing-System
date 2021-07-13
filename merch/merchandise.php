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
    <link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>

html, body {
    height: 100%;
}

#toTopBtn {
	background-color: rgb(174, 106, 219);
	border: none;
	border-radius: 4px;
	color: white;
	cursor: pointer;
	height: 48px;
	width: 48px;
    right: 0;
	bottom: 0;
	position: fixed;
	display: none;
    margin-right: 40px;
    margin-bottom: 40px;
	z-index: 1000;
	opacity: 70%;
	text-align: center;
}

#toTopBtn:hover {
	background-color: rgb(109, 61, 141);
	opacity: 100%;
	transition-duration: 0.3s;
}

.list-container {
	display: grid;
    place-items: center;
    grid-template-columns:repeat(auto-fit, minmax(260px, 1fr));
    grid-row-gap: 1em;
    margin: 20px 160px;
	padding: 20px 30px;
	border: 1px solid lightgrey;
	border-radius: 8px;
	min-height: 315px;
    overflow: hidden;
	height: auto;
    font-family: 'Quicksand', sans-serif; 
}

.card {
    position: relative;
    height: 380px;
    width: 260px;
    display: block;
    background: white;
    box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.15);
    transition: 0.5s linear;
    float: left;
}

.card:hover {
    box-shadow: 0px 1px 35px 0px rgba(0, 0, 0, 0.3);
}

.card .image {
    background: black;
    height: 100%;
    overflow: hidden;
}

.card.active .image img {
    opacity: 0.6;
    transform: scale(1.1);
}

.image img {
    height: 100%;
    width: 100%;
    transition: 0.3s;
}

.disabled-item{
	position: relative;
    top: -260px;
    left: 70px;
}

.disabled-item .disabled-word{
	position: absolute;
    background: rgb(0,0,0,0.5);
    padding: 21px 18px;
    border-radius: 80px;
    color: white;
    font-weight: 600;
    font-size: 18px;
}

.card .content {
    display: flex;
    justify-content: center;
    align-content: space-between;
    flex-direction: column;
    position: absolute;
    bottom: 0;
    background: white;
    width: 260px;
    text-align: center;
    padding: 20px 0;
}

.content .title {
    font-size: 22px;
    font-weight: 700;
    color: #333333;
    margin-bottom: 10px;
}

.content .bottom a {
    display: block;
    width: 90px;
    padding: 7px 15px;
    font-size: 17px;
    background: #3f89e7;
    color: white;
    margin: auto;
    font-weight: 500;
    border: none;
    cursor: pointer;
    transition: 0.4s ease;
    text-decoration: none;
}

.content .bottom a:hover {
    background: rgba(190,190,255,1);
}

.bottom {
    display: none;
}

</style>
</head>
<?php include "header.php"; ?>
	<div class="button">
		<a href="index.php">Home</a>
		<a href="aboutus.php">About Us</a>
		<a href="concert.php">Concert</a>
		<a href="#" class="active" disabled>Merchandise</a>
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
	        <input class="instant-search__input" onKeyUp="showResult(this.value)" type="text" name="search" spellcheck="false" autocomplete="off" placeholder="Search for more singer">
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
                    echo "<div class='bottom'>";
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
                        $('.c<?php echo $result['Merchandise_ID']; ?> .bottom').slideUp(500, function()
                        {
                            $('.c<?php echo $result['Merchandise_ID']; ?>').removeClass("active");
                        });
                    }
                    else
                    {
                        $('.c<?php echo $result['Merchandise_ID']; ?>').addClass("active");
                        $('.c<?php echo $result['Merchandise_ID']; ?> .bottom').stop().slideDown();
                    }
                });
            </script>
            <?php
        }
    ?>
</div>

<?php include "footer.php"; ?>