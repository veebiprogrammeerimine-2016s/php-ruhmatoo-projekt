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

<h2> Kasutaja leht</h2>

<h4><a href="data.php"> Esileht</a></h4>
<?=$msg;?>

<p>
	<a href="?logout=1">Logi välja</a>
</p>


<h2>Kasutaja sõidud</h2>
<form method="POST">

  <?php


  	$html = "<table class='table table-striped table-condensed'>";

  		$html .= "<tr>";
			//User ID related
  		$orderId = "ASC";
  		$arr="&darr;";
  		if (isset($_GET["order"]) &&
  		$_GET["order"] == "ASC" &&
  		$_GET["sort"] == "id") {

  			$orderId = "DESC";
  			$arr="&uarr;";
  		}


  			$html .= "<th>
  			<a href='?q=".$r."&sort=id&order=".$orderId."'>

  			User ID ".$arr."

  			</a>

  			</th>";

				//start_location related

  			$orderStart_location = "ASC";
  			$arr="&darr;";

  			if (isset($_GET["order"]) &&
  			$_GET["order"] == "ASC" &&
  			$_GET["sort"] == "start_location") {

  				$orderStart_location = "DESC";
  				$arr="&uarr;";
  			}

  				$html .= "<th>
  				<a href='?q=".$r."&sort=start_location&order=".$orderStart_location."'>

  				Start location ".$arr."
  				</a>

  				</th>";

					//Start_time related
  				$orderStart_time = "ASC";
					$arr="&darr;";
  				if (isset($_GET["order"]) &&
  				$_GET["order"] == "ASC" &&
  				$_GET["sort"] == "start_time") {

  					$orderStart_time = "DESC";

  				}

  					$html .= "<th>
  					<a href='?q=".$r."&sort=start_time&order=".$orderStart_time."'>

  					Start time ".$arr."
  					</a>

  					</th>";

						//Guest_id related
	  				$orderGuest_id = "ASC";
						$arr="&darr;";
	  				if (isset($_GET["order"]) &&
	  				$_GET["order"] == "ASC" &&
	  				$_GET["sort"] == "guest_id") {

	  					$orderGuest_id = "DESC";

	  				}

	  					$html .= "<th>
	  					<a href='?q=".$r."&sort=guest_id&order=".$orderGuest_id."'>

	  					Guest ID ".$arr."
	  					</a>

	  					</th>";



  		$html .= "</tr>";

  		//iga liikme kohta massiivis
  		foreach ($rides as $r) {

  			$html .= "<tr>";
					$html .= "<td>".$r->user_id."</td>";
  				$html .= "<td>".$r->start_location."</td>";
  				$html .= "<td>".$r->start_time."</td>";
					$html .= "<td>".$r->guest_id."</td>";





          $html .= "<td>
  							<a class='btn btn-default btn xs' href='edit.php?id=".$r->user_id."'>
  							edit.php
  							<span class='glyphicon glyphicon-pencil'></span>
  							</a>
  							</td>";

  			$html .= "</tr>";

  		}

  	$html .= "</table>";

  	echo $html;

  ?>

<?php require("../footer.php"); ?>
