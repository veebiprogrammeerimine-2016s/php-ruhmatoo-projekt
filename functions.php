<?php

	require("/home/karlkruu/config.php");
	
	
	//�hendus
	$database = "if16_andralla_2";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
	
	//klassid
	require("class/User.class.php");
	$User=new User($mysqli);
	
	require("class/Upload.class.php");
	$User=new User($mysqli);
	
	require("class/Helper.class.php");
	$Helper=new Helper($mysqli);

	
	//see fail peab olema k�igil lehtedel kus tahan kasutada SESSION muutujat
	session_start();

	
?>