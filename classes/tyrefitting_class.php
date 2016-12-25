<?php class TyreFitting
{
    private $connection;

    function __construct($mysqli)
    {
        // osobennost v PHP   $this ukazivaet na objekt klassa
        $this->connection = $mysqli;

    }
    function getSingleTyreFitting($details_id){

        $stmt = $this->connection->set_charset("utf8");

        $stmt = $this->connection->prepare("SELECT name, logo, description,location,pricelist FROM p_tyre_fittings WHERE id=?");

        $stmt->bind_param("i", $details_id);
        $stmt->bind_result($name, $logo, $description,$location,$pricelist);
        $stmt->execute();

        //tekitan objekti
        $tyreFitting = new Stdclass();

        //saime ühe rea andmeid
        if($stmt->fetch()){
            // saan siin alles kasutada bind_result muutujaid
            $tyreFitting->name = $name;
            $tyreFitting->logo = $logo;
            $tyreFitting->description = $description;
            $tyreFitting->location = $location;
            $tyreFitting->pricelist = $pricelist;


        }else{
            // ei saanud rida andmeid kätte
            // sellist id'd ei ole olemas
            // see rida võib olla kustutatud
            header("Location: index.php");
            exit();
        }

        $stmt->close();


        return $tyreFitting;

    }
    function FittingServicesMinPrice($details_id){

        $stmt = $this->connection->set_charset("utf8");

        /*	$stmt = $mysqli->prepare("SELECT name, description, category,size,price FROM p_tyre_fittings_services WHERE tyre_fitting_id=?");*/
        $stmt = $this->connection->prepare("SELECT id, name,description,category,size,MIN(price) FROM p_tyre_fittings_services WHERE tyre_fitting_id=? GROUP BY name ORDER BY price;");

        $stmt->bind_param("i", $details_id);
        $stmt->bind_result($id, $name, $description, $category, $size, $price);
        $stmt->execute();

        $result = array();

        // tee seda seni, kuni on rida andmeid
        // mis vastab select lausele
        while ($stmt->fetch()) {

            //tekitan objekti
            $i = new StdClass();

            $i->id = $id;
            $i->name = $name;
            $i->category = $category;
            $i->description = $description;
            $i->description = $description;
            $i->size = $size;
            $i->price = $price;

            array_push($result, $i);
        }

        $stmt->close();

        return $result;
    }
    function getAllTyreFittings() {

        $stmt = $this->connection->set_charset("utf8");
        $stmt = $this->connection->prepare("
			SELECT id,name, logo, LEFT(description, 100),owner_id
			FROM p_tyre_fittings
		");
        echo $this->connection->error;

        $stmt->bind_result($id,$name,$logo,$description, $owner_id);
        $stmt->execute();


        //tekitan massiivi
        $result = array();

        // tee seda seni, kuni on rida andmeid
        // mis vastab select lausele
        while ($stmt->fetch()) {

            //tekitan objekti
            $i = new StdClass();

            $i->id = $id;
            $i->name = $name;
            $i->logo = $logo;
            $i->description = $description;
            $i->owner_id = $owner_id;

            array_push($result, $i);
        }
        $stmt->close();
        $this->connection->close();
        return $result;
    }

    function getTyreFittingTimesAvailable($id) {

        $stmt = $this->connection->set_charset("utf8");
        $stmt = $this->connection->prepare("
			SELECT day,open,close,lunch_begin,lunch_end 
			FROM p_open_time WHERE tyre_fitting_id = ?
		");
        echo $this->connection->error;
        $stmt->bind_param("i", $id);
        $stmt->bind_result($day,$open,$close,$lunch_begin,$lunch_end);
        $stmt->execute();


        //tekitan massiivi
        $result = array();

        // tee seda seni, kuni on rida andmeid
        // mis vastab select lausele
        while ($stmt->fetch()) {

            //tekitan objekti
            $i = new StdClass();

            $i->day = $day;
            $i->open = $open;
            $i->close = $close;
            $i->lunch_begin = $lunch_begin;
            $i->lunch_end = $lunch_end;

            array_push($result, $i);
        }
        $stmt->close();
        $this->connection->close();

        return $result;
    }
}