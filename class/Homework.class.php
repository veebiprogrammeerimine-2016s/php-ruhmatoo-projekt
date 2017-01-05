<?php

class Homework{

    private $connection;

    function __construct($mysqli){
        $this->connection = $mysqli;
    }


    function save ($type, $descritpion, $date, $class, $priority, $email) {

        $stmt = $this->connection->prepare("INSERT INTO homework_groupwork (type, description, date, class, priority, email) VALUES (?, ?, ?, ?, ?, ?)");
        echo $this->connection->error;
        $stmt->bind_param("ssssss",$type, $descritpion, $date, $class, $priority, $email);

        if($stmt->execute()) {
            echo "Salvestamine õnnestus.";
        }else{
            echo "ERROR ".$stmt->error;
        }
        $stmt->close();
    }


    function get($useremail, $q){


        if($q == ""){
            $stmt = $this->connection->prepare("
            SELECT id, type, description, date, class, priority
            FROM homework_groupwork
            WHERE email = ?");
            echo $this->connection->error;

            $stmt->bind_param("s", $useremail);
            $stmt->bind_result($id, $type, $description, $date, $class, $priority);
            $stmt->execute();

            $result = array();
            while ($stmt->fetch()) {

                $homeworks = new StdClass();
                $homeworks->id = $id;
                $homeworks->type = $type;
                $homeworks->description = $description;
                $homeworks->date = $date;
                $homeworks->class = $class;
                $homeworks->priority = $priority;
                array_push($result, $homeworks);
            }
            $stmt->close();
            return $result;

        }else{

            $searchword = "%$q%";
            $stmt = $this->connection->prepare("
            SELECT id, type, description, date, class, priority
            FROM homework_groupwork
            WHERE email = ?
            AND (class LIKE ? OR description LIKE ? OR type LIKE ?)");
            echo $this->connection->error;

            $stmt->bind_param("ssss", $useremail, $searchword, $searchword, $searchword);
            $stmt->bind_result($id, $type, $description, $date, $class, $priority);
            $stmt->execute();

            $result = array();
            while ($stmt->fetch()) {

                $homeworks = new StdClass();
                $homeworks->id = $id;
                $homeworks->type = $type;
                $homeworks->description = $description;
                $homeworks->date = $date;
                $homeworks->class = $class;
                $homeworks->priority = $priority;
                array_push($result, $homeworks);
            }
            $stmt->close();
            return $result;
        }

    }


    function deleteAll($email){

        $stmt = $this->connection->prepare("DELETE FROM `homework_groupwork` WHERE email = ?");
        $stmt->bind_param("s",$email);
        echo $this->connection->error;
        $stmt->execute();
        $stmt->close();
    }


    function deleteSingle($id){


        $stmt = $this->connection->prepare("DELETE FROM `homework_groupwork` WHERE id = ?");
        $stmt->bind_param("i",$id);
        echo $this->connection->error;
        $stmt->execute();
        $stmt->close();

    }

}


?>