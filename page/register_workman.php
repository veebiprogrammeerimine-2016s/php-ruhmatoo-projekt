<?php
require ("header.php");
require ("../function/functions.php");
require ("../class/class_general.php");
require ("../class/class_login.php");
$error = "";
$login = new User($dbconn);
$input = new Input()

?>

<header>
  <title>Registreeri!</title>
  <link rel="stylesheet" type="text/css" href="../styles/newlogin.css">
</header>

<div class="login-page">
    <form class="form" method="post">
	    <input type="text" name="displayname" placeholder="Nimi" value="<?=$name?>"/>
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
	  <p class="message"><a href="home.php">Kodu</a></p>
    </form>
</div>