<?php

require("../../../config.php");

	
	require("class/Plant.class.php");
	require("class/User.class.php");
	require("class/Helper.class.php");
	
	
	//ÜHENDUS
	
	$database = "if16_mreintop";
	$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
	
	
	$User = new User($mysqli);
	$Plant = new Plant($mysqli);
	$Helper = new Helper($mysqli);
	
	// see fail, peab olema kõigil lehtedel kus 
	// tahan kasutada SESSION muutujat
	session_start();
	
	//***************
	//**** SIGNUP ***
	//***************



	
		
	


