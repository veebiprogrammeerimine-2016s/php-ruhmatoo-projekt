<?php

class Email{

    private $connection;

    function __construct($mysqli){
        $this->connection = $mysqli;
    }


    function save ($email) {

        $stmt = $this->connection->prepare("INSERT INTO newsletter_groupwork (email) VALUES (?)");
        echo $this->connection->error;
        $stmt->bind_param("s",$email);

        if($stmt->execute()) {
            echo "Salvestamine õnnestus.";
        }else{
            echo "ERROR ".$stmt->error;
        }
        $stmt->close();

    }

?>