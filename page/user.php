<?php 
	//ühendan sessiooniga
	//kuradi git ma ütlen!
	require("../functions.php");

	require("../class/Helper.class.php");
	$Helper = new Helper($mysqli);
	
	require("../class/User.class.php");
	$User = new User($mysqli);
	
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
	
	$search ="";
	
	if (isset($_GET["searchPost"]) && !empty($_GET["searchPost"])){
		
		//header("Location: data.php?search=".$_GET["searchPost"]);
		//echo "test";
		$search= $_GET["searchPost"];
		
	}
	
	$userid = $_GET["id"];
	$andmed = $User->getUserData($userid);
	
	//pre echob koodina
	//echo "<pre>";
	//var_dump($people);
	//echo "</pre>";
	
?>
<?php require("../header.php"); ?>
<div class="container">
	<div class="page-header">
		<h1>Kasutaja leht</h1>
	</div>
	<p class="lead">
	
	<?php 
	$html = "<div class='row'><div class='col-sm-4 col-md-3'><table class='table table-striped table-condensed'>";
	
	foreach ($andmed as $a) {
			
			
			
		
			$html .= "<tr>";
				$html .= "<td>".$a->id."</td>";
				$html .= "<td>".$a->caption."</td>";

			$html .= "</tr>";
		
		}
		
		
		
	$html .= "</table></div></div>";
	
	echo $html;
	?> 
	
	
	
	
	
	
	
	</p>
	
	

</div>
<?php //echo$_SESSION["userEmail"];?>

<?//=$_SESSION["userEmail"];?>




<?php require("../footer.php"); ?>