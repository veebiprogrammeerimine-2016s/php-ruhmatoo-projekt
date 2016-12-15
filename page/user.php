<?php 
	//�hendan sessiooniga
	//kuradi git ma �tlen!
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
	$username = $_GET["username"];
	$andmed = $User->getUserData($username);
	$search ="";
	
	if (isset($_GET["searchPost"]) && !empty($_GET["searchPost"])){
		
		//header("Location: data.php?search=".$_GET["searchPost"]);
		//echo "test";
		$search= $_GET["searchPost"];
		
	}
	


	
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
	$html = "<div class='c'><div class='col-sm-4 col-md-3'><table class='table table-striped table-condensed'>";
	
	foreach ($andmed as $a) {
			
			
			
		
			$html .= "<tbody>";
			
				$html .= "<th>".$a->caption."</th>";
				$html .= '<td><a href=topic.php?topicid='.$a->id.'><img src="'.$a->imgurl.'" alt="some_text" style="width:200px;height:200px;"></a> </td>';
			
			$html .= "</tbody>";
		
		}
		
		
		
	$html .= "</table></div></div>";
	
	echo $html;
	?> 
	
	
	
	
	
	
	
	</p>
	
	

</div>
<?php //echo$_SESSION["userEmail"];?>

<?//=$_SESSION["userEmail"];?>




<?php require("../footer.php"); ?>