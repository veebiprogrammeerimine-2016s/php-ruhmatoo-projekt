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
            }else{
                echo "ERROR ".$stmt->error;
            }
            $stmt->close();

        }


        function get($useremail){

            $stmt = $this->connection->prepare("
			SELECT id, name, classroom, email, material
			FROM teachers_groupwork
			WHERE useremail = ?
		");
            echo $this->connection->error;

            $stmt->bind_param("s", $useremail);
            $stmt->bind_result($id, $name, $classroom, $email, $material);
            $stmt->execute();

            $result = array();
            while ($stmt->fetch()) {

                $teachers = new StdClass();
                $teachers->id = $id;
                $teachers->name = $name;
                $teachers->classroom = $classroom;
                $teachers->email = $email;
                $teachers->material = $material;
                array_push($result, $teachers);
            }
            $stmt->close();
            return $result;
        }


        function deleteAll(){

            $stmt = $this->connection->prepare("DELETE FROM `teachers_groupwork` WHERE 1");
            echo $this->connection->error;
            $stmt->execute();
            $stmt->close();
        }

        function deleteSingle($id){

            $stmt = $this->connection->prepare("DELETE FROM `teachers_groupwork` WHERE id = ?");
            $stmt->bind_param("i",$id);
            echo $this->connection->error;
            $stmt->execute();
            $stmt->close();

        }

    }

?>