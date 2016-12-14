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
		empty($FeelingError) &&
		empty($dateError) &&
		empty($NumberofStepsError)
		){

			$date =  new DateTime($_POST['date']);
			$date =  $date->format('Y-m-d');

			saveUserData ($date, $Feeling, $NumberofSteps);

		header("Location: data.php");
		exit();
		}
		
	$users=getUserData();	
?>

<h1>Tänane päev</h1>

<form method="POST">
<br><br>
		<label><h3>Kuupäev</h3></label>
		<input name="date" type="date" value="<?=$date;?>"> <?php echo $dateError; ?>

		<br><br>
		 <label><h3>Enesetunne</h3></label>


			  <input list="Feeling" name="Feeling">
			  <datalist id="Feeling">
				<option value="Suurepärane">
				<option value="Hea">
				<option value="Rahuldav">
				<option value="Halb">
				<option value="Väga halb">
			  </datalist>


		<label><h3>Sammude arv</h3></label>
		<input name="NumberofSteps" type="Numberofsteps" value="<?=$NumberofSteps;?>"> <?php echo $NumberofStepsError; ?>
<br><br>
		<input type="submit" value="Salvesta andmed">
		<br>
		<br>
		
		
<p></p>		
</form>	
<a href="data2.php" class="btn">Mis on minu KMI?</a>
<h2>Minu enesetunne ja liikumisaktiivsus</h2>
<?php 
	
	$html = "<table>";
	
	$html .= "<tr>";
		$html .= "<th>Kuupäev</th>";
		$html .= "<th>Enesetunne</th>";
		$html .= "<th>Sammude arv</th>";
	$html .= "</tr>";
	
	//iga liikme kohta massiivis
	foreach($users as $u){
		
		$html .= "<tr>";
			$html .= "<td>".$u->Date."</td>";
			$html .= "<td>".$u->Feeling."</td>";
			$html .= "<td>".$u->NumberofSteps."</td>";
		$html .= "</tr>";
	}
	
	$html .= "</table>";
	
	echo $html;
	
	
	$listHtml = "<br><br>";
	
	
	
?>
	
	<a href="?logout=1">Logi välja</a>
</p>
</form>
