<?php

require("../functions.php");

	if(isset($_SESSION["userId"])) {
		header("Location: productselect.php");
		exit();
	}


$allPosts = $Products->getAllPosts();


?>

<?php require("../header.php"); ?>


<!--  K�ikide kasutajate postitused -->

<div class="container">
<?php


	$html = "<div class='row'>";
		
	foreach($allPosts as $p) {
		$html .= "<div class='col-md-3'>";
			$html .= "<div class='thumbnail'>";
				$html .= "<img src='uploads/".$p->name."'>";
				$html .= "<div class='caption'>";
					$html .= "<h3>".$p->heading."</h3>";
					$html .= "<p>".$p->description."</p>";
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