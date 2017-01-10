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
	
	
	

	
?>