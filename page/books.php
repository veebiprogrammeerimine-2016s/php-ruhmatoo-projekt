<?php
//FUNKTSIOONIDEGA FAILID
require("../functions.php");     
require("../class/Book.class.php");     
$Book = new Book($mysqli);  

//muutujad
$q = "";
$sc = "";
$topic = "";
$cat = "";
$error = "";
$order_by = "";

//kas otsitakse

if(isset($_GET["q"]) && isset($_GET["sc"])){
	if(strlen($_GET["q"]) < 2){
		$error = "Otsitav sõna peab olema vähemalt 2 tähemärki";
	} else {
		$q = $Helper->cleanInput($_GET["q"]);
		$sc = $Helper->cleanInput($_GET["sc"]);
	} 
}
 //kas sorteerimine on valitud
if(isset($_GET["order_by"])){
	$order_by = $Helper->cleanInput($_GET["order_by"]);
	if($order_by == "vaikimisi järjestus"){
		$order_by = "ASC";
	}
}
//kutsun funktsiooni, et saada kõik raamatud
$books = $Book->getBooks($cat, $q, $sc, $order_by);
$onlyCategories = $Book->getCategories(); //$Book->getBooks("", "", "", "");  //et kat. kuvamine poleks sõltuv kuvatavatest raamatutest
$tableHtml = "";

 //kas kategooria on valitud
if(isset($_GET["cat"])){
	$cat = $Helper->cleanInput($_GET["cat"]);
	//echo $cat;
} else {
	$_GET["cat"] = "";
}

?>


<?php
//HTML
require("../header.php");


?>
<br><br>
<div class="notleft">
<h4>Raamatud</h4>
<table style="width: 100%;" >
<tbody>

<!--1. RIDA....OTSING JA SORTEERIMINE-->
	<tr> 
		<td colspan="2">
		   <form class="form-inline">
		   
				<?php if($sc == "author"){ ?>
				<input type="radio" name="sc" value="author"  checked> autor
				<?php } else { ?>
				<input type="radio" name="sc" value="author"> autor
				
				<?php } if($sc == "title"){?>
				<input type="radio" name="sc" value="title" checked> pealkiri
				<?php } else { ?>
				<input type="radio" name="sc" value="title"> pealkiri
				
				<?php }if($sc == "description"){?>
				<input type="radio" name="sc" value="description" checked> kirjeldus
				<?php } else { ?>
				<input type="radio" name="sc" value="description"> kirjeldus
				<?php } ?>
				
				
				<br>
				<input type="search" name="q" value="<?=$q;?>" class="form-control focusedInput">
				<input type="submit" value="Otsi" class="btn btn-default"><?=$error;?>
														  
			
		</td>
		<td style="text-align:right;">
			
				<select name="order_by" onchange="this.form.submit()" class="form-control focusedInput">
				<?php
				$option = "";
				$sortOptions = array( 'vaikimisi järjestus', 'A-Z', 'Z-A', 'uuemad', 'vanemad', 'odavamad', 'kallimad' );
				if(isset($_GET["order_by"])){
				$option = $_GET["order_by"];
				}
				foreach( $sortOptions as $value ){
					if ($value == $option){
						$selected = "selected = 'selected'";
					} else {
						$selected = "";
					}
				echo "<option value='$value' $selected>  $value   </option>";
				}
				?>
				</select>	
			   <!--form-->
		</td>
	</tr>
	
<!--2. RIDA....KATEGOORIAD JA RAAMATUD-->
	<tr>
	    <!--lahter 1 kategooriad -->
		<td valign="top">
		<?php foreach($onlyCategories as $category){
			$topic = '<div>';
			$topic .= '<a href="books.php?cat='. $category->cat .'">'. $category->cat .'('. $category->counter .')</a>';
			$topic .= "</div>";
			echo $topic;
			
		}?>	
		<input type="hidden" name="cat" value="<?=$_GET["cat"];?>" >
		</td>
		</form>
		<!--lahter 2 leheküljed ja raamatud -->
		<td>
	       <!--Näitab kus kategoorias, algul kõik -->
			 <div id="tree">
				<p><a href="books.php">Kõik raamatud</a>&gt; <?php echo $cat;?> </p>
			</div>
			<!--leheküljed  1-20 21-40 jne ÜLEVAL 
			jätan praegu lk nr-d välja , kõigi raamatutega toimis, aga 
			kui konkreetne kategooria valida, siis ei saanud toimima
			
			if($_SERVER['QUERY_STRING'] != ""){
				
				parse_str($_SERVER['QUERY_STRING'], $params);

				unset($params['page']);
				$string = http_build_query($params);
				$stringQuery = "?".$string."&";
			}else{
				$stringQuery = "?";
			}
			?>
			
			<div id="numeric"> 
				<a href="books.php<?=$stringQuery;?>page=1">1-10</a> |     
				<a href="books.php<?=$stringQuery;?>page=10">11-20</a> |          
				<a href="books.php<?=$stringQuery;?>page=20">21-30</a> | 
			</div>
			-->
			
			<!--kõik raamatud-->
			<div>
			
			<?php 				
				$tableHtml .= "<table>";
					
				foreach($books as $book){
					
					$tableHtml .= "<tr>";
					
						if($book->image == ""){
							$book->image = ("../image/raamat.jpg");  //kui raamatust pilti pole
						}
						
						if(empty($cat)){    //aadressireal pole kategooriat näita kõiki raamatuid
							$tableHtml .= "<td>";  //link detailse vaateni
								$tableHtml .= '<a href="details.php?id='.$book->book_id.'"> 
													<img src="' .$book->image. '" style= "width:128px;" >
												</a>';
							$tableHtml .= "</td>";
							
							$tableHtml .= "<td>";
								$tableHtml .= '<p>Pealkiri: <a href="details.php?id='.$book->book_id.'">' .$book->title.'</a></p>';	
								$tableHtml .= "<p>Autor: " .$book->author."</p>";
								$tableHtml .= "<p>Aasta: " .$book->year."</p>";
							$tableHtml .= "</td>";
						}else{              //aadressireal on kategooria
							if($book->category == $cat){
								$tableHtml .= "<td>";  //link detailse vaateni
									$tableHtml .= '<a href="details.php?id='.$book->book_id.'"> 
													<img src="' .$book->image. '" style= "width:128px;" >
												   </a>';
								$tableHtml .= "</td>";
							
								$tableHtml .= "<td>";
									$tableHtml .= '<p>Pealkiri: <a href="details.php?id='.$book->book_id.'">' .$book->title.'</a></p>';	
									$tableHtml .= "<p>Autor: " .$book->author."</p>";
									$tableHtml .= "<p>Aasta: " .$book->year."</p>";
								$tableHtml .= "</td>";
							}	
						}
					$tableHtml .= "</tr>";
					
				}
				$tableHtml .= "</table>";	
				echo $tableHtml;									
			?>
			
			</div>
			<!--leheküljed  1-20 21-40 jne ALL 
			<div id="numeric">1-20 | 
				<a href="books.php?page=20">21-40</a> | 
				<a href="books.php?page=40">41-60</a> | 	
			</div>  -->
		</td>
	</tr>
</tbody>
</table>
</div>
<!--ajutine-->
<table border="1">
  <tr>
    <th>variable</th>
    <th>value</th>
  </tr>
  <?php
    foreach($_GET as $variable => $value) {
      echo "<tr><td>" . $variable . "</td>";
      echo "<td>" . $value . "</td>";
    }
  ?>
</table>
<!-- -->
<?php require("../footer.php");?>