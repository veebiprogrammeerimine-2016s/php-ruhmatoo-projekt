<?php
class Plant {
	
	private $connection;
	public $name;
	
	function __construct($mysqli){
		//This viitab klassile (THIS ==USER)
		$this->connection = $mysqli;
	}
	
	
	function getOptions() {	
		$stmt = $this->connection->prepare("
			SELECT id, name, watering_days
			FROM f_plant
			WHERE deleted IS NULL and private IS NULL");
		
		$stmt->bind_result($id, $plant, $watering);
		$stmt->execute();
		
		//tekitan massiivi
		$result=array();
		
		//Tee seda seni, kuni on rida andmeid. ($stmt->fech)
		//Mis vastab select lausele.
		//iga uue rea andme kohta see lause seal sees
		while($stmt->fetch()){
			
			//tekitan objekti
			$plantClass = new StdClass();
			
		    $plantClass->id=$id;
			$plantClass->plants=$plant;
			$plantClass->intervals=$watering;
			
			array_push($result, $plantClass);
		}
		return $result;
	}
	
    /* function to add plants to userplants */
    function save ($plant, $watering,$emailFromDb) {
		$stmt = $this->connection->prepare(
		"INSERT INTO f_userplants (names, userID, watering_interval, private) VALUES (?,?,?,?)");
        
		echo $this->connection->error;
        $stmt->bind_param("siis", $plant, $_SESSION["userId"], $watering,$emailFromDb);
		
		if ( $stmt->execute() )  {
			echo "salvestamine õnnestus";
		}  else  {		
			echo "ERROR".$stmt->error;
		}
    }
    
    /* function to add database plants to userplants*/
	function saveUserPlants($plant, $watering) {	
		$stmt = $this->connection->prepare(
		"INSERT INTO f_userplants (plantID, userID, watering_interval, private) VALUES (?,?,?,?)");
        
		echo $this->connection->error;
		//asendan küsimärgi
		$stmt->bind_param("iiis", $plant, $_SESSION["userId"], $watering, $_SESSION["userEmail"]);
        
		if ( $stmt->execute() )  {
			echo "salvestamine õnnestus";
		}  else  {
			echo "ERROR".$stmt->error;
		}	
	}
    
    /* function to add database plant names to userplants*/
    function saveSecond($plant){
         $stmt = $this->connection->prepare("update f_userplants set names=(select name FROM f_plant WHERE id=?)");
       
        echo $ths->connectin->error;
        $stmt->bind_param("i", $plant);
        
        if ($stmt->execute()){
            echo "salvestamine õnnestus";
        } else {
            echo "ERROR".$stmt->error;
        }
    }
    
/*	function save ($plant, $watering,$emailFromDb) {
		
		
		$stmt = $this->connection->prepare(
		"INSERT INTO f_plant (name, watering_days,private) VALUES (?,?,?)");
        
		echo $this->connection->error;
        $stmt->bind_param("sss", $plant,$watering,$emailFromDb);
		
		if ( $stmt->execute() )  {
			
			echo "salvestamine õnnestus";
			
		}  else  {
			
			echo "ERROR".$stmt->error;
		}}
        
    function saveSecond($plant,$emailFromDb){
         $stmt = $this->connection->prepare("Insert into f_userplants(names,plantID,userID, watering_interval,private) select name,id, ? ,watering_days, private FROM f_plant WHERE name=? and private=?");
       
        echo $ths->connectin->error;
        $stmt->bind_param("iss", $_SESSION["userId"],$plant,$emailFromDb);
        
        if ($stmt->execute()){
            echo "salvestamine õnnestus";
        } else {
            echo "ERROR".$stmt->error;
        }
    }    
		
	function saveUserPlants($plant, $watering) {
		
		
		$stmt = $this->connection->prepare(
		"INSERT INTO f_userplants (plantID, userID, watering_interval, private) VALUES (?,?,?,?)");
		
		echo $this->connection->error;
		
		
		
		//asendan küsimärgi
		$stmt->bind_param("iiis", $plant, $_SESSION["userId"], $watering, $_SESSION["userEmail"]);
		
		if ( $stmt->execute() )  {
			
			echo "salvestamine õnnestus";
			
		}  else  {
			
			echo "ERROR".$stmt->error;
		}
		
	} */
	
	function getAll($q,$sort,$direction) {
		
		$allowedSortOptions = ["id", "plant", "interval"];
			
		if(!in_array($sort,$allowedSortOptions)){
			$sort="id";
		}	
		
		if($sort == "interval"){
			$sort = "watering_days";
		}
		
		echo "Sorteerin...";

		$orderBy="ASC";
		if($direction=="descending"){
			$orderBy="DESC";
		}	
		
		if($q == ""){
			echo"ei otsi...";
			$stmt = $this->connection->prepare("
			SELECT url, id, name, watering_days, tip
			FROM f_plant
            join f_tips on f_tips.plantID=f_plant.id
			WHERE (deleted IS NULL) AND (private IS NULL)
			ORDER BY $sort $orderBy");
		} else {
			echo"Otsib...".$q;
			$searchWord = "%".$q."%";
			$stmt = $this->connection->prepare(
			"SELECT url, id, name, watering_days, tip from f_plant
             join f_tips on f_tips.plantID=f_plant.id
            WHERE deleted IS NULL AND (name LIKE ? OR watering_days LIKE ?) AND (private IS NULL) ORDER BY $sort $orderBy");
			$stmt->bind_param('ss', $searchWord, $searchWord);
		}
        
		echo $this->connection->error;
		
		$stmt->bind_result($url, $id, $name, $watering, $tip);
		$stmt->execute();
		
		//tekitan massiivi
		$result=array();
		
		//Tee seda seni, kuni on rida andmeid. ($stmt->fech)
		//Mis vastab select lausele.
		//iga uue rea andme kohta see lause seal sees
		while($stmt->fetch()){
			//tekitan objekti
			$plantClass = new StdClass();
			
            $plantClass->url=$url;
		    $plantClass->id=$id;
			$plantClass->name=$name;
			$plantClass->intervals=$watering;
            $plantClass->tip=$tip;

			array_push($result, $plantClass);
		}		
		return $result;
	}
		
		
	function getAllUserPlants($q,$sort,$direction) {
		
		$allowedSortOptions = ["plantID", "name", "interval"];
			
		if(!in_array($sort,$allowedSortOptions)){
			$sort="plantID";
		}	
        
		$user=$_SESSION["userEmail"];
		
        if($sort == "interval"){
			$sort = "watering_days";
		}

		$orderBy="ASC";
		if($direction=="descending"){
			$orderBy="DESC";
		}	
		
		if($q == ""){
			echo"ei otsi...";
			$stmt = $this->connection->prepare("
            SELECT plantID, name, watering_days from f_plant
            join f_userplants ON f_userplants.plantID=f_plant.id WHERE f_userplants.private='$user' OR f_plant.private='$user'
			AND f_plant.deleted IS NULL 
			ORDER BY $sort $orderBy");
		} else {
			echo"Otsib...".$q;
			$searchWord = "%".$q."%";
			$stmt = $this->connection->prepare(
			"SELECT plantID, name, watering_days from f_plant
            join f_userplants ON f_userplants.plantID=f_plant.id WHERE f_userplants.private='$user' OR f_plant.private='$user'
			AND f_plant.deleted IS NULL AND (name LIKE ? OR watering_days LIKE ?) ORDER BY $sort $orderBy");
			$stmt->bind_param('ss', $searchWord, $searchWord);
		}
        
		echo $this->connection->error;
		
		$stmt->bind_result($id, $name, $watering);
		$stmt->execute();
		
		//tekitan massiivi
		$result=array();
		
		//Tee seda seni, kuni on rida andmeid. ($stmt->fech)
		//Mis vastab select lausele.
		//iga uue rea andme kohta see lause seal sees
		while($stmt->fetch()){
			//tekitan objekti
			$plantClass = new StdClass();
			
		    $plantClass->id=$id;
			$plantClass->name=$name;
			$plantClass->intervals=$watering;
			
			array_push($result, $plantClass);
		}
		return $result;
	}

	/* function getAllUserPlants($q,$sort,$direction) {
		
		$allowedSortOptions = ["plantID", "name", "interval"];
			
		if(!in_array($sort,$allowedSortOptions)){
			
			$sort="plantID";
		}	
		$user=$_SESSION["userEmail"];
		if($sort == "interval"){
			$sort = "watering_days";
		}
		
		echo "Sorteerin...";

		$orderBy="ASC";
		if($direction=="descending"){
			$orderBy="DESC";
		}	
		
		if($q == ""){
			echo"ei otsi...";
			$stmt = $this->connection->prepare("
            SELECT plantID, name, watering_days from f_plant
            join f_userplants ON f_userplants.plantID=f_plant.id WHERE f_userplants.private='$user' OR f_plant.private='$user'
			AND f_plant.deleted IS NULL 
			ORDER BY $sort $orderBy");
			
            
		
		} else {
			echo"Otsib...".$q;
			$searchWord = "%".$q."%";
			$stmt = $this->connection->prepare(
			"SELECT plantID, name, watering_days from f_plant
            join f_userplants ON f_userplants.plantID=f_plant.id WHERE f_userplants.private='$user' OR f_plant.private='$user'
			AND f_plant.deleted IS NULL AND (name LIKE ? OR watering_days LIKE ?) ORDER BY $sort $orderBy");
			$stmt->bind_param('ss', $searchWord, $searchWord);
			
		}
		echo $this->connection->error;
		
		
		$stmt->bind_result($id, $name, $watering);
		$stmt->execute();
		
		
		
		//tekitan massiivi
		
		$result=array();
		
		//Tee seda seni, kuni on rida andmeid. ($stmt->fech)
		//Mis vastab select lausele.
		//iga uue rea andme kohta see lause seal sees
		
		while($stmt->fetch()){
			
			//tekitan objekti
			
			$plantClass = new StdClass();
			
		    $plantClass->id=$id;
			$plantClass->name=$name;
			$plantClass->intervals=$watering;
			
			
			
			array_push($result, $plantClass);
		}
		
		return $result;
		
		
	} */


	function getSingleData($edit_id){
        $user=$_SESSION["userEmail"];
		
		$stmt = $this->connection->prepare("SELECT name, watering_days FROM f_plant WHERE id=? AND deleted IS NULL AND private=?");

		$stmt->bind_param("is", $edit_id, $user);
		$stmt->bind_result($plant, $wateringInterval);
		$stmt->execute();
		
		//tekitan objekti
		$plantFromDb = new Stdclass();
		
		//saime ühe rea andmeid
		if($stmt->fetch()){
			// saan siin alles kasutada bind_result muutujaid
			$plantFromDb->name = $plant;
			$plantFromDb->watering_days= $wateringInterval;
			
			
		}else{
			echo("ei saanud rida andmeid kätte");
			// sellist id'd ei ole olemas
			// see rida võib olla kustutatud
			header("Location: data.php");
			exit();
		}
		
		return $plantFromDb;
		
	}
    
   /* function getSingle($edit_id){
        $user=$_SESSION["userEmail"];
		
		$stmt = $this->connection->prepare("SELECT name, watering_days, (select ) FROM f_plant
        join f_userplants ON f_userplants.plantID=f_plant.id WHERE id=? AND deleted IS NULL AND private=?");

		$stmt->bind_param("is", $edit_id, $user);
		$stmt->bind_result($plant, $wateringInterval);
		$stmt->execute();
		
		//tekitan objekti
		$plantFromDb = new Stdclass();
		
		//saime ühe rea andmeid
		if($stmt->fetch()){
			// saan siin alles kasutada bind_result muutujaid
			$plantFromDb->name = $plant;
			$plantFromDb->watering_days= $wateringInterval;
			
			
		}else{
			echo("ei saanud rida andmeid kätte");
			// sellist id'd ei ole olemas
			// see rida võib olla kustutatud
			header("Location: data.php");
			exit();
		}
		
		return $plantFromDb;
		
	} */
    
    
	function delete($id){
		$user=$_SESSION["userEmail"];
		$stmt = $this->connection->prepare("UPDATE f_userplants SET deleted=1 WHERE id=? AND deleted IS NULL AND private='$user'");
		$stmt->bind_param("i",$id);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			// õnnestus
			echo "kustutamine õnnestus!";
		}
        $stmt->close();
    }


	function update($id, $plant, $wateringInterval){
		$user=$_SESSION["userEmail"];
		$stmt = $this->connection->prepare("UPDATE f_plant SET name=?, watering_days=? WHERE id=? AND private='$user'");
 		$stmt->bind_param("ssi",$plant, $wateringInterval, $id);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			// õnnestus
			echo "salvestus õnnestus!";
		}	
	}
	
    
   /* function updateAll($id, $plant, $wateringInterval){
		$user=$_SESSION["userEmail"];
		$stmt = $this->connection->prepare("UPDATE f_userplant SET name=?, watering_days=? WHERE userID=? AND private='$user'");
		$stmt->bind_param("ssi", $plant, $wateringInterval, $_SESSION["userId"]);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			// õnnestus
			echo "salvestus õnnestus!";
		}	
	} */
}

