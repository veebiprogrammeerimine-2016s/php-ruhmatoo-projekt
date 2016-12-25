<?php

	require("../functions.php");

	if(!isset($_SESSION["userId"])) {
		header("Location: login.php");
		exit();
	}
	
	if(isset($_GET["logout"])) {
		session_destroy();
		header("Location: login.php");
		exit();
	}


// georg




























// karl-erik

$images = $Sneakers->getAllImages();











?>

<?php require("../header.php"); ?>


<!-- displayed posts -->

<div class="container">
<?php


	$html = "<div class='row'>";
		
	foreach($images as $i) {
		$html .= "<div class='col-md-3'>";
			$html .= "<div class='thumbnail'>";
				$html .= "<img src='../uploads/".$i->name."'>";
				$html .= "<div class='caption'>";
					$html .= "<h3>Kuulutuse pealkiri</h3>";
					//$html .= "<p>".$i->description."</p>";
					$html .= "<p><a href='#' class='btn btn-primary' role='button'>Vaata</a></p>";
				$html .= "</div>";
			$html .= "</div>";
		$html .= "</div>";
	}
	
	$html .= "</div>";
	
	echo $html;



?>
</div>









































<?php require("../footer.php"); ?>