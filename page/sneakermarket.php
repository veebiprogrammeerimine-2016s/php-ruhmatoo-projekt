<?php

require("../functions.php");

	
	
	if(isset($_GET["logout"])) {
		session_destroy();
		header("Location: sneakermarket.php");
		exit();
	}


// georg



if(isset($_GET["q"])){
		
		$q = $Helper->cleanInput($_GET["q"]);
		
		$allPosts = $Sneakers->getAllPosts($q);
		
	}else{
		
		$q="";
		$allPosts = $Sneakers->getAllPosts($q);

	}





















// karl-erik

//$allPosts = $Sneakers->getAllPosts();










require("../header.php");
?>
<div class="col-sm-6 col-sm-offset-3">
	<div class="panel panel-default">
		<div class="panel-body">
			<form>
				<div class="col-lg-12">
					<div class="input-group">
					  <input type="search" class="form-control" placeholder="Otsi" name="q" value="<?=$q;?>">
					  <span class="input-group-btn">
						<input class="btn btn-primary" type="submit" value="Otsi!" >
					  </span>
					</div>
				  </div>
				</div>
			</form>
		</div>
	</div>
</div>
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