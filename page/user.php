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

  $msg = "";

	if(isset($_SESSION["message"])){
		$msg = $_SESSION["message"];

		//kui ühe näitame siis kustuta ära, et pärast refreshi ei näitaks
		unset($_SESSION["message"]);
	}

  if ( isset($_POST["getUser"]) &&
		!empty($_POST["getUser"])
	  ) {

		echo $_POST["getUser"];
		$Rides->getUser($Helper->cleaninput($_POST["getUser"]));

	}
    $rides = $Rides->getUser();


    if(isset($_GET["r"])) {
  		$r = $_GET["r"];

  	} else {
  		//ei otsi
  		$r = "";
  	}

  	$sort = "id";
  	$order = "ASC";

  	if (isset($_GET["sort"]) && isset($_GET["order"])) {
  		$sort = $_GET["sort"];
  		$order = $_GET["order"];

  	}

  	$rides = $Rides->getUser();


?>

<?php require("../header.php"); ?>

<h2> Your page</h2>
<p>
	<a href="?logout=1">Log out</a>
</p>

<br>

<h4><a href="data.php"> Back</a></h4>
<?=$msg;?>

<h4><a href="youDrive.php">YouDrive</a></h4>

<h4><a href="youPassenger.php">YouPassenger</a></h4>


<?php require("../footer.php"); ?>
