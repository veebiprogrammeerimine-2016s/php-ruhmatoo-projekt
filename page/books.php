<?php
//FUNKTSIOONIDEGA FAILID
require("../functions.php");     
require("../class/Book.class.php");     
$Book = new Book($mysqli);                   
 
//kutsun funktsiooni, et saada kõik raamatud
$books = $Book->getBooks();
$tableHtml = "";
?>


<?php
//HTML
require("../header.php");


?>

<h4>Raamatud</h4>
<table>
<tbody>

<!--1. RIDA....OTSING JA SORTEERIMINE-->
	<tr>  
	   <p>otsing ja sorteerimine</p>                               <!--???-->
	</tr>
	
<!--2. RIDA....KATEGOORIAD JA RAAMATUD-->
	<tr>
	    <!--lahter 1 kategooriad -->
		<td>
		   
			<div id="topic">
				<a href="books.php?topic=kategooria1" alt="kategooria 1" title="kategooria 1">kategooria 1</a>       <!--???-->
			</div>
			<div id="topic">
				<a href="books.php?topic=kategooria2" alt="kategooria 2" title="kategooria 2">kategooria 2</a>
			</div>
			<div id="topic">
				<a href="books.php?topic=kategooria3" alt="kategooria 3" title="kategooria 3">kategooria 3</a>
			</div>
			<!--JNE-->
													
		</td>
		<!--lahter 2 leheküljed ja raamatud -->
		<td>
	       <!--Näitab kus kategoorias, algul kõik -->
			 <div id="tree">
				<p><a href="/books.php">Valik</a>&gt; Kõik raamatud </p>  <!--??? -->
			</div>
			<!--leheküljed  1-20 21-40 jne ÜLEVAL -->
			<div id="numeric">1-20 | 
				<a href="books.php?page=20">21-40</a> |                       <!--??? -->
				<a href="books.php?page=40">41-60</a> | 
				<a href="books.php?topic=kategooria1&page=60">61-80</a> |     <!--näiteks ??? -->
				<a href="books.php?topic=kategooria2&page=80">81-100</a> |  
			</div>
			<!--kõik raamatud-->
			<div>
			
			<?php 				
				$tableHtml .= "<table>";
					
				foreach($books as $book){
					
					$tableHtml .= "<tr>";
					
						if($book->image == ""){
							$book->image = ("../image/raamat.jpg");  //kui raamatust pilti pole
						}
						$tableHtml .= "<td>";  //link detailse vaateni
							$tableHtml .= '<a href="details.php?id='.$book->book_id.'"> 
												<img src="' .$book->image. '" style= "width:128px;" >
											</a>';
						$tableHtml .= "</td>";
						
						$tableHtml .= "<td>";
							$tableHtml .= "<div>" .$book->author."</div>";
							$tableHtml .= '<p><a href="details.php?id='.$book->book_id.'">' .$book->title.'</a></p>';	//link detailse vaateni
						$tableHtml .= "</td>";
					
					$tableHtml .= "</tr>";
					
				}
				$tableHtml .= "</table>";	
				echo $tableHtml;									
			?>
			
			</div>
			<!--leheküljed  1-20 21-40 jne ALL -->
			<div id="numeric">1-20 | 
				<a href="books.php?page=20">21-40</a> | 
				<a href="books.php?page=40">41-60</a> | 	
			</div>
		</td>
	</tr>
</tbody>
</table>
<?php require("../footer.php");?>