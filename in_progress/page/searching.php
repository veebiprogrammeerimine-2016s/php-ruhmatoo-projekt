<?php

	require("../functions.php");
	
    require("../class/Helper.class.php");
	$Helper = new Helper();
	
	require("../class/Note.class.php");
	$Note = new Note($mysqli);
	
	
	$q = "";
	
	if(isset($_POST["q"])&&($_POST["q"]!="")){
		$q = $Helper->cleanInput($_POST["q"]);
	}
	
	$sort = "id";
	$order = "ASC";
	
	if(isset($_POST["sort"]) && isset($_POST["order"])){
		$sort = $_POST["sort"];
		$order = $_POST["order"];
	}
	
	
	$notes = $Note->getAllNotes($q, $sort, $order); 

?>
<html>
	<head>
		<title>Search your device</title>
	</head>
	<body>
		<form method="POST"><br>
		<h1>Enter the serialnumber of your device or RMA number:</h1><br>
		
		<input type="search" name="q" value="<?=$q;?>">
		<br><br>
		<input type="submit" value="Search">
			
		</form>

</html>
<?php 
if($q != "") {

	$html = "<table border=1 class='table'>";
		
				
		$html .= "</tr>";

			$html .= "<th>RMA";
			$html .= "<th>Manufacturer";
			$html .= "<th>Model";
			$html .= "<th>Device";
			$html .= "<th>Serialnumber";
			$html .= "<th>Status";
			
			
			
	foreach ($notes as $note) {
		$html .= "<tr>";

			$html .= "<td>".$note->rma."</td>";
			$html .= "<td>".$note->manufacturer."</td>";
			$html .= "<td>".$note->model."</td>";
			$html .= "<td>".$note->device."</td>";
			$html .= "<td>".$note->serialnumber."</td>";
			$html .= "<td>".$note->status."</td>";

		$html .= "</tr>";
	}
	

	$html .= "</table>";
	
	echo $html;
	
}

?>


