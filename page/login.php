<?php
require("../function/login.php");
if (!empty($_POST["name"])) {
	echo "Kasutajanimi sisestatud";
	$name = $_POST["name"];
	if (!empty($_POST["pass"])) {
		echo "Parool sisestatud.";
		$startLogin = 1;
	} else {
		echo "Parooli ei sisestatud";
		$startLogin = 0;
	}

} else {
	echo "Kasutajanime ei sisestatud";
	$name = "";
	$startLogin = 0;
}

if ($startLogin == 1) {
	echo "Alustasin sisselogimisega.";
	
	logIn($_POST["name"], $_POST["pass"]);
}
?>
<link rel="stylesheet" type="text/css" href="../styles/newlogin.css">


<title>Sisselogimine</title>
<div class="login-page">
    <form class="form">
      <input type="email" placeholder="E-mail"/>
      <input type="password" placeholder="Parool"/>
      <button>login</button>
      <p class="message">Pole kasutaja? <a href="register.php">Registreeri!</a></p>
    </form>
  </div>
</div>