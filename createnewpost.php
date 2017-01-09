<?php
	
	require("functions.php");
	require("style/style.php");
	require("style/pagestyle.php");
	
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
	
	<form method="POST">
	
	<!--KATEGOORIA-->
	<label for="category">Vali eriala:</label></br>
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
	<label for="headline">Uue postitus:</label><br>
	<input placeholder="Pealkiri" name="headline">
	
	<!--Kommentaar-->
	<br>
	<textarea rows="4" cols="50" placeholder="Kirjuta milline probleem sul tekkis.." name="comment"></textarea>
	
	<input type="submit" value="postita">
	</form>
	
	<br><br>