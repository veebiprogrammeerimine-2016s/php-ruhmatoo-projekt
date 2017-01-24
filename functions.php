<?php
	
	require("/home/martkasa/config.php");
	
	$database="if16_martkasa2";
	$mysqli=new mysqli($serverHost, $serverUsername, $serverPassword, $database);
	
	session_start();
	
	require("../class/user.class.php");
	$User=new User($mysqli);
	require("../class/interest.class.php");
	$Interest=new Interest($mysqli);
	require("../class/products.class.php");
	$Products=new Products($mysqli);
	require("../class/profileinfo.class.php");
	$ProfileInfo=new ProfileInfo($mysqli);
	require("../class/helper.class.php");
	$Helper=new Helper($mysqli);
		
?>

