<?php
    session_start();
	include "dataconnection.php";
	
    $query = "SELECT * FROM concert WHERE Concert_Unable = 0 AND Concert_Status != 3 ORDER BY Concert_StartDate";
    $search = mysqli_query($connect, $query);
?>
<!DOCTYPE html>
<html>
<head>
<title>concerta</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="head-foot3.css">
	<link rel="stylesheet" href="search/search1.css">
	<link rel="stylesheet" href="tnc_privacy.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
/* Slideshow design */
.slideshow-container {
	max-width: 1000px;
	position: relative;
	margin: auto;
	text-align: center;
	z-index: 900;
}
/* Hide the images by default */
.mySlides {
	display: none;
}

/* Next & previous buttons */
.prev, .next {
	cursor: pointer;
	position: absolute;
	top: 10%;
	width: auto;
	padding: 10px;
	margin-top: -50px;
	color: white;
	font-weight: bold;
	font-size: 20px;
}

/* Position the "next button" to the right */
.next {
	/* background-color: rgba(0, 0, 0, 0.6); */
	height: 95%;
	right: 0;
}

/* Position the "prev button" to the left */
.prev {
	/* background-color: rgba(0, 0, 0, 0.6); */
	height: 95%;
	left: 0;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
	background-color: rgba(0, 0, 0, 0.6);
}

.active {
	background-color: #717171;
}

/* Fading animation */
.fade {
	animation-name: fade;
	animation-duration: 1.5s;
}

@keyframes fade {
	from {opacity: .4}
	to {opacity: 1}
}

/* The dots/bullets/indicators */
.dot {
	cursor: pointer;
	height: 15px;
	width: 15px;
	margin: 12px 4px;
	background-color: #bbb;
	border-radius: 50%;
	display: inline-block;
}

.active, .dot:hover {
	background-color: #717171;
}

</style>
</head>
<?php include "header.php"; ?>
	<div class="button">
		<a href="#" class="active" disabled  style='pointer-events: none;'>Home</a>
		<a href="aboutus.php">About Us</a>
		<a href="concert.php">Concert</a>
		<a href="merchandise.php">Merchandise</a>
		<a href="singer.php">Singer</a>
	</div>
  </div>
</div>

<!-- Search bar -->
<div id="searchUsers" class="instant-search" style="width: 1000px;">
	<div class="instant-search__input-container">
	    <form name="searchForm" action="" method="get">
			<input type="hidden" name="search_name">
			<input class="instant-search__input" onKeyUp="showResult(this.value)" type="text" name="search" spellcheck="false" autocomplete="off" placeholder="Search for Concert Ticket">
	    </form>
	    <i class="material-icons instant-search__icon" style="font-size: 24px; line-height: 1.4;">search</i>
    </div>
    <div id="livesearch"></div>
</div>

<!-- Poster slideshow -->
<div class="slideshow-container">
	<?php 
		$i=1;
        while($result = mysqli_fetch_assoc($search))
		{
			echo "<div class='mySlides fade'>";
			echo "<a href='result_concert.php?q=" . $result['Concert_Name'] . "' target='_blank'><img src='" .  str_replace("../", "", $result['Concert_Hor_Image']) . "' style='width:1000px; height:500px;'></a>";
            echo "</div>";
            $i++;
        }
	?>

	<!-- Next and previous buttons -->
    <a class="prev" onclick="plusSlides(-1)"><span class="material-icons" style='margin-top: 225px; font-size: 50px;'>keyboard_arrow_left</span></a>
    <a class="next" onclick="plusSlides(1)"><span class="material-icons" style='margin-top: 225px; font-size: 50px;'>keyboard_arrow_right</span></a>
</div>
<br>
<div style="text-align: center; margin-bottom: 20px;">
	<?php 
		$count = mysqli_num_rows($search);
		$j=0;
		while($j!=$count)
		{
			echo "<span class='dot' onclick='currentSlide(" . $j . ")'></span>";
			$j++;
		}
	?>
</div>

<script>
//manual-slide design
var slideIndex = 1;
showSlides(slideIndex);

//Next/previous controls
function plusSlides(n) 
{
	showSlides(slideIndex += n);
	showSlides();
}

//change slide when clicking the dots
function currentSlide(n) 
{
	//using n+1 as $j(php) start from 0
	showSlides(slideIndex = n+1);
	showSlides();
}


function showSlides(n) 
{
	var i;
	var slides = document.getElementsByClassName("mySlides");
	var dots = document.getElementsByClassName("dot");

	if(n > slides.length) 
	{
		slideIndex = 1;
	}
	
	if(n < 1) 
	{
		slideIndex = slides.length;
	}
	
	for(i = 0; i < slides.length; i++) 
	{
		slides[i].style.display = "none";
	}
	
	for (i = 0; i < dots.length; i++) 
	{
		dots[i].className = dots[i].className.replace(" active", "");
	}
	  
	slides[slideIndex-1].style.display = "inline-block";
	dots[slideIndex-1].className += " active";
}

//auto-slide design
var slide_index = 0;
showSlide();

function showSlide() 
{
	var i;
	var slide = document.getElementsByClassName("mySlides");
	var dot = document.getElementsByClassName("dot");
	
	for(i=0; i<slide.length; i++)
	{
		slide[i].style.display = "none";
	}
	
	slide_index++;
	
	if(slide_index > slide.length)
	{
		slide_index = 1;
	}
	
	for(i=0; i<dot.length; i++)
	{
		dot[i].className = dot[i].className.replace(" active", "");
	}
	
	slide[slide_index-1].style.display = "inline-block";
	dot[slide_index-1].className += " active";
	setTimeout(showSlide, 5000); //change image every 2 seconds
}

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
		}
	}
	xmlhttp.open("GET", "search/concert-livesearch.php?q=" + str, true);
	xmlhttp.send();
}
</script>

<?php include "footer.php"; ?>