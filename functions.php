<?php 
	// functions.php
	require("/home/juriderk/config.php");
	require("class/Insert.class.php");
	// et saab kasutada $_SESSION muutujaid
	// k�igis failides mis on selle failiga seotud
	session_start(); 
	
	/* �HENDUS */
	$database = "if16_derkun_shazza";
	$mysqli = new mysqli($serverHost, $serverUsername,  $serverPassword, $database);
	$insert= new insert ($mysqli);
?>