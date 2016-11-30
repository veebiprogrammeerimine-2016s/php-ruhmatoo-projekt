<?php
class Rides {

  private $connection;

  //käivitatakse siis kui on = new User(see j6uab siia)
  function __construct($mysqli) {
    //this viitab sellele klassile ja selle klassi muutujale

    $this->connection = $mysqli;
  }


  function get() {

    $stmt = $this->connection->prepare("
      SELECT id, user_id, start_location, start_time, arrival_location,
      arrival_time, free_seats, price, added
      FROM cp_rides
    ");
    echo $this->connection->error;

    $stmt->bind_result($id, $user_id, $start_location, $start_time, $arrival_location,
    $arrival_time, $free_seats, $price, $added);
    $stmt->execute();

    //tekitan massiivi
    $result = array();

    // tee seda seni, kuni on rida andmeid
    // mis vastab select lausele
    while ($stmt->fetch()) {

      //tekitan objekti
      $i = new StdClass();

      $i->id = $id;
      $i->user_id = $user_id;
      $i->start_location = $start_location;
      $i->start_time = $start_time;
      $i->arrival_location = $arrival_location;
      $i->arrival_time = $arrival_time;
      $i->free_seats = $free_seats;
      $i->price = $price;
      $i->added = $added;

      array_push($result, $i);
    }

    $stmt->close();

    return $result;
  }

  function getUser(){

    $stmt = $this->connection->prepare("SELECT user_id, start_location, start_time FROM cp_rideusers
      JOIN cp_rides ON cp.rideusers.ride_id =
       WHERE id=?");

    $stmt->bind_param("i", $_SESSION["userId"]);
    $stmt->bind_result($start_location, $start_time);
    $stmt->execute();

    //tekitan objekti
    $p = new Stdclass();

    //saime ühe rea andmeid
    if($stmt->fetch()){
      // saan siin alles kasutada bind_result muutujaid
      $r->start_location = $start_location;
      $r->start_time = $start_time;


    }else{
      // ei saanud rida andmeid kätte
      // sellist id'd ei ole olemas
      // see rida võib olla kustutatud
      header("Location: data.php");
      exit();
    }

    $stmt->close();

    return $r;

  }

  function save ($start_location, $start_time, $arrival_location,
  $arrival_time, $free_seats, $price) {

		$stmt = $this->connection->prepare("INSERT INTO cp_rides (user_id, start_location, start_time, arrival_location,
    arrival_time, free_seats, price) VALUES (?, ?, ?, ?, ?, ?, ?)");

		echo $this->connection->error;

		$stmt->bind_param("issssii", $_SESSION["userId"], $start_location, $start_time, $arrival_location,
    $arrival_time, $free_seats, $price);

		if($stmt->execute()) {
			echo "Salvestamine õnnestus";
		} else {
		 	echo "ERROR ".$stmt->error;
		}

		$stmt->close();

	}


  function saveUser($ride) {

    $stmt = $this->connection->prepare("
      SELECT id FROM user_interests_4
      WHERE user_id=? AND interest_id=?
    ");
    $stmt->bind_param("ii", $_SESSION["userId"], $interest);

    $stmt->execute();

    //kas oli rida
    if ($stmt->fetch()) {

      //oli olemas
      echo "juba olemas";
      //pärast returni enam koodi ei vaadata
      return;
    }

    // kui ei olnud, jõuame siia
    $stmt->close();

    $stmt = $this->connection->prepare("
      INSERT INTO user_interests_4 (user_id, interest_id)
      VALUES (?, ?)
    ");

    echo $this->connection->error;

    $stmt->bind_param("ii", $_SESSION["userId"], $interest);

    if($stmt->execute()) {
      echo "salvestamine õnnestus";
    } else {
      echo "ERROR ".$stmt->error;
    }

    $stmt->close();

  }
}
?>
