<?php

	require("../functions.php");

	require("../class/Helper.class.php");
$Helper = new Helper();

require("../class/User.class.php");
$User = new User($mysqli);

	//kui ei ole kasutaja id'd
	if (!isset($_SESSION["userId"])){

		//suunan sisselogimise lehele
		header("Location: login.php");
		exit();
	}


?>

<?php require("../header.php"); ?>

<div class="container">


	<div class="col-centered col-md-8">
    <form method="POST" >
    <h2> Give feedback to <?=$_GET["id"];?> </h2>

    <div class="form-group">
  <label for="comment"></label>
  <textarea class="form-control" rows="10" id="comment"></textarea>
    </div>

    <div class="form-group">
    <h3 for="sel1">Leave a rating:</h3>
    <select class="form-control" id="sel1">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>

  <input class="btn btn-sm hidden-xs" type="submit" value="Submit">
  <input class="btn btn-sm btn-block visible-xs-block" type="submit" value="Submit">
</form>
    <h3><a href="youDrivePast.php">Never mind...BACK!!!</a></h3>

  </div>
</div>
<?php require("../footer.php"); ?>
