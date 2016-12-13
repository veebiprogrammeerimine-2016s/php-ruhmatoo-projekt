<?php

require("functions.php");

//kui kasutaja on juba sisse logitud siis
//suunan data lehele

if (isset($_SESSION["userId"])) {

    //suunan sisselogimise lehele
    header("Location: data.php");
    exit();
}

//MUUTUJAD
$loginUsername = "";
$loginUsernameError = "";
$signupUsernameError = "";
$signupEmailError = "";
$signupPasswordError = "";
$signupPassword = "";
$signupUsername = "";
$signupEmail = "";
$signupAge = "";


if(isset($_POST["signupUsername"])){

    if(empty($_POST["signupUsername"])){

        $signupUsernameError = "Sisesta kasutajanimi";
    } else {
        $signupUsername = $_POST["signupUsername"];
    }
}

// kas e-post oli olemas
if ( isset ( $_POST["signupEmail"] ) ) {

    if ( empty ( $_POST["signupEmail"] ) ) {

        // oli email, kuid see oli tühi
        $signupEmailError = "See väli on kohustuslik!";

    } else {

        //email olemas
        $signupEmail = $_POST["signupEmail"];

    }

}


if ( isset ( $_POST["signupPassword"] ) ) {

    if ( empty ( $_POST["signupPassword"] ) ) {

        // oli password, kuid see oli tühi
        $signupPasswordError = "See väli on kohustuslik!";

    } else {

        // tean et parool on ja see ei olnud tühi
        // VÄHEMALT 8

        if ( strlen($_POST["signupPassword"]) < 8 ) {

            $signupPasswordError = "Parool peab olema vähemalt 8 tähemärkki pikk";

        }

    }


}

if ( isset ( $_POST["signupAge"] ) &&
    !empty ( $_POST["signupAge"] )) {

    $signupAge = $_POST["signupAge"];
}


if ( isset($_POST["signupEmail"]) &&
    isset($_POST["signupPassword"]) &&
	isset($_POST["signupAge"]) &&
    $signupEmailError == "" &&
    empty ($signupPasswordError)) {

    echo "Salvestan...<br>";

    $password = hash("sha512", $_POST["signupPassword"]);

    $signupEmail = cleanInput($signupEmail);
    $signupUsername = cleanInput($_POST["signupUsername"]);
    signUp($signupUsername, $signupEmail, cleanInput($password), $signupAge);

}

$error ="";
if (isset($_POST["loginUsername"]) &&
    isset($_POST["loginPassword"]) &&
    !empty($_POST["loginUsername"]) &&
    !empty($_POST["loginPassword"])) {

    $error = login(cleanInput($_POST["loginUsername"]), cleanInput($_POST["loginPassword"]));

}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Sisselogimise lehekülg</title>
</head>
<body>

<h1>Log in</h1>

<form method="POST">

    <p style="color:red;"><?=$error;?></p>

    <label>Username:</label><br>
    <input name="loginUsername" type="text" value="<?=$loginUsername;?>">
    <?php echo $loginUsernameError; ?>
    <br><br>
    <input name="loginPassword" type="password" placeholder="Password">
    <br><br>
    <input type="submit" value="Log in">

</form>

<h1>Create account</h1>

<form method="POST">

    <label>Username:</label><br>
    <input name="signupUsername" type="text" value="<?=$signupUsername;?>">
    <?php echo $signupUsernameError; ?>

    <br><br>

    <label>Email:</label><br>
    <input name="signupEmail" type="text" value="<?=$signupEmail;?>">
    <?php echo $signupEmailError; ?>

    <br><br>

    <input name="signupPassword" type="password" placeholder="Password">
    <?php echo $signupPasswordError; ?>

    <br><br>

    <label>Age:</label><br>
    <input name="signupAge" type="age" value="<?=$signupAge;?>">

    <br>

    <input type="submit" value="Create account">

</form>


</body>
</html>