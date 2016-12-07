<?php
	
	require("functions.php");
	
	if (!isset ($_SESSION["userId"])) {
		header("Location: loginpage.php");
		exit();	
	}
	
	//LOG OUT
	if (isset($_GET["logout"])) {
		session_destroy();
		header("Location: loginpage.php");
		exit();
	}
	
	//KOMMENTAARI SALVESTAMINE
	if (isset($_POST["category"])&&
		isset($_POST["headline"]) &&
		isset($_POST["comment"]) &&
		!empty($_POST["category"])&&
		!empty($_POST["headline"])&&
		!empty($_POST["comment"])
		)
	{
	comment($_POST["category"],$_POST["headline"], $_POST["comment"], $_SESSION["userEmail"]);
	}

?>

<html>
Tere tulemast <?=$_SESSION["userEmail"];?>!
<a href="?logout=1">Logi välja</a>
<body>
	
	<form method="POST">
	<!--KATEGOORIA-->
	<p><label for="category">Valikategooria:</label><br>
	<select name="category" id="category">
	<option value="">kategoria 1</option>
	<option value="kategooria1">kategooria1.1</option>
	<option value="kategooria1.2">kategooria1.2</option>
	<option value="kategooria2.2">kategooria2.1</option>
	<option value="kategooria2.2">kategooria2.2</option>
	</select>
	<!--pealkiri-->
	<label for="headline">headline</label><br>
	<input name="headline">
	<!--Kommentaar-->
	<label for="comment">comment</label><br>
	<input name="comment">
	
	<input type="submit" value="postita">
	
</form>
</body>		
</html>
<!--
Balti filmi, meedia, kunstide ja kommunikatsiooni instituut
Digitehnoloogiate instituut
Haridusteaduste instituut
Humanitaarteaduste instituut
Loodus- ja terviseteaduste instituut
Ühiskonnateaduste instituut
Haapsalu Kolledþ
Rakvere Kolledþ-->