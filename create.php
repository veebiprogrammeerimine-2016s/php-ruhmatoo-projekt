<?php

    require("functions.php");

    require("../class/User.class.php");
    $user = new user($mysqli);

    $signupEmailError = "";
    $signupPasswordError = "";
    $signupEmail = "";
    $signupName = "";
    $signupLastName = "";
    $signupNameError = "";
    $signupLastNameError = "";


    if ( isset ( $_POST["signupEmail"] ) ) {

        if ( empty ( $_POST["signupEmail"] ) ) {

         $signupEmailError = "See väli on kohustuslik!";

        } else {

            $signupEmail = $_POST["signupEmail"];

        }

    }
    if ( isset ( $_POST["signupPassword"] ) ) {

        if ( empty ( $_POST["signupPassword"] ) ) {

         $signupPasswordError = "See väli on kohustuslik!";

        } else {

            if ( strlen($_POST["signupPassword"]) < 8 ) {

                $signupPasswordError = "Parool peab olema vähemalt 8 tähemärkki pikk";

            }

        }

    }
    if ( isset ( $_POST["signupName"] ) ) {

        if ( empty ( $_POST["signupName"] ) ) {

            $signupNameError = "See väli on kohustuslik!";

        } else {

            $signupName = $_POST["signupName"];

        }

    }
    if ( isset ( $_POST["signupLastName"] ) ) {

        if ( empty ( $_POST["signupLastName"] ) ) {

            $signupLastNameError = "See väli on kohustuslik!";

        } else {

            $signupLastName = $_POST["signupLastName"];

        }

    }
    if ( isset($_POST["signupPassword"]) &&
        isset($_POST["signupEmail"]) &&
        empty($signupEmailError) &&
        empty($signupPasswordError)
    ) {

        echo "Salvestan...<br>";
        echo "email ".$signupEmail."<br>";

        $password = hash("sha512", $_POST["signupPassword"]);

        //echo "parool ".$_POST["signupPassword"]."<br>";
        //echo "räsi ".$password."<br>";

        //echo $serverPassword;

        signup ($signupEmail, $password);




}
?>
<?php require("header.php"); ?>
</form>

<h1>Kasutaja loomine</h1>

<form method="POST">

    <input name="signupEmail" type="text" placeholder="Email" value="<?=$signupEmail;?>"> <?php echo $signupEmailError; ?>

    <br><br>

    <input name="signupPassword" type="password" placeholder="Parool"> <?php echo $signupPasswordError; ?>

    <br><br>

    <input name="signupPassword" type="password" placeholder="Korda parooli"> <?php echo $signupPasswordError; ?>

    <br><br>

    <input name="firstName" type="name" placeholder="Eesnimi">

    <br><br>

    <input name="lastName" type="name" placeholder="Perekonnanimi">

    <br><br>

    <input type="submit" value="Loo kasutaja">


</form>
<?php require("footer.php"); ?>
