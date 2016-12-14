<?php

	require("../functions.php");

	require("../class/Helper.class.php");
$Helper = new Helper();

require("../class/Rides.class.php");
$Rides = new Rides($mysqli);

	//kui ei ole kasutaja id'd
	if (!isset($_SESSION["userId"])){

		//suunan sisselogimise lehele
		header("Location: login.php");
		exit();
	}


	//kui on ?logout aadressireal siis login välja
	if (isset($_GET["logout"])) {

		session_destroy();
		header("Location: login.php");
		exit();
	}

?>

<?php require("../header.php"); ?>

<h2> Your page</h2>
<p>
	<a href="?logout=1">Log out</a>
</p>

<br>

<h4><a href="data.php"> Back</a></h4>


<h4><a href="youDrive.php">YouDrive</a></h4>

<h4><a href="youPassenger.php">YouPassenger</a></h4>


<?php require("../footer.php"); ?>
