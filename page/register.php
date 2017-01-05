<?php
require ("header.php");
require ("../function/functions.php");
require ("../class/class_general.php");
require ("../class/class_login.php");
$error = "";
$displayname="";
$email="";
$login = new User($dbconn);
$input = new Input();

if (isset($_POST["displayname"])) {$name = $input->clean($_POST["displayname"]);}
if (isset($_POST["email"])) {$email = $input->clean($_POST["email"]);}
if (isset($_POST["password"])) {$password = $input->clean($_POST["password"]);}

if (isset($name) && isset($email) && isset($password)) {
  if ($login->checkIfExists($email)) {
    $error .= "Seda e-mailiaadressi on juba kasutatud.";
  } else {
    if (strlen($password) >= 6) {
      $hash = password_hash($password, PASSWORD_DEFAULT);
        if ($login->create($email, $name, $hash, "user")) {
          $registerSuccess = true;
        } else {$error .= "Midagi läks kahjuks valesti.";}
    } else {$error .= "Parool peab olema <i>vähemalt</i> 6 märki pikk.";}
  }
}
?>

<head>

</head>

<header>
  <title>Registreeri!</title>
  <link rel="stylesheet" type="text/css" href="../styles/newlogin.css">
</header>

<div class="login-page">
    <form class="form" method="post">
	    <input type="text" name="displayname" placeholder="Ees-ja Perekonnanimi" value="<?=$name?>"/>
      <input type="email" name="email" placeholder="E-maili aadress" value="<?=$email?>"/>
      <input type="password" name="password" placeholder="Parool"/>
	  <input type="number" name="age"  placeholder="Vanus"/>
      <input type="submit" class="button" value="Loo kasutaja">
      <?php if (!empty($error)) {
        echo "<p class='message'>$error</p>";
      }
      if ($registerSuccess) {
        echo "<p class='message'>Kasutaja on loodud. Võid nüüd sisse logida.</p>";
      }?>
      <p class="message">Oled juba registreerunud? <a href="login.php">Logi sisse</a></p>
	  <p class="message">Omad ametit mida soovid meie lehel pakkuda? <a href="register_workman.php">Registreeru töötajana!</a></p>
    </form>
</div>
