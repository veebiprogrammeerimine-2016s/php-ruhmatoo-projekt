<?php
require("header.php");

?>
<div class="header"><a class="hbutton" href="home.php">< </a><?php echo $appName; ?></div>

<body>
<style type="text/css">
#container {
	width:700px; 
	margin: 35 px;
	}
#two {
	background-color: #fff;
	padding: 8px;
	color: #212e36; font-size: 15px;
	width: 250px; 
	text-align: center;
	margin: 25 px;
}
.head {
	font-family: ; 
	color: black; 
	font-size: 20px; 
	text-align: center;
}
#one .head {
	font-size: 50px;
}
</style>
<center>
<div id="container">
<table id="inside" cellspacing="0" border="0">
<tr>
<td colspan="2" id="one">
<div class="head" style="color:white; font-size:24px";><b>Muuda profiili:</b></div>
</td>
</tr>
<tr>
<td id="two">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
<p>Nimi:</p>
<p><input type="text" size="15" name="" value="">
<br>
<p>Asukoht:</p>
<p><input type="text" size="20" name="" value="">
<br>
<p>Vanus:</p>
<p><input type="number" size="5" name="" value="">
<br>
<p>Amet:</p>
<p><input type="text" size="15" name="" value="">
<br>
<p>Minust:</p>
<p><input type="text" size="15" name="" value="">
<br>
<p>Uus parool (kui ei soovi muuta võid ka tühjaks jätta):</p>
<p><input type="password" size="10" name="" value="">
<br><br>
<p><input type="submit" name="submitbtn" value="Muuda kasutajat">
</form>
</td>
</tr>
</table>
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