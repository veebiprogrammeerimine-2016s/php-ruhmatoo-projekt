<?php

	require("/home/railtoom/config.php");

	//see fail peab olema seotud kõigiga kus tahame sessiooni kasutada, saab kasutada nüüd $_session muutujat
	session_start();
	$database = "if16_raily_4_projekt";
	///ainus koht kust andmebaasi ühendus
	$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);

?>
