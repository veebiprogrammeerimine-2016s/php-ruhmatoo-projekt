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

<h2>Kontrollige, kas see on broneering, mille tahate kustutada</h2>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		<input type="hidden" name="id" value="<?=$_GET["id"];?>">
		<label for="car_model">Mudel</label><br>
		<textarea id="car_model" name="car_model" rows="2" cols="20"><?php echo $R->Reserv;?></textarea><br><br>
		<label for="car_brand">Mark</label><br>
		<textarea id="car_brand" name="car_brand" rows="2" cols="20"><?php echo $R->Reserv2?></textarea><br><br>
		<label for="reg_nr">Registreerimisnumber</label><br>
		<textarea id="reg_nr" name="reg_nr" rows="2" cols="20"><?php echo $R->Reserv3?></textarea><br><br>
		<label for="date">Kuupäev</label><br>
		<textarea id="date" name="date" rows="2" cols="20"><?php echo $R->Reserv4?></textarea><br><br>
		<label for="time">Kellaaeg</label><br>
		<textarea id="time" name="time" rows="2" cols="20"><?php echo $R->Reserv5?></textarea><br><br>
		
	</form>

<a href="?id=<?=$_GET["id"];?>&delete=true">Kustuta</a><br>
<a href="EditReservations.php">Tagasi</a>