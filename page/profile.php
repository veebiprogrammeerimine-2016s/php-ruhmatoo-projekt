<?php
require("header.php");
$aboutUser = "Tere! Olen lihtsalt suvaline tegelane. Elan vanas majas ja minu juhtmed ja torud lähevad pidevalt katki ja umbe, seega jõlgun siin saidil tihti.";
?>
<style>
</style>
<title>Kasutaja && profiil</title>
<div class="header"><a class="hbutton" href="home.php">< </a><?php echo $appName;  ?></div>
<body>
<div class="row">
<div class="c-3">
<h2>Profiil</h2>
<img src="" style="width: 90%; border: 1px solid green;">

<p><b>Nimi:</b> <?php echo "NULL";?></p>
</div>

<div class="c-7">
<h2>Kasutajast</h2>
<h3>Natuke endast</h3>
<p><?php echo $aboutUser;?></p>
</div>
</div>
</body>

<div class="row footer" style="margin-top: 2em; background: gray;">
<div class="c-4">
<h5 style="margin-top: 0em; margin-bottom: 1em;"><?php echo $appName;?></h5>
<p>Abi | Privaatsus</p>
</div>
<div class="c-4">
<h5 style="margin-top: 0em;">Tagasiside</h5>
<p>Tagasiside saate saata <a href="feedback.php">siin.</a></p>
</div>
<div class="c-4">
<h5 style="margin-top: 0em;">Kontakt</h5>
<p>Elle: <br>Kristel: <br>Mihkel:</p>
</div>
</div>

<?php require("footer.php"); ?>
