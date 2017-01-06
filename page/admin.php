<?php 
	//ühendan sessiooniga
	//kuradi git ma ütlen!
	require("../functions.php");

	require("../class/Helper.class.php");
	$Helper = new Helper($mysqli);
	
	require("../class/User.class.php");
	$User = new User($mysqli);
	require("../class/Post.class.php");
	$Post = new Post($mysqli);
	
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
	
	if ($_SESSION["userId"] != 1 xor
		$_SESSION["userId"] != 64 xor
		$_SESSION["userId"] != 68) {
		
		session_destroy();
		
		header("Location: ../index.php");
		exit();
		
	}
	
	$search ="";
	
	if (isset($_GET["searchPost"]) && !empty($_GET["searchPost"])){
		
		//header("Location: data.php?search=".$_GET["searchPost"]);
		//echo "test";
		$search= $_GET["searchPost"];
		
	}
	
	if (isset($_POST["deletePostId"])){
		$Post->deletePost($_POST["deletePostId"]);
	}
	$Teavitus="";
	if (isset($_GET["success"])){
		$Teavitus="kustutatud";
	}
	if (isset($_GET["failed"])){
		$Teavitus="ebaõnnestus";
	}

	
	//pre echob koodina
	//echo "<pre>";
	//var_dump($people);
	//echo "</pre>";
	
?>
<?php require("../header.php"); ?>
<div class="container">
	<div class="page-header">
		<h1>Keda täna bännime?</h1>
	</div>
	<p class="lead">
	
	Siin saab postitusi kustutada ja muud jama teha
	
	<form method="POST">
		  <div class="form-group">
			<label>postituse id</label>
			<input type="text" class="form-control input-sm" name="deletePostId" placeholder="sisesta postituse id"  /required>
			<p class="help-block"></p>
		  </div>
		  <button type="submit" class="btn btn-default">kustuta</button>
		</form>
		
		<h1><?php echo $Teavitus;?></h1>
	</p>
	
	

</div>
<?php //echo$_SESSION["userEmail"];?>

<?//=$_SESSION["userEmail"];?>




<?php require("../footer.php"); ?>