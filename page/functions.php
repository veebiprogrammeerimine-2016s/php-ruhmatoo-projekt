<?php 

require("../../../config.php");

	$database = "if16_aarovidevik";
	
	
		$id = "";
	$description = "";
	$location = "";
	$date = "";
	$url = "";
		function tabelisse2 ($description, $location, $date, $url) {
		
		$mysqli = new mysqli($GLOBALS["serverHost"],$GLOBALS["serverUsername"],$GLOBALS["serverPassword"],$GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO colorNotes (kirjeldus, asukoht, kuupäev, url)  VALUES (?,?,?,?)");
		
		$stmt->bind_param("ssss", $description, $location, $date,$url);
		
		if ($stmt->execute()) {
			
			echo "Edukalt postitatud! <br>";
		} else {
			echo "ERROR ".$stmt->error;
		}
	}
	


	
	function getAllNature() {
	
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("SELECT id, kirjeldus, asukoht, kuupäev, url FROM colorNotes");
		$stmt->bind_result($id, $description, $location, $date, $url);
		$stmt->execute();
		
		$results = array();
		
		//tsükli sisu tehakse nii mitu korda, mitu rida SQL lausega tuleb
		while($stmt->fetch()) {
			
			$nature = new StdClass();
			$nature->id = $id;
			$nature->description = $description;
			$nature->location = $location;
			$nature->day = $date;
			$nature->url = $url;
	
			
			//echo $color."<br>";
			array_push($results, $nature);
			
		}
		
		return $results;
		
	}
	?>