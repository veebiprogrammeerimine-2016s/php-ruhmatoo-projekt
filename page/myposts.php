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
		
	if(isset($_GET["sort"]) && isset($_GET["direction"])) {
		$sort = $_GET["sort"];
		$direction = $_GET["direction"];
	} else {
		$sort = "heading";
		$direction = "ascending";
	}

require("../header.php");
?>

<div class="container">
	<ul class="nav nav-pills nav-stacked">
		<li role="presentation"><a href="createpost.php">Uus toote lisamine</a></li>
		<li role="presentation" class="active"><a href="#">Minu üleslaetud kuulutuste vaatamine</a></li>
	
	</ul>
	<br><br>
	
	<div class="panel panel-info">
<?php

$myPosts = $Products->getAllMyPosts($sort, $direction);
$direction = "ascending";

	if(isset($_GET["direction"])) {
		if($_GET["direction"] == "ascending") {
			$direction = "descending";
		}
	}
	$html = "<table class='table table-hover table-bordered'>";
			
		$html .= "<thead>";
			$html .= "<tr>";
				$html .= "<th><a href='?sort=heading&direction=".$direction."'>Toote nimi</a></th>";
				$html .= "<th><a href='?sort=price&direction=".$direction."'>Hind</a></th>";
				$html .= "<th><a href='?sort=description&direction=".$direction."'>Lühikirjeldus</a></th>";
				$html .= "<th style='width:250px'>Muuda</th>";
			$html .= "</tr>";
		$html .= "</thead>";
		
		foreach($myPosts as $mp) {
			
			$html .= "<tr>";
				$html .= "<td><a href='post.php?id=".$mp->postid."'>".$mp->heading."</a></td>";
				$html .= "<td>".$mp->price."</td>";
				$html .= "<td>".$mp->description."</td>";
				$html .= "<td><a href='editpost.php?id=".$mp->postid."'><span class='glyphicon glyphicon-cog'></span></a></td>";
			$html .= "</tr>";
		}
	$html .= "</table>";

	echo $html;

?>
	</div>
</div>

<?php require("../footer.php"); ?>