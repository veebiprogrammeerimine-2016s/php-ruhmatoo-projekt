<?php

    require("functions.php");

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
        isset($_POST["firstname"]) &&
        isset($_POST["lastname"]) &&
        empty($signupEmailError) &&
        empty($signupPasswordError) &&
        empty($firstnameError) &&
        empty($lastnameError)
    ) {

        echo "Salvestan...<br>";
        echo "email ".$signupEmail."<br>";

        $password = hash("sha512", $_POST["signupPassword"]);
		
		//echo "parool ".$_POST["signupPassword"]."<br>";
        //echo "räsi ".$password."<br>";

		$signupEmail = cleanInput($signupEmail);
		
		$User->signup($signupEmail, cleanInput($password), $firstname, $lastname);
}
?>
<?php require("header.php"); ?>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-sm-offset-6 col-md-offset-4">
            <h1 style="text-align:center;" >Kasutaja Loomine</h1>
            <form method="POST">
                <center><input style="text-align:center;" name="signupEmail" type="text" placeholder="Email" value="<?=$signupEmail;?>"> <?php echo $signupEmailError; ?>
                <br><br>
                <input style="text-align:center;" name="signupPassword" type="password" placeholder="Parool"> <?php echo $signupPasswordError; ?>
                <br><br>
                <input style="text-align:center;" name="signupPassword" type="password" placeholder="Korda parooli"> <?php echo $signupPasswordError; ?>
                <br><br>
                <input style="text-align:center;" name="firstname" type="text" placeholder="Eesnimi"> <?php echo $firstnameError; ?>
                <br><br>
                <input style="text-align:center;" name="lastname" type="text" placeholder="Perekonnanimi"> <?php echo $lastnameError; ?>
                <br><br>
                <input class="btn btn-success btn-sm" type="submit" value="Loo kasutaja">
                <a class="btn btn-danger btn-sm" href="firstpage.php"> Loobu</a>
                    <br><br>
                    <a class="btn btn-link btn-sm" href="firstpage.php"> Tagasi avalehele</a></center></center>
            </form>
        </div>
    </div>
</div>
<?php require("footer.php"); ?>
