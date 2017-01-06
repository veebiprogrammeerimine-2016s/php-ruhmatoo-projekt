<?php
require("header.php");
require("../class/class_data.php");
require("../class/class_general.php");
require("../class/class_login.php");
$data = new Internal($dbconn);
$login = new User($dbconn);
$districts = array();
$districts = $data->getDistrictIDs();
$allskills = array();
$allskills = $data->getSkillIDs();
$namechanged = false;
$agechanged = false;
$districtchanged = false;
$biochanged = false;

if (!isset($_SESSION["id"])) {
	header("Location: home.php");
	exit();
}
$name = $_SESSION["name"];
$age = $data->getAge($_SESSION["id"]);
$bio = $data->getBio($_SESSION["id"]);
if (isset($_POST["skill"])) {
	if (!$login->skillExists($_SESSION["id"], $_POST["skill"])) {
		$login->addSkill($_SESSION["id"], $_POST["skill"]);
	}
}
if (isset($_POST["name"])) {
	if ($login->changeName($_SESSION["id"], $_POST["name"])) {
		$namechanged = true;
	}
}
if (isset($_POST["age"])) {
	if ($login->changeAge($_SESSION["id"], $_POST["age"])) {
		$agechanged = true;
	}
}
if (isset($_POST["district"])) {
	if ($login->changeDistrict($_SESSION["id"], $_POST["district"])) {
		$districtchanged = true;
	}
}
if (isset($_POST["bio"])) {
	if ($login->changeBio($_SESSION["id"], $_POST["bio"])) {
		$biochanged = true;
	}
}
?>
<div class="header"><a class="hbutton" href="home.php">< </a><?php echo $appName; ?></div>

<body>
<style type="text/css">
#container {
	width: 1200px;
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
<form method="post" >
<p>Nimi:</p>
<p><input type="text" size="15" name="name" value="<?=$name?>"></p>
<br>
<p>Asukoht:</p>
<p><select name="district" style="width: 100%;">
	<?php foreach($districts as $a) {
			$dname = $data->getDistrictName($a);
			echo "<option value='".$a."'>".$dname."</option>";
		} ?>
</select></p>
<br>
<p>Vanus:</p>
<p><input type="number" size="15" name="age" value="<?=$age ?>">
<br>
<p>Amet:</p>
<p>Juba valitud ametid:
	<?php
	$skills = array();
	$skills = $data->getWorkerSkills($_SESSION["id"]);
	if (!empty($skills)) {
		foreach ($skills as $a) {
			$skillname = $data->getSkillName($a);
			echo $skillname.", ";
		}
	} else { echo "Ametid puuduvad";} ?></p>
<p><select name="skill" style="width: 100%;">
<?php
	unset($a);
	foreach($allskills as $a) {
			$skillname = $data->getSkillName($a);
			echo "<option value='".$a."'>".$skillname."</option>";
		}
?>
</select></p>
<br>
<p>Minust:</p>
<p><input type="text" size="15" name="bio" value="<?=$bio ?>"></p>
<br><br>
<p><input type="submit" name="submitbtn" value="Muuda kasutajat"></p>
	<?php if ($namechanged) {echo "Nimi on muudetud.";}
	if ($agechanged) {echo "Vanus on muudetud.";}
	if ($districtchanged) {echo "Asukoht on muudetud.";}
	if ($biochanged) {echo "Bio on muudetud.";}?>
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
