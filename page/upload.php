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
	
	$search ="";
	
	if (isset($_GET["searchPost"]) && !empty($_GET["searchPost"])){
		
		//header("Location: data.php?search=".$_GET["searchPost"]);
		//echo "test";
		$search= $_GET["searchPost"];
		
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
	
	if (isset($_FILES["fileToUpload"])) {
		
		if (empty($$_FILES["fileToUpload"])) {
		
			header("Location: upload.php?empty");
		
		}
		
	}
	
	if (isset($_POST["caption"])) {
		if (!empty($_POST["caption"])) {
			if (strlen($_POST["caption"])<3 ||
				strlen($_POST["caption"])>30) {
					header("Location: upload.php?short");
			}
		}	
	}
	
	if	(isset($_GET["empty"])) {
				 $uploadError="
						<br><div class='alert alert-danger' style='text-align: center'>
						<strong>
						 <span  class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'> </span>
						Tühjasi väljasi ei tohi olla!</strong>
						</div>";	 
	}
	
	if	(isset($_GET["short"])) {
				 $uploadError="
						<br><div class='alert alert-danger' style='text-align: center'>
						<strong>
						 <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'> </span>
						Pealkiri peab olema vähemalt 3 tähemärki pikk!</strong>
						</div>";
	}
	
	if	(isset($_GET["success"])) {
				 $uploadError="
						<br><div class='alert alert-success' style='text-align: center'>
						
						<span class='glyphicon glyphicon-ok' aria-hidden='true'> </span>
						Sinu postitus laeti üles! <strong><a style='color:green; font-size:150%' href='data.php'>Trehva üle</a>    <span class='glyphicon glyphicon-sunglasses' aria-hidden='true'></span></strong>
						</div>";	 
	}
	
	$imgurl="";
	
	if	(
		isset($_POST["caption"]) &&
		isset($_FILES["fileToUpload"]) && 
		!empty($_FILES["fileToUpload"]["name"]) &&
		(strlen($_POST["caption"])>3))
		{
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
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>

<div class="container">
	<div class="col-lg-4">
	<div class="page-header">
		<h1>Loo uus postitus</h1>
	</div>
	<form class="form" method=post enctype="multipart/form-data">
	  <div class="form-group">
		<label>Postituse pealkiri</label>
		<input type="text" name="caption" id="caption" class="form-control" placeholder="Sisesta pealkiri" /required>
	  </div>
	  <a data-toggle="tooltip" title="Pilt peab olema .bmp, .gif, .png, .jpg või .jpeg formaadis ning maksimaalselt 5mb.">Lisainfo</a>
	  <div class="form-group">
	  <br>
		<label for="exampleInputFile">Pildifail</label>
			<input type="file" name="fileToUpload"  id="fileToUpload">
		<p class="help-block">
		
		</p>
	  </div>
	  <button type="submit" name="submit" class="btn btn-default btn-block">Lae üles</button>
	</form>
	
		<?php echo $uploadError; ?>
	</div>


</div>

<?php require("../footer.php"); ?>