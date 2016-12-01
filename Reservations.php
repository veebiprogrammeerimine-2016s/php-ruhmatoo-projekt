<?php

	//require("functions.php");
	require("Header.php");
	
	$reg_nr = "";
	$car_brand = "";
	$car_model = "";
	$reg_nr_Error = "";
	$car_model_Error = "";
	$car_brand_Error = "";
	
	if (isset ($_POST["reg_nr"])) {
		
		if (empty($_POST["reg_nr"])) {
			
			$reg_nr_Error = "Palun sisestage registreerimisnumber";
			
		} else {
			
			$reg_nr = $_POST["reg_nr"];
			
		}
			
	}
	
		if (isset ($_POST["car_brand"])) {
		
			if (empty($_POST["car_brand"])) {
			
				$car_brand_Error = "Palun sisestage enda automark";
			
			} else {
			
				$car_brand = $_POST["car_brand"];
			
			}
		
		}
	
	if (isset($_POST["car_model"])) {
		
		if (empty($_POST["car_model"])) {
			
			$car_model_Error = "Palun sisestage enda automudel";
			
		} else {
			
			$car_model = $_POST["car_model"];
			
		}
		
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Broneerimise leht</title>
	</head>
	<body>
	<div class="container">
		<form method="post">
			<div class="form-group row">
			<div class="col-sm-10">
			<h1>Sõiduki Andmed</h1><br>
			</div>
				<label for="reg_nr" class="col-sm-4 col-form-label">Registreerimisnumber</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="reg_nr">
				</div>
			</div>
		<fieldset class="form-group row">
			<legend class="col-form-legend col-sm-4">Sõiduki tüüp</legend>
				<div class="col-sm-10">
					<div class="form-check">
				<label class="form-check-label">
            <input class="form-check-input" type="radio" name="veichle_types" id="veichle_type1" value="Sõiduauto" checked>
            Sõiduauto
          </label>
        </div>
			<div class="form-check">
				<label class="form-check-label">
            <input class="form-check-input" type="radio" name="veichle_types" id="veichle_type2" value="Maastur">
            Maastur
          </label>
        </div>
			<div class="form-check">
				<label class="form-check-label">
            <input class="form-check-input" type="radio" name="veichle_types" id="veichle_type3" value="Kaubik">
            Kaubik
          </label>
							
		  <br><br>
				
			<div class="form-group row">
				<label for="car_brand" class="col-sm-4 col-form-label">Mark</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="car_brand" id="car_brand">
					</div>
				</div>
				
				<div class="form-group row">
				<label for="car_model" class="col-sm-4 col-form-label">Mudel</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="car_model" id="car_model">
				</div>
			</div>
		
		<br><br>
		
			<h1>Kliendi Andmed</h1>
			<form method="post">
			
		<label for="name" class="col-sm-4 colf-form-label">
		<div class="">
			

		</form>
	</body>
</html>