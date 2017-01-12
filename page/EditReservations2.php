<?php

	require("../Functions.php");
	require("../../../config.php");
	require("../Header.php");
	
	
	if(isset($_GET["delete"])) {
	DeleteReservation($_GET["id"]);
	header("Location: EditReservations.php");
	exit();
	
	}

	$R = GetSingleData($_GET["id"]);
?>

<div class="col-lg-8 col-lg-offset-2">
<h1>Kontrollige, kas see on broneering, mille tahate kustutada</h1><br>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		<input type="hidden" name="id" value="<?=$_GET["id"];?>">
		<label for="car_model">Mudel</label><br>
		<textarea id="car_model" name="car_model" rows="1" cols="20"><?php echo $R->Reserv;?></textarea><br><br>
		<label for="car_brand">Mark</label><br>
		<textarea id="car_brand" name="car_brand" rows="1" cols="20"><?php echo $R->Reserv2?></textarea><br><br>
		<label for="reg_nr">Registreerimisnumber</label><br>
		<textarea id="reg_nr" name="reg_nr" rows="1" cols="20"><?php echo $R->Reserv3?></textarea><br><br>
		<label for="date">Kuupäev</label><br>
		<textarea id="date" name="date" rows="1" cols="20"><?php echo $R->Reserv4?></textarea><br><br>
		<label for="time">Kellaaeg</label><br>
		<textarea id="time" name="time" rows="1" cols="20"><?php echo $R->Reserv5?></textarea><br><br>		
	</form>

<a class="btn btn-primary" href="?id=<?=$_GET["id"];?>&delete=true">Kustuta</a><br><br>
<a class="btn btn-primary" href="EditReservations.php">Tagasi</a>
</div>