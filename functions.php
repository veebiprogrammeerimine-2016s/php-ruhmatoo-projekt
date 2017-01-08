<?php

	require("/home/ingomagi/config.php");
	session_start();
	$database = "if16_veinipood";
	$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
	
	
	require("../Class/Helper.class.php");
	$Helper = new Helper();
	
		
	
	
?>