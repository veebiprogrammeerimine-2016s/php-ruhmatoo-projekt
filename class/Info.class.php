<?php
class Info{
	private $connection;
	//k?ivitataks siis kui on = new User(see j?uab siia)

	function __construct($mysqli){
		//this viitab sellele klassile ja selle klassi muutujale
		$this->connection=$mysqli;
	}
	/*K?IK FUNKTSIOONID */

	function saveInfo($info, $cast) {
		$stmt = $this->connection->prepare("INSERT INTO s_info (info, cast) VALUE (?, ?)");
		echo $this->connection->error;
		$stmt->bind_param("ss", $info, $cast);
		if ( $stmt->execute() ) {
			echo "�nnestus <br>";
		} else {
			echo "ERROR ".$stmt->error;
		}
	}


	function getAll($q, $sort, $order){

		$allowedSort = ["id", "info", "cast"];

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
				SELECT id, info, cast, rating
				FROM s_info
				WHERE deleted IS NULL
				AND ( info LIKE ? OR cast LIKE ? OR rating LIKE ? )
				ORDER BY $sort $orderBy
				");
			$searchWord="%".$q."%";
			$stmt->bind_param("ss", $searchWord, $searchWord);
		}else {
			//ei otsi
			$stmt = $this->connection->prepare("
				SELECT id, info, cast
				FROM s_info
				WHERE deleted IS NULL
				ORDER BY $sort $orderBy
				");
		}
		//var_dump($this->connection);
		echo $this->connection->error;
		$stmt->bind_result($id, $info, $cast);
		$stmt->execute();
		$results=array();
		//ts?klissisu toiimib seni kaua, mitu rida SQL lausega tuleb
		while($stmt->fetch()) {
			$human=new StdClass();
			$human->id=$id;
			$human->info=$info;
			$human->cast=$cast;
			//echo $rating."<br>";
			array_push($results, $human);
		}
		return $results;
	}


	function getSinglePerosonData($edit_id){
 		$stmt = $this->connection->prepare("SELECT info, cast FROM s_info
		WHERE id=? AND deleted IS NULL");
 		$stmt->bind_param("i", $edit_id);
 		$stmt->bind_result($info, $cast);
 		$stmt->execute();
 		//tekitan objekti
 		$p = new Stdclass();
 		//saime ?he rea andmeid
 		if($stmt->fetch()){
 			// saan siin alles kasutada bind_result muutujaid
 			$p->info = $info;
			$p->cast = $cast;
 		}else{
 			// ei saanud rida andmeid k?tte
 			// sellist id'd ei ole olemas
 			// see rida v?ib olla kustutatud
 			header("Location: showpage.php");
 			exit();
 		}
 		$stmt->close();
 		$this->connection->close();
 		return $p;
 	}


	function updatePerson($id, $info, $cast){
 		$stmt = $this->connection->prepare("UPDATE s_info SET info=?, cast=? WHERE id=? AND deleted IS NULL");

 		$stmt->bind_param("ssi",$info, $cast, $id);
 		// kas �nnestus salvestada

 		if($stmt->execute()){
 			// ?nnestus
 			echo "salvestus ?nnestus!";
 		}
 		$stmt->close();
 		$this->connection->close();
 	}


	function deletePerson($id){
 		$stmt = $this->connection->prepare("UPDATE s_info SET deleted=NOW()
 		WHERE id=? AND deleted IS NULL");
 		$stmt->bind_param("i",$id);
 		// kas ?nnestus salvestada
 		if($stmt->execute()){
 			// ?nnestus
 			echo "salvestus ?nnestus!";
 		}
 		$stmt->close();
 		$this->connection->close();
 	}



}
?>
