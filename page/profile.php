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

<h1>Profile</h1>

<a href="productselect.php">Esileht</a><br>
<a href="data.php">Tooted</a><br>

<h3>	
	Email: <?php $ProfileInfo->profileEmail(); ?><br>
	Gender: <?php $ProfileInfo->profileGender(); ?><br>
	Age: <?php $ProfileInfo->profileAge(); ?><br>
	Created: <?php $ProfileInfo->profileCreated(); ?>
</h3>