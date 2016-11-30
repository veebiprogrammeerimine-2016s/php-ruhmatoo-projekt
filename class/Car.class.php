<?php class Car {
    private $connection;
    function __construct($mysqli){
        $this->connection = $mysqli;
    }
    function saveCar ($Tyyp, $Color) {

        $stmt = $this->connection->prepare("INSERT INTO CarWatchingGame (Tyyp, Color) VALUES (?, ?)");

        echo $this->connection->error;

        $stmt->bind_param("ss", $Tyyp, $Color);

        if ($stmt->execute()) {

            echo "Salvestamine õnnestus";
        } else {
            echo "ERROR ".$stmt->error;
        }
    }
}