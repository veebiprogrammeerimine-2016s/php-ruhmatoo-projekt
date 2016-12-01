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
	header("Location: home.php");		
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

if($singleBook->image == ""){
			$singleBook->image = ("../image/raamat.jpg"); //kui raamatu pilti pole
		}
		

if(isset($_GET["delete"])){
	$status = "deleted";          //kui aadressireal deleted, siis tehingute tabelisse 'status' väärtuseks deleted
	$deleted = "deleted";         //kui aadressireal deleted, siis raamatute tabelisse 'deleted' väärtuseks deleted
	$error = "";
	$msg = "Raamat kustutatud!";
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
				$msg = "Oled osad andmed ära kustutanud, tärniga tähistatud väljad peavad olema täidetud!";
			}else{
				$error = "";
				$msg = "Andmed edukalt muudetud!";
			}
}
if(empty($error)){
	//FUNKTSIOON, et vajadusel teises tabelis punkte muuta
	if($coins != $singleBook->coins || $status == "deleted"){
		$Coin->updateCoins($_SESSION["userId"], $_GET["id"], $coins, $status);   
	}
		
	//FUNKTSIOON, et raamatu andmeid muuta
	$Book->changeData($category, $title, $author, $year, $condition, $location, $description, $coins, $image, $_GET["id"], $deleted);
	
		
}


?>

<?php
//HTML
require("../header.php");
?>
<h4>Muuda raamatu andmeid</h4>
<br>
<?php echo $msg ."<br><br>";?>

<br><br>
<table>
	<tr>
		<td valign="top">
			<img src="<?=$singleBook->image;?>" alt="book picture" style= "width:200px;" >
		</td>
		<td style="text-align:right;">
 
			<form method="post">
				
				<select name="category">
				
				
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
				<br><br>
				 
				<input name="title" type="text" placeholder="<?=$singleBook->title?>" value="<?=$title;?>"> *<br>
				
				<input name="author" type="text" placeholder="<?=$singleBook->author?>" value="<?=$author;?>"> *<br> 
				
				<input name="year" type="year" placeholder="<?=$singleBook->year?>" value="<?=$year;?>"> <br>
				 
				<input name="location" type="text" placeholder="<?=$singleBook->location?>" value="<?=$location;?>"> *<br>
				<br>
				Seisukord <select name="condition">
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
				</select> *
				<br><br>
				Väärtus müntides: <select name="points">
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
				<br><br>
				
				<input name="picture" value="<?=$image;?>" type="text" placeholder="http://www.aadress.ee"> Uus pildi aadress (URL)
				<br><br>
				<p>Kirjeldus</p>
				<textarea name="description" rows="4" cols="50" placeholder="<?=$description;?>"><?=$description;?></textarea>
				<br><br>
				<input type="submit" name="change" value="Muuda andmeid"><br>
			</form>
		</td>
	</tr>
	<tr>
		<td>
			<!--Kustuta link -->
			<a href="?id=<?=$_GET["id"];?>&delete=true">Kustuta raamat</a>
		</td>
	</tr>
</table>

<?php require("../footer.php");?>