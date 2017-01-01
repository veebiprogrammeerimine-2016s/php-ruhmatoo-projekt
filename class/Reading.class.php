<?php

    class Reading{

        private $connection;

        function __construct($mysqli){
            $this->connection = $mysqli;
        }


        function save ($title, $author, $class, $email) {

            $stmt = $this->connection->prepare("INSERT INTO reading_groupwork (title, author, class, email) VALUES (?, ?, ?, ?)");
            echo $this->connection->error;
            $stmt->bind_param("ssss",$title, $author, $class, $email);

            if($stmt->execute()) {
                echo "Salvestamine õnnestus.";
            }else{
                echo "ERROR ".$stmt->error;
            }
            $stmt->close();
        }


        function get($useremail){

            $stmt = $this->connection->prepare("
                SELECT id, title, author, class
                FROM reading_groupwork
                WHERE email = ?
            ");
            echo $this->connection->error;

            $stmt->bind_param("s", $useremail);
            $stmt->bind_result($id, $title, $author, $class);
            $stmt->execute();

            $result = array();
            while ($stmt->fetch()) {

                $lessons = new StdClass();
                $lessons->id = $id;
                $lessons->name = $title;
                $lessons->classcode = $author;
                $lessons->teacher = $class;
                array_push($result, $lessons);
            }
            $stmt->close();
            return $result;
        }}

?>