<?php

	require("/config.php");
	
	$database = "...";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);

	session_start();
?>