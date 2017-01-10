
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

header("Location: data3.php");
exit();
}

//tahaks printida pilti
echo '<img src="weight.jpg"/>';

?>



<?php require ("header.php"); ?>
<h1> Pikkus ja kehakaal </h1>
<h3> Sisesta kehakaal ja pikkus KMI arvutamiseks </h3>
<form method="GET" action="<?=$_SERVER['PHP_SELF'];?>">
<label><h3>Pikkus:</h3></label>
<input type="text" name="height" value="" /> <?php echo $heightError; ?>
<br/>
<label><h3>Kaal:</h3></label>
<input type="text" name="weight" value="" /> <?php echo $weightError; ?>
<br />
<button <p type="submit" class="text-center" name="calculate">Arvuta</button> </p>
</form>



</form>

