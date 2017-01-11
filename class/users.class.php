<?php
class Users{
    private $connection;
    function __construct($mysqli){
        $this->connection = $mysqli;
    }
    function signup ($email, $password, $bday, $gender){

        $stmt = $this->connection->prepare("INSERT INTO garagediary_users (email, password, bday, gender) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss", $email, $password, $bday, $gender);

        if($stmt->execute()){
            $signupNotice ="Account created!";
        }else{
            $signupNotice ="E-mail already in use!";
        }
        return $signupNotice;
    }


    function login ($email, $password){

        $loginNotice = "";

        $stmt = $this->connection->prepare("SELECT id, email, password, created FROM garagediary_users WHERE email=?");
        $stmt->bind_param("s", $email);

        //määran tulpadele muutujad
        $stmt->bind_result($id, $emailFromDatabase, $passwordFromDatabase, $created);
        $stmt->execute();

        //küsin rea andmeid
        if($stmt->fetch()){
            //oli rida siis võrdlen paroole
            $hash = hash("sha512", $password);
            if ($hash == $passwordFromDatabase){
                echo "Kasutaja".$email." logis sisse!";
                $_SESSION["userId"] = $id;
                $_SESSION['email'] = $emailFromDatabase;

                //suunaks uuele lehele
                header("Location: index.php");
            }else{
                $loginNotice = "Incorrect password!";
            }

        }else{
            //ei olnud
            $loginNotice ="Such account doesn't exist!";
        }
        return $loginNotice;
    }
}
