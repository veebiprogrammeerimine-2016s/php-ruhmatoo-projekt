<?php
class User{

    private $connection;
    function __construct($mysqli)
    {
        $this->connection = $mysqli;
    }

    /*TEISED FUNKTSIOONID*/
    function signUp($username, $email, $password, $age){
        $stmt = $this->connection->prepare("INSERT INTO user_tv (username, email, password, age) VALUES (?, ?, ?, ?)");

        echo $this->connection->error;

        $stmt->bind_param("ssss", $username, $email, $password, $age);

        if ($stmt->execute()) {
            echo "Success!";
        } else {
            echo "ERROR " . $stmt->error;
        }

        $stmt->close();
        $this->connection->close();

    }

    function login($username, $password){

        $error = "";


        $database = "if16_ege";
        $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);

        //sqli rida
        $stmt = $this->connection->prepare("
		SELECT id, username, email, password, created, age, newUser
		FROM user_tv WHERE username = ?");

        echo $mysqli->error;

        $stmt->bind_param("s", $username);

        $stmt->bind_result($id, $usernameFromDb, $emailFromDb, $passwordFromDb, $created, $age, $newUser);
        $stmt->execute();


        if ($stmt->fetch()) {

            $hash = hash("sha512", $password);
            if ($hash == $passwordFromDb) {
                echo "User logged in" . $id;

                $_SESSION["userId"] = $id;
                $_SESSION["userName"] = $usernameFromDb;
                $_SESSION["userEmail"] = $emailFromDb;
				$_SESSION["userAge"] = $age;
                $_SESSION['newUser'] = $newUser;
                $_SESSION["message"] = "<h1>Welcome!</h1>";

                header("Location: data.php");
                exit();

            } else {
                $error = "Incorrect password!";

            }

        } else {

            $error = "Username doesn't exist";
        }

        return $error;

    }

    function updateLogin($userId) {

        $database = "if16_ege";
        $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);

        $stmt = $mysqli->prepare("UPDATE user_tv
                              SET newUser=0 WHERE id=?");

        $stmt->bind_param("i", $userId);

        if ($stmt->execute()) {
            //õnnestus
            //echo
        }

        $mysqli->close();

    }

}

?>