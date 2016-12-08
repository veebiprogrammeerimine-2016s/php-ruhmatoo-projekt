<?php

	require("../../config.php");
	
	$database = "if16_kliiva";

	
	
	function SaveFeedback($Name, $Telephone, $Email, $Add_info) {
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO feedback_data (Name, Email, Telephone, Additional_info) VALUES (?, ?, ?, ?)");
		echo $mysqli->error;
		
		$stmt->bind_param("siss", $Name, $Email, $Telephone, $Add_info);
		if ($stmt->execute()) {
			
			echo "Salvestamine õnnestus";
			
		} else {
			
			echo "Ilmnes viga".$stmt->error;
			
		}
		
	}
	
	function SaveData($reg_nr, $veichle_types, $car_brand, $car_model, $telephone) {
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO data_car_and_client (Registration_nr, Veichle_type, Veichle_brand, Veichle_model, Telephone)");
		echo $mysqli->error;
		
		$stmt->bind_param("ssssi", $reg_nr, $veichle_types, $car_brand, $car_model, $telephone);
		if ($stmt->execute()) {
			
			echo "Salvestamine õnnestus";
			
			
		} else {
			
			echo "Ilmnes viga".$stmt->error;
			
		}
	}
?>