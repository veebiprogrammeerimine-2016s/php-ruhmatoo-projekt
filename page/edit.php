<?php
//FUNKTSIOONIDEGA FAILID
require("../functions.php"); 
    
require("../class/User.class.php");     
$User = new User($mysqli);

require("../class/Book.class.php");     
$Book = new Book($mysqli);

require("../class/Coin.class.php");     
$Coin = new Coin($mysqli);


// kui pole sisse loginud siis suunan avalehele
if (!isset($_SESSION["userId"])){
	session_destroy();
	header("Location: index.php");		
}

//FUNKTSIOON, et saada raamatu andmed
$singleBook = $Book->getSingle($_GET["id"]);    //aadressireal on raamatu id

//kontrollin, et kasutaja ei saaks võõrast raamatut muuta
if( $singleBook->user != $_SESSION["userId"]){
	header("Location: user.php");
}else{
	//echo "OK";
}
//MUUTUJAD
$title = $singleBook->title;
$author = $singleBook->author;
$year = $singleBook->year;
$location = $singleBook->location;
$image = $singleBook->image;
$description = $singleBook->description;
$category = $singleBook->category;
$condition = $singleBook->condition;
$coins = $singleBook->coins;
$status = NULL;    //project_coins tabelis on kustutamata tehingu 'status' NULL
$deleted = NULL;   //project_books tabelis on kustutamata raamatu 'deleted' väärtus NULL
$msg = "Täida väljad, mida tahad muuta!";
$error = "kontrollida";
$note = "Muuda raamatu andmeid";

if($singleBook->image == ""){
			$singleBook->image = ("../image/raamat.jpg"); //kui raamatu pilti pole
		}
		

if(isset($_GET["delete"])){
	$status = "deleted";     //kui aadressireal deleted, siis tehingute tabelisse 'status' väärtuseks deleted
	$deleted = "deleted";    //kui aadressireal deleted, siis raamatute tabelis raamat kustutatakse
	$error = "";
	$note = "Raamat kustutatud!";
	$msg = "";
}
if(isset($_POST["change"])) {
		$title = $Helper->cleanInput($_POST["title"]);
		$title = ucfirst(strtolower($title));
		$author = $Helper->cleanInput($_POST["author"]);
		$author = ucwords(strtolower($author));
		$year = $Helper->cleanInput($_POST["year"]);
		$location = $Helper->cleanInput($_POST["location"]);
		$image = $Helper->cleanInput($_POST["picture"]);
		$description = $Helper->cleanInput($_POST["description"]);
		$category = $_POST["category"];
		$condition = $_POST["condition"];
		$coins = $_POST["points"];
			if(empty($title) || empty($author) || empty($location) || empty($condition)){
				$msg = "Oled osa andmeid ära kustutanud, tärniga tähistatud väljad peavad olema täidetud!";
			}else{
				$error = "";
				$note = "Andmed edukalt muudetud!";
				$msg = "";
			}
}
if(empty($error)){
	//FUNKTSIOON, et vajadusel teises tabelis punkte muuta
	if($coins != $singleBook->coins || $status == "deleted"){
		$Coin->updateCoins($_SESSION["userId"], $_GET["id"], $coins, $status);   
	}
		
	//FUNKTSIOON, et raamatu andmeid muuta
	$Book->changeData($category, $title, $author, $year, $condition, $location, $description, $coins, $image, $_GET["id"]);		
}
   //FUNKTSIOON, et raamat kustutada
   if($deleted == "deleted"){
		$Book->deleteBook($_GET["id"]);
   }


?>
<?php $page = "user"; ?>

<?php
//HTML
require("../header.php");
?>
<div class="new">
<h4><?=$note?></h4>
<br>
<p class="text-danger"><?php echo $msg ."<br><br>";?></p>
<br>

<div class="table-responsive">
<table>
	<tr>
		<td  rowspan="8">
			<img src="<?=$singleBook->image;?>" alt="book picture" style= "width:200px;" >
		</td>
<form method="post" class="form-inline">
		<td>Kategooria </td>		
		<td><select name="category" class="form-control focusedInput">	
			<?php
				$topic = array( 'Ajalugu, kultuur','Arvutid ja infotehnoloogia', 'Ehitus, tehnika', 'Elulood, memuaarid', 'Esoteerika', 
				'Fotograafia', 'Ilukirjandus', 'Kodu ja aed', 'Kokandus', 'Kunst ja arhitektuur', 'Käsiraamatud, õppekirjandus', 'Käsitöö',
				'Lastekirjandus', 'Loodus', 'Majandus, poliitika', 'Reisijuhid', 'Sõnastikud', 'Võõrkeelne kirjandus', 'Muu');
				if(isset($_POST["category"])){
					$category = $_POST["category"];
				}
				foreach( $topic as $value ){
					if ($value == $category){
						$selected = "selected = 'selected'";
					} else {
						$selected = "";
					}
				
				echo "<option value='$value' $selected>$value</option>";
			}
			?>
			</select>
				
		</td>
	</tr>
	<tr>		
		<td>Pealkiri<span class="text-danger"> * </span> </td>
		<td><input name="title" type="text" placeholder="<?=$singleBook->title?>" value="<?=$title;?>" class="form-control focusedInput"> 
		</td>	
	</tr>
	<tr>		
		<td>Autor<span class="text-danger"> * </span></td>
		<td><input name="author" type="text" placeholder="<?=$singleBook->author?>" value="<?=$author;?>" class="form-control focusedInput"> 
		</td>	
	</tr>
	<tr>		
		<td>Ilmumise aasta</td>
		<td><input name="year" type="year" placeholder="<?=$singleBook->year?>" value="<?=$year;?>" class="form-control focusedInput"> 
		</td>
	</tr>
	<tr>		
		<td>Asukoht<span class="text-danger"> * </span></td>
		<td><input name="location" type="text" placeholder="<?=$singleBook->location?>" value="<?=$location;?>" class="form-control focusedInput"> 
		</td>
	</tr>
	<tr>
		<td>Seisukord </td>
		<td><select name="condition" class="form-control focusedInput">
				<option value=""><?=$singleBook->condition;?></option>
				
			<?php
				$cond = array( 'Uus', 'Väga hea', 'Hea', 'Keskmine', 'Halb' );
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
				<span class="text-danger"> * </span>
			</select> 
		</td>
	</tr>
	<tr>
		<td>Väärtus müntides:</td>
		<td><select name="points" class="form-control focusedInput">
				<option value=""><?=$singleBook->coins;?></option>
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
		</td>				
	</tr>	
	<tr>			
		<td>Uus pildi aadress (URL)</td>
		<td><input name="picture" value="<?=$image;?>" type="text" placeholder="http://www.aadress.ee" class="form-control focusedInput"> 
		</td>				
	</tr>
	<tr>		
		<td>Kirjeldus</td>
		<td colspan="2">
				<textarea name="description" rows="6" cols="50" placeholder="<?=$description;?>" class="form-control focusedInput" ><?=$description;?></textarea>
		</td>			
	</tr>
	<tr>
		<td>
			<!--Kustuta link -->
			<a href="?id=<?=$_GET["id"];?>&delete=true">Kustuta raamat</a>
		</td>
		<td></td>
		<td><input type="submit" name="change" value="Muuda andmeid" class="btn btn-default"><br></td>
	</tr>
</form>
</table>
</div>
</div>
<?php require("../footer.php");?>