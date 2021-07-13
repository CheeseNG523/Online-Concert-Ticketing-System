<?php
	session_start();
    unset($_SESSION['admin_email']);
	//session_unset();
	session_destroy();
	header("location: ..\login\login.php");
?>