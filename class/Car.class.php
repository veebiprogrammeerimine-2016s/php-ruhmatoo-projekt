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
    function getUserCars () {

        $stmt = $this->connection->prepare("SELECT id, RegPlate, Mark, Model FROM repairCars WHERE Deleted IS NULL");
        echo $this->connection->error;

        $stmt ->bind_result($id, $RegPlate, $Mark, $Model);
        $stmt -> execute ();

        $result = array();

        while ($stmt->fetch()) {

            $car = new StdClass ();
            $car->id = $id;
            $car->Tyyp = $RegPlate;
            $car->Color = $Mark;
            $car->Created = $Model;

            array_push($result, $car);

        }

        $stmt->close();
        return $result;
    }
}
?>