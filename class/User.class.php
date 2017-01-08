<?php
class User
{

    private $connection;

    function __construct($mysqli)
    {

        //this viitab klassile (this == User)
        $this->connection = $mysqli;


    }

    /*TEISED FUNKTSIOONI*/
    function signUp($username, $email, $password, $age)
    {


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

    function login($username, $password)
    {

        $error = "";


        $database = "if16_ege";
        $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);

        //sqli rida
        $stmt = $mysqli->prepare("
		SELECT id, username, email, password, created, age
		FROM user_tv WHERE username = ?");

        echo $mysqli->error;

        $stmt->bind_param("s", $username);

        $stmt->bind_result($id, $usernameFromDb, $emailFromDb, $passwordFromDb, $created, $age);
        $stmt->execute();


        if ($stmt->fetch()) {

            $hash = hash("sha512", $password);
            if ($hash == $passwordFromDb) {
                echo "User logged in" . $id;

                $_SESSION["userId"] = $id;
                $_SESSION["userName"] = $usernameFromDb;
                $_SESSION["userEmail"] = $emailFromDb;
				$_SESSION["userAge"] = $age;
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

}

function student_confirmation($id,$username,$password,$email,$age)
{
$subject = "Email Verification mail";
$headers = "From: email@domain.com \r\n";
$headers .= "Reply-To: email@domain.com \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$message = '<html><body>';
$message.='<div style="width:550px; background-color:#CC6600; padding:15px; font-weight:bold;">';
$message.='Email Verification mail';
$message.='</div>';
$message.='<div style="font-family: Arial;">Confiramtion mail have been sent to your email id<br/>';
$message.='click on the below link in your verification mail id to verify your account ';
$message.="<a href='http://yourdomain.com/user-confirmation.php?id=$id&email=$email&confirmation_code=$rand'>click</a>";
$message.='</div>';
$message.='</body></html>';

mail($email,$subject,$message,$headers);
}
?>