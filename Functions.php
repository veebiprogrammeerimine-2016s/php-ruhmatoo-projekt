<?php

	require("../../config.php")
	
	$database = "if16_kliiva"

	
	
	function SaveClientData($Name, $Telephone, $Email, $Add_info) {
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO client_data (Name, Telephone, Email, Additional_info) VALUES (?, ?, ?, ?)");
		echo $mysqli->error;
		
		$stmt->bind_param("siss", $Name, $Telephone, $Email, $Add_info);
		if ($stmt->execute()) {
			
			echo "Salvestamine õnnestus";
			
		} else {
			
			echo "Ilmnes viga".$stmt->error;
			
		}
		
	}
	
	function SaveVeichleData($reg_nr, $veichle_types, $) {
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO veichle_data (Registration_nr, Veichle_type, Veichle_brand, Veichle_model)");
		echo $mysqli->error;
		
		$stmt->bind_param("ssss", $reg_nr, $veichle_types, $car_brand, $car_model);
		if ($stmt->execute()) {
			
			echo "Salvestamine õnnestus";
			
			
		} else {
			
			echo "Ilmnes viga".$stmt->error;
			
		}
	}
?>