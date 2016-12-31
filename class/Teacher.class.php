<?php

    class Teacher{

        private $connection;

        function __construct($mysqli){

            $this->connection = $mysqli;
        }


        function save ($name, $roomnumber, $email, $website, $useremail) {

            $stmt = $this->connection->prepare("INSERT INTO teachers_groupwork (name, classroom, material, email, useremail) VALUES (?, ?, ?, ?, ?)");
            echo $this->connection->error;
            $stmt->bind_param("sssss",$name, $roomnumber, $email, $website, $useremail );

            if($stmt->execute()) {
                echo "Salvestamine õnnestus.";
            } else {
                echo "ERROR ".$stmt->error;
            }
            $stmt->close();
        }



    }

?>