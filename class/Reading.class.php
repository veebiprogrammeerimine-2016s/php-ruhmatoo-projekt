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

                $reading = new StdClass();
                $reading->id = $id;
                $reading->name = $title;
                $reading->author = $author;
                $reading->class = $class;
                array_push($result, $reading);
            }
            $stmt->close();
            return $result;
        }

        function deleteAll(){

            $stmt = $this->connection->prepare("DELETE FROM `reading_groupwork` WHERE 1");
            echo $this->connection->error;
            $stmt->execute();
            $stmt->close();
        }


        function deleteSingle($id){

            $stmt = $this->connection->prepare("DELETE FROM `reading_groupwork` WHERE id = ?");
            $stmt->bind_param("i",$id);
            echo $this->connection->error;
            $stmt->execute();
            $stmt->close();

        }
    }

?>