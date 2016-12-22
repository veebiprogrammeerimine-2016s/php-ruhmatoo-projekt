<?php class Car {
    private $connection;
    function __construct($mysqli){
        $this->connection = $mysqli;
    }
    function saveCar ($RegPlate, $Mark, $Model) {

        $stmt = $this->connection->prepare("INSERT INTO repairCars (UserId, RegPlate, Mark, Model) VALUES (?, ?, ?, ?)");

        echo $this->connection->error;

        $stmt->bind_param("isss",$_SESSION["userId"], $RegPlate, $Mark, $Model);

        if ($stmt->execute()) {

            echo "Salvestamine õnnestus";
        } else {
            echo "ERROR ".$stmt->error;
        }
    }
	
	function getSingleData($edit_id){


		$stmt = $this->connection->prepare("SELECT id, Mileage, DoneJob, JobCost, Comment FROM repairWork WHERE id=? AND deleted IS NULL");

		$stmt->bind_param("i", $edit_id);
		$stmt->bind_result($id, $Mileage, $DoneJob, $JobCost, $Comment);
		$stmt->execute();

		$car = new Stdclass();

		if($stmt->fetch()){

			$car->Mileage = $Mileage;
			$car->DoneJob = $DoneJob;
			$car->JobCost = $JobCost;
			$car->Comment = $Comment;

		}else{

			//header("Location: userpage.php");
			//exit();
		}

		$stmt->close();

		return $car;

	}

	function getWorks($carid){

		$stmt = $this->connection->prepare("SELECT id, Mileage, DoneJob, JobCost, Comment FROM repairWork WHERE carId=?");

		$stmt->bind_param("i", $carid);
		$stmt->bind_result($id, $Mileage, $DoneJob, $JobCost, $Comment);
		$stmt->execute();

		$result = array();

		while($stmt->fetch()){
			
			$work = new Stdclass();

			$work->id = $id;
			$work->Mileage = $Mileage;
			$work->DoneJob = $DoneJob;
			$work->JobCost = $JobCost;
			$work->Comment = $Comment;
			
			array_push($result, $work);

		}
		
		

		$stmt->close();

		return $result;

	}

    function getUserCars ($id, $RegPlate, $Mark, $Model) {

        $stmt = $this->connection->prepare("SELECT id, UserId, RegPlate, Mark, Model FROM repairCars WHERE deleted IS NULL");
        echo $this->connection->error;

        $stmt ->bind_result($id, $_SESSION["userId"], $RegPlate, $Mark, $Model);
        $stmt -> execute ();

        $result = array();

        while ($stmt->fetch()) {

            $Car = new StdClass ();
            $Car->id = $id;
            $Car->UserId = $UserId;
            $Car->RegPlate = $RegPlate;
            $Car->Mark = $Mark;
            $Car->Model = $Model;

            array_push($result, $Car);

        }

        $stmt->close();
        return $result;
    }
    function getAll($q, $sort) {

        $allowedSort = ["RegPlate", "Mark", "Model"];
        if(!in_array($sort, $allowedSort)) {
            //ei ole lubatud tulp
            $sort = "UserId";
        }
        if($q != "") {

            echo "Otsib: ".$q;

            $stmt = $this->connection->prepare("
			SELECT id, RegPlate, Mark, Model
			FROM repairCars
			WHERE deleted IS NULL
			AND (RegPlate LIKE ? OR Mark LIKE ? OR Model LIKE ?)
			ORDER BY $sort
			
			");


            $searchWord="%".$q."%";
            $stmt->bind_param("sss", $searchWord, $searchWord, $searchWord);


        } else {
            $stmt = $this->connection->prepare("
			SELECT id, RegPlate, Mark, Model
			FROM repairCars
			WHERE deleted IS NULL
			ORDER BY $sort 
			");


        }
        echo $this->connection->error;

        $stmt->bind_result($id ,$RegPlate, $Mark, $Model);
        $stmt->execute();


        //tekitan massiivi
        $result = array();

        // tee seda seni, kuni on rida andmeid
        // mis vastab select lausele
        while ($stmt->fetch()) {

            //tekitan objekti
            $Car = new StdClass();

            $Car->id = $id;
            $Car->RegPlate = $RegPlate;
            $Car->Mark = $Mark;
            $Car->Model = $Model;

            //echo $plate."<br>";
            // iga kord massiivi lisan juurde nr m�rgi
            array_push($result, $Car);
        }

        $stmt->close();


        return $result;
    }
	
	function update($Mileage, $DoneJob, $JobCost, $Comment, $id){


		$stmt = $this->connection->prepare("UPDATE repairCars SET Mileage=?, DoneJob=?, JobCost=?, Comment=? WHERE id=?");
		$stmt->bind_param("isisi",$Mileage, $DoneJob, $JobCost, $Comment, $id);

		if($stmt->execute()){
	
			echo "salvestus õnnestus!";
		}
		$stmt->close();

	}
	
	function saveWorkForSingleCar($Mileage, $DoneJob, $JobCost, $Comment, $carid){


		$stmt = $this->connection->prepare("INSERT INTO repairWork (Mileage, DoneJob, JobCost, Comment, carId) VALUES(?,?,?,?,?)");
		$stmt->bind_param("isisi",$Mileage, $DoneJob, $JobCost, $Comment, $carid);

		if($stmt->execute()){
	
			echo "salvestus õnnestus!";
		}
		$stmt->close();

	}
	
	function deleteCar ($deleted) {


		$stmt = $this->connection->prepare("UPDATE repairCars SET deleted=NOW() WHERE id=? AND deleted IS NULL");

		echo $this->connection->error;
		
		$stmt->bind_param("s", $deleted);

		if($stmt->execute()) {
			echo "kustutamine õnnestus";
		} else {
		 	echo "ERROR ".$stmt->error;
		}

		$stmt->close();

	}

}
?>