<?php

require("../functions.php");

	
	
	if(isset($_GET["logout"])) {
		session_destroy();
		header("Location: sneakermarket.php");
		exit();
	}


// georg




























// karl-erik

$allPosts = $Sneakers->getAllPosts();










require("../header.php");
?>


<!-- ****** KUVATAKSE KÕIKIDE KASUTAJATE POSTITUSED ****** -->
<div class="container">
<?php


	$html = "<div class='row'>";
		
	foreach($allPosts as $p) {
		$html .= "<div class='col-md-3'>";
			$html .= "<div class='thumbnail'>";
				$html .= "<img src='../uploads/".$p->name."'>";
				$html .= "<div class='caption'>";
					$html .= "<h3>".$p->heading."</h3>";
					$html .= "<p>".$p->brand.", ".$p->model.", Suurus ".$p->size."</p>";
					$html .= "<p><a href='post.php?id=".$p->postid."' class='btn btn-primary' role='button'>Vaata</a></p>";
				$html .= "</div>";
			$html .= "</div>";
		$html .= "</div>";
	}
	
	$html .= "</div>";
	
	echo $html;



?>
</div>









































<?php require("../footer.php"); ?>