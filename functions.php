<?php

	require("/home/johalaas/config.php");
	
	
	
	
	//Ühendus
	$database = "if16_johan";
	$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);

	require("../Class/Helper.class.php");
	$Helper = new Helper();
	
	
	// functions.php
	//var_dump($GLOBALS);
	
	// see fail, peab olema kõigil lehtedel kus 
	// tahan kasutada SESSION muutujat
	session_start();
		
	
	
	
	
	
?>