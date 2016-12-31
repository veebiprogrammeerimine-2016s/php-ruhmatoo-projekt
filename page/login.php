<?php
require ("header.php");
require ("../function/functions.php");
require ("../class/class_general.php");
require ("../class/class_login.php");
$error = "";
$login = new User($dbconn);
$input = new Input();
if (isset($_POST["email"])) {
	$email = $input->clean($_POST["email"]);
}
if (isset($_POST["password"])) {
	$password = $input->clean($_POST["password"]);
}
if (isset($email) && isset($password)) {
	if ($login->checkIfExists($email)) {
		$hash = $login->getHash($email);
		if (password_verify($password, $hash)) {
			if ($login->logIn($email)) {
				header("Location: home.php");
			}
		} else {$error = "Kontrollige oma andmeid.";}
	} else {$error = "Kontrollige, kas sisestasite andmed õigesti.";}
}
?>
<link rel="stylesheet" type="text/css" href="../styles/newlogin.css">


<title>Sisselogimine</title>
<div class="login-page">
    <form class="form" method="post">
      <input type="email" name="email" placeholder="E-mail" value="<?=$email;?>" required/>
      <input type="password" name="password" placeholder="Parool" required/>
      <input type="submit" class="button" value="Logi sisse">
			<?php if (!empty($error)) {echo "<p class='message'>$error</p>";}?>
      <p class="message">Pole kasutaja? <a href="register.php">Registreeri!</a></p>
	  <p class="message">Unustasid parooli?<a href="">Abi</a></p>
	  <p class="message"><a href="home.php">Kodu</a></p>

    </form>
  </div>
</div>
