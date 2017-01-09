
<?php
//Teine data leht, KMI ja pilt
require("functions.php");

//kas kasutaja on sisse loginud, kui pole, suuna login.php

	if (!isset($_SESSION["userId"])) {

		header("Location: login.php");
		exit();
	}


  //Muutujad:
$height = "";
$weight = "";
$heightError = "";
$weightError = "";

//kontrollin, kas kasutaja sisestas andmed
if(isset($_POST["height"])) {
  if (empty($_POST["height"])){
    $heightError="See väli on kohustuslik!";

  }else {
    $height=$_POST["height"];
  }

}

if(isset($_POST["weight"])) {
  if (empty($_POST["weight"])){
    $weightError="See väli on kohustuslik!";

  }else {
    $weight=$_POST["weight"];
  }

}

if(isset($_POST["height"]) &&
  isset($_POST["weight"]) &&
  empty($heightError) &&
  empty($weightError)
  ){

saveUserLW ($height, $weight);

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
<input name="height" type="height" value="<?=$height;?>"> <?php echo $heightError; ?>
<br><br>
<label><h3>Kaal</h3></label>
<input name="weight" type="weight" value="<?=$weight;?>"> <?php echo $weightError; ?>
<br><br>
<input type="submit" value="Arvuta">


</form>

