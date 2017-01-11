<?php class TyreFitting
{
    private $connection;

    function __construct($mysqli)
    {
        // osobennost v PHP   $this ukazivaet na objekt klassa
        $this->connection = $mysqli;

    }

    function removeService($id) {
        $stmt = $this->connection->set_charset("utf8");
        $stmt = $this->connection->prepare("DELETE FROM p_tyre_fittings_services WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        return "ok";
    }

    function updateTyreFittingService($id, $name, $descroption, $category, $size, $price, $tyreFittingId) {
        $stmt = $this->connection->set_charset( "utf8" );
        $stmt = $this->connection->prepare("UPDATE p_tyre_fittings_services SET name=?, description=?, category=?, size=?, price=?, tyre_fitting_id=?  WHERE id=?");
        $stmt->bind_param("sssddii", $name, $descroption, $category, $size, $price, $tyreFittingId, $id);
        if ($stmt->execute()) {
            $stmt->close();
            return "ok!";
        }
    }

    function getTyreFittingServiceById($serviceId) {
        $stmt = $this->connection->set_charset( "utf8" );
        $stmt = $this->connection->prepare( "SELECT name, description, category, size, price, tyre_fitting_id FROM p_tyre_fittings_services WHERE id=?" );
        $stmt->bind_param( "i", $serviceId );
        $stmt->bind_result($name, $description, $category, $size, $price, $tyre_fitting_id);
        $stmt->execute();

        $tyreFitterService = new Stdclass();

        if ($stmt->fetch()) {
            $tyreFitterService->name = $name;
            $tyreFitterService->description = $description;
            $tyreFitterService->category = $category;
            $tyreFitterService->size = $size;
            $tyreFitterService->price = $price;
            $tyreFitterService->tyre_fitting_id = $tyre_fitting_id;
        }
        $stmt->close();
        return $tyreFitterService;
    }

    function updateTyreFitter($id, $name, $description, $logo, $location, $pricelist, $ownerId) {
        $stmt = $this->connection->set_charset( "utf8" );
        $stmt = $this->connection->prepare("UPDATE p_tyre_fittings SET name=?, logo=?, description=?, location=?, pricelist=?, owner_id=? WHERE id=?");
        $stmt->bind_param("sssssii", $name, $description, $logo, $location, $pricelist, $ownerId, $id);
        if ($stmt->execute()) {
            $stmt->close();
            return "ok!";
        }
    }

    function addNewService($name, $description, $category, $size, $price, $tyreFittingId) {
        $stmt = $this->connection->set_charset("utf8");
        $stmt = $this->connection->prepare("INSERT INTO p_tyre_fittings_services (name, description, category, size, price, tyre_fitting_id) VALUES(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssddi", $name, $description, $category, $size, $price, $tyreFittingId);
        $stmt->execute();
        $stmt->close();
        return "ok";
    }

    function getTyreFitterServices($tyreFittingId) {
        $stmt = $this->connection->set_charset("utf8");
        $stmt = $this->connection->prepare("SELECT p_tyre_fittings_services.id, p_tyre_fittings_services.name, p_tyre_fittings_services.price FROM p_tyre_fittings_services WHERE tyre_fitting_id=?");
        $stmt->bind_param("i", $tyreFittingId);
        $stmt->bind_result($id, $name, $price);
        $stmt->execute();

        $fittingServices = array();
        while ($stmt->fetch()) {
            $service = new StdClass();
            $service->id = $id;
            $service->name = $name;
            $service->price = $price;
            array_push($fittingServices, $service);
        }
        $stmt->close();
        return $fittingServices;
    }

    function removeTyreFitter($tyreFittingId) {
        $stmt = $this->connection->set_charset("utf8");
        $stmt = $this->connection->prepare("DELETE FROM p_tyre_fittings WHERE id=?");
        $stmt->bind_param("i", $tyreFittingId);
        $stmt->execute();
        $stmt->close();
        return "ok";
    }

    function addTyreFitterWorkingTime($day, $open, $close, $tyreFittingId) {
        $stmt = $this->connection->set_charset("utf8");
        $stmt = $this->connection->prepare("INSERT INTO p_open_time (day, open, close, tyre_fitting_id) VALUES(?, ?, ?, ?)");
        $stmt->bind_param("issi", $day, $open, $close, $tyreFittingId);
        $stmt->execute();
        $stmt->close();
    }

    function addNewTyreFitting($name, $description, $logo, $location, $pricelist, $ownerId) {
        $stmt = $this->connection->set_charset( "utf8" );
        $stmt = $this->connection->prepare("INSERT INTO p_tyre_fittings (name, description, logo, location, pricelist, owner_id)  VALUES(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $name, $description, $logo, $location, $pricelist, $ownerId);
        $stmt->execute();
        return $stmt->insert_id;
    }

    function getSingleTyreFitting($details_id)
    {

        $stmt = $this->connection->set_charset( "utf8" );

        $stmt = $this->connection->prepare( "SELECT name, logo, description,location,pricelist FROM p_tyre_fittings WHERE id=?" );

        $stmt->bind_param( "i", $details_id );
        $stmt->bind_result($name, $logo, $description,$location,$pricelist);
        $stmt->execute();

        //tekitan objekti
        $tyreFitting = new Stdclass();

        //saime ühe rea andmeid
        if ($stmt->fetch()) {
            // saan siin alles kasutada bind_result muutujaid
            $tyreFitting->name = $name;
            $tyreFitting->logo = $logo;
            $tyreFitting->description = $description;
            $tyreFitting->location = $location;
            $tyreFitting->pricelist = $pricelist;
        } else {
            // ei saanud rida andmeid kätte
            // sellist id'd ei ole olemas
            // see rida võib olla kustutatud
            header( "Location: index.php" );
            exit();
        }

        //$stmt->close();


        return $tyreFitting;

    }

    function getTyreFittingsByOwnerId($owner_id)
    {
        $stmt = $this->connection->set_charset("utf8");
        $stmt = $this->connection->prepare("SELECT id, name, owner_id FROM p_tyre_fittings WHERE owner_id=?");
        $stmt->bind_param("i", $owner_id);
        echo $this->connection->error;
        $stmt->bind_result($id, $name, $owner_id);
        $stmt->execute();

        $result = array();

        while ($stmt->fetch()) {
            $i = new StdClass();
            $i->id = $id;
            $i->name = $name;
            $i->owner_id = $owner_id;
            array_push($result, $i);
        }

        $stmt->close();
        // $this->connection->close();
        return $result;
    }

    function FittingServicesMinPrice($details_id)
    {

        $stmt = $this->connection->set_charset( "utf8" );

        /*	$stmt = $mysqli->prepare("SELECT name, description, category,size,price FROM p_tyre_fittings_services WHERE tyre_fitting_id=?");*/
        $stmt = $this->connection->prepare( "SELECT id, name,description,category,size,MIN(price) FROM p_tyre_fittings_services WHERE tyre_fitting_id=? GROUP BY name ORDER BY price;" );

        $stmt->bind_param( "i", $details_id );
        $stmt->bind_result( $id, $name, $description, $category, $size, $price );
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

            array_push( $result, $i );
        }

        $stmt->close();

        return $result;
    }

    function getAllTyreFittings()
    {

        $stmt = $this->connection->set_charset( "utf8" );
        $stmt = $this->connection->prepare( "
			SELECT id,name, logo, LEFT(description, 100),owner_id
			FROM p_tyre_fittings
		" );
        echo $this->connection->error;

        $stmt->bind_result( $id, $name, $logo, $description, $owner_id );
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

            array_push( $result, $i );
        }
        $stmt->close();
        $this->connection->close();
        return $result;
    }

    function getTyreFittingTimesAvailable($id)
    {

        $stmt = $this->connection->set_charset( "utf8" );
        $stmt = $this->connection->prepare( "
			SELECT day,open,close,lunch_begin,lunch_end 
			FROM p_open_time WHERE tyre_fitting_id = ?
		" );
        echo $this->connection->error;
        $stmt->bind_param( "i", $id );
        $stmt->bind_result( $day, $open, $close, $lunch_begin, $lunch_end );
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

            array_push( $result, $i );
        }
        $stmt->close();
        $this->connection->close();

        return $result;
    }
}