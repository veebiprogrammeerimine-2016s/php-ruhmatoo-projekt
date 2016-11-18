<?php
	var_dump($_POST);
	var_dump(isset($_POST["signupEmail"]));


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

	//MUUTUJAD
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
			$signupEmail = $_POST["signupEmail"];

		}

	}

	$signupPasswordError = "*";

	if (isset ($_POST["signupPassword"])) {

		if (empty ($_POST["signupPassword"])) {

			$signupPasswordError = "* Väli on kohustuslik!";

		} else {

			// parool ei olnud tühi

			if ( strlen($_POST["signupPassword"]) < 8 ) {

				$signupPasswordError = "* Parool peab olema vähemalt 8 tähemärkki pikk!";

			}

		}

		/* GENDER */

		if (!isset ($_POST["gender"])) {

			//error
		}else {
			// annad väärtuse
		}

	}

	//vaikimisi väärtus
	$gender = "";

	if (isset ($_POST["gender"])) {
		if (empty ($_POST["gender"])) {
			$genderError = "* Väli on kohustuslik!";
		} else {
			$gender = $_POST["gender"];
		}

	}




	if ( $signupEmailError == "*" AND
		 $signupPasswordError == "*" &&
		 isset($_POST["signupEmail"]) &&
		 isset($_POST["signupPassword"])
	  ) {

		//vigu ei olnud, kõik on olemas
		echo "Salvestan...<br>";
		echo "email ".$signupEmail."<br>";
		echo "parool ".$_POST["signupPassword"]."<br>";

		$password = hash("sha512", $_POST["signupPassword"]);

		echo $password."<br>";

		$User->signup($signupEmail, $password);


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

				<label>E-post</label><br>

				<div class="form-group">
					<input class="form-control" name="loginEmail" type="email">
				</div>

				<br><br>

				<input name="loginPassword" placeholder="Parool" type="password">

				<br><br>

				<input class="btn btn-success btn-sm hidden-xs" type="submit" value="Logi sisse 1">
				<input class="btn btn-success btn-sm btn-block visible-xs-block" type="submit" value="Logi sisse 2">
			</form>
		</div>

		<div class="col-sm-4 col-sm-offset-2 col-md-3 col-md-offset-3">

			<h1>Loo kasutaja</h1>

			<form method="POST" >

				<label>E-post</label><br>
				<input name="signupEmail" type="email" value="<?=$signupEmail;?>"> <?php echo $signupEmailError; ?>

				<br><br>

				<input name="signupPassword" placeholder="Parool" type="password"> <?php echo $signupPasswordError; ?>

				<br><br>

				<?php if ($gender == "female") { ?>
					<input type="radio" name="gender" value="female" checked> female<br>
				<?php } else { ?>
					<input type="radio" name="gender" value="female" > female<br>
				<?php } ?>

				<?php if ($gender == "male") { ?>
					<input type="radio" name="gender" value="male" checked> male<br>
				<?php } else { ?>
					<input type="radio" name="gender" value="male" > male<br>
				<?php } ?>


				<?php if ($gender == "other") { ?>
					<input type="radio" name="gender" value="other" checked> other<br>
				<?php } else { ?>
					<input type="radio" name="gender" value="other" > other<br>
				<?php } ?>

				<input type="submit" value="Loo kasutaja">

			</form>

		</div>
	</div>
</div>

<?php require("../footer.php"); ?> 
