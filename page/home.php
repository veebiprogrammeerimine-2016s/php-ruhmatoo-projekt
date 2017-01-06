<!DOCTYPE html>
<?php
require("header.php");
require("../class/class_data.php");
require("../class/class_general.php");
$input = new Input();
$internal = new internal($dbconn);
$search = "";
$districts = array();
$districts = $internal->getDistrictIDs();
$skills = array();
$skills = $internal->getSkillIDs();

if (isset($_GET["search"]) && !empty($_GET["search"])) {
	$search = $input->clean($_GET["search"]);
	$workers = array();
	$workers = $internal->searchWorkers($search);
} else {
	$workers = array();
	$workers = $internal->getWorkers();
}

if (isset($_GET["district"]) && isset($_GET["skill"])) {
	$workers = array();
	$workers = $internal->filterWorkers($_GET["district"]);
	$workers = $internal->filterBySkill($workers, $_GET["skill"]);
}
?>

<title>Töömehe leidja</title>
<div class="row">
<div class="header c-6"><?=$appName?></div>
<div class="header c-6">
<div>
<?php
if (!isset($_SESSION["id"]))
{echo '<a class="button" href="login.php" style="display:flex; align-items:center; width: 150px; float:right; justify-content: center;">Logi sisse</a>';
} else {
	echo '<a class="button" href="logout.php" style="display:flex; align-items:center; width: 150px; float:right; justify-content: center;">Logi välja</a>';
	echo '<a class="button" href="profile.php?id='.$_SESSION["id"].'" style="display:flex; align-items:center; width: 150px; float:right; justify-content: center;">Profiil</a>';

}?>
</div>
</div>
</div>

<div class="row">

<div class="c-3" style="border: 2px solid gray; border-top: 0; border-left: 0; margin-bottom: 0; background: white;">
<h3 style="margin-top: 0; margin-bottom: 0;">Otsi</h3>
<form method="get">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div style="display:flex;align-items:center">
<input type="text" name="search" style="width: 85%; margin-top:10px; margin-bottom: 0; float:left;" value="<?=$search?>">
<button type="submit" class="button" style="float:right; margin-top:10px; margin-left: 5px;">
<i class="fa fa-search"></i>
</button>
</div>
<?php if (!empty($search)) {echo "<a href='home.php'>Tühista otsing</a>";}?>
<div style="margin-top: 5px;"></div>
</form>
<br><br>
<h3 style="margin-top: 0; margin-bottom: 0;">Sorteeri</h3>
<form>
<!--<h6>Linnaosa</h6>
<input type="text" placeholder="Kesklinn" style="width: 100%;" name="district">-->
<p>
<h6>Linnaosa</h6>
<select style="width: 100%;" name="district">

	<?php foreach($districts as $a) {
			$dname = $internal->getDistrictName($a);
			echo "<option value='".$a."'>".$dname."</option>";
		} ?>

</select>
</p>
<h6>Oskused</h6>
<select style="width: 100%;" name="skill">
<?php
foreach ($skills as $a) {
	$sname = $internal->getSkillName($a);
	echo "<option value='".$a."'>".$sname."</option>";

}
?>
</select>
<!--
<input type="checkbox" name="builder" value="yes"> Ehitaja <br>
<input type="checkbox" name="pipe" value="yes"> Torumees <br>
<input type="checkbox" name="electrician" value="yes"> Elektrik <br>
-->

<input type="submit" class="button" style="width: 100%; margin-top:10px; margin-bottom: 0;" value="Sorteeri">
</form>
</div>


<div class="c-9">
	<?php
	if (sizeof($workers) > 0 and !empty($workers[0])){
		foreach($workers as $a) {
			unset($b);
			$workername = $internal->getName($a);
			echo "<a href='profile.php?id=$a'>";
			if ($internal->hasImage($a)) {
				echo "<div class='userbox'>";
			} else
			{echo "<div class='userbox defaultuser'>";}
				echo "<a href='profile.php?id=$a' class='title'>$workername</a>";
				echo "<p style='border-bottom: 2px solid darkgray;'>Oskused<br></p>";
				$userskills = array();
				$userskills = $internal->getWorkerSkills($a);
				if (!empty($userskills)) {
					foreach ($userskills as $b) {
						$skillname = $internal->getSkillName($b);
						echo $skillname."<br>";
					}
				} else { echo "Ametid puuduvad";}
			echo "<p style='border-bottom: 2px solid darkgray;'>Asukoht<br></p>";
			$userd = $internal->getUserDistrict($a);
			echo $internal->getDistrictName($userd)."<br>";
			echo "</div>";
			echo "</a>";
		}} else {
			echo "<h1 class='bigerror'>Töömehi ei ole. :/</h1>";
		}
	?>
</div>

<?php require "footer.php"; ?>
