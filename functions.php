<?php 
	// functions.php
	require("/home/juriderk/config.php");
	
	// et saab kasutada $_SESSION muutujaid
	// k�igis failides mis on selle failiga seotud
	session_start(); 
	
	/* �HENDUS */
	$db = "if16_derkun_shazza";
	$mysqli = new mysqli($serverHost, $serverUsername,  $serverPassword, $db);
	
?>