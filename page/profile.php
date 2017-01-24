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
<h1>Market</h1>
<?php

	$html = "<table>";
	
	$html .= "<tr>";
		$html .= "<th>Contact E-Mail</th>";
		$html .= "<th>Description</th>";
		$html .= "<th>Price (€)</th>";
	$html .= "</tr>";
	
	foreach($productdata as $p) {
		
		$html .= "<tr>";
			$html .= "<td>".$p->contactemail."</td>";
			$html .= "<td>".$p->description."</td>";
			$html .= "<td>".$p->price."</td>";
		$html .= "</tr>";
	}
	$html .= "</table>";
	echo $html;
?>
<?php require("../footer.php"); ?>
