<?php
	
	//require("../../../../config.php");
	require("Functions.php");
	
	$reg_nr = "";
	$car_brand = "";
	$car_model = "";
	$veichle_type = "";
	$reg_nr_Error = "";
	$car_model_Error = "";
	$car_brand_Error = "";
	$telephone = "";
	$telephone_Error = "";
	
	
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
	
	if (isset($_POST["telephone"])) {
		
		if (empty($_POST["telephone"])) {
			
			$telephone_Error = "Palun sisestage enda automudel";
			
		} else {
			
			$telephone = $_POST["telephone"];
			
		}
		
	}

	if (isset($_POST["veichle_type"])) {
		
		if(empty($_POST["veichle_type"])) {
			
			$veichle_type = $_POST["veichle_type"];
			
		}
		
	}
	
	if (isset($_POST["reg_nr"]) && isset($_POST["veichle_type"]) && isset($_POST["car_brand"]) && isset($_POST["car_model"]) && isset($_POST["telephone"])
	&& empty($reg_nr_Error) && empty($car_brand_Error) && empty($car_model_Error) && empty($telephone_Error)) {
		
		echo "Salvestan...<br>";
		SaveData($reg_nr, $veichle_type, $car_brand, $car_model, $telephone);
		
	}
?>

<?php require("Header.php");?>

	<div class="container">
		<form method="POST">
			<div class="form-group row">
			<div class="col-sm-10">
			<h1>Andmed</h1><br>
			</div>
				<label class="form-check-label">
				<div class="form-group row">
				<label for="reg_nr" class="col-sm-4 col-form-label">Registreerimisnumber</label>
				<div class="col-sm-10">
					<input class="form-control" name="reg_nr">
				</div>
				</label>
				
			</div>
			
			<label class="form-check-label">
			<div class="form-group row">
				<label for="veichle_type" class="col-sm-4 col-form-label">Sõiduki tüüp</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="veichle_type" id="veichle_type">
					</div>
					</label>
				</div>
			
			<label class="form-check-label">
			<div class="form-group row">
				<label for="car_brand" class="col-sm-4 col-form-label">Mark</label>
					<div class="col-sm-10">
						<input class="form-control" name="car_brand" id="car_brand">
					</div>
					</label>
				</div>
				<label class="form-check-label">
				<div class="form-group row">
				<label for="car_model" class="col-sm-4 col-form-label">Mudel</label>
				<div class="col-sm-10">
					<input class="form-control" name="car_model" id="car_model">
				</div>
				</label>
				
				</div>
		<label class="form-check-label">
		<div class="form-group row">
				<label for="telephone" class="col-sm-4 col-form-label">Telefon</label>
				<div class="col-sm-10">
					<input type="tel" class="form-control" name="telephone" id="telephone">
				</div>

				
			
			</label>
			
				</label>
			</div>
			



<table>
			<?php 
							 
			 $limit = 7;
			 $starttime = 9;
			 $endtime = 16;
			 
			$html = "";
			 
			$html .= "<tr>";
			$html .= "<th>kell</th>";
			for($i = 0; $i < $limit; $i++){
				
				$day = date("d.m.Y",mktime(0, 0, 0, date("m")  , date("d")+$i, date("Y")));
				
				//echo $day."<br>";
				$html .= "<th>".$day."</th>";

			}
			
			$html .= "</tr>";
			
			for($j = $starttime; $j <= $endtime; $j++){
				
				if($j < 10){
					$time = "0".$j.":00";
				}else{
					$time = $j.":00";
				}
							
				//echo $day."<br>";
				//echo "<th>".$day."</th>";
				$html .= "<tr>";
				$html .= "<td>".$time."</td>";
				
				// :00
				
				for($k = 0; $k < $limit; $k++){
					
					$day = date("d.m.Y",mktime(0, 0, 0, date("m")  , date("d")+$k, date("Y")));
				
					$day_t = date("d.m.Y",mktime(0, 0, 0, date("m")  , date("d"), date("Y")));

					if(isset($_GET["time"]) && $_GET["time"] == $time && $_GET["date"] == $day ){
						$html .= "<td><a style='height: 19px; display:block; background-color:green;' href='?date=".$day."&time=".$time."'></a></td>";
					}else{
						$html .= "<td><a style='height: 19px; display:block; background-color:gray;' href='?date=".$day."&time=".$time."'></a></td>";
					}
				}
				
				$html .= "</tr>";
				
				if($j < 10){
					$time = "0".$j.":30";
				}else{
					$time = $j.":30";
				}
				
				$html .= "<tr>";
				
				// :30
				
				$html .= "<td>".$time."</td>";
				for($k = 0; $k < $limit; $k++){
					
					$day = date("d.m.Y",mktime(0, 0, 0, date("m")  , date("d")+$k, date("Y")));

					if(isset($_GET["time"]) && $_GET["time"] == $time && $_GET["date"] == $day ){
						$html .= "<td><a style='height: 19px; display:block; background-color:green;' href='?date=".$day."&time=".$time."'></a></td>";
					}else{
						$html .= "<td><a style='height: 19px; display:block; background-color:gray;' href='?date=".$day."&time=".$time."'></a></td>";
					}
				}
				$html .= "</tr>";
				
				
				
				
				

			}
			//var_dump($html);
			echo $html;

			?>
			</table>
			
			
			<br>
			
			<input type="submit" class="btn btn-success">

			

		</form>
	</body>
</html>