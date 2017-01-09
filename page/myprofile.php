<?php 
    //session_start();
	require("../functions.php");
	require("../class/User.class.php");
	require("../class/Picture.class.php");

    // $current_user = $_SESSION['user_username'];
    // $user_username = mysqli_real_escape_string($database,$_REQUEST['user_username']);
    // $profile_username=$rws['user_username'];

	/*MUUTUJAD*/
	$fileToUpload = "";

	//kui ei ole kasutaja id'd
	if (!isset($_SESSION["userId"])) {

		//suunan sisselogimise lehele
		header("Location: login.php");
		exit();

	}

	//kui on ?logout aadressi real siis login välja
	if(isset ($_GET["logout"])) {

		session_destroy();
		header("Location:login.php");
		exit();
	}

	if(isset($_POST["fileToUpload"]) &&
		!empty($_POST["fileToUpload"])) {
		echo "blah";
		updatePicUrl(basename($_FILES["fileToUpload"]["name"]), $_SESSION['userName']);
	}
?>

<?php require("../header.php"); ?>

<h1>Your profile</h1>
<html>
<body>
<p>
<img style="height: 200px; width: auto; " src="../profilepics/<?php getProfileURL(); ?>">

<form method="post" enctype="multipart/form-data">
	<h3>Change your profile picture:</h3>
	<input type="file" name="fileToUpload">
	<button type="submit" name="submit">Upload</button>
</form>
<h3>Username: <?=$_SESSION["userName"];?></h3>
<h3>Age: <?=$_SESSION["userAge"]?></h3>
<h3>E-mail: <?=$_SESSION["userEmail"]?></h3>

<?php

//<input name="signupPassword" type="password" >
//<input type="submit" value="Save">
?>

</html>   
 
<?php 
$_SESSION['error'] = "";
$_SESSION['form_data'] = "";
?>

<br>
<input type="button" value="Back to calendar" onclick="location='calendar.php'" />
<br><br>
<a href="?logout=1"> Log out</a>
</p>

<?php require("../footer.php"); ?>