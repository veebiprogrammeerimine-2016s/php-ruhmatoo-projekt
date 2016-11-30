<?php

    require("functions.php");

    require("class/user.class.php");
    $User = new User($mysqli);

    $signupEmailError = "";
    $signupPasswordError = "";
    $signupEmail = "";
    $firstname = "";
    $lastname = "";
    $firstnameError = "";
    $lastnameError = "";


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
    
	if ( isset ( $_POST["firstname"] ) ) {

        if ( empty ( $_POST["firstname"] ) ) {

            $firstnameError = "See väli on kohustuslik!";

        } else {

            $firstname = $_POST["firstname"];

        }
    }
    if ( isset ( $_POST["lastname"] ) ) {

        if ( empty ( $_POST["lastname"] ) ) {

            $lastnameError = "See väli on kohustuslik!";

        } else {

            $lastname = $_POST["lastname"];

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
		
		echo "parool ".$_POST["signupPassword"]."<br>";
        echo "räsi ".$password."<br>";

		$signupEmail = cleanInput($signupEmail);
		
		$User->signup($signupEmail, cleanInput($password), $firstname, $lastname);
       


}
?>
<?php require("header.php"); ?>
<div class="container">
    <div class="row">
        <div align="center">
            <h1>Kasutaja loomine</h1>
            <form method="POST">
            <br>
                <div class="form-group">
                    <input name="signupEmail" type="text" placeholder="Email" value="<?=$signupEmail;?>"> <?php echo $signupEmailError; ?>
                </div>
                <br>
                <div class="form-group">
                    <input name="signupPassword" type="password" placeholder="Parool"> <?php echo $signupPasswordError; ?>
                </div>
                <br>
                <div class="form-group">
                    <input name="signupPassword" type="password" placeholder="Korda parooli"> <?php echo $signupPasswordError; ?>
                </div>
                <br>
                <div class="form-group">
                    <input name="firstname" type="name" placeholder="Eesnimi"> <?php echo $firstnameError; ?>
                </div>
                <br>
                <div class="form-group">
                    <input name="lastname" type="name" placeholder="Perekonnanimi"> <?php echo $lastnameError; ?>

                </div>
                <input class="btn btn-Success btn-sm" type="submit" value="Loo kasutaja">
                <br>
                <a class="btn btn-Success btn-sm" href="firstpage.php"> Loobu</a>


</form>
<?php require("footer.php"); ?>
