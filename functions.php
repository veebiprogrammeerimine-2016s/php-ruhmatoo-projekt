<?php

	require("/home/karlkruu/config.php");
	
	
	//ühendus
	$database = "if16_andralla_2";
	$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
	
	//klassid
	require("class/User.class.php");
	$User=new User($mysqli);
	
	require("class/Upload.class.php");
	$User=new User($mysqli);
	
	require("class/Helper.class.php");
	$Helper=new Helper($mysqli);

	
	//see fail peab olema kõigil lehtedel kus tahan kasutada SESSION muutujat
	session_start();

	
?>