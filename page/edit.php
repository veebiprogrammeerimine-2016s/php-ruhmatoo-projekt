<?php

//FUNKTSIOONIDEGA FAILID
require("../functions.php");     
require("../class/User.class.php");      //peab olema ENNE ojekti loomist
$User = new User($mysqli);               //objekt
		
//MUUTUJAD
$category = "";
$title = "";
$author = "";
$year = "";
$location = "";
$description = "";
$coins = "";
?>


<?php
//HTML
require("../header.php");


?>
<h4>Lisa raamat, mille soovid loovutada!</h4>
<br>
<form method="post">
	
	<select name="category">
	<option value="none">Vali kategooria</option>
	
<?php
	$category = array( 'Ajalugu, kultuur','Arvutid ja infotehnoloogia', 'Ehitus, tehnika', 'Elulood, memuaarid', 'Esoteerika', 
	'Fotograafia', 'Ilukirjandus', 'Kodu ja aed', 'Kokandus', 'Kunst ja arhitektuur', 'Käsiraamatud, õppekirjandus', 'Käsitöö',
	'Lastekirjandus', 'Loodus', 'Majandus, poliitika', 'Reisijuhid', 'Sõnastikud', 'Võõrkeelne kirjandus', 'Muu');
	if(isset($_POST["category"])){
		$cat = $_POST["category"];
	}
	foreach( $category as $value ){
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
	<input name="title" type="text" placeholder="Raamatu pealkiri" value="<?=$title;?>"> <br>
	<input name="author" type="text" placeholder="Raamatu autor" value="<?=$author;?>"><br> 
	<input name="year" type="year" placeholder="Ilmumise aasta"><br>
	<input name="location" type="text" placeholder="Raamatu asukoht"> <br>
	<br>
		<select name="condition">
	<option value="none">Raamatu seisukord</option>
	
<?php
	$condition = array( 'Uus', 'Väga hea', 'Keskmine', 'Halb' );
	if(isset($_POST["condition"])){
		$cond = $_POST["condition"];
	}
	foreach( $condition as $value ){
		if ($value == $cond){
			$selected = "selected = 'selected'";
		} else {
			$selected = "";
		}
	
    echo "<option value='$value' $selected>$value</option>";
}
?>
	</select>
	<br><br>
	<p>Mitu münti on raamat väärt? Vali vahemikus 1-10, kus 10 on kõige väärtuslikum:</p>
	<select name="valinumber">
	
<?php
	$number = "";
	if(isset($_POST["valinumber"])){
		$number = $_POST["valinumber"];
	}
	for($i=1; $i<11; $i++){
		if($i == $number){
			$selected = "selected = 'selected'";
		} else {
			$selected = "";
		}
		echo "<option value='$i' $selected>$i</option>";
	}
?>
	</select>
	<br><br>
	<input name="picture" type="url" placeholder="URL:http://www.aadress.ee"> Lisa pildi aadress (URL)
	<br><br>
	<textarea rows="4" cols="50" name="description">Kommentaar</textarea>
	<input type="submit" value="Lisa raamat"><br>
</form>
<br>

<?php require("../footer.php");?>