<?php

$connect=mysqli_connect("localhost","root","","concerta");
//1.server name 2.username 3.password 4.database name

if($connect)
{
	//echo "Connect Successfully!";
}

else
{
	die("Could not connect".mysqli_error());
}


?>