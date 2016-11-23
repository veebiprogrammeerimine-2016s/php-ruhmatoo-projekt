<?php
class user {
    private $connection;
    function __construct($mysqli) {
        $this->connection = $mysqli;
    }
    function signup ($email, $password) {


        $this->connection = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);

        $stmt = $this->connection->prepare("INSERT INTO repairUsers (email, password) VALUES (?, ?)");


        echo $this->connection->error;

        $stmt->bind_param("ss", $email, $password);

        if ($stmt->execute()) {

            echo "salvestamine õnnestus";
        } else {
            echo "ERROR ".$stmt->error;
        }
    }
}
?>