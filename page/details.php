<?php
//FUNKTSIOONIDEGA FAILID
require("../functions.php");     
require("../class/Book.class.php");     
$Book = new Book($mysqli); 

// kui ei ole id'd aadressireal siis suunan
if(!isset($_GET["id"])){
	header("Location: books.php");
	exit();
}                 
 
//kutsun funktsiooni, saadan kaasa konkreetse raamatu id

$singleBook = $Book->getSingle($_GET["id"]);
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
		
		$tableHtml .= "<td>";
			$tableHtml .= "<p>Kategooria: " .$singleBook->category."</p>";
			$tableHtml .= "<p>Münte kulub: " .$singleBook->coins. "</p>";
			$tableHtml .= "<p>Autor: " .$singleBook->author. "</p>";
			$tableHtml .= "<p>Ilmumise aasta: " .$singleBook->year. "</p>";
			$tableHtml .= "<p>Seisukord: " .$singleBook->condition. "</p>";
			$tableHtml .= "<p>Asukoht: " .$singleBook->location. "</p>";
			$tableHtml .= "<p>Kirjeldus: " .$singleBook->description. "</p>";
		$tableHtml .= "</td>";
	
	$tableHtml .= "</tr>";
	

$tableHtml .= "</table>";	
echo $tableHtml;
?>

<?php require("../footer.php");?>
