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
        }


        function get($useremail){

            $stmt = $this->connection->prepare("
                SELECT id, name, classcode, teacher
                FROM classes_groupwork
                WHERE email = ?
            ");
            echo $this->connection->error;

            $stmt->bind_param("s", $useremail);
            $stmt->bind_result($id, $name, $classcode, $teacher);
            $stmt->execute();

            $result = array();
            while ($stmt->fetch()) {

                $lessons = new StdClass();
                $lessons->id = $id;
                $lessons->name = $name;
                $lessons->classcode = $classcode;
                $lessons->teacher = $teacher;
                array_push($result, $lessons);
            }
            $stmt->close();
            return $result;
        }


        function deleteAll($email){

            $stmt = $this->connection->prepare("DELETE FROM `classes_groupwork` WHERE email = ?");
            $stmt->bind_param("s",$email);
            echo $this->connection->error;
            $stmt->execute();
            $stmt->close();
        }


        function deleteSingle($id){

            $stmt = $this->connection->prepare("DELETE FROM `classes_groupwork` WHERE id = ?");
            $stmt->bind_param("i",$id);
            echo $this->connection->error;
            $stmt->execute();
            $stmt->close();

        }


    }


?>