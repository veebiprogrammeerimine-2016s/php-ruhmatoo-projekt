<?php

	//require("functions.php")
	require("Header.php")
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Broneerimise leht</title>
	</head>
	<body>
	<div class="container">
		<form>
			<div class="form-group row">
			<div class="col-sm-10">
			<h1>Sõiduki Andmed</h1><br>
			</div>
		
				<label for="reg_nr" class="col-sm-4 col-form-label">Registreerimisnumber</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="reg_nr">
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
					<input type="text" class="form-control" id="car_brand">
				</div>
			</div>
				
				<div class="form-group row">
				<label for="car_model" class="col-sm-4 col-form-label">Mudel</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="car_model">
				</div>
			</div>
			
				<fieldset class="">

		</form>
	</body>
</html>