<?php

//FUNKTSIOONIDEGA FAILID
require("../functions.php");     
require("../class/User.class.php");      
$User = new User($mysqli);                         


	
// MUUTUJAD
$username = "";
$email = "";
$password = "";
$error = "";
	

// kontrollin, kas väljad on täidetud
if(isset($_POST["username"])){     		
	if(empty($_POST["username"]) || empty($_POST["email"]) 
		|| empty($_POST["password"]) || empty($_POST["passwordAgain"]) ) {
		$error = "Kõik väljad on kohustuslikud!";
		$username = $_POST["username"];
		$email = $_POST["email"];
	} else {
		if ( strlen($_POST["password"]) < 8 ) {
			$error = "Parool peab olema vähemalt 8 tähemärki";
			$username = $_POST["username"];
			$email = $_POST["email"];
		} elseif ($_POST["password"] != $_POST["passwordAgain"]){
			$error = "Salasõnad ei kattu!";	
			$username = $_POST["username"];
			$email = $_POST["email"];
		} else {
			$username = $Helper->cleanInput($_POST["username"]);
			$email = $Helper->cleanInput($_POST["email"]);
			$password = $Helper->cleanInput($_POST["password"]);
			$password = hash("sha512", $password);
		}
	}
} 
		
// kui ühtegi errorit pole kutsun funktsiooni
if(isset($_POST["username"]) && empty($error)){	
	
	
	$User->signUp($username, $email, $password);	  //signUp() on User.class php-s
	header("Location: join.php?user=".$_POST["username"]."&joined=true");
}

//HTML
require("../header.php");
if(isset($_GET["joined"])){
	echo "<br><br><br><p>Kasutaja " .$_GET['user']. " edukalt loodud!</p>";
	echo "Võid nüüd sisse <a href='login.php'>logida</a>!";
}else{
?>
<p>Loo kasutaja</p>

<form method="post">
	<input name="username" type="text" placeholder="Kasutajanimi" value="<?=$username;?>"> <br>
	<input name="email" type="text" placeholder="E-post" value="<?=$email;?>"><br> 
	<input name="password" type="password" placeholder="Salasõna"><br>
	<input name="passwordAgain" type="password" placeholder="Salasõna uuesti"> <br>
	<br>
	<input type="submit" value="Loo kasutaja"><br>
</form>
<br>
<?=$error;}?>
<?php require("../footer.php");?>