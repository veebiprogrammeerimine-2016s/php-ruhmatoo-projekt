<?php
	#var_dump($_POST);
	#var_dump(isset($_POST["signupEmail"]));


	require("../functions.php");

	require("../class/Helper.class.php");
	$Helper = new Helper();

	require("../class/User.class.php");
	$User = new User($mysqli);

	// kui on sisseloginud siis suunan data lehele
	if (isset($_SESSION["userId"])) {
		header("Location: data.php");
		exit();
	}

	//var_dump($_GET);

	//echo "<br>";

	//var_dump($_POST);

	//Muutujad
		$signupEmailError = "*";
		$signupEmail = "";

		//kas keegi vajutas nuppu ja see on olemas

		if (isset ($_POST["signupEmail"])) {

			//on olemas
			// kas epost on tühi
			if (empty ($_POST["signupEmail"])) {

				// on tühi
				$signupEmailError = "* Väli on kohustuslik!";

			} else {
				// email on olemas ja õige
				$signupEmail = $Helper->cleanInput($_POST["signupEmail"]);

			}

		}


		$signupPasswordError = "*";


		if (isset ($_POST["signupPassword"])) {


			if (empty ($_POST["signupPassword"])) {

				$signupPasswordError = "* Väli on kohustuslik!";

			} else {

				//parool ei olnud tyhi

				if( strlen($_POST["signupPassword"]) < 8 ) {

					$signupPasswordError = "* Parool peab olema vähemalt 8 tähemärki pikk";
				}
			}

		}

		$firstname = "";
		$firstnameError = "*";

		if (isset ($_POST["firstname"])) {


			if (empty ($_POST["firstname"])) {

				$firstnameError = "* Väli on kohustuslik!";

			}  else {

					$firstname = $Helper->cleanInput($_POST["firstname"]);

			}

		}

		$lastname = "";
		$lastnameError = "*";


		if (isset ($_POST["lastname"])) {


			if (empty ($_POST["lastname"])) {

				$lastnameError = "* Väli on kohustuslik!";

			} else {

					$lastname = $Helper->cleanInput($_POST["lastname"]);

			}

		}

		if ( $signupEmailError == "*" &&
				 $signupPasswordError == "*" &&
				 $firstnameError == "*" &&
				 $lastnameError == "*" &&
				 isset($_POST["signupEmail"]) &&
				 isset($_POST["signupPassword"]) &&
				 isset($_POST["firstname"]) &&
				 isset($_POST["lastname"])
		   ) {

			//vigu ei olnud, kõik on olemas
			echo "Salvestan...<br>";
			echo "email ".$signupEmail."<br>";
			//echo "parool ".$_POST["signupPassword"]."<br>";

			$password = hash("sha512", $_POST["signupPassword"]);

			//echo $password."<br>";

		$User->signup($signupEmail, $password, $firstname, $lastname);

	}

	$loginEmail = "";
	$loginEmailError = " ";

	if (isset ($_POST["loginEmail"])) {


		if (empty ($_POST["loginEmail"])) {


			$loginEmailError = "* Unustasid e-maili!";

		} else {

			$loginEmail = $Helper->cleanInput($_POST["loginEmail"]);

		}

	}

	$loginPassword = "";
	$loginPasswordError = " ";

	if (isset ($_POST["loginPassword"])) {


		if (empty ($_POST["loginPassword"])) {


			$loginPasswordError = "* Unustasid parooli!";

		} else {

			$loginPassword = $Helper->cleanInput($_POST["loginPassword"]);

		}

	}

	$notice = "";
	//kas kasutaja tahab sisse logida
	if ( isset($_POST["loginEmail"]) &&
		 isset($_POST["loginPassword"]) &&
		 !empty($_POST["loginEmail"]) &&
		 !empty($_POST["loginPassword"])
	) {

		$notice = $User->login($_POST["loginEmail"], $_POST["loginPassword"]);

	}

?>

<?php require("../header.php"); ?>


	<div class="container">
		<div class="row">

		<div class="col-sm-4 col-md-3">


			<h1>Logi sisse &lt;a href="#"&gt;</h1>
				<p style="color:red;"><?=$notice;?></p>
				<form method="POST" >

				<label>E-post</label>

			<div class ="form-group">
				<input class = "form-control" name="loginEmail" type="email" value="<?=$loginEmail;?>"> <?php echo $loginEmailError; ?>
			</div>

				<label>Parool</label>

				<div class ="form-group">
					<input class = "form-control" name="loginPassword" type="password"> <?php echo $loginPasswordError; ?>
				</div>


				<input class="btn btn-success btn-sm hidden-xs" type="submit" value="Logi sisse">
				<input class="btn btn-success btn-sm btn-block visible-xs-block" type="submit" value="Logi sisse">

		</form>

	</div>

	<div class="col-sm-4 col-sm-offset-2 col-md-3 col-md-offset-3">

		<h1>Loo kasutaja</h1>

		<form method="POST" >


			<label>E-post</label> <?php echo $signupEmailError; ?>

		<div class ="form-group">
			<input class = "form-control" name="signupEmail" type="email" value="<?=$signupEmail;?>">
		</div>


			<label>Parool</label> <?php echo $signupPasswordError; ?>

			<div class ="form-group">
				<input class = "form-control" name="signupPassword" type="password">
			</div>


			<label> Eesnimi</label> <?php echo $firstnameError; ?>

			<div class ="form-group">
				<input class = "form-control" name="firstname" type="text" value="<?=$firstname;?>">
			</div>


			<label> Perekonnanimi</label> <?php echo $lastnameError; ?>

			<div class ="form-group">
				<input class = "form-control" name="lastname" type="text" value="<?=$lastname;?>">
			</div>

			<input class="btn btn-success btn-sm hidden-xs" type="submit" value="Loo kasutaja">
			<input class="btn btn-success btn-sm btn-block visible-xs-block" type="submit" value="Loo kasutaja">

		</form>

 	 </div>

	</div>

</div>
<?php require("../footer.php"); ?>
