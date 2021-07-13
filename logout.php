<?php
	session_start();
    unset($_SESSION['email']);
	//session_unset();
	session_destroy();
	header("location: login.php");
?>