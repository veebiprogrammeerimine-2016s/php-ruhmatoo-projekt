<?php

class User
{
    private $connection;

    function __construct($mysqli)
    {
        $this->connection = $mysqli;
    }

    /* Login */
    function login($email, $password)
    {
        $stmt = $this->connection->prepare("SELECT id, email, password, created 
		FROM admins
		WHERE email = ?");

        $stmt->bind_param("s", $email);
        $stmt->bind_result($id, $emailFromDb, $passwordFromDb, $created);
        $stmt->execute();
        if ($stmt->fetch()) {
            $hash = hash("sha512", $password);
            if ($hash == $passwordFromDb) {
                $_SESSION["userId"] = $id;
                $_SESSION["userEmail"] = $emailFromDb;
                header("Location: homework.php");
                exit();
            }

        }
    }
}