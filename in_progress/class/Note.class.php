<?php

class Note {
	
    private $connection;
	
	function __construct($mysqli){
		$this->connection = $mysqli;
	}
	
   
    function saveNote($paid_warranty, $serialnumber, $device, $manufacturer, $model, $date_of_purchase, $first_lastname, $country, $city, $address, $postcode, $email, $number, $problem, $add_info) {
		
		$stmt = $this->connection->prepare("INSERT INTO repairing (paid_warranty, serialnumber, device, manufacturer , model, date_of_purchase, first_lastname,
										   country, city, address, postcode, email, number, problem, add_info) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		echo $this->connection->error;
		
		$stmt->bind_param("ssssssssssisiss", $paid_warranty, $serialnumber, $device, $manufacturer, $model, $date_of_purchase, $first_lastname, $country, $city, $address, $postcode, $email, $number, $problem, $add_info);

		if ( $stmt->execute() ) {
			echo "salvestamine õnnestus";	
		} else {	
			echo "ERROR ".$stmt->error;
		}
		
	}
	
	
	function getAllNotes($q, $sort, $order) {
		
		//lubatud tulbad
		$allowedSort = ["id"];
		
		if(!in_array($sort, $allowedSort)){
			//ei olnud lubatud tulpade sees
			$sort = "id"; //las sorteerib id järgi
		}
		
		$orderBy = "ASC";
		
		if($order == "DESC"){
			$orderBy = "DESC";
		}
		
		//echo "sorteerin ".$sort." ".$orderBy." ";
		
		//otsime
		if($q != "") {
			
			echo "Searching... ".$q;
			
			$stmt = $this->connection->prepare("
				SELECT id, paid_warranty, serialnumber, device, manufacturer , model, date_of_purchase, first_lastname,
				country, city, address, postcode, email, number, problem, add_info
				FROM repairing
				WHERE deleted IS NULL
				AND (serialnumber LIKE ?)
				ORDER BY $sort $orderBy
			");
			$searchWord = "%".$q."%";
			$stmt->bind_param("ssssssssssisiss", $searchWord);
		
		}else{
			//ei otsi
			$stmt = $this->connection->prepare("
				SELECT id, paid_warranty, serialnumber, device, manufacturer , model, date_of_purchase, first_lastname,
				country, city, address, postcode, email, number, problem, add_info
				FROM repairing
				WHERE deleted IS NULL
				ORDER BY $sort $orderBy
			");
		}
		
		$stmt->bind_result($id, $paid_warranty, $serialnumber, $device, $manufacturer, $model, $date_of_purchase, $first_lastname, $country, $city, $address, $postcode, $email, $number, $problem, $add_info);
		$stmt->execute();
		
		$result = array();
		
		// tsükkel töötab seni, kuni saab uue rea AB'i
		// nii mitu korda palju SELECT lausega tuli
		while ($stmt->fetch()) {
			//echo $note."<br>";
			
			$object = new StdClass();
			$object->id = $id ;
			$object->paid_warranty = $paid_warranty;
			$object->serialnumber = $serialnumber;
			$object->device = $device;
			$object->manufacturer = $manufacturer;
			$object->model = $model;
			$object->date_of_purchase = $date_of_purchase;
			$object->first_lastname = $first_lastname;
			$object->country = $country;
			$object->city = $city;
			$object->address = $address;
			$object->postcode = $postcode;
			$object->email = $email;
			$object->number = $number;
			$object->problem = $problem;
			$object->add_info = $add_info;
		
			
			
			
			array_push($result, $object);
			
		}
		
		return $result;
		
	}
	
	function getSingleNoteData($edit_id){
    		
		$stmt = $this->connection->prepare("SELECT paid_warranty, serialnumber, device, manufacturer , model, date_of_purchase, first_lastname,
										   country, city, address, postcode, email, number, problem, add_info FROM repairing WHERE id=? AND deleted IS NULL");

		$stmt->bind_param("i", $edit_id);
		$stmt->bind_result($paid_warranty, $serialnumber, $device, $manufacturer, $model, $date_of_purchase, $first_lastname, $country, $city, $address, $postcode, $email, $number, $problem, $add_info);
		$stmt->execute();
		
		//tekitan objekti
		$n = new Stdclass();
		
		//saime ühe rea andmeid
		if($stmt->fetch()){
			// saan siin alles kasutada bind_result muutujaid
			$n->paid_warranty = $paid_warranty;
			$n->serialnumber = $serialnumber;
			$n->device = $device;
			$n->manufacturer = $manufacturer;
			$n->model = $model;
			$n->date_of_purchase = $date_of_purchase;
			$n->first_lastname= $first_lastname;
			$n->country = $country;
			$n->city= $city;
			$n->address = $address;
			$n->postcode = $postcode;
			$n->email = $email;
			$n->number = $number;
			$n->problem= $problem;
			$n->add_info = $add_info;
			
			
		}else{
			// ei saanud rida andmeid kätte
			// sellist id'd ei ole olemas
			// see rida võib olla kustutatud
			header("Location: data.php");
			exit();
		}
		
		$stmt->close();		
		return $n;
		
	}


	function updateNote($paid_warranty, $serialnumber, $device, $manufacturer, $model, $date_of_purchase, $first_lastname, $country, $city, $address, $postcode, $email, $number, $problem, $add_info){
				
		$stmt = $this->connection->prepare("UPDATE repairing SET paid_warranty=?, serialnumber=?, device=?, manufacturer=?, model=?, date_of_purchase=?, first_lastname=?,
				country=?, city=?, address=?, postcode=?, email=?, number=?, problem=?, add_info=? WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("ssssssssssisissi", $paid_warranty, $serialnumber, $device, $manufacturer, $model, $date_of_purchase, $first_lastname, $country, $city, $address, $postcode, $email, $number, $problem, $add_info, $id);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			// õnnestus
			echo "Edited";
		}
		
		$stmt->close();
		
	}
	
	
	function deleteNote($id){
		
		$stmt = $this->connection->prepare("
			UPDATE repairing
			SET deleted=NOW() 
			WHERE id=? AND deleted IS NULL
		");
		$stmt->bind_param("i", $id);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			// õnnestus
			echo "salvestus õnnestus!";
		}
		
		$stmt->close();
		
	}
	
} 
?>