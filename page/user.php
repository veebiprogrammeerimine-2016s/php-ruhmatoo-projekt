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

// kui pole sisse loginud siis suunan avalehele
if (!isset($_SESSION["userId"])){
	session_destroy();
	header("Location: home.php?");
		
}

//funktsioon, mis arvutab kasutaja müdndid kokku
$userCoins = $Coin->getCoins($_SESSION["userId"], $_SESSION["userId"]);
//funktsioonid, et saada kasutaja pakutud/saadud raamatud
$userOffers = $Coin->userOffers($_SESSION["userId"]);
$userWishes = $Coin->userWishes($_SESSION["userId"]);
echo $_SESSION['userId'];


?>

<?php
//HTML
require("../header.php");
?>
<h4>Sinu raamaturiiul</h4>
<p>Vabad mündid hetkeseisuga: <?=$userCoins;?></p>
<?php 
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
				$tableOffers  .= '<td> <a href="books.php?contact='. $offer->buyer .'"> Võta ühendust! </a></td>';  //vaja veel teha
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
				$tableWishes  .= '<td><a href="details.php?id='. $wish->book_id .'">'.$wish->title.'</td>';
				$tableWishes  .= '<td>Münte kulub: '. $wish->points .'</td>';
				$tableWishes  .= '<td>Valisid raamatu</td>';
				$tableWishes  .= '<td> <a href="books.php?contact='. $wish->seller .'"> Võta ühendust! </a></td>';  //vaja veel teha
				
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
	echo $tableWishes ;
}if(empty($userWishes) && empty($userOffers)){
	echo "Raamatute vahetamisi pole veel toimunud!";
}
?>
	</table>
	</div>

<?php require("../footer.php");?>