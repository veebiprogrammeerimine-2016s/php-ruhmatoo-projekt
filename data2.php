
<?php
//Teine data leht, KMI ja pilt
require("functions.php");


	if (!isset($_SESSION["userId"])) {

		header("Location: login.php");
		exit();
	}

	//kas ?logout on aadressireal

	if (isset($_GET["logout"])) {

		session_destroy();

		header("Location: login.php");
		exit();

	}

  //Muutujad:

$length = "";
$weight = "";
$lengthError = "";
$weightError = "";


//kontrollin, kas kasutaja sisestas andmed
if(isset($_POST["length"])) {
  if (empty($_POST["length"])){
    $AgeError="See väli on kohustuslik!";

  }else {
    $Feeling=$_POST["length"];
  }

}

if(isset($_POST["weight"])) {
  if (empty($_POST["weight"])){
    $AgeError="See väli on kohustuslik!";

  }else {
    $Feeling=$_POST["weight"];
  }

}

if(isset($_POST["length"]) &&
  isset($_POST["weight"]) &&
  empty($lengthError) &&
  empty($weightError)
  ){

saveUserLW ($length, $weight);

echo '<img src="../weight.jpg"/>';

?>

<h1> Sisesta kehakaal ja pikkus KMI arvutamiseks </h1>
<form method="POST">
<br><br>
<label><h3>Pikkus</h3></label>
<input name="length" type="length" value="<?=$length;?>"> <?php echo $lengthError; ?>
<br><br>
<label><h3>Kaal</h3></label>
<input name="weight" type="weight" value="<?=$weight;?>"> <?php echo $weightError; ?>
<br><br>
<input type="submit" value="Arvuta KMI">
</form>
