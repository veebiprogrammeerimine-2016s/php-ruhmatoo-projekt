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
	
	.cat_col {
		color:A11F2F; 
		font-weight: 
		600;
	}
	
	clock {
		color:black;
	}
	
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
	
	body {
		background: url(image/background.png);
	}

</style>
<body>

	<h2>Tee uus postitus</h2
	<form method="POST">
	<!--KATEGOORIA-->
	<p><label for="category">Vali eriala:</label><br>
	<select name="category" id="category" size="4" required>
	<option value="BMKKI" disabled="" class="cat_col">Balti filmi, meedia, kunstide ja kommunikatsiooni instituut</option>
	<option value="Ajakirjandus">Ajakirjandus</option>
	<option value="Kunst,Muusika,Multimeedia">Kunst,Muusika,Multimeedia</option>
	<option value="Koreograafia">Koreograafia</option>
	<option value="Audiovisuaalne meedia">Audiovisuaalne meedia</option>
	<option value="Reklaam ja imagoloogia">Reklaam ja imagoloogia</option>
	<option value="Ristmeedia filmis ja televisioonis">Ristmeedia filmis ja televisioonis</option>
	<option value="Suhtekorraldus">Suhtekorraldus</option>
	<option value="Reklaam ja imagoloogia">Reklaam ja imagoloogia</option>
	<option value="" disabled="DI" class="cat_col">Digitehnoloogiate instituut</option>
	<option value="Informaatika">Informaatika</option>
	<option value="Infoteadus">Infoteadus</option>
	<option value="Infoteadus">Matemaatika</option>
	<option value="" disabled="HTI" class="cat_col">Haridusteaduste instituut</option>
	<option value="Alushariduse pedagoog">Alushariduse pedagoog</option>
	<option value="Andragoogika">Andragoogika</option>
	<option value="Eripedagoogika">Eripedagoogika</option>
	<option value="Klassiopetaja">Klassiopetaja</option>
	<option value="Kutsepadagoogika">Kutsepadagoogika</option>
	<option value="Noorsootoo">Noorsootoo</option>
	<option value="Pedagoogika">Pedagoogika</option>
	<option value="" disabled="DI" class="cat_col">Huminaarteaduste instituut</option>
	<option value="Aasia uuringud">Aasia uuringud </option>
	<option value="Ajalugu">Ajalugu</option>
	<option value="Antropoloogia">Antropoloogia</option>
	<option value="Eesti filoloogia">Eesti filoloogia</option>
	<option value="Euroopa nüüdiskeeled ja kultuurid">Euroopa nüüdiskeeled ja kultuurid</option>
	<option value="Filosoofia">Filosoofia</option>
	<option value="Interdistsiplinaarsed humanitaarteadused">Interdistsiplinaarsed humanitaarteadused</option>
	<option value="Kultuuriteadus">Kultuuriteadus</option>
	<option value="Vene filoloogia">Vene filoloogia</option>
	<option value="" disabled="DI" class="cat_col">Loodus- ja terviseteaduste instituut</option>
	<option value="Bioloogia (kõrvalerialaga)">Bioloogia (kõrvalerialaga)</option>
	<option value="Integreeritud loodusteadused">Integreeritud loodusteadused</option>
	<option value="Integreeritud tehnoloogiad ja käsitöö">Integreeritud tehnoloogiad ja käsitöö</option>
	<option value="Kehakultuur">Kehakultuur</option>
	<option value="Keskkonnakorraldus">Keskkonnakorraldus</option>
	<option value="Psühholoogia (psühholoogia suund)">Psühholoogia (psühholoogia suund)</option>
	<option value="Psühholoogia (inimeseõpetuse suund)">Psühholoogia (inimeseõpetuse suund)</option>
	<option value="Reakreatsioonikorraldus">Reakreatsioonikorraldus</option>
	<option value="" disabled="DI" class="cat_col">Ühiskonnateaduste instituut</option>
	<option value="Haldus- ja ärikorraldus">Haldus- ja ärikorraldus</option>
	<option value="Interdistsiplinaarsed sotsiaalteadused">Interdistsiplinaarsed sotsiaalteadused</option>
	<option value="Poliitika ja valitsemine">Poliitika ja valitsemine</option>
	<option value="Riigiteadused">Riigiteadused</option>
	<option value="Sotsiaaltöö">Sotsiaaltöö</option>
	<option value="Sotsioloogia">Sotsioloogia</option>
	<option value="Õigusteadus">Õigusteadus</option>
	<option value="Õigusteadus (inglise keeles)">Õigusteadus (inglise keeles)</option>
	<option value="" disabled="DI" class="cat_col">Haapsalu Kolledž</option>
	<option value="Käsitöötehnoloogiad ja disain">Käsitöötehnoloogiad ja disain</option>
	<option value="Liiklusohutus">Liiklusohutus</option>
	<option value="Rakendusinformaatika">Rakendusinformaatika</option>
	<option value="Tervisejuht">Tervisejuht</option>
	<option value="" disabled="DI" class="cat_col">Rakvere Kolledž</option>
	<option value="Alushariduse pedagoog">Alushariduse pedagoog</option>
	<option value="Sotsiaalpedagoogika">Sotsiaalpedagoogika</option>
	
	</select>
	<br><br>
	<!--pealkiri-->
	<label for="headline">Uue postitus:</label><br>
	<input placeholder="Pealkiri" name="headline">
	<br>
	<!--Kommentaar-->
	<textarea rows="4" cols="50" placeholder="Kirjuta milline probleem sul tekkis.." name="comment"></textarea>
	
	<br><br>
	<input type="submit" value="postita">
	
	<br><br>
	<a href="?logout=1">Logi välja</a>
	
	<br><br>
</form>
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