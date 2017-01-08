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


	if(isset($_GET["sort"]) && isset($_GET["direction"])){
		$sort=$_GET["sort"];
		$direction=$_GET["direction"];
		
	}else{
		$sort="contactemail";
		$direction="ascending";
	}
	
	if(isset($_GET["q"])){
		
		$q = $Helper->cleanInput($_GET["q"]);
		
		//$sneakerdata=$Sneakers->getallsneakers($q, $sort, $direction);
		
	}else{
		
		$q="";
		//$sneakerdata=$Sneakers->getallsneakers($q, $sort, $direction);

	}










?>



<?php require("../header.php"); ?>





<div class="container">
	
	
	<ul class="nav nav-tabs">
		<li role="presentation"><a href="createpost.php">Uus kuulutus</a></li>
		<li role="presentation" class="active"><a href="#">Minu kuulutused</a></li>
	</ul>




<!--
	<h2>Market</h2>
	<form>
		<input type="search" name="q" value="<?=$q;?>">
		<input type="submit" value="Search"><br><br>
	</form>
-->
	

	
<?php
/*
		$direction="ascending";
		if(isset($_GET["direction"])){
			if($_GET["direction"] == "ascending"){
				$direction = "descending";
			}
		}

		$html = "<table class='table table-striped table-bordered'>";
		
		$html .= "<tr>";
			$html .= "<th><a href='?q=".$q."&sort=contactemail&direction=".$direction."'>Contact E-Mail</a></th>";
			$html .= "<th><a href='?q=".$q."&sort=description&direction=".$direction."'>Description</a></th>";
			$html .= "<th><a href='?q=".$q."&sort=price&direction=".$direction."'>Price ($)</a></th>";
		$html .= "</tr>";
		
		foreach($sneakerdata as $c) {
			
			$html .= "<tr>";
				$html .= "<td>".$c->contactemail."</td>";
				$html .= "<td>".$c->description."</td>";
				$html .= "<td>".$c->price."</td>";
				//$html .= "<td><a href='edit.php?contactemail=".$c->contactemail."'>edit.php</a></td>";
			$html .= "</tr>";
			
		}

		$html .= "</table>";

		echo $html;

*/
?>


	<div>
		<h3></h3>
	</div>

	<div class="panel panel-default">
		

<?php

$myPosts = $Sneakers->getAllMyPosts();

$direction = "ascending";

	if(isset($_GET["direction"])) {
		if($_GET["direction"] == "ascending") {
			$direction = "descending";
		}
	}


	$html = "<table class='table table-hover table-bordered'>";
			
		$html .= "<thead>";
			$html .= "<tr>";
				$html .= "<th><a href='?q=".$q."&sort=heading&direction=".$direction."'>Pealkiri</a></th>";
				$html .= "<th><a href='?q=".$q."&sort=model&direction=".$direction."'>Mudel</a></th>";
				$html .= "<th><a href='?q=".$q."&sort=price&direction=".$direction."'>Hind</a></th>";
				$html .= "<th><a href='?q=".$q."&sort=description&direction=".$direction."'>Kirjeldus</a></th>";
				$html .= "<th style='width:50px'>Muuda</th>";
			$html .= "</tr>";
		$html .= "</thead>";
		
		foreach($myPosts as $mp) {
			
			$html .= "<tr>";
				$html .= "<td>".$mp->heading."</td>";
				$html .= "<td>".$mp->model."</td>";
				$html .= "<td>".$mp->price."</td>";
				$html .= "<td>".$mp->description."</td>";
				$html .= "<td><a href='editpost.php?id=".$mp->postid."'><span class='glyphicon glyphicon-pencil'></span></td>";
			$html .= "</tr>";
		}

	$html .= "</table>";

	echo $html;









?>

	</div>










</div>






















<?php require("../footer.php"); ?>