<?php

require("../../config.php");

session_start();

function signUp ($Email, $Password, $Date, $Gender) {

		$database = "if16_mariiviita";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);

		$stmt = $mysqli->prepare("INSERT INTO USERSAMPLE (Email, Password, Date, Gender) VALUES (?, ?, ?, ?)");

		echo $mysqli->error;

		$stmt->bind_param("ssss", $Email, $Password, $Date, $Gender);

		if($stmt->execute()) {
			echo "Salvestamine �nnestus";
		} else {
		 	echo "ERROR ".$stmt->error;
		}

		$stmt->close();
		$mysqli->close();

	}


	function login ($Email, $Password) {

		$error = "";

		$database = "if16_mariiviita";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);

		$stmt = $mysqli->prepare("
		SELECT id, Email, Password, Date, Gender
		FROM USERSAMPLE
		WHERE email = ?");

		echo $mysqli->error;

		//asendan k�sim�rgi
		$stmt->bind_param("s", $Email);

		//m��ran v��rtused muutujatesse
		$stmt->bind_result($id, $EmailFromDb, $PasswordFromDb, $DateFromDb, $GenderFromDb);
		$stmt->execute();

		//andmed tulid andmebaasist v�i mitte
		// on t�ene kui on v�hemalt �ks vaste
		if($stmt->fetch()){

			//oli sellise meiliga kasutaja
			//password millega kasutaja tahab sisse logida
			$hash = hash("sha512", $Password);
			if ($hash == $PasswordFromDb) {

				echo "Kasutaja logis sisse ".$id;

				//m��ran sessiooni muutujad, millele saan ligi
				// teistelt lehtedelt
				$_SESSION["userId"] = $id;
				$_SESSION["userEmail"] = $EmailFromDb;


				header("Location: data.php");
				exit();

			}else {
				$error = "Parool on vale!";
			}


		} else {

			// ei leidnud sellise e-mailiga kasutajat
			$error = "Sellise e-mailiga kasutajat ei ole!";
		}

		return $error;

	}

	function saveUserData ($currentDate, $Feeling, $NumberofSteps) {

		$database = "if16_mariiviita";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);

		$stmt = $mysqli->prepare("INSERT INTO userData (currentDate, Feeling, NumberofSteps, user_id) VALUES (?, ?, ?, ?)");

		echo $mysqli->error;

		$stmt->bind_param("ssii", $currentDate, $Feeling, $NumberofSteps, $_SESSION["userId"]);

		if($stmt->execute()) {
			echo "Salvestamine �nnestus";
		} else {
		 	echo "ERROR ".$stmt->error;
		}

		$stmt->close();
		$mysqli->close();

	}

	function getUserData() {

		$database = "if16_mariiviita";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);

		$stmt = $mysqli->prepare("
			SELECT currentDate, Feeling, NumberofSteps
			FROM userData
			WHERE user_id=?
		");
		echo $mysqli->error;
		$stmt->bind_param("i", $_SESSION["userId"]);
		$stmt->bind_result($currentDate, $Feeling, $NumberofSteps);
		$stmt->execute();


		//tekitan massiivi
		$result = array();

		// tee seda seni, kuni on rida andmeid
		// mis vastab select lausele
		while ($stmt->fetch()) {

			//tekitan objekti
			$UserData = new StdClass();

			$UserData->Date = $currentDate;
			$UserData->Feeling = $Feeling;
			$UserData->NumberofSteps = $NumberofSteps;

			//echo $plate."<br>";
			// iga kord massiivi lisan juurde nr m�rgi
			array_push($result, $UserData);
		}

		$stmt->close();
		$mysqli->close();

		return $result;
	}


	function saveUserLW  ($height, $weight) {

		$database = "if16_mariiviita";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);

		$stmt = $mysqli->prepare("INSERT INTO userLW (height, weight, user_id) VALUES (?, ?, ?)");

		echo $mysqli->error;

		$stmt->bind_param("iii", $height, $weight, $_SESSION["userId"]);

		if($stmt->execute()) {
			echo "Salvestamine �nnestus";
		} else {
			echo "ERROR ".$stmt->error;
		}

		$stmt->close();
		$mysqli->close();

	}

?>
