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

    $stmt = $this->connection->prepare("
    SELECT cp_rides.user_id, cp_rides.start_location,
    cp_rides.start_time,
    cp_users.id
    FROM cp_rideusers
    JOIN cp_users ON cp_users.id=cp_rideusers.user_id
    JOIN cp_rides ON cp_rides.id=cp_rideusers.ride_id
    WHERE cp_rides.user_id=?;
    ");

    echo $this->connection->error;
		$stmt->bind_param("i", $_SESSION["userId"]);
    $stmt->bind_result($user_id, $start_location, $start_time, $guest_id);
    $stmt->execute();

    //tekitan objekti
    $results = array();
    //tsykli sisu tehakse nii mitu korda, mitu rida
    //SQL lausega tuleb
    while ($stmt->fetch()) {

      $r = new StdClass();
      $r->user_id = $user_id;
      $r->start_location = $start_location;
      $r->start_time = $start_time;
      $r->guest_id = $guest_id;

      //echo $age."<br>";
      //echo $color."<br>";
      array_push($results, $r);
    }

    return $results;
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
