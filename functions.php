<?php


	require("/home/rasmaavi/config.php");
    $database = "if16_Aavister";
    $mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
	
	require("class/Car.class.php");
	$Car = new Car($mysqli);

    require("class/user.class.php");
    $User = new User($mysqli);

	session_start();
	

	function cleanInput($input){
		
		$input = trim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
		
		return $input;
		
	}
	
	function getAll($q, $sort) {

		$allowedSort = ["UserId", "RegPlate", "Mark", "Model"];
		if(!in_array($sort, $allowedSort)) {
			//ei ole lubatud tulp
			$sort = "UserId";
		}

		if($q != "") {

			echo "Otsib: ".$q;

			$stmt = $this->connection->prepare("
			SELECT UserId, RegPlate, Mark, Model
			FROM repairCars
			WHERE deleted IS NULL AND UserId = ?
			AND (RegPlate LIKE ? OR Mark LIKE ? OR Model LIKE ?)
			ORDER BY $sort
			
			");
			$searchWord="%".$q."%";
			$stmt->bind_param("iss", $_SESSION["UserId"], $searchWord, $searchWord);

		} else {
			$stmt = $this->connection->prepare("
			SELECT UserId, RegPlate, Mark, Model
			FROM repairCars
			WHERE deleted IS NULL AND UserId = ?
			ORDER BY $sort 
			");


		}
		echo $this->connection->error;

		$stmt->bind_result($UserId, $RegPlate, $Mark, $Model);
		$stmt->execute();


		//tekitan massiivi
		$result = array();

		// tee seda seni, kuni on rida andmeid
		// mis vastab select lausele
		while ($stmt->fetch()) {

			//tekitan objekti
			$car = new StdClass();

			$car->id = $id;
			$car->plate = $plate;
			$car->carColor = $color;

			//echo $plate."<br>";
			// iga kord massiivi lisan juurde nr m�rgi
			array_push($result, $car);
		}

		$stmt->close();


		return $result;
	}
	
?>