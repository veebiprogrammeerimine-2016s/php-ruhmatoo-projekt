
<?php
//Teine data leht, KMI ja pilt
require("functions.php");

//kas kasutaja on sisse loginud, kui pole, suuna login.php

	if (!isset($_SESSION["userId"])) {

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
    $lengthError="See väli on kohustuslik!";

  }else {
    $length=$_POST["length"];
  }

}

if(isset($_POST["weight"])) {
  if (empty($_POST["weight"])){
    $weightError="See väli on kohustuslik!";

  }else {
    $weight=$_POST["weight"];
  }

}

if(isset($_POST["length"]) &&
  isset($_POST["weight"]) &&
  empty($lengthError) &&
  empty($weightError)
  ){

saveUserLW ($length, $weight);

header("Location: data3.php");
exit();
}

//tahaks printida pilti
echo '<img src="weight.jpg"/>';

?>
<?php require ("header.php"); ?>
<h1> Pikkus ja kehakaal </h1>
<h3> Sisesta kehakaal ja pikkus KMI arvutamiseks </h3>
<form method="POST">
<label><h3>Pikkus</h3></label>
<input name="length" type="length" value="<?=$length;?>"> <?php echo $lengthError; ?>
<br><br>
<label><h3>Kaal</h3></label>
<input name="weight" type="weight" value="<?=$weight;?>"> <?php echo $weightError; ?>
<br><br>
<input type="submit" value="Arvuta">


</form>

