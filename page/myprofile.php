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

if(isset($_FILES["fileToUpload"]) && !empty($_FILES["fileToUpload"]['name'])){
	$target_dir = "../profilepics/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["fileToUpload"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			//echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}
	// Check if file already exists
	if (file_exists($target_file)) {
		echo "File already exists. ";
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

			echo "Your profile picture has been updated!";

			//echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";


			// save file name to DB here
			updatePicUrl($_SESSION['userName'], (basename($_FILES["fileToUpload"]["name"])));

		} else {
			echo "Sorry, there was an error updating your file.";
		}
	}
}
?>

<?php require("../header.php"); ?>

<html>
<body background="http://wallpapercave.com/wp/ZzQWCHl.jpg">
</body>
</html>

<h1>Your profile</h1>

<html>
<body>
<p>
<img style="height: 140px; width: auto; " src="../profilepics/<?php getProfileURL(); ?>" class="img-circle">

<form method="post" enctype="multipart/form-data">
	<h3>Change your profile picture:</h3>
	<input type="file" name="fileToUpload">
	<br>
	<button type="submit" class="btn btn-success btn-xs">Upload</button>

</form>

<h4>Username: <?=$_SESSION["userName"];?></h4>
<h4>Age: <?=$_SESSION["userAge"]?></h4>
<h4>E-mail: <?=$_SESSION["userEmail"]?></h4>

<?php

//<input name="signupPassword" type="password" >
//<input type="submit" value="Save">
?>
 
<?php 
$_SESSION['error'] = "";
$_SESSION['form_data'] = "";
?>

<br>
<input class = "btn btn-sm btn-success" value="Back to calendar" onclick="location='calendar.php'" />
<br><br>
<a href="?logout=2" class="btn btn-warning btn-sm" role="button">Log out</a>

</p>

<?php require("../footer.php"); ?>