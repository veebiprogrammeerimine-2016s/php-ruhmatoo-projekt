<?php
//FUNKTSIOONIDEGA FAILID
require("../functions.php");     
require("../class/Book.class.php");     
$Book = new Book($mysqli); 

//MUUTUJAD
$getBook = "";

// kui ei ole id'd aadressireal siis suunan
if(!isset($_GET["id"])){        //book_id
	header("Location: books.php");
	exit();
}                 
 
//kutsun funktsiooni, saadan kaasa konkreetse raamatu id

$singleBook = $Book->getSingle($_GET["id"]);

//kui on ?get aadressireal siis login välja
if(isset($_GET["id"]) && isset($_GET["get"])){
	$getBook = "Raamat on lisatud sinu <a href='user.php'>raamaturiiulisse</a>! <br> 
	Võta omanikuga ühendust, et kokku leppida raamatu kättesaamise osas.";
}
?>


<?php
//html
require("../header.php");

?>

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
<?php ;}

//kui on sisse loginud kasutaja
if(isset($_SESSION["userId"]) && !isset($_GET["get"])){ ?>
	<br><br>
	<h4><a href="?id=<?=$_GET["id"];?>&get=true">Soovin seda raamatut</a></h4> 

<?php ;} ?>
	
	
<?php require("../footer.php");?>
