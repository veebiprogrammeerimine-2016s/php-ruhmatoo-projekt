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
	
	$trainingdate = "";
	if(!isset($_GET["date"]) && !isset($_GET["month"]) && !isset($_GET["year"])){
		$trainingdate = "";
	} else {
		$trainingdate = $_GET["date"].'.  '.$_GET["month"].' '.$_GET["year"];
	}
	
	//ei ole tühjad väljad, mida salvestada
	if  (isset($_POST["exercise"]) &&
		isset($_POST["sets"]) &&
		isset($_POST["repeats"]) &&
		isset($_POST["notes"]) &&
		!empty($_POST["exercise"]) &&
		!empty($_POST["sets"]) &&
		!empty($_POST["repeats"]) &&
		!empty($_POST["notes"])
		) {
			$User->saveExercise($trainingdate, $Helper->cleanInput($_POST["exercise"]), $Helper->cleanInput($_POST["sets"]), $Helper->cleanInput($_POST["repeats"]), $Helper->cleanInput($_POST["notes"]));
		}
	
	$exercise = "";
	$exerciseError = "";
	$sets = "";
	$setsError = "";
	$repeats = "";
	$repeatsError = "";
	$notes = "";
	$notesError = "";
	
	if(isset($_GET["q"])) {
		
		//kui otsib, võtame otsisõna aadressirealt
		$q = $_GET["q"];
	} else {
		//kas otsisõna on tühi
		$q = "";
	}
	
	$sort = "id";
	$order = "ASC";
	
	if (isset($_GET["sort"]) && isset($_GET["order"])) {
		$sort = $_GET["sort"];
		$order = $_GET["order"];
	}

	$userData = $User->addToArray();
	$userExercises = $User->get($q, $sort, $order);
	
	$est_gender = "";
	if ($userData->gender == "female") {
		$est_gender = "naine";
	}
	
	if ($userData->gender == "male"){
		$est_gender = "mees";
	}

?>
<?php require("../header.php"); ?>
<?php require("../CSS.php")?>

<div class "data" style="padding-left:10px;">
<div align="center"><h1>Minu treeningpäevik</h1>
	<p>
		<a href="data.php">&larr; Tagasi foorumisse</a><br>
	</p>
</div>

<div class="user" style="padding-left:20px;padding-right:20px"> 
	<div class="row">
			<div class="col-sm-4 col-md-4">

			<h2>Minu andmed</h2>
				
				<p>Eesnimi: <?php echo $userData->firstname;?></p>
				<p>Perekonnanimi: <?php echo $userData->lastname;?></p>
				<p>Kasutaja e-post: <?php echo $userData->email;?></p>
				<p>Sugu: <?php echo $est_gender?></p>
				<p>Telefoninumber: <?php echo $userData->phonenumber;?></p>

				<p><a class="btn btn-default btn-sm" href="editUser.php"><span class='glyphicon glyphicon-pencil'></span> Muuda andmeid</a></p>
				<p><a href="editPassword.php">Muuda parooli</a></p>
				<br>

			<h2>Lisa tehtud treening</h2>
				<p><b>Vali kalendrist kuupäev: </b><?php echo $trainingdate; ?> </p>
				<form method="POST"> 
				<label>Treeningharjutus</label><br>
							
						<input type="text" name="exercise" value="<?=$exercise;?>"> <?php echo $exerciseError;?> <br><br>
					
				<label>Seeria</label><br>
						
						<input type="text" name="sets" value="<?=$sets;?>"> <?php echo $setsError;?> <br><br>
						
				<label>Kordus</label><br>
						
						<input type="text" name="repeats" value="<?=$repeats;?>"> <?php echo $repeatsError;?> <br><br>
					
				<label>Märkmed</label><br>
				
				<textarea cols="40" rows="5" name="notes" value="<?=$notes;?>"></textarea> <?php echo $notesError; ?><br><br>
				
				<input type="submit" value="Salvesta">	
				</form>
				<br>
			</div>
	

	<div class="col-sm-3 col-md-6">
			<br>
			<head></head>
			<body>
			<?php
			error_reporting(E_ALL ^ E_WARNING);
			require_once('../calender/lib/donatj/SimpleCalendar.php');

			$calendar = new donatj\SimpleCalendar();

			$calendar->setStartOfWeek('Monday');

			$calendar->addDailyHtml( 'Täna', 'today');
			$calendar->show(true);
			?>
			</body>
	</div>
	</div>


<h3>Otsi tehtud treeninguid</h3>
<form>
	<input type="search" name="q" value="<?=$q;?>">
	<input type="submit" value="Otsi">
</form>
<br>

<?php

	$html = "<table class='table table-hover'>";

	//TABELI SORTEERIMINE
	$html .= "<tr>";
	
		$exerciseOrder = "ASC";
		$setsOrder="ASC"; 
		$repeatsOrder="ASC"; 
		$createdOrder="ASC";
		$exerciseArrow = "&uarr;";
		$setsArrow = "&uarr;";
		$repeatsArrow = "&uarr;";
		$createdArrow = "&uarr;";

		
		if (isset($_GET["sort"]) && $_GET["sort"] == "exercise") {
			if (isset($_GET["order"]) && $_GET["order"] == "ASC") {
				$exerciseOrder="DESC";
				$exerciseArrow = "&darr;";
			}
		}
		
		if (isset($_GET["sort"]) && $_GET["sort"] == "sets") {
			if (isset($_GET["order"]) && $_GET["order"] == "ASC") {
				$setsOrder="DESC"; 
				$setsArrow = "&darr;";
			}
		}
		
		if (isset($_GET["sort"]) && $_GET["sort"] == "repeats") {
			if (isset($_GET["order"]) && $_GET["order"] == "ASC") {
				$repeatsOrder="DESC";
				$repeatsArrow = "&darr;";
			}
		}
		
		if (isset($_GET["sort"]) && $_GET["sort"] == "training_time") {
			if (isset($_GET["order"]) && $_GET["order"] == "ASC") {
				$createdOrder="DESC";
				$createdArrow = "&darr;";
			}
		}

	$html .= "<thead class='bg-success'>";
		$html .= "<th>
				<a href='?q=".$q."&sort=exercise&order=".$exerciseOrder."'>
					Treeningharjutus".$exerciseArrow."
				</a>
				</th>";
		$html .= "<th>
				<a href='?q=".$q."&sort=sets&order=".$setsOrder."'>
					Seeria ".$setsArrow."
				</a>	
				</th>";
		$html .= "<th>
				<a href='?q=".$q."&sort=repeats&order=".$repeatsOrder."'>
					Kordused ".$repeatsArrow."
				</a>
				</th>";
		$html .= "<th>
				<a href='?q=".$q."&sort=training_time&order=".$createdOrder."'>
					Kuupäev	".$createdArrow."
				</a>
				</th>";
		$html .= "<th>Märkmed</th>";
	$html .= "</tr>";
	$html .= "</thead>";
	
	foreach($userExercises as $p) {
		$html .= "<tr>";
			$html .= "<td>".$p->exercise."</td>";
			$html .= "<td>".$p->sets."</td>";
			$html .= "<td>".$p->repeats."</td>";
			$html .= "<td>".$p->training_time."</td>";
			$html .= "<td>".$p->notes."</td>";
		$html .= "</tr>";	
	}

	$html .= "</table>";
	echo $html;
?>
</div>

<?php require("../footer.php"); ?>