<?php

class Note {
	
    private $connection;
	
	function __construct($mysqli){
		$this->connection = $mysqli;
	}
	
   
    function saveNote($paid_warranty, $serialnumber, $device, $manufacturer, $model, $date_of_purchase, $first_lastname, $country, $city, $address, $postcode, $email, $number, $problem, $add_info, $rma, $status) {
		
		
		$stmt = $this->connection->prepare("INSERT INTO repairing (paid_warranty, serialnumber, device, manufacturer , model, date_of_purchase, first_lastname,
										   country, city, address, postcode, email, number, problem, add_info, rma,status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
		echo $this->connection->error;
		
		$stmt->bind_param("ssssssssssisissss", $paid_warranty, $serialnumber, $device, $manufacturer, $model, $date_of_purchase, $first_lastname, $country, $city, $address, $postcode, $email, $number, $problem, $add_info, $rma, $status);

		if ( $stmt->execute() ) {
			echo "";	
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
			
//			echo "Searching... ".$q;
			
			$stmt = $this->connection->prepare("
				SELECT id, paid_warranty, serialnumber, device, manufacturer , model, date_of_purchase, first_lastname,
				country, city, address, postcode, email, number, problem, add_info, rma, status
				FROM repairing
				WHERE deleted IS NULL
				AND (id LIKE ? OR paid_warranty LIKE ? OR serialnumber LIKE ? OR device LIKE ? OR manufacturer LIKE ? OR model LIKE ? OR date_of_purchase LIKE ? OR
				first_lastname LIKE ? OR country LIKE ? OR city LIKE ? OR postcode LIKE ? OR email LIKE ? OR number LIKE ? OR problem LIKE ? OR add_info LIKE ? OR rma LIKE ? OR status LIKE ?)
				ORDER BY $sort $orderBy
			");
			$searchWord = "%".$q."%";
			$stmt->bind_param("issssssssssisisss", $searchWord, $searchWord, $searchWord, $searchWord, $searchWord, $searchWord, $searchWord, $searchWord, $searchWord, 
							  $searchWord, $searchWord, $searchWord, $searchWord, $searchWord, $searchWord, $searchWord, $searchWord);
		
		}else{
			//ei otsi
			$stmt = $this->connection->prepare("
				SELECT id, paid_warranty, serialnumber, device, manufacturer , model, date_of_purchase, first_lastname,
				country, city, address, postcode, email, number, problem, add_info, rma, status
				FROM repairing
				WHERE deleted IS NULL
				ORDER BY $sort $orderBy
			");
		}
		
		$stmt->bind_result($id, $paid_warranty, $serialnumber, $device, $manufacturer, 
						   $model, $date_of_purchase, $first_lastname, $country, $city, $address, $postcode, $email, $number, $problem, $add_info, $rma, $status);
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
			$object->rma = $rma;
			$object->status= $status;
		
			
			
			
			array_push($result, $object);
			
		}

		return $result;
		
	}
	
	function getSingleNoteData($edit_id){
    		
		$stmt = $this->connection->prepare("SELECT paid_warranty, serialnumber, device, manufacturer , model, date_of_purchase, first_lastname,
										   country, city, address, postcode, email, number, problem, add_info, rma, status FROM repairing WHERE id=? AND deleted IS NULL");

		$stmt->bind_param("i", $edit_id);
		$stmt->bind_result($paid_warranty, $serialnumber, $device, $manufacturer, $model, 
						   $date_of_purchase, $first_lastname, $country, $city, $address, $postcode, $email, $number, $problem, $add_info, $rma, $status);
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
			$n->rma = $rma;
			$n->status = $status;
			
			
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


	function updateNote($id, $paid_warranty, $serialnumber, $device, $manufacturer, $model, $date_of_purchase, 
						$first_lastname, $country, $city, $address, $postcode, $email, $number, $problem, $add_info, $rma, $status){
				
		$stmt = $this->connection->prepare("UPDATE repairing SET paid_warranty=?, serialnumber=?, device=?, manufacturer=?, model=?, date_of_purchase=?, first_lastname=?,
				country=?, city=?, address=?, postcode=?, email=?, number=?, problem=?, add_info=?, rma=?, status=? WHERE id=? AND deleted IS NULL");
				
		$stmt->bind_param("ssssssssssisissssi", $paid_warranty, $serialnumber, $device, $manufacturer, $model, $date_of_purchase, 
						  $first_lastname, $country, $city, $address, $postcode, $email, $number, $problem, $add_info, $rma, $status, $id);
		
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