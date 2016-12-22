<?php
require("header.php");

$conn = new mysqli($server, $user, $pass, $db);
$conn->query("SET NAMES 'utf8'");
$conn->query("SET CHARACTER SET 'utf8'");

$sql = "SELECT id, name FROM districts ORDER BY name";
$districts = $conn->query($sql);
if ($conn->connect_error) {
	die("Ühendus nurjus: " . $conn->connect_error);
}
$skillsql = "SELECT id, skill FROM skills ORDER BY skill";
$skills = $conn->query($skillsql);
?>

<title>Töömehe leidja</title>
<div class="row">
<div class="header c-6"><?php echo $appName;?></div>
<div class="header c-6">
<div style="float:right; display: flex; justifiy-content: center; align-items: center; margin-left: 1em;">
<form style= "font-size: 0.5em; margin: 0;">
<input type="text" name="search" placeholder="Otsi...">
<input type="submit" class="button" style=""  value="Otsi">
</form>
<a class="button" href="login.php">Logi sisse</a>
</div>
</div>

<div class="row">

<div class="c-3" style="border: 2px solid gray; border-top: 0; border-left: 0; margin-bottom: 0; background: white;">
<h3 style="margin-top: 0; margin-bottom: 0;">Sorteeri</h3>
<form>
<!--<h6>Linnaosa</h6>
<input type="text" placeholder="Kesklinn" style="width: 100%;" name="district">-->
<p>
<h6>Linnaosa</h6>
<select style="width: 100%;" name="district">
  <?php 
	if ($districts->num_rows > 0) {
		while($row = $districts->fetch_assoc()) {
			echo "<option value='".$row["id"]."'>".$row["name"]."</option>";
	}
	}
	$conn->close()
  ?>
</select>
</p>
<h6>Oskused</h6>
<?php
	if ($skills->num_rows > 0) {
		while($row = $skills->fetch_assoc()) {
			echo "<input type='checkbox' name='skill[]' value='".$row["id"]."'>".$row["skill"]."<br>";	
			//echo "<input type='checkbox' name='".$row["id"]."' value='y'>".$row["skill"]."<br>";	
		}	
	}
?>
<!--
<input type="checkbox" name="builder" value="yes"> Ehitaja <br>
<input type="checkbox" name="pipe" value="yes"> Torumees <br>
<input type="checkbox" name="electrician" value="yes"> Elektrik <br>
-->
<h6>Populaarsus</h6>
<input type="radio" name="popularity" value="3">Vähetuntud
<input type="radio" name="popularity" value="5">Keskmine
<input type="radio" name="popularity" value="7">Populaarne
<input type="submit" class="button" style="width: 100%; margin-top:10px; margin-bottom: 0;" value="Sorteeri">
</form>
</div>

<div class="c-7">

</div>

<?php require "footer.php"; ?>
