<?php


require("../functions.php");

	if(!isset($_SESSION["userId"])){
		header("Location: login.php");
		exit();
	}

	if(isset($_GET["logout"])){
		session_destroy();
		header("Location: login.php");
		exit();
	}




















require("../header.php");
?>



<div class="container">

	<div>
		<h3></h3>
	</div>

	<div class="panel panel-default">
	
	
<?php

$flaggedPosts = $Sneakers->getAllFlaggedPosts();

$html = "<table class='table table-hover table-bordered'>";
			
		$html .= "<thead>";
			$html .= "<tr>";
				$html .= "<th>Pealkiri</a></th>";
				$html .= "<th style='width:50px'>Muuda</th>";
			$html .= "</tr>";
		$html .= "</thead>";
		
		foreach($flaggedPosts as $fp) {
			
			$html .= "<tr>";
				$html .= "<td><a href='post.php?id=".$fp->postid."'>".$fp->postid."</a></td>";
				$html .= "<td><a href='adminedit.php?id=".$fp->postid."'><span class='glyphicon glyphicon-pencil'></span></a></td>";
			$html .= "</tr>";
		}

	$html .= "</table>";

	echo $html;








?>	
	
	
	
	
	
	
	
	
	
	</div>
</div>	























