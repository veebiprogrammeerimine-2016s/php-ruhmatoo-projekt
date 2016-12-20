<?php

require("../functions.php");
require("database.php");

//kui ei ole kasutaja id'd
if (!isset($_SESSION["userId"])) {

	//suunan sisselogimise lehele
	header("Location: login.php");
	exit();

}

//kui on ?logout aadressi real siis login välja
if(isset ($_GET["logout"])) {

	session_destroy();
	header("Location:login.php");
	exit();
}

$msg = " ";
if(isset($_SESSION["message"])) {
	$msg = $_SESSION["message"];

	//kui ühe näitame siis kusutua ära, et pärast refreshi ei näita
	unset($_SESSION["message"]);

}


?>




<h1>TV Show Calendar</h1>

<p>
	<h2>Welcome <?=$_SESSION["userName"];?>!</h2>
	<br><br>
	
	<h3>To continue, please add at least one series to your calender!</h3>
	<form method="POST">
	
	
	
	<?php
	//siin peaks saama kasutaja valida loetelust seriaali, mida oma kalendrisse lisada
	?>
	<input name="series" type="text">
	<br><br>
	
	
	
	<input type="submit" value="Save">
	</form>
	
	<a href="?logout=1"> Log out</a>
</p>
