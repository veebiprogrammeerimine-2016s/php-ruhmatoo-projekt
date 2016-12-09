<?php
//FUNKTSIOONIDEGA FAILID
require("../functions.php");     
require("../class/User.class.php");     
$User = new User($mysqli); 
require("../class/Coin.class.php");     
$Coin = new Coin($mysqli);

//MUUTUJAD
$tableOffers  = "";
$tableWishes = "";
$book_id = "";
$status = "pending";  //on ostnud raamatu, aga pole veel kätte saanud

// kui pole sisse loginud siis suunan avalehele
if (!isset($_SESSION["userId"])){
	session_destroy();
	header("Location: home.php?");		
}

if (isset($_GET["gotIt"])){
	$book_id = $_GET["gotIt"];
	echo $book_id;
	$status = "OK";  //on ostnud raamatu ja sai kätte
}	


//funktsioon, mis arvutab kasutaja müdndid kokku
$userCoins = $Coin->getCoins($_SESSION["userId"], $_SESSION["userId"]);
//funktsioonid, et saada kasutaja pakutud/saadud raamatud
$userOffers = $Coin->userOffers($_SESSION["userId"]);
$userWishes = $Coin->userWishes($_SESSION["userId"]);

//funktsioon, et muuta kätte saadud raamatu staatus OK
$Coin->changeStatus($book_id, $_SESSION["userId"], $status);									

?>

<?php
//HTML
require("../header.php");
?>
<h4>Sinu raamaturiiul</h4>
<p>Vabad mündid hetkeseisuga: <?=$userCoins;?></p>
<?php 

//KUI POLE RAAMATUID LISANUD EGA VALINUD
if(empty($userWishes) && empty($userOffers)){
	echo "Raamatute vahetamisi pole veel toimunud!";
}
//KUI MIDAGI ANNAB
if(!empty($userOffers)){  ?>
	<br>
	<p>Soovid anda</p>
	<div class="table-responsive">
	<table class="table table-hover table-condensed">
		<tr>
			<th>Pealkiri</th>
			<th>Mündid</td>
			<th>Staatus</th>
			<th></th>
		</tr>

	<?php
	
	foreach($userOffers as $offer){
		if($offer->status == "pending"){
			$tableOffers  .= '<tr class="success">';
				$tableOffers  .= '<td><a href="details.php?id='. $offer->book_id .'">'.$offer->title.'</td>';
				$tableOffers  .= '<td>'. $offer->points .'</td>';
				$tableOffers  .= '<td>Soovija olemas</td>';
				$tableOffers  .= 	'<td> <a href="new_pm.php?contact='. $offer->buyer .'&book='.$offer->book_id.'"> Võta ühendust! </a></td>';  //vaja veel teha
			$tableOffers  .= '</tr>';
		}		
	} 
	foreach($userOffers as $offer){
		if($offer->status == ""){
			$tableOffers  .= '<tr>';
			$tableOffers  .= '<td><a href="details.php?id='. $offer->book_id .'">'.$offer->title.'</td>';
			$tableOffers  .= '<td>'. $offer->points .'</td>';
			$tableOffers  .= '<td>Ootel</td>';
			$tableOffers  .= '<td><a href="edit.php?id='. $offer->book_id .'"> Muuda </td>';
			$tableOffers  .= '</tr>';	
		} 
	}
	
	foreach($userOffers as $offer){
		if($offer->status == "OK"){
			$tableOffers  .= '<tr>';
			$tableOffers  .= '<td><a href="details.php?id='. $offer->book_id .'">'.$offer->title.'</td>';
			$tableOffers  .= '<td>Saadud mündid: '. $offer->points .'</td>';
			$tableOffers  .= '<td> Tehing edukalt lõpetatud </td>';
			$tableOffers  .= '<td> </td>';
			$tableOffers  .= '</tr>';
		}
	}
	$tableOffers .= '</table>';
	echo $tableOffers ;
}	?>
	</div>


<?php
//KUI MIDAGI SAAB
if(!empty($userWishes)){  
?>
	<br><br>
	<p>Soovid saada</p>
	<div class="table-responsive">
	<table class="table table-hover table-condensed">
		<tr>
			<th>Pealkiri</th>
			<th>Mündid</td>
			<th>Staatus</th>
			<th></th>
		</tr>
<?php
	
	foreach($userWishes as $wish){
		if($wish->status == "pending"){
			$tableWishes  .= '<tr class="success">';
				$tableWishes  .= '<form>';
				$tableWishes  .= 	'<td><a href="details.php?id='. $wish->book_id .'">'.$wish->title.'</td>';
				$tableWishes  .= 	'<td>Münte kulub: '. $wish->points .'</td>';
				$tableWishes  .= 	'<td>';
			//dropdown	
			if ($wish->book_id == $book_id){
				$selected = "selected = 'selected'";
			} else {
				$selected = "";
			}
				$tableWishes  .=    	'<select name="gotIt" onchange="this.form.submit()">';
				$tableWishes  .=         	'<option value="Pole kätte saanud" >Pole kätte saanud </option>';
				$tableWishes  .=         	'<option value = "'. $wish->book_id .'" '.$selected.' ">Olen kätte saanud </option>';
				$tableWishes  .=    	'</select>';
				$tableWishes  .= 	'</td>';
				$tableWishes  .= 	'<td> <a href="new_pm.php?contact='. $wish->seller .'&book='.$wish->book_id.'"> Võta ühendust! </a></td>';  
				$tableWishes  .= '</form>';
				
			$tableWishes  .= '</tr>';
		}		
	}
	foreach($userWishes as $wish){
		if($wish->status == "OK"){
			$tableWishes .= '<tr>';
			$tableWishes .= '<td><a href="details.php?id='. $wish->book_id .'">'.$wish->title.'</td>';
			$tableWishes .= '<td>Münte kulus: '. $wish->points .'</td>';
			$tableWishes .= '<td> Tehing edukalt lõpetatud </td>';
			$tableWishes .= '<td> </td>';
			$tableWishes .= '</tr>';
		}	
	}
	$tableWishes .= '</table>';
	echo $tableWishes ;
}
?>  
	</div>

<?php require("../footer.php");?>