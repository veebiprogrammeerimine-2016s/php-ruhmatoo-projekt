<?php 
	//ühendan sessiooniga
	//kuradi git ma ütlen!
	require("../functions.php");
	

	require("../class/Helper.class.php");
	$Helper = new Helper($mysqli);
	
	require("../class/User.class.php");
	$User = new User($mysqli);
	
	require("../class/Rating.class.php");
	$Rating = new Rating($mysqli);
	
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
		<h1>Kasutaja kasutajanimi viimati <a href="user.php?username=<?php echo $_GET["username"]; ?>&postitas">postitas</a>/<a href="user.php?username=<?php echo $_GET["username"]; ?>&laikis">laikis</a></h1>
	</div>
	<p class="lead">
	
	<?php 
	
	
	
    $html="";
	
	
	
	
	if (isset($_GET["postitas"])){
		
		foreach ($andmed as $a) {
			
			$html .= "<div style='padding-bottom:5px';><br><table>";
				$html .= '<tr><span class="caption">'.$a->caption.'</tr>';
				$html .= '<td><a href="topic.php?topicid='.$a->id.'&posted"><img src='.$a->imgurl.' ></a></td>';
			$html .= "</table></div><br><br><hr>";
			
						
		
		}
		
	}
		
	
	$userid = $_GET["username"];
	$rated_pictures = $Rating->ratedPictures($userid);	
	
	if (isset($_GET["laikis"])){
		
		foreach	($rated_pictures as $asd) {

			$html .= "<div style='padding-bottom:5px';><br><table>";
				$html .= '<tr><span class="caption">'.$asd->caption.'</tr>';
				$html .= '<td><a href="topic.php?topicid='.$asd->pic_id.'&posted"><img src='.$asd->imgurl.' ></a></td>';
			$html .= "</table></div><br><br><hr>";

		}
		
	}
	
	


	echo $html;
	?> 
	
	
	
	
	
	
	
	</p>
	
	

</div>
<?php //echo$_SESSION["userEmail"];?>

<?//=$_SESSION["userEmail"];?>




<?php require("../footer.php")?>