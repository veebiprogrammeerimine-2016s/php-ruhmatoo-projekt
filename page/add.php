<?php

//FUNKTSIOONIDEGA FAILID
require("../functions.php");     
require("../class/Book.class.php");     //peab olema ENNE ojekti loomist
$Book = new Book($mysqli);               //objekt
require("../class/Coin.class.php");
$Coin = new Coin($mysqli);
		
//MUUTUJAD
$category = "";
$title = "";
$author = "";
$year = "";
$location = "";
$condition = "";
$coins = "";
$image = "";
$description = "";
$error = "";
$note = "Lisa raamat, mille soovid loovutada!";
$ok = "";

if(isset($_GET["ok"])){
	$note = "Raamat lisatud!";
	$ok ='Raamatu andmeid saab muuta <a  href="user.php">Sinu riiulis</a>. <br> Kui raamat leiab uue omaniku, kantakse mündid Sinu kontole.<br><br><strong>Lisa veel raamatuid!</strong>';
}

// kontrollin, kas väljad on täidetud
if(isset($_POST["title"])){ 
	$category = $_POST["category"];
	$title = $Helper->cleanInput($_POST["title"]);
	$title = ucfirst(strtolower($title));
	$author = $Helper->cleanInput($_POST["author"]);
	$author = ucwords(strtolower($author));
	$year = $Helper->cleanInput($_POST["year"]);
	$location = $Helper->cleanInput($_POST["location"]);
	$condition = $_POST["condition"];
	$coins = $_POST["points"];
	$image = $Helper->cleanInput($_POST["picture"]);
	$description = $Helper->cleanInput($_POST["description"]);
	if(empty($_POST["title"]) || empty($_POST["author"]) 
		|| empty($_POST["location"]) || empty($_POST["condition"])) {
		$error = "Tärniga tähistatud väljad on kohustuslikud!";
		
	}
}
//ühtegi errorit	
if(isset($_POST["title"]) && empty($error)) {
	$userId = $_SESSION["userId"];
	$BookId = $Book->addBook($userId, $category, $title, $author, $year, $condition, $location, $description, $coins, $image);  //funktsiooni raamatu andmebaasi lisamiseks
	$Coin->userTransaction($BookId); //funktsioon, et lisada andmebaasi raamatu tehinguid puudutav info
	header("Location: add.php?ok=true");  //et lehe refresh'ides raamatut topelt ei lisataks
	
	
}
?>


<?php
//HTML
require("../header.php");
?>

<br><br>
<div class="notleft">
<h4><?=$note?></h4>
<p><?=$ok?></p>
<br>

<form method="post" class="form-inline">
	
	<select name="category" class="form-control focusedInput">
	<option value="Vali kategooria">Vali kategooria</option>
	
<?php
	$topic = array( 'Ajalugu, kultuur','Arvutid ja infotehnoloogia', 'Ehitus, tehnika', 'Elulood, memuaarid', 'Esoteerika', 
	'Fotograafia', 'Ilukirjandus', 'Kodu ja aed', 'Kokandus', 'Kunst ja arhitektuur', 'Käsiraamatud, õppekirjandus', 'Käsitöö',
	'Lastekirjandus', 'Loodus', 'Majandus, poliitika', 'Reisijuhid', 'Sõnastikud', 'Võõrkeelne kirjandus', 'Muu');
	if(isset($_POST["category"]) && $_POST["category"] == "Vali kategooria"){
		$cat = "Muu";
	} else {
			$cat = $_POST["category"];
	}
	foreach( $topic as $value ){
		if ($value == $cat){
			$selected = "selected = 'selected'";
		} else {
			$selected = "";
		}
	
    echo "<option value='$value' $selected>$value</option>";
}
?>
	</select>
	<br><br>
	<input name="title" type="text" placeholder="Raamatu pealkiri" value="<?=$title;?>" class="form-control focusedInput"> <span class="text-danger"> * </span><br>
	<input name="author" type="text" placeholder="Raamatu autor" value="<?=$author;?>" class="form-control focusedInput"><span class="text-danger"> * </span><br> 
	<input name="year" type="year" placeholder="Ilmumise aasta" value="<?=$year;?>" class="form-control focusedInput"><br>
	<input name="location" type="text" placeholder="Raamatu asukoht" value="<?=$location;?>" class="form-control focusedInput"> <span class="text-danger"> * </span><br>
	<br>
		<select name="condition" class="form-control focusedInput">
	<option value="">Raamatu seisukord</option>
	
<?php
	$cond = array( 'Uus', 'Väga hea', 'Hea', 'Keskmine', 'Halb' );
	if(isset($_POST["condition"])){
		$condition = $_POST["condition"];
	}
	foreach( $cond as $value ){
		if ($value == $condition){
			$selected = "selected = 'selected'";
		} else {
			$selected = "";
		}
	
    echo "<option value='$value' $selected>$value</option>";
}
?>
	</select> <span class="text-danger"> * </span>
	<br><br>
	<p>Mitu münti on raamat väärt? Vali vahemikus 1-10, kus 10 on kõige väärtuslikum:</p>
	<select name="points" class="form-control focusedInput">
	
<?php
	if(isset($_POST["points"])){
		$coins = $_POST["points"];
	}
	for($i=1; $i<11; $i++){
		if($i == $coins){
			$selected = "selected = 'selected'";
		} else {
			$selected = "";
		}
		echo "<option value='$i' $selected>$i</option>";
	}
?>
	</select>
	<br><br>
	<input name="picture" type="text" placeholder="http://www.aadress.ee" class="form-control focusedInput"> Lisa pildi aadress (URL)
	<br><br>
	<textarea name="description" rows="4" cols="50" placeholder="Kommentaar" class="form-control focusedInput"></textarea>
	<br><br>
	<input type="submit" value="Lisa raamat" class="btn btn-default"><br>
</form>
<div>
<br>

<div class="text-danger"> <?=$error;?></div>
<?php require("../footer.php");?>