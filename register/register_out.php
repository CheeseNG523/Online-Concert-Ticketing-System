<?php
	session_start();
    unset($_SESSION['register_email']);
	//session_unset();
	session_destroy();
	header("location: ..\..\concerta\login.php");
?>