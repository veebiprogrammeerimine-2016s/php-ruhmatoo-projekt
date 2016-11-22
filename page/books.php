<?php
//FUNKTSIOONIDEGA FAILID
require("../functions.php");     
require("../class/Book.class.php");     
$Book = new Book($mysqli);                   
 
//kutsun funktsiooni, et saada kõik raamatud
$books = $Book->getBooks();    
?>


<?php
//HTML
require("../header.php");


?>

<h4>Raamatud</h4>
<?php 
//kõik raamatud
$tableHtml = "<br><br>";
$tableHtml .= "<table>";
	
foreach($books as $book){
	
	$tableHtml .= "<tr>";
	
		if($book->image == ""){
			$book->image = ("../image/raamat.jpg"); //link teha detailse vaateni
		}
		$tableHtml .= "<td>";
			$tableHtml .= '<a href="books.php"> 
								<img src="' .$book->image. '" style= "width:128px;" >
							</a>';
		$tableHtml .= "</td>";
		
		$tableHtml .= "<td>";
			$tableHtml .= "<div>" .$book->author."</div>";
			$tableHtml .= '<p><a href="books.php">' .$book->title.'</a></p>';	//link detailse vaateni
		$tableHtml .= "</td>";
	
	$tableHtml .= "</tr>";
	
}
$tableHtml .= "</table>";	
echo $tableHtml;
	
	
	

?>

<?php require("../footer.php");?>
