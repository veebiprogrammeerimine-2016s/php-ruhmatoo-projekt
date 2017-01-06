<?php
require ("header.php");
require ("../function/functions.php");
require ("../class/class_general.php");
require ("../class/class_login.php");
require ("../class/class_data.php");
$error = "";
$email = "";
$name = "";
$registerSuccess= false;
$login = new User($dbconn);
$input = new Input();
$data = new internal($dbconn);
$districts = array();
$districts = $data->getDistrictIDs();
$skills = array();
$skills = $data->getSkillIDs();

if (isset($_POST["displayname"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["district"]) && isset($_POST["age"])) {
$email = $input->clean($_POST["email"]);
$name = $input->clean($_POST["displayname"]);
$password = $input->clean($_POST["password"]);
$district = $input->clean($_POST["district"]);
$skill = $_POST["skill"];
$age = $input->clean($_POST["age"]);
$bio = $input->clean($_POST["bio"]);
  if ($login->checkIfExists($email)) {
    $error .= "Seda e-mailiaadressi on juba kasutatud.";
  } else {
    if (strlen($password) >= 6) {
      $hash = password_hash($password, PASSWORD_DEFAULT);
        if ($login->create($email, $name, $hash, "worker", $district, $age)) {
            $userid = $login->getId($email);
            $login->addBio($userid, $bio);
            $login->addSkill($userid, $skill);
              $registerSuccess = true;

        } else {$error .= "Midagi läks kahjuks valesti.";}
    } else {$error .= "Parool peab olema <i>vähemalt</i> 6 märki pikk.";}
  }
}
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
      <select style="width: 100%; color: black;" name="district">
        <?php foreach($districts as $a) {
            $dname = $data->getDistrictName($a);
      			echo "<option value='".$a."'>".$dname."</option>";
          } ?>
      </select>
      <select style="width: 100%; color: black;" name="skill">
        <?php
        unset($a);
        foreach($skills as $a) {
            $skillname = $data->getSkillName($a);
            echo "<option value='".$a."'>".$skillname."</option>";
          }
        ?>
      </select>
      <br>
      <textarea name="bio" placeholder="Natukene endast..." style="width: 100%; font-family: Roboto;"></textarea>
      <br>


      <input type="submit" class="button" value="Loo kasutaja">
      <?php if (!empty($error)) {
        echo "<p class='message' style='color:red;'>$error</p>";
      }
      if ($registerSuccess) {
        echo "<p class='message' style='color:green;'>Kasutaja on loodud. Võid nüüd sisse logida.</p>";
      }?>
      <p class="message">Oled juba registreerunud? <a href="login.php">Logi sisse</a></p>
      <p class="message">Soovid registreeruda tavakasutajana? <a href="register.php">Registreeru siin!</a></p>
	  <p class="message"><a href="home.php">Kodu</a></p>
    </form>
</div>
