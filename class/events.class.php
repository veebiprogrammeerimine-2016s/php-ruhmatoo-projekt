<?php
class Events{
    private $connection;
    function __construct($mysqli){
        $this->connection = $mysqli;
    }

    function newEvent($email, $type, $vin, $date, $price, $descr){

        $stmt = $this->connection->prepare("INSERT INTO garagediary_events (carVin, carOwner, eventType, eventDate, eventPrice, eventDescr) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("ssssds", $vin, $email, $type, $date, $price, $descr);
        $stmt->execute();

    }

    function getAllEvents ($email, $q, $sort, $order){

        $allowedSort = ["eventType", "eventDate", "eventPrice", "eventDescr"];
        if(!in_array($sort, $allowedSort)){
            $sort = "eventType";
        }

        $orderBy = "ASC";

        if($order == "DESC"){
            $orderBy = "DESC";
        }


        if ($q == ""){
            $stmt = $this->connection->prepare("SELECT eventId, carVin, eventType, eventDate, eventPrice, eventDescr FROM garagediary_events WHERE deleted is NULL AND carOwner = ? ORDER BY $sort $orderBy");
            $stmt->bind_param("s", $email);
        }else{
            $stmt = $this->connection->prepare("SELECT eventId, carVin, eventType, eventDate, eventPrice, eventDescr FROM garagediary_events WHERE deleted is NULL AND (carVin LIKE ? OR eventType LIKE ? OR eventDate LIKE ? OR eventPrice LIKE ? OR eventDescr LIKE ?) AND carOwner = ? ORDER BY $sort $orderBy");
            $searchWord = "%".$q."%";
            $stmt->bind_param("ssssss", $searchWord, $searchWord, $searchWord, $searchWord, $searchWord, $email);
        }

        echo $this->connection->error;
        $stmt->bind_result($id, $vin, $type, $date, $price, $descr);

        $stmt->execute();

        $result = array();

        //seni kuni on üks rida andmeid saada(10 rida = 10 korda)
        while($stmt->fetch()){
            $event = new StdClass();
            $event->carVin = $vin;
            $event->eventId = $id;
            $event->eventType = $type;
            $event->eventDate = $date;
            $event->eventPrice = $price;
            $event->eventDescr = $descr;
            array_push($result, $event);
        }

        $stmt->close();

        return $result;
    }
    function delEvent($id){

        $stmt = $this->connection->prepare("UPDATE garagediary_events SET deleted=NOW() WHERE eventId=? AND deleted IS NULL");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
    function getSingleEventData($edit_id){

        $stmt = $this->connection->prepare("SELECT eventType, eventDate, eventPrice, eventDescr FROM garagediary_events WHERE eventId=? AND deleted IS NULL");
        $stmt->bind_param("i", $edit_id);
        $stmt->bind_result($eventType, $eventDate, $eventPrice, $eventDescr);
        $stmt->execute();

        //tekitan objekti
        $event = new stdclass();

        //saime ühe rea andmeid
        if($stmt->fetch()){
            // saan siin alles kasutada bind_result muutujaid
            $event->type = $eventType;
            $event->date = $eventDate;
            $event->price = $eventPrice;
            $event->descr = $eventDescr;


        }else{
            // ei saanud rida andmeid kätte
            // sellist id'd ei ole olemas
            // see rida võib olla kustutatud
            header("Location: index.php");
            exit();
        }

        $stmt->close();
        return $event;

    }
    function updateEvent($id, $type, $date, $price, $descr){


        $stmt = $this->connection->prepare("UPDATE garagediary_events SET eventType=?, eventDate=?, eventPrice=?, eventDescr=? WHERE eventId=? AND deleted IS NULL");
        $stmt->bind_param("ssdsi",$type, $date, $price, $descr, $id);

        // kas õnnestus salvestada
        if($stmt->execute()){
            // õnnestus
            echo "salvestus õnnestus!";
        }

        $stmt->close();

    }

    function getVinsForEvents($email){

      $stmt = $this->connection->prepare("SELECT carVin FROM garagediary_usercars WHERE carOwner=?");
      $stmt->bind_param("s", $email);
      $stmt->bind_result($vincodes);

      $stmt->execute();
      $result = array();

      while ($stmt->fetch()) {
          $v = new StdClass();
          $v->vincodes = $vincodes;
          array_push($result, $v);
        }
        $stmt->close();
        return $result;
    }



}
