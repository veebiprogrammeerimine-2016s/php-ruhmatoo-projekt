<?php 

	require("../functions.php");

	if(!isset ($_SESSION["userId"])) {
		require("../header.php");
		
	} else {
		require("../header1.php");
	}

	if (isset($_GET["logout"])) {
		session_destroy();
		header('Location: '.$_SERVER['PHP_SELF']);
		exit();
		
	}	
	
?>

<!DOCTYPE html>
<html>
<body>
<style>
	.container-fluid {
		font-family: 'Open Sans', sans-serif;
		font-size: 13px;
	}
</style>

<div class="container-fluid">
    <div class="row">
		<div align="center">
			<h2>About us</h2>
			

			This website is built to share images that destress and calm your mind. <br>
			Have a look around. Login to upload.

		</div>
	</div>
</div>
</body>
</html>

<?php require("../footer.php"); ?>