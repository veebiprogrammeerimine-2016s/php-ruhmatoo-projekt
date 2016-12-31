<?php

class Lesson{

    private $connection;

    function __construct($mysqli){
        $this->connection = $mysqli;
    }


    function save ($name, $classcode, $teacher, $useremail) {

        $stmt = $this->connection->prepare("INSERT INTO classes_groupwork (name, classcode, teacher, email) VALUES (?, ?, ?, ?)");
        echo $this->connection->error;
        $stmt->bind_param("ssss",$name, $classcode, $teacher, $useremail);

        if($stmt->execute()) {
            echo "Salvestamine õnnestus.";
        }else{
            echo "ERROR ".$stmt->error;
        }
        $stmt->close();
    }}



?>