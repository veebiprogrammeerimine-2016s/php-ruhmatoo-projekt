<?php

require("../../config.php");

session_start();

function getSingleTyreFitting($details_id){
    	$database = "if16_stanislav";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		$stmt = $mysqli->set_charset("utf8");
        
		$stmt = $mysqli->prepare("SELECT name, logo, description,location,pricelist FROM p_tyre_fittings WHERE id=?");

		$stmt->bind_param("i", $details_id);
		$stmt->bind_result($name, $logo, $description,$location,$pricelist);
		$stmt->execute();
		
		//tekitan objekti
		$tyreFitting = new Stdclass();
		
		//saime ühe rea andmeid
		if($stmt->fetch()){
			// saan siin alles kasutada bind_result muutujaid
			$tyreFitting->name = $name;
			$tyreFitting->logo = $logo;
			$tyreFitting->description = $description;
			$tyreFitting->location = $location;
			$tyreFitting->pricelist = $pricelist;
			
			
		}else{
			// ei saanud rida andmeid kätte
			// sellist id'd ei ole olemas
			// see rida võib olla kustutatud
			header("Location: index.php");
			exit();
		}
		
		$stmt->close();

		
		return $tyreFitting;
		
	}
function getTyreFittingServices($details_id){
    	$database = "if16_stanislav";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		$stmt = $mysqli->set_charset("utf8");
        
	/*	$stmt = $mysqli->prepare("SELECT name, description, category,size,price FROM p_tyre_fittings_services WHERE tyre_fitting_id=?");*/
	$stmt = $mysqli->prepare("SELECT  name,description,category,size,MIN(price) FROM p_tyre_fittings_services WHERE tyre_fitting_id=? GROUP BY category;");
		
		$stmt->bind_param("i", $details_id);
		$stmt->bind_result($name, $description, $category, $size, $price);
		$stmt->execute();
		
		$result = array();
		
		// tee seda seni, kuni on rida andmeid
		// mis vastab select lausele
		while ($stmt->fetch()) {
			
			//tekitan objekti
			$i = new StdClass();
			
			$i->name = $name;
			$i->category = $category;
			$i->description = $description;
			$i->description = $description;
			$i->size = $size;
			$i->price = $price;
		
			array_push($result, $i);
		}
		
		//tekitan objekti
		
			
			
		/*}else{
			// ei saanud rida andmeid kätte
			// sellist id'd ei ole olemas
			// see rida võib olla kustutatud
			header("Location: index.php");
			exit();
		}*/

		$stmt->close();

		
		return $result;
		
	}
function getAllTyreFittings() {
		
		$database = "if16_stanislav";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		$stmt = $mysqli->set_charset("utf8");
		$stmt = $mysqli->prepare("
			SELECT id,name, logo, LEFT(description, 100),owner_id
			FROM p_tyre_fittings
		");
		echo $mysqli->error;
		
		$stmt->bind_result($id,$name,$logo,$description, $owner_id);
		$stmt->execute();
		
		
		//tekitan massiivi
		$result = array();
		
		// tee seda seni, kuni on rida andmeid
		// mis vastab select lausele
		while ($stmt->fetch()) {
			
			//tekitan objekti
			$i = new StdClass();
			
			$i->id = $id;
			$i->name = $name;
			$i->logo = $logo;
			$i->description = $description;
			$i->owner_id = $owner_id;
		
			array_push($result, $i);
		}
		$stmt->close();
		$mysqli->close();
		
		return $result;
}

// REGISTRATION

function signUP($username,$password)
	{
		
		$database = "if16_stanislav";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		$stmt = $mysqli->set_charset("utf8");
		// sqli rida
		$stmt = $mysqli->prepare("INSERT INTO p_owners (username,password) VALUES (?,?)");
		
		
		echo $mysqli->error;
		
		// stringina üks täht iga muutuja kohta (?), mis tüüp
		// string - s
		// integer - i
		// float (double) - d
		$stmt->bind_param("ss",$username,$password); // sest on email ja password VARCHAR - STRING , ehk siis email - s, password - sa
		
		//täida käsku
		if($stmt->execute())
		{
			
		}
		else
		{
			echo "ERROR ".$stmt->error;
		}
		
		//panen ühenduse kinni
		$stmt->close();
		
	}
	
	// SIGN IN
	
	function login ($username, $password) {
		
		
		$database = "if16_stanislav";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);

		$stmt = $mysqli->prepare("
		SELECT id, username, password 
		FROM p_owners
		WHERE username = ?");
	
		echo $mysqli->error;
		
		//asendan küsimärgi
		$stmt->bind_param("s", $username);
		
		//määran väärtused muutujatesse
		$stmt->bind_result($id, $usernameFromDb, $passwordFromDb);
		$stmt->execute();
		
		//andmed tulid andmebaasist või mitte
		// on tõene kui on vähemalt üks vaste
		if($stmt->fetch()){
			
			//oli sellise meiliga kasutaja
			//password millega kasutaja tahab sisse logida
			//$hash = hash("sha512", $password);
			if ($password == $passwordFromDb) {
				
				//echo "Kasutaja logis sisse ".$id;
				
				//määran sessiooni muutujad, millele saan ligi
				// teistelt lehtedelt
				$_SESSION["userId"] = $id;
				$_SESSION["username"] = $usernameFromDb;
				
				//$_SESSION["message"] = "<h1>Tere tulemast!</h1>";
				
				header("Location: data.php");
				exit();
				
			}
			
		} 
	}
	
	
	
	
?>

