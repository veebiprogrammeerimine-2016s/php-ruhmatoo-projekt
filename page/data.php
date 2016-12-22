<?php

	require("../functions.php");

	//kui ei ole kasutaja id'd
	if(!isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: login.php");
		exit();
		
	}



	if(isset($_GET["logout"])){
		
		session_destroy();
		header("Location:login.php");
		exit();
		
	}

	
	if(isset($_POST["contactemail"]) && isset($_POST["description"]) && isset($_POST["price"]) &&
		!empty($_POST["contactemail"]) && !empty($_POST["description"]) && !empty($_POST["price"])
		) {
		
		$Sneakers->savesneaker($Helper->cleanInput($_POST["contactemail"]), $Helper->cleanInput($_POST["description"]), $Helper->cleanInput($_POST["price"]));
		
		
	}
	
	if(isset($_GET["sort"]) && isset($_GET["direction"])){
		$sort=$_GET["sort"];
		$direction=$_GET["direction"];
		
	}else{
		$sort="contactemail";
		$direction="ascending";
	}
	
	if(isset($_GET["q"])){
		
		$q = $Helper->cleanInput($_GET["q"]);
		
		$sneakerdata=$Sneakers->getallsneakers($q, $sort, $direction);
		
	}else{
		
		$q="";
		$sneakerdata=$Sneakers->getallsneakers($q, $sort, $direction);

	}
		
	
?>


<?php
// --- UPLOAD PHP ---

if(isset($_FILES["fileToUpload"]) && !empty($_FILES["fileToUpload"]["name"])) {
	
	$target_dir = "uploads/";
	$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
	
	if(isset($_POST["submitUpload"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			echo "Files is an image - ".$check["mime"].".";
			$uploadOk = 1;
			
		} else {
			echo "File is not an image.";
			$upload = 0;
		}
	}
	
	if(file_exists($target_file)) {
		echo "Selline fail on juba olemas";
		$uploadOk = 0;
	}
	
	if($imageFileType != "jpg" &&
		$imageFileType != "png" &&
		$imageFileType != "jpeg" &&
		$imageFileType != "gif") {
			echo "Ainult .jpg, .jpeg, .png ja .gif formaadid on lubatud";
			$uploadOk = 0;
		}
	
	if($uploadOk == 0) {
		echo "Faili ei ole üles laetud.";
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			echo "Pilt nimega ".basename($_FILES["fileToUpload"]["name"])." on üles laetud.";
			
			
			
		} else {
			echo "Üleslaadimisel ilmnes tõrge.";
		}
	}
	
} else {
	echo "Vali pilt, mida soovid  üles laadida.";
}



?>




<?php require("../header.php"); ?>
<div class="container">
	<h1>
		Welcome<a href="user.php"> <?=$_SESSION["userEmail"];?></a>!
	</h1>
	<p>
		<a href="profile.php">Minu profiil</a>
		<br><a href="?logout=1">Logi valja</a>

	</p>

	

<!--KUULUTUSE ÜLESLAADIMISVORM-->
	
	<h2>Sell Sneakers</h2>

		<form method="POST">

			<label><b>Create a post</b></label><br><br>
		
			<label>Description</label><br>
			<textarea rows="2" cols="40" name="description" type="text" maxlength="50" placeholder="ex. Air Jordan X Retro 'OVO', size 43"></textarea><br><br>
			
			<label>Price ($)</label><br>
			<input name="price" type="integer" placeholder="ex. 490"><br><br>
			
			<label>Contact E-Mail</label><br>
			<input name="contactemail" type="text" value="<?=$_SESSION["userEmail"];?>">
			
			<br><br>
			<input type="submit" value="Save & Post">

		</form>


<!--UPLOAD VORM-->

		<form action="data.php" method="post" enctype="multipart/form-data">
			Uploadi pilt:
			<input type="file" name="fileToUpload" id="fileToUpload">
			<input type="submit" value="Upload Image" name="submitUpload">
		</form>
			
			
	<h2>Market</h2>
	<form>
		<input type="search" name="q" value="<?=$q;?>">
		<input type="submit" value="Search"><br><br>
	</form>


	<?php

		$direction="ascending";
		if(isset($_GET["direction"])){
			if($_GET["direction"] == "ascending"){
				$direction = "descending";
			}
		}

		$html = "<table class='table table-striped table-bordered'>";
		
		$html .= "<tr>";
			$html .= "<th><a href='?q=".$q."&sort=contactemail&direction=".$direction."'>Contact E-Mail</a></th>";
			$html .= "<th><a href='?q=".$q."&sort=description&direction=".$direction."'>Description</a></th>";
			$html .= "<th><a href='?q=".$q."&sort=price&direction=".$direction."'>Price ($)</a></th>";
		$html .= "</tr>";
		
		foreach($sneakerdata as $c) {
			
			$html .= "<tr>";
				$html .= "<td>".$c->contactemail."</td>";
				$html .= "<td>".$c->description."</td>";
				$html .= "<td>".$c->price."</td>";
				//$html .= "<td><a href='edit.php?contactemail=".$c->contactemail."'>edit.php</a></td>";
			$html .= "</tr>";
			
		}

		$html .= "</table>";

		echo $html;


	?>
</div>

<?php require("../footer.php"); ?>