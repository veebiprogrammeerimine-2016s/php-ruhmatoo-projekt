<?php

//FUNKTSIOONIDEGA FAILID
require("../functions.php");     
require("../class/Book.class.php");     //peab olema ENNE ojekti loomist
$Book = new Book($mysqli);               //objekt

		
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

// kontrollin, kas väljad on täidetud
if(isset($_POST["title"])){ 
	$category = $_POST["category"];
	$title = $Helper->cleanInput($_POST["title"]);
	$author = $Helper->cleanInput($_POST["author"]);
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
	$error = 'Aitäh, raamat "'.$title. '" on lisatud pakutavate raamatute nimekirja! Vajadusel saad raamatu andmeid muuta Sinu riiulis. <br> Kui raamat leiab uue omaniku, kantakse mündid Sinu kontole.';
	$userId = $_SESSION["userId"];
	$Book->addBook($userId, $category, $title, $author, $year, $condition, $location, $description, $coins, $image);
}
?>


<?php
//HTML
require("../header.php");


?>
<h4>Lisa raamat, mille soovid loovutada!</h4>
<br>
<form method="post">
	
	<select name="category">
	<option value="Vali kategooria">Vali kategooria</option>
	
<?php
	$topic = array( 'Ajalugu, kultuur','Arvutid ja infotehnoloogia', 'Ehitus, tehnika', 'Elulood, memuaarid', 'Esoteerika', 
	'Fotograafia', 'Ilukirjandus', 'Kodu ja aed', 'Kokandus', 'Kunst ja arhitektuur', 'Käsiraamatud, õppekirjandus', 'Käsitöö',
	'Lastekirjandus', 'Loodus', 'Majandus, poliitika', 'Reisijuhid', 'Sõnastikud', 'Võõrkeelne kirjandus', 'Muu');
	if(isset($_POST["category"]) && $_POST["category"] == "Vali kategooria"){
		$cat = "Muu";
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
	<input name="title" type="text" placeholder="Raamatu pealkiri" value="<?=$title;?>"> *<br>
	<input name="author" type="text" placeholder="Raamatu autor" value="<?=$author;?>">*<br> 
	<input name="year" type="year" placeholder="Ilmumise aasta" value="<?=$year;?>"><br>
	<input name="location" type="text" placeholder="Raamatu asukoht" value="<?=$location;?>"> *<br>
	<br>
		<select name="condition">
	<option value="">Raamatu seisukord</option>
	
<?php
	$cond = array( 'Uus', 'Väga hea', 'Keskmine', 'Halb' );
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
	</select> *
	<br><br>
	<p>Mitu münti on raamat väärt? Vali vahemikus 1-10, kus 10 on kõige väärtuslikum:</p>
	<select name="points">
	
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
	<input name="picture" type="text" placeholder="http://www.aadress.ee"> Lisa pildi aadress (URL)
	<br><br>
	<textarea name="description" rows="4" cols="50" placeholder="Kommentaar"></textarea>
	<br><br>
	<input type="submit" value="Lisa raamat"><br>
</form>
<br>

<?=$error;?>
<?php require("../footer.php");?>