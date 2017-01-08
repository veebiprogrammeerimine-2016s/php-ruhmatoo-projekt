<?php class Owner
{
    private $connection;

    function __construct($mysqli)
    {
        // osobennost v PHP   $this ukazivaet na objekt klassa
        $this->connection = $mysqli;

    }


    function signUP($username,$password)
    {
        $stmt = $this->connection->set_charset("utf8");
        // sqli rida
        $stmt = $this->connection->prepare("INSERT INTO p_owners (username,password) VALUES (?,?)");


        echo $this->connection->error;

        // stringina üks täht iga muutuja kohta (?), mis tüüp
        // string - s
        // integer - i
        // float (double) - d
        $stmt->bind_param("ss",$username,$password); // sest on email ja password VARCHAR - STRING , ehk siis email - s, password - sa

        //täida käsku
        if($stmt->execute())
        {

        }
        else
        {
            echo "ERROR ".$stmt->error;
        }

        //panen ühenduse kinni
        $stmt->close();

    }

    function login ($username, $password) {

        $stmt = $this->connection->prepare("
		SELECT id, username, password 
		FROM p_owners
		WHERE username = ?");

        echo $this->connection->error;

        //asendan küsimärgi
        $stmt->bind_param("s", $username);

        //määran väärtused muutujatesse
        $stmt->bind_result($id, $usernameFromDb, $passwordFromDb);
        $stmt->execute();

        //andmed tulid andmebaasist või mitte
        // on tõene kui on vähemalt üks vaste
        if($stmt->fetch()){

            //oli sellise meiliga kasutaja
            //password millega kasutaja tahab sisse logida
            //$hash = hash("sha512", $password) ;
            $hash = hash("sha512", $password);

            if ($hash == $passwordFromDb) {

                //echo "Kasutaja logis sisse ".$id;

                //määran sessiooni muutujad, millele saan ligi
                // teistelt lehtedelt
                $_SESSION["userId"] = $id;
                $_SESSION["username"] = $usernameFromDb;

                header("Location: data.php");
                exit();

            }

        }
    }
    function LoginRegValidation($User)
    {
        if (isset($_SESSION["userId"])) {
            //suunan sisselogimise lehele
            header("Location: data.php");


            exit();
        }


        if (isset($_POST["regPassword"]) && isset($_POST["regUsername"])) {
            if (!empty($_POST["regPassword"]) && !empty($_POST["regUsername"])) {
                $password = hash("sha512", $_POST["regPassword"]);
                $User->signUP($_POST["regUsername"], $password);

                ?>
                <script>alert("Kasutaja on tehtud!");</script>
                <?php

            }

        }

        if (isset($_POST["username"]) && isset($_POST["password"])) {

            $User->login($_POST["username"], $_POST["password"]);
            if (!isset($_SESSION["userId"])) {
                ?>
                <script> alert("Vale parool või kasutaja nimi"); </script> <?php
            }

        }
    }
}

?>