<?php
	
	//FUNKTSIOONID
	require("functions.php");
	require("style/style.php");
	require("style/pagestyle.php");
	
	//LOOGIMINE OUT
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

<body>
	<ul>
		<li><a class="active1" href="homepage.php">AVALEHT</a></li>
		<li><a class="active" href="forumpage.php">FOORUM</a></li>
		<li><a class="active1" href="userpage.php">MINU KASUTAJA</a></li>
		<li><a class="active1" href="?logout=1">LOGI VÄLJA</a></li>
	</ul>

<div style="page">

	<p class="down"> <a href="forumpage.php"> FOORUM </a> / UUS POSTITUS</p>
	
	<center>
	
	<form method="POST">
	
	<!--KATEGOORIA-->
	<label for="category">Vali instituut:</label></br>
	<select name="category" id="category" required>
	<option value="">Näita</option>
	<option value="Balti filmi, meedia, kunstide ja kommunikatsiooni instituut">Balti filmi, meedia, kunstide ja kommunikatsiooni instituut</option>
	<option value="Digitehnoloogiate instituut">Digitehnoloogiate instituut</option>
	<option value="Haridusteaduste instituut">Haridusteaduste instituut</option>
	<option value="Huminaarteaduste instituut">Huminaarteaduste instituut</option>
	<option value="Loodus- ja terviseteaduste instituut">Loodus- ja terviseteaduste instituut</option>
	<option value="Ühiskonnateaduste instituut">Ühiskonnateaduste instituut</option>
	<option value="Haapsalu Kolledž">Haapsalu Kolledž</option>
	<option value="Rakvere Kolledž">Rakvere Kolledž</option>
	</select>
	<br><br>
	<!--pealkiri-->
	<label for="headline">Uus postitus:</label><br>
	<input placeholder="Pealkiri" class="text" name="headline" required>
	
	<!--Kommentaar-->
	<br>
	<input placeholder="Kirjuta milline probleem sul tekkis.." name="comment" class="text" required>
	
	<input type="submit" class="submit submit1" value="Postita">
	</form>
	
	</center>
	<br><br>

	<p class="down"></p>

</div>	

</body>
</html>