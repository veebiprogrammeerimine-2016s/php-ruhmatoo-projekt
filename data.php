<?php
	require("functions.php");
	
	//kas kasutaja on sisse loginud, kui pole, siis suunata login lehele
	
	
	if (!isset($_SESSION["userId"])) {
		
		header("Location: login.php");
		exit();
	}
	
	//kas ?logout on aadressireal
	
	if (isset($_GET["logout"])) {
		
		session_destroy();
		
		header("Location: login.php");
		exit();
		
	}
	
	//muutujad
	$date="";
	$dateError="";
	$Feeling="";
	$FeelingError="";
	$NumberofSteps="";
	$NumberofStepsError="";
	
	//kontrollin, kas kasutaja sisestas andmed
	if(isset($_POST["Feeling"])) {
		if (empty($_POST["Feeling"])){
			$AgeError="See väli on kohustuslik!";
			
		}else {
			$Feeling=$_POST["Feeling"];
		}
		
	}

	if(isset($_POST["date"])) {
		if (empty($_POST["date"])){
			$dateError="See väli on kohustuslik!";
			
		}else {
			$date=$_POST["date"];
		}
		
	}

	if(isset($_POST["NumberofSteps"])) {
		if (empty($_POST["NumberofSteps"])){
			$NumberofStepsError="See väli on kohustuslik!";
			
		}else {
			$NumberofSteps=$_POST["NumberofSteps"];
		}
		
	}

	//ühtegi viga ei olnud ja saan kasutaja andmed salvestada
	if(isset($_POST["Feeling"]) &&
		isset($_POST["date"]) &&
		isset($_POST["NumberofSteps"]) &&
		empty($_POST["FeelingError"]) &&
		empty($_POST["dateError"]) &&
		empty($_POST["NumberofStepsError"])
		){
		
			$date =  new DateTime($_POST['date']);
			$date =  $date->format('Y-m-d');
		
		header("Location: data.php");
		exit();		
		}
?>
	
<h1>Tänane päev</h1>

<form method="POST">
<br><br>
		<label><h3>Kuupäev</h3></label>
		<input name="date" type="date" value="<?=$date;?>"> <?php echo $dateError; ?>
		
		<br><br>
		<label><h3>Enesetunne</h3></label>
		<input name="Feeling" type="Feeling" value="<?=$Feeling;?>"> <?php echo $FeelingError; ?>
		
		<br><br>
		<label><h3>Sammude arv</h3></label>
		<input name="NumberofSteps" type="Numberofsteps" value="<?=$NumberofSteps;?>"> <?php echo $NumberofStepsError; ?>
<br><br>
		<input type="submit" value="Salvesta andmed">
		
<p>
	<a href="?logout=1">Logi välja</a>
</p>		
</form>		

