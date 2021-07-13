<?php
$connect=mysqli_connect("localhost","root","","concerta");
//"server name", "username", "password", "database name"
if($connect)
{
	//echo "Connect Successfully!";
}
else
{
	die("Could not connect".mysqli_error());
}	
?>