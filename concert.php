<?php
    session_start();
	include "dataconnection.php";
	 
    $query = "SELECT * FROM concert, venue WHERE concert.Venue_ID = venue.Venue_ID AND concert.Concert_Unable = 0 AND concert.Concert_Status = 2 ORDER BY Concert_StartDate";
    $search = mysqli_query($connect, $query);

    $query2 = "SELECT * FROM concert, venue WHERE concert.Venue_ID = venue.Venue_ID AND concert.Concert_Unable = 0 AND concert.Concert_Status = 1 ORDER BY Concert_StartDate";
    $search2 = mysqli_query($connect, $query2);
?>
<!DOCTYPE html>
<html>
<head>
    <title>List of Concert</title>
    <link rel="stylesheet" href="head-foot3.css">
    <link rel="stylesheet" href="search/search1.css">
    <link rel="stylesheet" href="product_result.css">
    <link rel="stylesheet" href="tnc_privacy.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>

.card.active .image img {
    opacity: 0.6;
    transform: scale(1.1);
}

.card .content {
    display: flex;
    justify-content: center;
    align-content: space-between;
    flex-direction: column;
    position: absolute;
    bottom: 0;
    background: white;
    width: 200px;
    text-align: center;
    padding: 20px 30px;
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

</style>
</head>
<?php include "header.php"; ?>
	<div class="button">
		<a href="index.php">Home</a>
		<a href="aboutus.php">About Us</a>
		<a href="#" class="active" disabled style='pointer-events: none;'>Concert</a>
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

<span class='list-container-title'>On Sold</span>
<div class="list-container">
    <?php
		while($result = mysqli_fetch_assoc($search))
        {
			echo "<div class='card c" . $result['Concert_ID'] . "'>";
                echo "<div class='image'>";
                    echo "<img src='" . str_replace("../", "", $result['Concert_Ver_Image']) . "'>";
                echo "</div>";
                echo "<div class='content'>";
                    echo "<div class='title'>" . $result['Concert_Name'] . "</div>"; 
                    echo "<div class='read_more'>";
                        echo "<a href='result_concert.php?q=" . $result['Concert_Name'] . "' target='_self'>Read more</a>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
            ?>
            <script>
                //hover function
                $('.c<?php echo $result['Concert_ID']; ?>').hover(function(){
                    if($(this).hasClass('active'))
                    {
                        $('.c<?php echo $result['Concert_ID']; ?>').removeClass("active");
                    }
                    else
                    {
                        $('.c<?php echo $result['Concert_ID']; ?>').addClass("active");
                    }
                });
            </script>
            <?php
        }
    ?>
</div>

<span class='list-container-title'>Upcoming</span>
<div class="list-container">
    <?php
		while($result2 = mysqli_fetch_assoc($search2))
        {
			echo "<div class='card c" . $result2['Concert_ID'] . "'>";
                echo "<div class='image'>";
                    echo "<img src='" . str_replace("../", "", $result2['Concert_Ver_Image']) . "'>";
                    if($result2['Concert_Status']==1)
                    {
                        echo "<div class='disabled-item' style='top: -300px;left: 67px;'><label class='disabled-word'>Upcoming</label></div>";
                    }
                echo "</div>";
                echo "<div class='content'>";
                    echo "<div class='title'>" . $result2['Concert_Name'] . "</div>"; 
                    echo "<div class='read_more'>";
                        echo "<a href='result_concert.php?q=" . $result2['Concert_Name'] . "' target='_self'>Read more</a>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
            ?>
            <script>
                //hover function
                $('.c<?php echo $result2['Concert_ID']; ?>').hover(function(){
                    if($(this).hasClass('active'))
                    {
                        $('.c<?php echo $result2['Concert_ID']; ?>').removeClass("active");
                    }
                    else
                    {
                        $('.c<?php echo $result2['Concert_ID']; ?>').addClass("active");
                    }
                });
            </script>
            <?php
        }
    ?>
</div>

<?php include "footer.php"; ?>