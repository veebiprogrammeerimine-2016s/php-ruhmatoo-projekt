<?php
	require_once("../../config.php");
	
	
	
	function getSingleProductData($contactemail){
        $database = "if16_martkasa_2";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		$stmt = $mysqli->prepare("SELECT description, price FROM products WHERE id=?");
		$stmt->bind_param("s", $contactemail);
		$stmt->bind_result($description, $price);
		$stmt->execute();
		
		$product = new Stdclass();
		if($stmt->fetch()){
			$product->description = $description;
			$product->price = $price;
		}else{
			header("Location: data.php");
			exit();
		}
		$stmt->close();
		$mysqli->close();
		return $product;
		
	}
	
	function updateproduct($contactemail, $description, $price){
        $database = "if16_martkasa_2";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		$stmt = $mysqli->prepare("UPDATE products SET description=?, price=? WHERE contactemail=?");
		$stmt->bind_param("sss",$description, $price, $contactemail);
		if($stmt->execute()){
			echo "salvestus õnnestus!";
		}
		$stmt->close();
		$mysqli->close();
		
	}
	
	

	
	
	?>