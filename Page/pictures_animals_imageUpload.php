<?php 
	require("../functions.php");

	if(!isset ($_SESSION["userId"])) {
		header("Location: login.php");
		exit();
		
	}
	
	if (isset($_GET["logout"])) {
		
		session_destroy();
		header("Location: login.php");
		exit();
		
	}
	
	$msg = " ";
	if(isset($_SESSION["message"])) {
		$msg = $_SESSION["message"];
	
	unset($_SESSION["message"]);
	
	}

	if(count($_FILES) > 0) {
		
		if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
			
			mysql_connect("localhost", "if16", "ifikad16");
			mysql_select_db ("if16_gerltoom");
			$imgData =addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
			$imageProperties = getimageSize($_FILES['userImage']['tmp_name']);
			$sql = "INSERT INTO pictures_animals_output_images(imageType ,imageData)
			VALUES('{$imageProperties['mime']}', '{$imgData}')";
			$current_id = mysql_query($sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysql_error());
			
			if(isset($current_id)) {
				
				header("Location: pictures_animals_listImages.php");
			}
		}
	}
?>

<?php require("../header1.php"); ?>

<!DOCTYPE html>
<html>
<style>
	.container-fluid {
		font-family: 'Open Sans', sans-serif;
		font-size: 13px;
	}
</style>

<body>
<div class="container-fluid">
    <div class="row">
		<div align="center">
			<form name="frmImage" enctype="multipart/form-data" action="" method="post" class="frmImageUpload">
			<br>
			<label>Upload Animal Image File:</label><br/>
			<input name="userImage" type="file" class="inputFile" />
			<input type="submit" value="Submit" class="btnSubmit" />
			</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>

<?php require("../footer.php"); ?>