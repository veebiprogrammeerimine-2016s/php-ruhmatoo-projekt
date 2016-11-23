<?php 
class Shelter {
	
	private $connection;
	
	function __construct($mysqli){
		
		$this->connection = $mysqli;
		
	}
	
function save

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
				SELECT id, name, county, city
				FROM g_animalshelters
				AND (name LIKE ? OR county LIKE ? OR city LIKE ?)
				ORDER BY $sort $orderBy
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
		
		$stmt->bind_result($id, $city, $county, $city);
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
