<?php class Car {
    private $connection;
    function __construct($mysqli){
        $this->connection = $mysqli;
    }
    function saveCar ($RegPlate, $Mark, $Model) {

        $stmt = $this->connection->prepare("INSERT INTO repairCars (RegPlate, Mark, Model) VALUES (?, ?, ?)");

        echo $this->connection->error;

        $stmt->bind_param("sss", $RegPlate, $Mark, $Model);

        if ($stmt->execute()) {

            echo "Salvestamine õnnestus";
        } else {
            echo "ERROR ".$stmt->error;
        }
    }
	
	function getSingleData($edit_id){


		$stmt = $this->connection->prepare("SELECT id, Mileage, DoneJob, JobCost, Comment FROM repairCars WHERE id=?");

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

			header("Location: userpage.php");
			exit();
		}

		$stmt->close();

		return $car;

	}

	
    function getUserCars () {

        $stmt = $this->connection->prepare("SELECT id, RegPlate, Mark, Model, Mileage, Donejob, JobCost, Comment FROM repairCars");
        echo $this->connection->error;

        $stmt ->bind_result($id, $RegPlate, $Mark, $Model, $Mileage, $DoneJob, $JobCost, $Comment);
        $stmt -> execute ();

        $result = array();

        while ($stmt->fetch()) {

            $car = new StdClass ();
            $car->id = $id;
            $car->Tyyp = $RegPlate;
            $car->Mark = $Mark;
            $car->Model = $Model;
			$car->Mileage = $Mileage;
			$car->DoneJob = $DoneJob;
			$car->JobCost = $JobCost;
			$car->Comment = $Comment;

            array_push($result, $car);

        }

        $stmt->close();
        return $result;
    }
    function getAll($q, $sort) {

        $allowedSort = ["UserId", "RegPlate", "Mark", "Model"];
        if(!in_array($sort, $allowedSort)) {
            //ei ole lubatud tulp
            $sort = "UserId";
        }

        if($q != "") {

            echo "Otsib: ".$q;

            $stmt = $this->connection->prepare("
			SELECT UserId, RegPlate, Mark, Model
			FROM repairCars
			WHERE deleted IS NULL AND UserId = ?
			AND (RegPlate LIKE ? OR Mark LIKE ? OR Model LIKE ?)
			ORDER BY $sort
			
			");
            $searchWord="%".$q."%";
            $stmt->bind_param("iss", $_SESSION["UserId"], $searchWord, $searchWord);

        } else {
            $stmt = $this->connection->prepare("
			SELECT UserId, RegPlate, Mark, Model
			FROM repairCars
			WHERE deleted IS NULL AND UserId = ?
			ORDER BY $sort 
			");


        }
        echo $this->connection->error;

        $stmt->bind_result($UserId, $RegPlate, $Mark, $Model);
        $stmt->execute();


        //tekitan massiivi
        $result = array();

        // tee seda seni, kuni on rida andmeid
        // mis vastab select lausele
        while ($stmt->fetch()) {

            //tekitan objekti
            $car = new StdClass();

            $Car->id = $UserId;
            $Car->RegPlate = $RegPlate;
            $Car->Mark = $Mark;
            $Car->Model = $Model;

            //echo $plate."<br>";
            // iga kord massiivi lisan juurde nr m�rgi
            array_push($result, $RegPlate);
        }

        $stmt->close();


        return $result;
    }
	
	function update($Mileage, $DoneJob, $JobCost, $Comment){


		$stmt = $this->connection->prepare("UPDATE repairCars SET Mileage=?, DoneJob=?, JobCost=?, Comment=? WHERE id=?");
		$stmt->bind_param("isis",$Mileage, $DoneJob, $JobCost, $Comment);

		if($stmt->execute()){
	
			echo "salvestus �nnestus!";
		}
		$stmt->close();

	}

}
?>