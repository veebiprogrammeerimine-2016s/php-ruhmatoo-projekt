<?php
class Top{
	private $connection;
	//k�ivitataks siis kui on = new User(see j�uab siia)

	function __construct($mysqli){
		//this viitab sellele klassile ja selle klassi muutujale
		$this->connection=$mysqli;
	}
	/*K�IK FUNKTSIOONID */

	function saveTop($tvshow, $rating) {
		$stmt = $this->connection->prepare("INSERT INTO Top10 (tvshow, rating) VALUE (?, ?)");
		echo $this->connection->error;
		$stmt->bind_param("si", $tvshow, $rating);
		if ( $stmt->execute() ) {
			echo "�nnestus <br>";
		} else {
			echo "ERROR ".$stmt->error;
		}
	}


	function getAll($q, $sort, $order){

		$allowedSort = ["id", "tvshow", "rating"];

		// sort ei kuulu lubatud tulpade sisse
		if(!in_array($sort, $allowedSort)){
			$sort = "id";
		}

		$orderBy = "ASC";

		if($order == "DESC") {
			$orderBy = "DESC";
		}
		echo "Sorteerin: ".$sort." ".$orderBy." ";

		if($q!=""){
			//otsin
			echo"otsin: ".$q;
			$stmt = $this->connection->prepare("
				SELECT id, tvshow, rating
				FROM Top10
				WHERE deleted IS NULL
				AND ( tvshow LIKE ? OR rating LIKE ? )
				ORDER BY $sort $orderBy
				");
			$searchWord="%".$q."%";
			$stmt->bind_param("ss", $searchWord, $searchWord);
		}else {
			//ei otsi
			$stmt = $this->connection->prepare("
				SELECT id, tvshow, rating
				FROM Top10
				WHERE deleted IS NULL
				ORDER BY $sort $orderBy
				");
		}
		//var_dump($this->connection);
		echo $this->connection->error;
		$stmt->bind_result($id, $tvshow, $rating);
		$stmt->execute();
		$results=array();
		//ts�klissisu toiimib seni kaua, mitu rida SQL lausega tuleb
		while($stmt->fetch()) {
			$human=new StdClass();
			$human->id=$id;
			$human->tvshow=$tvshow;
			$human->rating=$rating;
			//echo $rating."<br>";
			array_push($results, $human);
		}
		return $results;
	}


	function getSinglePerosonData($edit_id){
 		$stmt = $this->connection->prepare("SELECT tvshow, rating FROM Top10
		WHERE id=? AND deleted IS NULL");
 		$stmt->bind_param("i", $edit_id);
 		$stmt->bind_result($tvshow, $rating);
 		$stmt->execute();
 		//tekitan objekti
 		$p = new Stdclass();
 		//saime �he rea andmeid
 		if($stmt->fetch()){
 			// saan siin alles kasutada bind_result muutujaid
 			$p->tvshow = $tvshow;
 			$p->rating = $rating;
 		}else{
 			// ei saanud rida andmeid k�tte
 			// sellist id'd ei ole olemas
 			// see rida v�ib olla kustutatud
 			header("Location: data.php");
 			exit();
 		}
 		$stmt->close();
 		$this->connection->close();
 		return $p;
 	}


	function updatePerson($id, $tvshow, $rating){
 		$stmt = $this->connection->prepare("UPDATE Top10 SET tvshow=?, rating=? WHERE id=? AND deleted IS NULL");

 		$stmt->bind_param("sii",$tvshow, $rating, $id);
 		// kas õnnestus salvestada

 		if($stmt->execute()){
 			// �nnestus
 			echo "salvestus �nnestus!";
 		}
 		$stmt->close();
 		$this->connection->close();
 	}


	function deletePerson($id){
 		$stmt = $this->connection->prepare("UPDATE Top10 SET deleted=NOW()
 		WHERE id=? AND deleted IS NULL");
 		$stmt->bind_param("i",$id);
 		// kas �nnestus salvestada
 		if($stmt->execute()){
 			// �nnestus
 			echo "salvestus �nnestus!";
 		}
 		$stmt->close();
 		$this->connection->close();
 	}



}
?>
