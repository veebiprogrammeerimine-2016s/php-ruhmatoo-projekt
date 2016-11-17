<?php 
	//ühendan sessiooniga
	require("../functions.php");

	require("../class/Helper.class.php");
	$Helper = new Helper($mysqli);
	
	require("../class/Upload.class.php");
	$Upload = new Upload($mysqli);
	
	
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
	
	if	(isset($_POST["caption"]) &&
		(isset($_FILES["fileToUpload"]))&& 
		!empty(($_FILES["fileToUpload"]["name"]))) {
			
		
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
<form>
  <div class="form-group">
    <label>Caption</label>
    <input type="text" class="form-control" placeholder="Insert a caption here">
  </div>
  <div class="form-group">
    <label for="exampleInputFile">File input</label>
    <input type="file" id="exampleInputFile">
    <p class="help-block">Lisainfo tuleb siia alla.</p>
  </div>

  <button type="submit" class="btn btn-default">Submit</button>
</form>
</div>
<?php //echo$_SESSION["userEmail"];?>

<?//=$_SESSION["userEmail"];?>




<?php require("../footer.php"); ?>