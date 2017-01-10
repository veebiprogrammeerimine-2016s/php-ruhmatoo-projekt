<?php 
	// functions.php
	require("/home/juriderk/config.php");
	
	// et saab kasutada $_SESSION muutujaid
	// kõigis failides mis on selle failiga seotud
	session_start(); 
	
	/* ÜHENDUS */
	$db = "if16_derkun_shazza";
	$mysqli = new mysqli($serverHost, $serverUsername,  $serverPassword, $db);
	
?>