<?php 
	// et saada ligi sessioonile
	require("../functions.php");
	
    require("../class/Helper.class.php");
	$Helper = new Helper();
	
	require("../class/Note.class.php");
	$Note = new Note($mysqli);
	
	//ei ole sisseloginud, suunan login lehele
	if(!isset ($_SESSION["userId"])) {
		header("Location: login.php");
		exit();
	}
	
	//kas kasutaja tahab välja logida
	// kas aadressireal on logout olemas
	if (isset($_GET["logout"])) {
		
		session_destroy();
		
		header("Location: login.php");
		exit();
	}
	
	if (	isset($_POST["note"]) && 
			isset($_POST["color"]) && 
			!empty($_POST["note"]) && 
			!empty($_POST["color"]) 
	) {
		
		$note = $Helper->cleanInput($_POST["note"]);
		$color = $Helper->cleanInput($_POST["color"]);
		
		$Note->saveNote($note, $color);
		
	}
	
	
	$q= "";
	if(isset($_GET["q"])){
		$q=$Helper->cleanInput($_GET["q"]);
		
	}
	
	$sort = "id";
	$order = "ASC";
	
	if(isset($_GET["sort"]) && isset($_GET["order"])){
		$sort = $_GET["sort"];
		$order = $_GET["order"];
	}
	
	
	$notes = $Note->getAllNotes($q, $sort, $order);
	
	
	//echo "<pre>";
	//var_dump($notes);
	//echo "</pre>";

?>
<?php require("header2.php");?>


	
<!DOCTYPE html>
<html>
	<head>

		<title>iKala - esileht</title>
		<link rel="stylesheet" type="text/css" href="disain.css">
	</head>
	<body >
	   
<h1>Tere tulemast <a href="user.php"><?=$_SESSION["userEmail"];?></a>!</h1>

<form method="POST" id="sisestus">

	<input id="kirjeldus" class ="form-control" name="description" placeholder="Kirjeldus" type="text"> <br>
	<input id="Asukoht"class ="form-control" name="location" placeholder="Asukoht" type="text"> <br>
	<input id="Kuupäev"class ="form-control" name="date" placeholder="Kuupäev" type="text"> <br>
	<input id="Pilt"class ="form-control" name="url" placeholder="Pilt" type="text"> <br>
	<input class="btn btn-success btn-sm hidden-xs" type="submit" value="Postita">
</form>





<?php 

	//iga liikme kohta massiivis
	foreach ($notes as $n) {
		
		$style = "width:100px; 
				  float:left;
				  min-height:100px; 
				  border: 1px solid gray;
				  background-color: ".$n->noteColor.";";
		
		echo "<p style='  ".$style."  '>".$n->note."</p>";
	}


?>


<h2 style="clear:both;">Tabel</h2>
<?php 
	$html = "<table class='table'>";
		
		$html .= "<tr>";
		
			$orderId = "ASC";
			
			if (isset($_GET["order"]) && 
				$_GET["order"] == "ASC" && 
				$_GET["sort"] == "id" ){
				
				$orderId = "DESC";
			}
		
			$html .= "<th>
			
						<a href='?q=".$q."&sort=id&order=".$orderId."'>
							id
						</a>
					</th>";
			
			$orderNote = "ASC";
			
			if (isset($_GET["order"]) && 
				$_GET["order"] == "ASC" && 
				$_GET["sort"] == "note" ){
				
				$orderNote = "DESC";
			}
		
			$html .= "<th>
			
						<a href='?q=".$q."&sort=note&order=".$orderNote."'>
							Märkus
						</a>
					</th>";
						
			
			
			$orderColor = "ASC";
			
			if (isset($_GET["order"]) && 
				$_GET["order"] == "ASC" && 
				$_GET["sort"] == "color" ){
				
				$orderColor = "DESC";
			}
		
			$html .= "<th>
			
						<a href='?q=".$q."&sort=color&order=".$orderColor."'>
							Värv
						</a>
					</th>";
					
		$html .= "</tr>";
	foreach ($notes as $note) {
		$html .= "<tr>";
			$html .= "<td>".$note->id."</td>";
			$html .= "<td>".$note->note."</td>";
			$html .= "<td>".$note->noteColor."</td>";
			$html .= "<td><a href='edit.php?id=".$note->id."'><span class='glyphicon-pencil>'<span> edit.php</a></td>";
		$html .= "</tr>";
	}
	
	$html .= "</table>";
	
	echo $html;

	
	echo $html;

?>
<?php require("../booter.php");?>


