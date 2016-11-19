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
	
	if (isset($_GET["exists"])) {
		
		$uploadError="
					<br><div class='alert alert-danger'>
					<strong>
					 <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'> </span>
					File already exists</strong>
					</div>";
		
	}
	
	
	$imgurl="";
	
	if  (isset($_POST["submit"]) or
		isset($_POST["caption"]) or
		isset($_FILES["fileToUpload"])) {
			
		}	if	(empty($_FILES["fileToUpload"]["name"]) or
				empty($_POST["caption"])) {
				 
				 $uploadError="
						<br><div class='alert alert-danger'>
						<strong>
						 <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'> </span>
						Field(s) empty</strong>
						</div>";
				 
		}
	
	
	if	(
		isset($_POST["caption"]) &&
		isset($_FILES["fileToUpload"])&& 
		!empty($_FILES["fileToUpload"]["name"])) {
			
		$caption = $Helper->cleanInput($_POST["caption"]);
		$Upload->uploadPicture($caption,$imgurl);
			
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