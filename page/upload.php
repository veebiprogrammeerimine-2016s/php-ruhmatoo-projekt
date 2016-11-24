<?php 
	//ühendan sessiooniga
	require("../functions.php");

	require("../class/Helper.class.php");
	$Helper = new Helper($mysqli);
	
	require("../class/Upload.class.php");
	$Upload = new Upload($mysqli);
	
	$uploadError="";
	
	//kui ei ole sisseloginud, suunan login lehele
	if (!isset($_SESSION["userId"])) {
		header("Location: index.php");
		exit();
	}
	
	//kas aadressireal on logout
	if (isset($_GET["logout"])) {
		
		session_destroy();
		
		header("Location: ../index.php");
		exit();
		
	}
	
	if (isset($_GET["large"])) {
		
		$uploadError="
					<br><div class='alert alert-danger'>
					<strong>
					 <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'> </span>
					Error: File too large (maximum 500kb)</strong>
					</div>";
		
	}
	
	$caption="";
	
	if (isset($_POST["caption"])) {
		
		if (empty($_POST["caption"])) {
		
			header("Location: upload.php?empty");
		
		}
		
	}
	
	if (isset($_POST["fileToUpload"])) {
		
		if (empty($_POST["fileToUpload"])) {
		
			header("Location: upload.php?empty");
		
		}
		
	}
	
	if (isset($_POST["caption"])) {
		
		if (!empty($_POST["caption"])) {
		
			if (strlen($_POST["caption"])<3) {
			
					header("Location: upload.php?short");
			
			}
		
		}
		
	}
	
	if	(isset($_GET["empty"])) {
				 
				 $uploadError="
						<br><div class='alert alert-danger'>
						<strong>
						 <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'> </span>
						Error: Empty field(s)</strong>
						</div>";
				 
	}
	
	if	(isset($_GET["short"])) {
				 
				 $uploadError="
						<br><div class='alert alert-danger'>
						<strong>
						 <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'> </span>
						Error: Caption too short (minimum 4 letters)</strong>
						</div>";
				 
	}
	
	if	(isset($_GET["success"])) {
				 
				 $uploadError="
						<br><div class='alert alert-success'>
						<strong>
						 <span class='glyphicon glyphicon-ok' aria-hidden='true'> </span>
							Your post was submitted! Check it out here: (siia tuleb postituse link)</strong>
						</div>";
				 
	}
	
	$imgurl="";
	
	if	(
		isset($_POST["caption"]) &&
		isset($_FILES["fileToUpload"]) && 
		!empty($_FILES["fileToUpload"]["name"]) &&
		(strlen($_POST["caption"])>3))	{
		$userid=$_SESSION["userId"];
		$caption = $Helper->cleanInput($_POST["caption"]);
		$Upload->uploadPicture($userid,$caption,$imgurl);
			
		}
	
	
	//pre echob koodina
	//echo "<pre>";
	//var_dump($people);
	//echo "</pre>";
	
?>

<?php require("../header.php"); ?>
<br><br>
<div class="container">
<div class="page-header">
	<h1>Loo uus postitus</h1>

<p class="lead">
</p>

</div>
<form method=post enctype="multipart/form-data">
  <div class="form-group">
    <label>Caption</label>
    <input type="text" name="caption" id="caption" class="form-control" placeholder="Insert a caption here">
  </div>
  <div class="form-group">
    <label for="exampleInputFile">File input</label>
    <input type="file" name="fileToUpload"  id="fileToUpload">
    <p class="help-block">Lisainfo tuleb siia alla.</p>
  </div>

  <button type="submit" name="submit" class="btn btn-default">Submit</button>
</form>

<?php echo $uploadError; ?>

</div>
<?php //echo$_SESSION["userEmail"];?>

<?//=$_SESSION["userEmail"];?>




<?php require("../footer.php"); ?>