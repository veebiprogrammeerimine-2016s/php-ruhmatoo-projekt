<!--LEHT KASUTAJA MEELEOLUMUUTUSTE JA SAMMUDE ARVU SISESTAMISEKS-->

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
<!--trükitakse kasutaja sisestatud andmed välja-->
<?php require ("header.php"); ?>
<div class="form-group" style="padding-left:75%; padding-top:2%;">
	<a class="btn btn-success" href="?logout=1" role="button">Logi välja</a>
</div>

<div class="col-sm-4 col-md-4">

<h1><font color=#00b33c><strong>Tänane päev</h1></font></strong>
<div class="container">
		<div class="row">
		<div class="col-sm-5 col-md-5">
		
<form method="POST">
<br><br>

<form class="form-horizontal">
		<div class="form-group">
			<label for="inputDate" class="col-sm-4 control-label">Kuupäev</label>
			<div class="col-sm-10">
				<input type="date" class="form-control" id="inputdate" label="Kuupäev">
			</div>
		</div>
		
		
		<br><br>
		 <div class="form-group">
			<label for="inputFeeling" class="col-sm-4 control-label">Enesetunne</label>
			<div class="col-sm-10">
				<input list="Feeling" class="form-control" id="inputFeeling" label="Enesetunne">
			  <datalist id="Feeling">
				<option value="Suurepärane">
				<option value="Hea">
				<option value="Rahuldav">
				<option value="Halb">
				<option value="Väga halb">
			  </datalist>
			</div>
		</div>

		<br><br>
		<div class="form-group">
			<label for="inputNumberofSteps" class="col-sm-4 control-label">Sammude arv</label>
			<div class="col-sm-10">
				<input type="NumberofSteps" class="form-control" id="inputNumberofSteps">
			</div>
		</div>
</form>		
<br><br>
<br><br>
		<a class="btn btn-success" type="submit" role="button">Salvesta andmed</a>
	
		<br>
		<br>
		
<p></p>		
</form>	
</div>

<?php require ("header.php"); ?>
<!--<div class="form-group" style="padding-top:-1%;">
	<a class="btn btn-success" href="?logout=1" role="button">Logi välja</a>
</div>-->
<div class="col-sm-5 col-md-5">

	<h2><font color="#ff9933">Minu enesetunne ja liikumisaktiivsus</h2></font>

	<br><br>
 
<?php	
	$html="<table class='table'>";
	
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
		
</p>
</form>

	<a href="data2.php" class="btn"><h3>Mis on minu KMI?</h3></a>
	
<?php require ("footer.php"); ?>
