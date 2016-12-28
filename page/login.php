<?php

    require("functions.php");
    require("../class/User.class.php");

    $User = new User($mysqli);

    // Kui on sisse loginud, siis suunan data lehele.
    if(isset($_SESSION["userId"])){

        header("Location: data.php");
        exit();
    }



    $signupEmailError = "";
    $signupPasswordError = "";
    $signupEmail = "";
    $signupFirstName = "";
    $signupLastName = "";
    $error = "";



    if(isset($_POST["signupFirstname"])){

        if(!empty($_POST["signupFirstname"])){

            $signupFirstName = $_POST["signupFirstname"];

        }

    }


    if(isset($_POST["signupLastname"])){

        if(!empty($_POST["signupLastname"])){

            $signupLastName = $_POST["signupLastname"];

        }

    }


    // Kui registreerimis-formis emaili pole, tekitab errori, muidu salvestab formi sisu muutujasse.
    if(isset($_POST["signupEmail"])){

        if (empty($_POST["signupEmail"])){

            $signupEmailError = "See väli on kohustuslik!";

        }else{

            $signupEmail = $_POST["signupEmail"];
        }

    }


    // Kui registreerimis-formis ei ole parooli pandud või see on liiga lühike tekitab errori.
    if( isset( $_POST["signupPassword"] ) ){

        if( empty( $_POST["signupPassword"] ) ){

            $signupPasswordError = "Parool on kohustuslik";

        }else{

            // Kas parooli pikkus on väiksem kui 8
            if ( strlen($_POST["signupPassword"]) < 8 ){
                $signupPasswordError = "Parool peab olema vähemalt 8 tähemärkki pikk";

            }

        }

    }


    // Kui paroolid on olemas ning nendega seoses errorit polnud, tekitab kasutaja.
    // Muidu redirectib tagasi, kustutades sellega formi sisu.
    if (isset($_POST["signupEmail"]) && isset($_POST["signupPassword"]) && $signupEmailError == "" && $signupPasswordError == ""){

        $password = hash("sha512", $_POST["signupPassword"]);
        $signupEmail = $Helper->cleanInput($signupEmail);
        $User->signUp($signupEmail, $Helper->cleanInput($password));

    }else{
        header("Location: index.php");

    }


    // Kui sisselogimis-form on saadetud ning millegagi täidetud, logi sisse.
    if (isset($_POST["loginEmail"]) && isset($_POST["loginPassword"]) && !empty($_POST["loginEmail"]) && !empty($_POST["loginPassword"])){

        $error = $User->login($Helper->cleanInput($_POST["loginEmail"]), $Helper->cleanInput($_POST["loginPassword"]));

    }

?>


