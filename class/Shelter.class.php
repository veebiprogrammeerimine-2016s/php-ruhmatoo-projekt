<?php 
class Shelter {
	
	private $connection;
	
	function __construct($mysqli){
		
		$this->connection = $mysqli;
		
	}
	
function save ($name, $county, $city) {
	
		$stmt = $this->connection->prepare("INSERT INTO g_animalshelters (name, county, city) VALUES (?, ?, ?)");
	
		echo $this->connection->error;
		
		$stmt->bind_param("sss", $name, $county, $city);
		
		if($stmt->execute()) {
			echo "Salvestamine onnestus";
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		
		$stmt->close();
		
		
	}

function get($s, $sort, $order) {
		
		$allowedSort = ["id", "name", "county", "city"];
		
		if(!in_array($sort, $allowedSort)){
			// ei ole lubatud tulp
			$sort = "id";
		}
		
		$orderBy = "ASC";
		
		if ($order == "DESC") {
			$orderBy = "DESC";
		}
		//echo "Sorteerin: ".$sort." ".$orderBy." ";
		
		
		//kas otsib
		if ($s != "") {
			
			echo "Otsib: ".$s;
			
			$stmt = $this->connection->prepare("
				SELECT name, county, city
				FROM g_animalshelters
				AND (name LIKE ? OR county LIKE ? OR city LIKE ?)
				
			");
			$searchWord = "%".$s."%";
			$stmt->bind_param("sss", $searchWord, $searchWord, $searchWord);
			
			
		} else {
			
			$stmt = $this->connection->prepare("
				SELECT id, name, county, city
				FROM g_animalshelters
				ORDER BY $sort $orderBy
			");
			
		}
		
		echo $this->connection->error;
		
		$stmt->bind_result($id, $name, $county, $city);
		$stmt->execute();
		
		
		//tekitan massiivi
		$result = array();
		
		// tee seda seni, kuni on rida andmeid
		// mis vastab select lausele
		while ($stmt->fetch()) {
			
			//tekitan objekti
			$shelter = new StdClass();
			
			$shelter->id = $id;
			$shelter->name = $name;
			$shelter->county = $county;
			$shelter->city = $city;
			

			// iga kord massiivi lisan juurde nr märgi
			array_push($result, $shelter);
		}
		
		$stmt->close();
		
		
		return $result;
	}

function getSingle($edit_id) {

		$stmt = $this->connection->prepare("SELECT name, county, city FROM `g_animalshelters` WHERE id=?");

		$stmt->bind_param("i", $edit_id);
		$stmt->bind_result($name, $county, $city);
		$stmt->execute();
		
		//tekitan objekti
		$Shelter = new Stdclass();
		
		//saime ühe rea andmeid
		if($stmt->fetch()){
			// saan siin alles kasutada bind_result muutujaid
			$Shelter->name = $name;
			$Shelter->county = $county;
			$Shelter->city = $city;
			
			
		}else{
			// ei saanud rida andmeid kätte
			// sellist id'd ei ole olemas
			// see rida võib olla kustutatud
			header("Location: animals.php");
			exit();
		}
		
		$stmt->close();
		
	}
function getAll() {
		
		$database = "if16_Tanelmaas_1";
		$this-> connection= new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
		$stmt = $this-> connection->prepare("
			SELECT id, name
			FROM g_animalshelters
		");
		echo $this-> connection->error;
		
		$stmt->bind_result($id, $name);
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
		
			array_push($result, $i);
		}
		
		$stmt->close();
		
		return $result;
	}
}
?>