<?php
class User
{

    private $connection;

    function __construct($mysqli)
    {

        $this->connection = $mysqli;
    }

    //Program functions

    function signup($email, $password, $name, $surname) {

        $stmt = $this->connection->prepare("INSERT INTO cp_users (email, password, name, surname) VALUE (?, ?, ?, ?)");
        echo $this->connection->error;

        $stmt->bind_param("ssss", $email, $password, $name, $surname);

        if ( $stmt->execute() ) {
            echo "Success!";
        } else {
            echo "ERROR ".$stmt->error;
        }

    }

    function login($email, $password) {

        $notice = "";


        $stmt = $this->connection->prepare("
			SELECT id, email, password, created
			FROM cp_users
			WHERE email = ?
		");

        echo $this->connection->error;

        //asendan küsimärgi
        $stmt->bind_param("s", $email);

        //rea kohta tulba väärtus
        $stmt->bind_result($id, $emailFromDb, $passwordFromDb, $created);

        $stmt->execute();

        //ainult SELECT'i puhul
        if($stmt->fetch()) {
            // oli olemas, rida käes
            //kasutaja sisestas sisselogimiseks
            $hash = hash("sha512", $password);

            if ($hash == $passwordFromDb) {
                echo "User $id logged in";

                $_SESSION["userId"] = $id;
                $_SESSION["userEmail"] = $emailFromDb;
                //echo "ERROR";

                header("Location: data.php");
                exit();

            } else {
                $notice = "Incorrect password!";
            }


        } else {

            //ei olnud ühtegi rida
            $notice = "Username linked with ".$email." doesn't exist";
        }

        $stmt->close();

        return $notice;

    }

}
?>