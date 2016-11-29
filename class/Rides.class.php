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

  function getUser() {

    $stmt = $mysqli->prepare("SELECT user_id, ride_ide, user_id.cp_rides  FROM interests JOIN cp_rideusers ON interests.id=user_interests.interest_id
      WHERE user_interests.user_id=?
    ");
		//SESSION USER ID
		echo $this->connection->error;

    $stmt->bind_param("i", $_SESSION["userId"]);

    $stmt->bind_result($ride);
    $stmt->execute();


		//tekitan massiivi
		$result = array();

		// tee seda seni, kuni on rida andmeid
		// mis vastab select lausele
		while ($stmt->fetch()) {

			//tekitan objekti
			$i = new StdClass();

			$i->interest = $interest;

			array_push($result, $i);
		}

		$stmt->close();

		return $result;
	}

  function save ($ride) {

		$stmt = $this->connection->prepare("INSERT INTO cp_rides (user_id, start_location, start_time, arrival_location,
    arrival_time, free_seats, price, added) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

		echo $this->connection->error;

		$stmt->bind_param("issssiis", $_SESSION["userId"], $start_location, $start_time, $arrival_location,
    $arrival_time, $free_seats, $price, $added);

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
