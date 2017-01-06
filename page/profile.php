<?php
require("header.php");
require("../class/class_data.php");
$internal = new internal($dbconn);
$secretMode = true;
if (isset($_SESSION["id"])) {
	$secretMode = false;
}
$aboutUser = "Olen maailma kõige ilusam ja edukam inimene.";
?>
<style>
</style>
<title>Kasutaja <?php echo $internal->getName($_GET["id"]); ?> profiil</title>
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
<center><img src="http://24.media.tumblr.com/f98b35148f53e23e62fe402463b6aa93/tumblr_n6old80nsE1smtsipo1_500.gif"></center>
</td>
</tr>
<tr>
<td id="two">
<div class="head" ;><b>Oluline:</b></div>
<p><b>Asukoht:</b> <?php
$district = $internal->getUserDistrict($_GET["id"]);
if (!empty($district)) {echo $internal->getDistrictName($district);}
?></p>
<p><b>Vanus:</b> <?php echo $internal->getAge($_GET["id"]);?></p>
<p><b>Amet:</b> <?php
	$skills = array();
	$skills = $internal->getWorkerSkills($_GET["id"]);
	if (!empty($skills)) {
		foreach ($skills as $a) {
			$skillname = $internal->getSkillName($a);
			echo $a.", ";
		}
	} else { echo "Ametid puuduvad";}
?></p>

</td>
<td id="three">
<div class="head" style="";><b>Kontakt:</b></div>
<p><b>E-mail:</b> <?php if ($secretMode == false) {echo $internal->getEmail($_GET["id"]);}?></p>
<p><b>Telefoni nr:</b> <?php if ($secretMode == false) {echo $internal->getNumber($_GET["id"]);}?></p>

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


<?php require("footer.php"); ?>