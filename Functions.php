<?php 

	require("../../../config.php");
	
	$database = "if16_kliiva";


	function SaveReservation($reg_nr, $veichle_type, $car_brand, $car_model, $telephone_nr, $date, $time) {
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("INSERT INTO Reservation_Data (Registration_Nr, Veichle_Type, Car_Brand, Car_Model, Telephone_Nr, Reserved_Date, Reserved_Time) VALUES (?, ?, ?, ?, ?, ?, ?) ");
		echo $mysqli->error;
		
		$stmt->bind_param("ssssiss", $reg_nr, $veichle_type, $car_brand, $car_model, $telephone_nr, $date, $time);
		if($stmt->execute()) {
			
			echo "Salvestamine õnnestus";
			
		} else {
			
			echo "Ilmnes viga ".$stmt->error;
			
		}
		
	}
	
	
	function CleanInput($input) {
		
		$input = trim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
		
		return $input;
		
	}
	
	
	function GetAllReservations() {
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT id, Registration_Nr, Veichle_Type, Car_Brand, Car_Model, Telephone_Nr, Reserved_Date, Reserved_Time FROM Reservation_Data WHERE deleted IS NULL");
		echo $mysqli->error;
		
		$stmt->bind_result($id, $reg_nr, $veichle_type, $car_brand, $car_model, $telephone_nr, $date, $time);
		$stmt->execute();
		
		$result = array();
		
		while($stmt->fetch()) {
			
			$object = new StdClass();
			$object->id = $id;
			$object->reg_nr = $reg_nr;
			$object->veichle_type = $veichle_type;
			$object->car_brand = $car_brand;
			$object->car_model = $car_model;
			$object->telephone_nr = $telephone_nr;
			$object->r_date = $date;
			$object->r_time = $time;
			
			array_push($result, $object);
		}
		
		return $result;
		
	}
	
	function DeleteReservation($id) {
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("UPDATE Reservation_Data SET deleted=NOW() WHERE id=? AND deleted IS NULL");
		
		$stmt->bind_param("i", $id);
		
		if($stmt->execute()) {
			
			echo "Õnnestus!";
			
		}
		
	}
	
	function GetSingleData($edit_id) {
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT Car_Model, Car_Brand, Registration_Nr, Reserved_Time, Reserved_Date FROM Reservation_Data WHERE id=? AND deleted IS NULL");
		
		$stmt->bind_param("i", $edit_id);
		$stmt->bind_result($RData1, $RData2, $RData3, $RData4, $RData5);
		$stmt->execute();
		
		$R = new StdClass();
		
		if($stmt->fetch()) {
			
			$R->Reserv = $RData1;
			$R->Reserv2 = $RData2;
			$R->Reserv3 = $RData3;
			$R->Reserv4 = $RData4;
			$R->Reserv5 = $RData5;
			
		} else {
			
			header("Location: EditReservations2.php");
			exit();
			
		}
		
		return $R;
		
	}

	
?>