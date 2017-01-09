<?php

	require_once("../../config.php");
	
	$database = "if16_romil";

	
	function getSingleNoteData($edit_id){
    
		//echo "id on ".$edit_id;
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("SELECT note, color FROM colorNotes WHERE id=?");

		$stmt->bind_param("i", $edit_id);
		$stmt->bind_result($note, $color);
		$stmt->execute();
		
		//tekitan objekti
		$n = new Stdclass();
		
		//saime �he rea andmeid
		if($stmt->fetch()){
			// saan siin alles kasutada bind_result muutujaid
			$n->note = $note;
			$n->color = $color;
			
			
		}else{
			// ei saanud rida andmeid k�tte
			// sellist id'd ei ole olemas
			// see rida v�ib olla kustutatud
			header("Location: data.php");
			exit();
		}
		
		$stmt->close();
		$mysqli->close();
		
		return $n;
		
	}


	function updateNote($id, $note, $color){
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("UPDATE colorNotes SET note=?, color=? WHERE id=?");
		$stmt->bind_param("ssi",$note, $color, $id);
		
		// kas �nnestus salvestada
		if($stmt->execute()){
			// �nnestus
			echo "salvestus �nnestus!";
		}
		
		$stmt->close();
		$mysqli->close();
		
	}
	
	
?>