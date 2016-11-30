<?php 
class Eetris{
	private $connection;
	//käivitataks siis kui on = new User(see jõuab siia)
	
	function __construct($mysqli){
		//this viitab sellele klassile ja selle klassi muutujale
		$this->connection=$mysqli;
	}
	/*KÕIK FUNKTSIOONID */
	
	function saveEetris ($tvshow_name, $time, $channel) {	
		$stmt = $this->connection->prepare("INSERT INTO t_eetris (tvshow_name, time, channel) VALUES (?,?)");
		echo $this->connection->error;
		$stmt->bind_param("si", $tvshow_name, $time, $channel);
		if($stmt->execute()) {
			echo "salvestamine õnnestus";
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		$stmt->close();
		$$this->connection->close();
	}
	
	function getAllEetris() {
		
		$allowedSort = ["id", "tvshow_name", "time", "channel"];

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
				SELECT id, tvshow_name, time, channel
				FROM t_eetris
				WHERE deleted IS NULL
				AND ( tvshow_name LIKE ? OR time LIKE ? or channel LIKE ? )
				ORDER BY $sort $orderBy
				");
			$searchWord="%".$q."%";
			$stmt->bind_param("ss", $searchWord, $searchWord);
		}else {
			//ei otsi
			$stmt = $this->connection->prepare("
				SELECT id, tvshow_name, time, channel
				FROM t_eetris
				WHERE deleted IS NULL
				ORDER BY $sort $orderBy
				");
		}
		//var_dump($this->connection);
		echo $this->connection->error;
		$stmt->bind_result($id, $tvshow_name, $time, $channel);
		$stmt->execute();
		$results=array();
		//ts?klissisu toiimib seni kaua, mitu rida SQL lausega tuleb
		while($stmt->fetch()) {
			$human=new StdClass();
			$human->id=$id;
			$human->tvshow_name=$tvshow_name;
			$human->time=$time;
			$human->channel=$channel;
			//echo $time."<br>";
			array_push($results, $human);
		}
		return $results;
	}


	function getSinglePerosonData($edit_id){
 		$stmt = $this->connection->prepare("SELECT tvshow_name, time, channel FROM t_eetris
		WHERE id=? AND deleted IS NULL");
 		$stmt->bind_param("i", $edit_id);
 		$stmt->bind_result($tvshow_name, $time, $channel);
 		$stmt->execute();
 		//tekitan objekti
 		$p = new Stdclass();
 		//saime ?he rea andmeid
 		if($stmt->fetch()){
 			// saan siin alles kasutada bind_result muutujaid
 			$p->tvshow_name = $tvshow_name;
 			$p->time = $time;
			$p->channel = $channel;
 		}else{
 			// ei saanud rida andmeid k?tte
 			// sellist id'd ei ole olemas
 			// see rida v?ib olla kustutatud
 			header("Location: data.php");
 			exit();
 		}
 		$stmt->close();
 		$this->connection->close();
 		return $p;
 	}


	function updatePerson($id, $tvshow_name, $time, $channel){
 		$stmt = $this->connection->prepare("UPDATE t_eetris SET tvshow_name=?, time=?, channel=? WHERE id=? AND deleted IS NULL");

 		$stmt->bind_param("siis",$tvshow_name, $time, $id, $channel);
 		// kas õnnestus salvestada

 		if($stmt->execute()){
 			// ?nnestus
 			echo "salvestus ?nnestus!";
 		}
 		$stmt->close();
 		$this->connection->close();
 	}


	function deletePerson($id){
 		$stmt = $this->connection->prepare("UPDATE t_eetris SET deleted=NOW()
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