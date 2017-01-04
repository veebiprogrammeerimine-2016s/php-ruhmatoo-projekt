<?php 
	require("../functions.php");
	
	if(!isset ($_SESSION["userId"])) {
		header("Location: login.php");
		exit();
		
	}
	
	if (isset($_GET["logout"])) {
		
		session_destroy();
		header("Location: login.php");
		exit();
		
	}
	
	$msg = " ";
	if(isset($_SESSION["message"])) {
		$msg = $_SESSION["message"];
	
	unset($_SESSION["message"]);
	
		}
	
	
?>