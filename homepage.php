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
	$people = allinfo();
?>

<html>
<style>
	

	table, td, th {
		border: 1px solid black;
	}

	table {
		border-collapse: collapse;
		width: 100%;
	}

	th {
		height: 50px;
	}
</style>

<body>

	<h2>Tee uus postitus</h2
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
	
	<br><br>
	<input type="submit" value="postita">
	</form>
	
	<br><br>
	<a href="?logout=1">Logi välja</a>
</body>		
</html>
<?php 
$html = "<table>";
	
	$html .= "<tr>";
		$html .= "<th>Category</th>";
		$html .= "<th>Pealkiri</th>";
		$html .= "<th>Kommentaar</th>";
		$html .= "<th>Postitud</th>";
		$html .= "<th>Kasutaja</th>";	
	$html .= "</tr>";

	
	foreach ($people as $p) {
	$html .= "<tr>";
		$html .= "<td>".$p->category."</a></td>";
		$html .= "<td>".$p->headline."</td>";
		$html .= "<td>".$p->comment."</td>";
		$html .= "<td>".$p->created."</td>";
		$html .= "<td>".$p->email."</td>";
		$html .= "<td><a href='comment.php?id=".$p->id."'>Reply</a></td>";
	$html .= "</tr>";
	}

$html .= "</table>";
echo $html
?>

<?php include 'footer.php';?>
	</body>
</html>	
