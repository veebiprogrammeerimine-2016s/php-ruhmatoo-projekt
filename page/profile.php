<?php
require("header.php");
$aboutUser = "Olen maailma kõige ilusam ja edukam inimene.";
?>
<style>
</style>
<title>Kasutaja & profiil</title>
<div class="header"><a class="hbutton" href="home.php">< </a><?php echo $appName; ?></div>
<body>
<style type="text/css">
#container {
	width:500px; 
	margin: 25 px;
	}
#two, #three, #four {
	background-color: #fff;
	padding: 8px;
	color: #212e36; font-size: 15px;
}
#two, #three {
	width: 250px; 
	text-align: center;
}
#four {
	text-align: center;
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
<div class="head" style="color:white; font-size:24px";><b>Profiil</b></div>
<img src="http://24.media.tumblr.com/f98b35148f53e23e62fe402463b6aa93/tumblr_n6old80nsE1smtsipo1_500.gif">
</td>
</tr>
<tr>
<td id="two">
<div class="head" ;><b>Oluline:</b></div>
<p><b>Asukoht:</b> <?php echo "NULL";?></p>
<p><b>Vanus:</b> <?php echo "NULL";?></p>
<p><b>Amet:</b> <?php echo "NULL";?></p>

</td>
<td id="three">
<div class="head" style="";><b>Kontakt:</b></div>
<p><b>E-mail:</b> <?php echo "NULL";?></p>
<p><b>Telefoni nr:</b> <?php echo "NULL";?></p>

</td>
</tr>
<tr>
<td colspan="2" id="four">
<div class="head" style="";><b>Minust:</b></div>
<p><i><?php echo $aboutUser;?></i></p>
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
