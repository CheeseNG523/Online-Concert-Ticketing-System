<?php
    session_start();
    include "dataconnection.php";
    
?>
<!DOCTYPE html>
<html>
<head>
    <title>About Us</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="head-foot3.css">
	<link rel="stylesheet" href="tnc_privacy.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=ZCOOL+XiaoWei&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
/*About us story section*/
.header-pic {
	top: 0;
	width: 100%;
	filter: brightness(40%);
	z-index: 10;
}

.header-pic_text {
	position: absolute;
	display: block;
	top: 260px;
	left: 160px;
    color: white;
	font-family: 'ZCOOL XiaoWei', serif; 
	font-size: 32px;
}

.story-container {
	display: inline-block; 
	position: relative; 
	background-color: white; 
	border-radius: 8px; 
	margin-top: -190px; 
	margin-bottom: 30px;
	left: 160px; 
	width: 80%;
}

.story {
	width: 100%; 
	height: 400px; 
	overflow: hidden;
}

.story h2 {font-size: 32px;}

.story-img {float: left;}

#toTopBtn {
	background-color: rgb(174, 106, 219);
	border: none;
	border-radius: 4px;
	color: white;
	cursor: pointer;
	height: 48px;
	width: 48px;
	right: 0;
	bottom: 50px;
	position: fixed;
	display: none;
	margin-right: 40px;
	z-index: 1200;
	opacity: 70%;
	text-align: center;
}

#toTopBtn:hover {
	background-color: rgb(109, 61, 141);
	opacity: 100%;
	transition-duration: 0.3s;
}

/*Team member section*/
.group-container {
	text-align: center; 
	background: rgb(251, 247, 255); 
    /*background: linear-gradient(120deg, rgb(230, 230, 255) 29%, rgb(205, 247, 255) 100%);*/
	height: 465px;
	padding: 0px 160px;
}

.group-container h1 {
	font-family: 'Quicksand', sans-serif; 
	color: black; 
	font-size: 32pt; 
	margin: auto; 
	padding: 30px 0px 20px 0px;
}

.group-container hr {
	width: 40px;
	border: 1px solid transparent; 
	margin: auto;
}

.group-container img {
	width: 60%;
}

.group-container p {
	font-family: 'Quicksand', sans-serif; 
	font-weight: 400;
	font-size: 16pt;
}

.member-1-container, .member-2-container {
	display: block; 
	margin: 20px 20px 20px 0px; 
	height: 230px; 
	width: 32%; 
	float: left;
}

.member-3-container {
	display: block; 
	margin: 20px 0px; 
	height: 230px; 
	width: 32%; 
	float: left;
}

</style>
</head>
<?php include "header.php"; ?>
    <div class="button">
		<a href="index.php">Home</a>
		<a href="#" class="active" disabled style='pointer-events: none;'>About Us</a>
		<a href="concert.php">Concert</a>
		<a href="merchandise.php">Merchandise</a>
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

		//if page height is over 500px, show button
		if(height > 500)
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

<!--About us-->
<div class="abtus_container">
	<img src="images/aboutus/header_pic.jpg" class="header-pic">
	<div class="header-pic_text">
		<h1>About Us</h1>
	</div>
	<!--Company Story-->
	<div class="story-container">
		<div class="story">
			<div class="story-img">
				<img src="images/aboutus/about2.jpg" style="border-top-left-radius: 8px; width: 600px; height: 100%;">
			</div>
			<div class="story-1-text" style="display: block; float: left; text-align: justify; padding: 40px 50px; width: 500px; font-family: sans-serif;">
				<h2>The Story</h2>
				<p>Welcome to concerta, your number one source for all concert tickets. We're dedicated to giving you the very best of our services.</p>
				<p>Founded in 2020, concerta has come a long way from its beginnings in Ayer Keroh, Melaka. 
				When we first started out, our passion for convinient concert ticket purchasing platform drove us to do tons of research so that concerta can offer you the best online concert ticketing platform. 
				We now serve customers all over Malaysia, and are thrilled that we're able to turn our passion into our own website.</p>
				<p>We sincerely hope you enjoy our products as much as we enjoy offering them to you.</p>
			</div>
		</div>
		<div class="story">
			<div class="story-2-text" style="display: block; float: left; text-align: justify; padding: 40px 50px; width: 500px; font-family: sans-serif;">
			<h2>What we do</h2>
                <p>Concerta is a Professional online concert ticketing system Platform. Here we will provide you only interesting content, which you will like very much.</p>
                <p>Our development team dedicated to providing you the best of online concert ticketing platform, with a focus on dependability and daily update.</p>
                <p>We're working to turn our passion for ticket concert ordering system into a booming online website. We hope you enjoy our online concert ticketing platform as much as we enjoy offering them to you.</p>
			</div>
			<div class="story-img">
			<img src="images/aboutus/about3.jpg" style="width: 600px; height: 100%;">
			</div>
		</div>
		<div class="story">
			<div class="story-img">
				<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15946.97479825707!2d102.2761136!3d2.2494935!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x66b6b12b75469278!2sMultimedia%20University!5e0!3m2!1szh-CN!2smy!4v1614158108700!5m2!1szh-CN!2smy" width="600" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
			</div>
			<div class="story-3-text" style="display: block; float: left; text-align: justify; padding: 40px 50px; width: 500px; font-family: sans-serif;">
				<h2>Contact us</h2>
				<p><i class='material-icons' style='vertical-align: middle; margin-right: 10px;'>call</i>011-1522 1518</p>
				<p><i class='material-icons' style='vertical-align: middle; margin-right: 10px;'>email</i>concerta.my@gmail.com</p>
				<p><i class='material-icons' style='vertical-align: middle; margin-right: 10px;'>place</i>Jalan Ayer Keroh Lama, 75450 Bukit Beruang, Melaka</p>
			</div>
		</div>
	</div>

	<!--Team member-->
	<div class="group-container">
		<h1>OUR TEAM</h1>
		<hr style="border-top: 3px solid orangered;">
		<div class="member-1-container">
			<img src="images/aboutus/team1.jpg">
			<p>Ng Tian Hoe</p>
		</div>
		<div class="member-2-container">
			<img src="images/aboutus/team2.jpg">
			<p>Kwang Chee Seng</p>
		</div>
		<div class="member-3-container">
			<img src="images/aboutus/team3.jpg">
			<p>Kong Kein Wah</p>
		</div>
	</div>
</div>
<!--About us end-->

<?php include "footer.php"; ?>