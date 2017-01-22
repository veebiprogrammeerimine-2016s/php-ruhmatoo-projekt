<?php
    require("../functions.php");
    require("../class/Series.class.php");
	
    if(isset ($_GET["logout"])) {

        session_destroy();
        header("Location:login.php");
        exit();
    }

    if(isset($_POST['user_tv_db'])){

        addSeriesToDb($_SESSION['userId'], $_POST['user_tv_db']);
    }
	
?>

<?php require("../header.php"); ?>
<html>
<body background="http://wallpapercave.com/wp/ZzQWCHl.jpg">
</body>
</html>
<br>
<h3>Save some of your TV shows here</h3>
<form method="POST">
	<select name="user_tv_db">
		<?php getSeriesData() ?>
	</select>
    <button type="submit" class="btn btn-success btn-xs">Submit</button>
</form>

<link href="calendar.css" type="text/css" rel="stylesheet" />
<br>

<input class = "btn btn-sm btn-success" value="My profile" onclick="location='myprofile'" />
<br><br>
<a href="?logout=2" class="btn btn-warning btn-sm" role="button">Log out</a>


<?php
include '../class/Calendar.class.php';
 
$calendar = new Calendar();
 
echo $calendar->show();
?>

<?php require("../footer.php"); ?>