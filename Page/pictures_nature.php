<?php
	require("../functions.php");

	require("../Class/Helper.Class.php");
	$Helper = new Helper();
	
	require("../Class/User.class.php");
	$User = new User($mysqli);

?>

<?php require("../header.php"); ?>
<br><br><br><br><br><br>
<div class="container-fluid">
<div class="row">
<div align="center">
	<img src="sipelgad.jpg">
  </div>
</div>
<?php require("../footer.php"); ?>