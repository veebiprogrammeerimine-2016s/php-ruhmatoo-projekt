<?php
//Teine data leht, KMI ja pilt
require("functions.php");

require("Class/KMI.class.php");

//kas kasutaja on sisse loginud, kui pole, suuna login.php

	if (!isset($_SESSION["userId"])) {

		header("Location: login.php");
		exit();
	}


if(isset($_GET['height'], $_GET['weight'], $_GET['calculate'])):
    $height = $_GET['height'];
    $Splitted = str_split($height);
    if(count($Splitted) == 3):
        $height = "{$Splitted[0]}.{$Splitted[1]}{$Splitted[2]}";
    endif;

    new KMI($_GET['weight'], $height);
endif;


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

}

?>

<div class="container">
<form method="GET">
<div class="col-xs-6 col-sm-6 col-md-6">
<div class = "row">
<div class="input-field col s12">
<?php require ("header.php"); ?>
<img src="KMI.png"  style="width:250px;height:228px;">


<h3> Sisesta kehakaal ja pikkus KMI arvutamiseks </h3>
<form method="GET" action="<?=$_SERVER['PHP_SELF'];?>">
<label><h3>Pikkus:</h3></label>
<input class="form-control-sm" placeholder="cm" type="text" name="height" value="" /> <?php echo $heightError;?>
<br/>
</div>

<div class="row">
	<div class="col-xs-6 col-sm-6 col-md-6">
		<div class="input-field col s12">
<label><h3>Kaal:</h3></label>
<input  class="form-control-sm"  placeholder="kg" type="text" name="weight" value="" /> <?php echo $weightError;?>
<br><br>
</div>
<button <p type="submit" class="text-center btn btn-primary " name="calculate"> Arvuta</button> </p>
<a class="btn btn-success btn-warning" href="?logout=1" role="button">Logi välja</a>
</form>
<?php require ("footer.php"); ?>
<?php
