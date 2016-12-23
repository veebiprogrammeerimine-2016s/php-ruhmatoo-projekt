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

  $rides = $Rides->getUser($r, $sort, $order);


?>

<?php require("../header.php"); ?>

<h2> YouDrive</h2>

<h4><a href="user.php"> Back</a></h4>
<?=$msg;?>

<h2>Search </h2>

<form>
	<input type="search" name="r" value="<?=$r;?>">
	<input type="submit" value="Search">
</form>


<h2>Registered rides</h2>

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

  			Ride ID ".$arr."

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
						$arr="&uarr;";

  				}

  					$html .= "<th>
  					<a href='?q=".$r."&sort=start_time&order=".$orderStart_time."'>

  					Start time ".$arr."
  					</a>

  					</th>";

						//Guest_id related
	  				$orderArrival_location = "ASC";
						$arr="&darr;";
	  				if (isset($_GET["order"]) &&
	  				$_GET["order"] == "ASC" &&
	  				$_GET["sort"] == "arrival_location ") {

	  					$orderArrival_location  = "DESC";
							$arr="&uarr;";

	  				}

	  					$html .= "<th>
	  					<a href='?q=".$r."&sort=arrival_location &order=".$orderArrival_location ."'>

	  					Arrival location ".$arr."
	  					</a>

	  					</th>";

							$orderArrival_time= "ASC";
							$arr="&darr;";
							if (isset($_GET["order"]) &&
							$_GET["order"] == "ASC" &&
							$_GET["sort"] == "arrival_time") {

								$orderArrival_time = "DESC";
								$arr="&uarr;";

							}

								$html .= "<th>
								<a href='?q=".$r."&sort=arrival_time&order=".$orderArrival_time."'>

								Time of arrival ".$arr."
								</a>

								</th>";

								$orderFree_seats= "ASC";
								$arr="&darr;";
								if (isset($_GET["order"]) &&
								$_GET["order"] == "ASC" &&
								$_GET["sort"] == "free_seats") {

									$orderFree_seats = "DESC";
									$arr="&uarr;";

								}

									$html .= "<th>
									<a href='?q=".$r."&sort=free_seats&order=".$orderFree_seats."'>

									Free seats ".$arr."
									</a>

									</th>";

									$orderGuest_name= "ASC";
									$arr="&darr;";
									if (isset($_GET["order"]) &&
									$_GET["order"] == "ASC" &&
									$_GET["sort"] == "guest_name") {

										$orderGuest_name = "DESC";
										$arr="&uarr;";

									}

										$html .= "<th>
										<a href='?q=".$r."&sort=guest_name&order=".$orderGuest_name."'>

									 Passenger ".$arr."
										</a>

										</th>";

										$orderGuest_email = "ASC";
										$arr="&darr;";
										if (isset($_GET["order"]) &&
										$_GET["order"] == "ASC" &&
										$_GET["sort"] == "guest_email") {

											$orderGuest_email = "DESC";
											$arr="&uarr;";

										}

										$html .= "<th>
										<a href='?q=".$r."&sort=guest_email&order=".$orderGuest_email."'>

									 Passenger email ".$arr."
										</a>

										</th>";



										$html .= "<th>

									 Edit ride
										</a>

										</th>";

  		$html .= "</tr>";

  		//iga liikme kohta massiivis
  		foreach ($rides as $r) {

  			$html .= "<tr>";
					$html .= "<td>".$r->ride_id."</td>";
  				$html .= "<td>".$r->start_location."</td>";
  				$html .= "<td>".$r->start_time."</td>";
					$html .= "<td>".$r->arrival_location."</td>";
					$html .= "<td>".$r->arrival_time."</td>";
					$html .= "<td>".$r->free_seats."</td>";
					$html .= "<td>".$r->guest_name."</td>";
					$html .= "<td>".$r->guest_email."</td>";

          $html .= "<td>


  							<a class='btn btn-default btn xs' href='edit.php?id=".$r->ride_id."'>
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
