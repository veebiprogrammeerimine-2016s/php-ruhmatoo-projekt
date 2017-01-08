<?php

require("../functions.php");

//kui ei ole kasutaja id'd suunan sisselogimise lehele
	if(!isset($_SESSION["userId"])) {
		header("Location: login.php");
		exit();
	}

//logout
	if(isset($_GET["logout"])) {
		session_destroy();
		header("Location: sneakermarket.php");
		exit();
	}


/**** KUI KASUTAJA VAJUTAB "LOO UUS KUULUTUS" NUPPU ****/
	if(isset($_POST["newpost"])) {
		
		/* luuakse uus kirje andmebaasi sm_posts*/
		$Sneakers->createNewPost();
		
		/* võtab viimati kasutaja poolt loodud kuulutuse id andmebaasist*/
		$newPostData = $Sneakers->getNewPostId();
		$newPostId = $newPostData->id;
		
		/* suunab kuulutuse loomise lehele koos id'ga, mis vastab kasutaja poolt viimati loodud andmebaasikirjega */
		header("Location: createpost.php?id=".$newPostId);
		exit();
	}


$newPostBtn = "";
$modifyPostBtn = "disabled";


/* muutujad postcounti jaoks */
$pc = $Sneakers->ifUserHasCreatedPost();
$upc = $pc->postcheck;


/* ajutised echo'd kontrollimiseks */
//echo "userId: ".$_SESSION["userId"]."<br>";
//echo "User postcheck: ".$upc."<br>";


/* kui kasutaja pole loonud ühtegi kuulutust, siis on getNewPostId funktsiooni StdClass tühi, mis lööb erroreid, selleks oli vaja postcounti kontrollida */
/* samuti määrata ära tingimus, mis aktiveerib/desaktiveerib uue kuulutuse loomise nupu või vana kuulutuse jätkamise */
	if($upc == 0) {
		$newPostData = "";
	} else {
		$newPostData = $Sneakers->getNewPostId();
		$newPostStatus = $newPostData->status;
		$newPostId = $newPostData->id;
		
		if($newPostStatus == 0) {
		$newPostBtn = "disabled";
		$modifyPostBtn = "";
		} else {
			$newPostBtn = "";
			$modifyPostBtn = "disabled";
		}
	}






/*
	if($newPostStatus == 0) {
		$newPostBtn = "disabled";
		$modifyPostBtn = "";
	} else {
		$newPostBtn = "";
		$modifyPostBtn = "disabled";
	}
*/






require("../header.php"); 
?>



<div class="container">
	
	
<!-- **** KUULUTUSTE LEHE ALAMMENÜÜ **** -->
	
		<ul class="nav nav-tabs">
			<li role="presentation" class="active"><a href="">Uus kuulutus</a></li>
			<li role="presentation"><a href="myposts.php">Minu kuulutused</a></li>
		</ul>
	
	
	<div class="col-md-6 col-md-offset-3">
		<div>
			<h3></h3>
		</div>
	
	
		<div>
			<form method="POST">
				<fieldset <?php echo $newPostBtn; ?>>
					<label class="btn btn-success btn-lg btn-block">
						Loo uus kuulutus<input type="submit" name="newpost" value="true" style="display: none;">
					</label>
				</fieldset>
			</form>
			<div>
				<h3></h3>
			</div>
			
			<fieldset <?php echo $modifyPostBtn; ?>>
				<a href="createpost.php?id=<?php echo $newPostId; ?>" class="btn btn-warning btn-lg btn-block" role="button">Jätka oma kuulutuse loomist</a>
			</fieldset>
			
			<div>
				<h3></h3>
			</div>
			<a href="myposts.php" class="btn btn-default btn-lg btn-block" role="button">Vaata oma loodud kuulutusi</a>
		</div>
	</div>

</div>
	
	



	


	



<?php require("../footer.php"); ?>