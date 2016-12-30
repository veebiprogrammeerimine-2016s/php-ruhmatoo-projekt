<?php

	require("../functions.php");
	
	require("../class/User.class.php");
	$User = new User($mysqli);
	
	require("../class/Helper.class.php");
	$Helper = new Helper();
	
	//kas on sisse loginud, kui ei ole, siis suunata login lehele
	
	if (!isset ($_SESSION["userId"])) {
		
		header("Location: login.php");
		exit();
	}
	
	//kas ?logout on aadressireal
	if (isset($_GET["logout"])) {
		
		session_destroy ();
		header ("Location: login.php");
		exit();
	}
	
	//ei ole tühjad väljad, mida salvestada
	if  (isset($_POST["exercise"]) &&
		isset($_POST["sets"]) &&
		isset($_POST["repeats"]) &&
		!empty($_POST["exercise"]) &&
		!empty($_POST["sets"]) &&
		!empty($_POST["repeats"])
		) {
			$User->saveExercise($Helper->cleanInput($_POST["exercise"]), $Helper->cleanInput($_POST["sets"]), $Helper->cleanInput($_POST["repeats"]));
		}
	
	$exercise = "";
	$exerciseError = "";
	$sets = "";
	$setsError = "";
	$repeats = "";
	$repeatsError = "";

	$userData = $User->addToArray();
	//echo $userData;
	//var_dump($userFavorites);
?>
<?php require("../header.php"); ?>

<div class "data" style="padding-left:10px;">
<div align="center"><h1>Minu treeningpäevik</h1>
	<p>
		<a href="data.php">Tagasi avalehele</a><br>
		<a href="?logout=1">Logi välja</a>
	</p>
</div>

<div class="container">
	<div class="row">
			<div class="col-sm-4 col-md-4">

			<h2>Minu andmed</h2>
				
				<p>Eesnimi: <?php echo $userData->firstname;?></p>
				<p>Perekonnanimi: <?php echo $userData->lastname;?></p>
				<p>Kasutaja e-post: <?php echo $userData->email;?></p>
				<p>Sugu: <?php echo $userData->gender;?></p>
				<p>Telefoninumber: <?php echo $userData->phonenumber;?></p>

				<p><a class="btn btn-default btn-sm" href="editUser.php"><span class='glyphicon glyphicon-pencil'></span> Muuda andmeid</a></p>
				<br>

			<h2>Lisa tehtud treening</h2>
				<form method="POST"> 
				<label>Harjutus</label><br>
							
						<input type="text" name="exercise" value="<?=$exercise;?>"> <?php echo $exerciseError;?> <br><br>
					
				<label>Seeria</label><br>
						
						<input type="text" name="sets" value="<?=$sets;?>"> <?php echo $setsError;?> <br><br>
						
				<label>Kordus</label><br>
						
						<input type="text" name="repeats" value="<?=$repeats;?>"> <?php echo $repeatsError;?> <br><br>
					
					<input type="submit" value="Salvesta">	
				</form>
				<br>
			</div>
	

	<div class="col-sm-3 col-md-6">
			<br>
			<head><link rel="stylesheet" href="../calender/lib/css/SimpleCalendar.css" /></head>
			<body>
			<?php
			error_reporting(E_ALL ^ E_WARNING);
			require_once('../calender/lib/donatj/SimpleCalendar.php');

			$calendar = new donatj\SimpleCalendar();

			$calendar->setStartOfWeek('Monday');

			$calendar->addDailyHtml( 'Sample Event', 'today', 'tomorrow' );
			$calendar->show(true);
			?>
			</body>
	</div>
	</div>
</div>


<?php require("../footer.php"); ?>