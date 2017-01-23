<?php	
	
	require("functions.php");
	require("style/style.php");
	require("style/pagestyle.php");
	
	if (isset($_GET["logout"])) {
		session_destroy();
		header("Location: loginpage.php");
		exit();
	}
	
?>

<html>

<body>
	<ul>
		<li><a class="active" href="homepage.php">AVALEHT</a></li>
		<li><a class="active1" href="forumpage.php">FOORUM</a></li>
		<li><a class="active1" href="userpage.php">MINU KASUTAJA</a></li>
		<li><a class="active1" href="?logout=1">LOGI VÄLJA</a></li>
	</ul>

<div style="page">

<p class="down"> AVALEHT </p>
<p> Liikmed: Andra Kaljurand, Ksenia Belorusskaja 

<br>
Eesmärk:
	Luua veebisait, kus need õpilased, kes soovivad Tallinna Ülikooli sisse astuda, leiaksid endale sobiva eriala.
	Nad saavad lugeda foorumist postitusi, samuti lisada sinna postitusi, kui neil on mure või küsimus mingi teatud eriala kohta.
	Veebilehel oleks veel uudisteplokk, kus on informatsioon sisseastumiseksamite kohta.
</p>
	
</div>
</body>
</html>	