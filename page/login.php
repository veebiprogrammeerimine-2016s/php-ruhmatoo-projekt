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
<link rel="stylesheet" type="text/css" href="../styles/login.css">


<title>Töömehe leidja</title>


<div class="materialContainer">

   <div class="box">

      <div class="title">Logi sisse</div>

      <div class="input">
	 <form method="post">
         <label for="name">E-mail</label>
         <input type="email" name="name" id="name" value="<?php echo $name; ?>">
         <span class="spin"></span>
      </div>

      <div class="input">
         <label for="pass">Parool</label>
         <input type="password" name="pass" id="pass">
         <span class="spin"></span>
      </div>

      <div class="button login">
        <button><span>Logi Sisse</span> <i class="fa fa-check"></i></button>
	</div>
	</form>
      <a href="" class="pass-forgot">Unustasid parooli?</a>
	  <a href="home.php" class="back">Tagasi</a>
</div>
<div class="overbox">
      <div class="material-button alt-2"><span class="shape"></span></div>

      <div class="title">Registreeri</div>

      <div class="input">
         <label for="regname">Kasutajanimi</label>
         <input type="text" name="regname" id="regname">
         <span class="spin"></span>
      </div>

      <div class="input">
         <label for="regpass">Parool</label>
         <input type="password" name="regpass" id="regpass">
         <span class="spin"></span>
      </div>

      <div class="input">
         <label for="reregpass">Korda parooli</label>
         <input type="password" name="reregpass" id="reregpass">
         <span class="spin"></span>
      </div>

      <div class="button">
         <button><span>Edasi</span></button>
      </div>


   </div>

</div>
</html>
