<?php

	
	require("../functions.php");

	//kui ei ole kasutaja id'd
	if (!isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: login.php");
		exit();
	}
	
	$productdata=$Products->getalluproducts();


?>
<?php require("../header.php"); ?>
