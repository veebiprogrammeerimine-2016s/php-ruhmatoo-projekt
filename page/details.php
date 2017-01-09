<?php
//FUNKTSIOONIDEGA FAILID
require("../functions.php");     
require("../class/Book.class.php");     
$Book = new Book($mysqli); 

require("../class/Coin.class.php");     
$Coin = new Coin($mysqli);

//MUUTUJAD
$getBook = "";
$status = "";
// kui ei ole id'd aadressireal siis suunan
if(!isset($_GET["id"])){        //book_id
	header("Location: books.php");
	exit();
}                 
 
//kutsun funktsiooni, saadan kaasa konkreetse raamatu id

$singleBook = $Book->getSingle($_GET["id"]);

//kui on ?get aadressireal..st keegi tahab raamatut, siis kuvatakse teade
if(isset($_GET["id"]) && isset($_GET["get"])){
	$getBook = "Raamat on lisatud sinu <a href='user.php'>raamaturiiulisse</a>! <br> 
	Võta omanikuga ühendust, et kokku leppida raamatu kättesaamise osas.";
	$status = "pending";
	//FUNKTSIOON, kui keegi ostab, siis raamat kustutakse project_books tabelis
	$Book->deleteBook($_GET["id"]);  
	// FUNKTSIOON, kui keegi ostab, siis raamatu staatuseks 'pending' project_points tabelis
	$Coin->changeStatus($_GET["id"], $_SESSION["userId"], $status);  //raamatu id, soovija id, pending
	
}

?>


<?php
$page = "books";
//html
require("../header.php");

?>
<div class="new">
<div class="notleft">
<h4>Raamatu info</h4>
<?php


$tableHtml = "<br><br>";
$tableHtml .= "<table>";
	$tableHtml .= "<tr>";
	
		if($singleBook->image == ""){
			$singleBook->image = ("../image/raamat.jpg"); //kui raamatu pilti pole
		}
		$tableHtml .= "<td>";
			$tableHtml .= ' <img src="' .$singleBook->image. '" style= "width:200px;" >';
		$tableHtml .= "</td>";
	if(!isset($_GET["get"])){
		$tableHtml .= "<td>";
			$tableHtml .= "<p>Kategooria: " .$singleBook->category."</p>";
			$tableHtml .= "<p>Münte kulub: " .$singleBook->coins. "</p>";
			$tableHtml .= "<p>Autor: " .$singleBook->author. "</p>";
			$tableHtml .= "<p>Ilmumise aasta: " .$singleBook->year. "</p>";
			$tableHtml .= "<p>Seisukord: " .$singleBook->condition. "</p>";
			$tableHtml .= "<p>Asukoht: " .$singleBook->location. "</p>";
			$tableHtml .= "<p>Kirjeldus: " .$singleBook->description. "</p>";
		$tableHtml .= "</td>";
	}else{
		$tableHtml .= "<td>";
			$tableHtml .= "<p>" . $getBook . "</p>";
		$tableHtml .= "</td>";
	}
	
	$tableHtml .= "</tr>";
	

$tableHtml .= "</table>";	
echo $tableHtml;

//kui on sisse logimata kasutaja
if(!isset($_SESSION["userId"])){
?>
	<br><br><p>Kui soovid seda raamatut või soovid ise mõnda raamatut pakkuda, siis <a href="login.php">logi sisse</a>.</p>
<?php ;} ?>

<?php 
//kui on sisse loginud kasutaja
if(isset($_SESSION["userId"]) && !isset($_GET["get"])&& $singleBook->status == NULL){ 
	//kutsun funktsiooni, et teada saada palju münte kasutajal on
	$userCoins = $Coin->getCoins($_SESSION["userId"], $_SESSION["userId"]);
	//kui on sisse loginud kasutaja ja see raamat on veel saadaval 
	if($userCoins >= $singleBook->coins){?>
	<br><br>
	<h4><a href="?id=<?=$_GET["id"];?>&get=true">Soovin seda raamatut</a></h4> 
	<br>
	<p>Küsi omanikult täpsemat <a href="new_pm.php?contact=<?=$singleBook->user;?>&book=<?=$_GET["id"]?>">infot</a></p>
	
<?php
; }else{?>
	<br><br><h4>Sul ei ole piisavalt münte. Müntide saamiseks paku raamatuid!</h4>
<?php
; }
}
?>
</div>

</div>	
	
<?php require("../footer.php");?>
