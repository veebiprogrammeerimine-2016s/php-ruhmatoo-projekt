<?php

require("../functions.php");
require("../class/User.class.php");
$User = new User($mysqli);

//Kui on sisse loginud, siis suunan data lehele.
if(isset($_SESSION["userId"])){

    header("Location: data.php");
    exit();
}

//MUUTUJAD
$signupEmailError = "";
$signupPasswordError = "";
$signupEmail = "";

if(isset($_POST["signupEmail"])) {
    if (empty($_POST["signupEmail"])) {
        $signupEmailError = "See väli on kohustuslik!";
    } else {
        $signupEmail = $_POST["signupEmail"];
    }
}

if( isset( $_POST["signupPassword"] ) ){

    if( empty( $_POST["signupPassword"] ) ){

        $signupPasswordError = "Parool on kohustuslik";

    } else {

        // kas parooli pikkus on väiksem kui 8
        if ( strlen($_POST["signupPassword"]) < 8 ) {

            $signupPasswordError = "Parool peab olema vähemalt 8 tähemärkki pikk";

        }

    }

}

//Peab olema email ja parool
if ( isset($_POST["signupEmail"]) &&
    isset($_POST["signupPassword"]) &&
    $signupEmailError == "" &&
    empty($signupPasswordError)
) {
    echo "Salvestan...";

    echo "email: ".$signupEmail."<br>";
    echo "password: ".$_POST["signupPassword"]."<br>";

    $password = hash("sha512", $_POST["signupPassword"]);

    echo "password hashed: ".$password."<br>";

    // KASUTAN FUNKTSIOONI
    $signupEmail = $Helper->cleanInput($signupEmail);

    $User->signUp($signupEmail, $Helper->cleanInput($password));

}

$error ="";
if ( isset($_POST["loginEmail"]) &&
    isset($_POST["loginPassword"]) &&
    !empty($_POST["loginEmail"]) &&
    !empty($_POST["loginPassword"])
) {

    $error = $User->login($Helper->cleanInput($_POST["loginEmail"]), $Helper->cleanInput($_POST["loginPassword"]));

}

?>


