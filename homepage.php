<?php
	
	require("functions.php");
	require("header.php");
	
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

<h2>Tere tulemast <?=$_SESSION["userEmail"];?> ! </h2>

<center>
<?php 
$html = "<table>";
	
	$html .= "<tr>";
		$html .= "<th>Eriala</th>";
		$html .= "<th>Pealkiri</th>";
		$html .= "<th>Kommentaar</th>";
		$html .= "<th>Postitud</th>";
		$html .= "<th>Kasutaja</th>";	
	$html .= "</tr>";

	
	foreach ($people as $p) {
	$html .= "<tr>";
		$html .= "<td>".$p->id."</td>";
		$html .= "<td><a href='homepage.php?id='>".$p->category."</a></td>";
		$html .= "<td>".$p->headline."</td>";
		$html .= "<td>".$p->created."</td>";
		$html .= "<td>".$p->email."</td>";	
	$html .= "</tr>";
	}

$html .= "</table>";
echo $html
?>

<html>
<style type="text/css">
	.cat_col {color:#A11F2F; font-weight: 600;}
	p {font-family: courier;font-size:110%;}
	h2 {font-family: courier;}
	#clock {color:black;}
</style>

<script type="text/javascript">
	function updateClock (){
	  var currentTime = new Date ( );
	  var currentHours = currentTime.getHours ();
	  var currentMinutes = currentTime.getMinutes ();
	  var currentSeconds = currentTime.getSeconds();
	  currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
	  currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
	  var timeOfDay = ''; 

	  var currentTimeString = currentHours + ":" + currentMinutes + ':' + currentSeconds+ " " + timeOfDay;

	  document.getElementById("clock").innerHTML = currentTimeString;
	}

</script>
<body onLoad="updateClock(); setInterval('updateClock()', 1000 )">
<span id="clock">&nbsp;</span>

	<body>
	<h2>Tee uue postituse</h2>
	<form method="POST">
	<!--KATEGOORIA-->
	<p><label for="category">Vali eriala:</label><br>
	<select name="category" id="category" size="4" required>
	<option value="BMKKI" disabled="" class="cat_col">Balti filmi, meedia, kunstide ja kommunikatsiooni instituut</option>
	<option value="Ajakirjadnus">Ajakirjandus</option>
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
</center>

<?php echo date("d.m.Y");?>