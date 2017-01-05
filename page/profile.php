<?php
require("header.php");
$aboutUser = "Tere! Olen Raivo, olen oma habet kasvatanud juba aasta! Muidu tegelen it-ga.";
?>
<style>
</style>
<title>Kasutaja && profiil</title>
<div class="header"><a class="hbutton" href="home.php">< </a><?php echo $appName; ?></div>
<body>
<center>
<h2 style="color:white";>Profiil</h2>
<div class="row">
<div class="c-12" >
<div style="width:75%; margin-left: 0 auto; background: white; border: 2px solid gray;">

<img src="https://static.pexels.com/photos/119705/pexels-photo-119705.jpeg" style="height: 175px; border: 0; float: right; margin-right: 10px;">
<div style="float: left;"></div>


<h2 style="float:left;margin-right: 10px;">Minust:</h2>
<p><?php echo $aboutUser;?></p>

<h2 style="float:left;">Kontakt:</h2>
<p><b>Nimi:</b> <?php echo "NULL";?></p>

<h2 style="float:left;">Oluline:</h2>
<p><?php echo "NULL";?></p>

<div style="clear: both;"></div>
</div>

</div>
</div>
</center>
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
