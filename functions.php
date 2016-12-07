<?php

	require("/home/marikraav/config.php");
	
	$database = "if16_TREENI";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);

	session_start();
?>