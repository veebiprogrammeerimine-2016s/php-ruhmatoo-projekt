<?php class Order
{
    private $connection;

    function __construct($mysqli)
    {
        // osobennost v PHP   $this ukazivaet na objekt klassa
        $this->connection = $mysqli;

    }
    function getOrders($id)
    {
        $stmt = $this->connection->set_charset("utf8");
        // sqli rida
        $stmt = $this->connection->prepare("SELECT booktime FROM p_orders WHERE tyre_fitting_id = ?");

        echo $this->connection->error;

        $stmt->bind_param("i", $id);
        $stmt->bind_result($booktime);
        $stmt->execute();

        //tekitan massiivi
        $result = array();

        // tee seda seni, kuni on rida andmeid
        // mis vastab select lausele
        while ($stmt->fetch()) {
            //tekitan objekti
            $i = new StdClass();
            $i->booktime = $booktime;
            array_push($result, $i);
        }
        $stmt->close();

        //$mysqli->connection->close();
        return $result;
    }

    function placeOrder($name, $email, $phone,
                        $note, $service, $carnumber,
                        $booktime, $tyreFittingId )
    {

        $stmt = $this->connection->eset_charset("utf8");
        // sqli rida
        $stmt = $this->connection->eprepare("INSERT INTO p_orders (name,email,phone,note,service,carnumber,booktime,tyre_fitting_id)VALUES (?,?,?,?,?,?,?,?)");


        echo $this->connection->eerror;

        // stringina üks täht iga muutuja kohta (?), mis tüüp
        // string - s
        // integer - i
        // float (double) - d
        $stmt->bind_param("sssssssi",$name, $email, $phone,
            $note, $service, $carnumber,
            $booktime, $tyreFittingId);

        //täida käsku
        if($stmt->execute())
        {
            //salvestamine õnnestunud
            return true;
        }
        else
        {
            echo "ERROR ".$stmt->error;
            return false;
        }

        //panen ühenduse kinni
        $stmt->close();

    }

}