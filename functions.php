<?php

require("../../config.php");


function getAllTyreFittings() {
		
		$database = "if16_stanislav";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		$stmt = $mysqli->set_charset("utf8");
		$stmt = $mysqli->prepare("
			SELECT id,name, logo, LEFT(description, 100),owner_id
			FROM p_tyre_fittings
		");
		echo $mysqli->error;
		
		$stmt->bind_result($id,$name,$logo,$description, $owner_id);
		$stmt->execute();
		
		
		//tekitan massiivi
		$result = array();
		
		// tee seda seni, kuni on rida andmeid
		// mis vastab select lausele
		while ($stmt->fetch()) {
			
			//tekitan objekti
			$i = new StdClass();
			
			$i->id = $id;
			$i->name = $name;
			$i->logo = $logo;
			$i->description = $description;
			$i->owner_id = $owner_id;
		
			array_push($result, $i);
		}
		$stmt->close();
		$mysqli->close();
		
		return $result;
}

function signUP($username,$password)
	{
		
		$database = "if16_stanislav";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		$stmt = $mysqli->set_charset("utf8");
		// sqli rida
		$stmt = $mysqli->prepare("INSERT INTO p_owners (username,password) VALUES (?,?)");
		
		
		echo $mysqli->error;
		
		// stringina üks täht iga muutuja kohta (?), mis tüüp
		// string - s
		// integer - i
		// float (double) - d
		$stmt->bind_param("ss",$username,$password); // sest on email ja password VARCHAR - STRING , ehk siis email - s, password - sa
		
		//täida käsku
		if($stmt->execute())
		{
			
		}
		else
		{
			echo "ERROR ".$stmt->error;
		}
		
		//panen ühenduse kinni
		$stmt->close();
		
	}
	
?>

