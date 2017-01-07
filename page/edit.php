<?php
	require("../functions.php");
	
	require("../class/Reply.class.php");
	$Reply = new Reply($mysqli);
	
	require("../class/Helper.class.php");
	$Helper = new Helper($mysqli);
	
	$topic_id= $_GET["topic"];
	//echo $topic_id;
	$reply_id= $_GET["topic"];
	
	//Tegin, et teised kasutajad, kes ei oma muutmise õigust ei saaks urlile õigeid ID'si sisestades sinna lehele
	$access = $Reply->checkAccess($_GET["topic"], $_GET["reply"], $_SESSION["userId"]);
	//echo $access;
	if ($access == "no"){
		header("Location: data.php");
	}
	
	//kunagi võiks ka teha ifDel, kui kasutajad postitusi nt taastama tahavad hakata
	
	$reply = $Reply->find($_GET["topic"], $_GET["reply"], $_SESSION["userId"]);
	
	$fileError = "";
	//kas kasutaja uuendab andmeid
	if(isset($_POST["update"])){
		if(empty($_FILES["fileToUpload"]["name"])){
			//echo $_POST["new_reply"];
			$Reply->update($Helper->cleanInput($_POST["new_reply"]), $_GET["reply"]);
			$Reply->updateTime($_GET["reply"]);
			$reply = $_POST["new_reply"];
			$reply = $Reply->find($_GET["topic"], $_GET["reply"], $_SESSION["userId"]);
		} 
		
		if(isset($_FILES["fileToUpload"]) && !empty($_FILES["fileToUpload"]["name"])) {
			if ($fileError == ""){
			$target_dir = "../uploads/";
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				
				// Check if image file is a actual image or fake image
				if(isset($_POST["submit"])) {
					
					$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
					if($check !== false) {
						//echo "File is an image - " . $check["mime"] . ".";
						$uploadOk = 1;
					} else {
						$fileError = "Tegemist pole pildiga.";
						$uploadOk = 0;
					}
				}
				// Check if file already exists
				if (file_exists($target_file)) {
					$fileError = "Kahjuks sellise nimega pilt juba eksisteerib.";
					$uploadOk = 0;
				}
				// Check file size
				if ($_FILES["fileToUpload"]["size"] > 500000) {
					$fileError = "Sinu pilt on liiga suur!";
					$uploadOk = 0;
				}
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif" ) {
					$fileError = "Ainult JPG, JPEG, PNG & GIF failid on lubatud!";
					$uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
					//$fileError = "Kahjuks sinu pilti ei saanud üles laadida.";
				// if everything is ok, try to upload file
				} else {
					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
						//echo "Sinu pilt ". basename( $_FILES["fileToUpload"]["name"]). " on üles laetud!";
						
						// save file name to DB here	
						$Reply->updateWithFile($Helper->cleanInput($_POST["new_reply"]), $_GET["reply"], $target_file);
						$Reply->updateTime($_GET["reply"]);
						$reply = $_POST["new_reply"];
						$reply = $Reply->find($_GET["topic"], $_GET["reply"], $_SESSION["userId"]);
						
					} else {
						$fileError = "Midagi läks faili üleslaadimisel valesti.";
					}
				}
			} 
		} 	
	}
	
	$deltopic = $_GET["topic"];
	$delreply = $_GET["reply"];
	$nofile = "no.jpg";

	if(isset($_GET["deletepic"]) && isset($_GET["topic"]) && isset($_GET["reply"])) {
		
 		$Reply->delPic($_GET["topic"], $_GET["reply"], $nofile);
		
 	}
	
	$topic_id = $_GET["topic"];
	if(isset($_POST["delete"])){
		$Reply->del($_GET["topic"], $_GET["reply"]);
		header("Location: topic.php?id=$topic_id.php");
 		//exit();
	}
	
	$reply_change_msg= "";
	if(isset($_SESSION["reply_change_message"])){
		$reply_change_msg = $_SESSION["reply_change_message"];
		
		//kui ühe näitame siis kustuta ära, et pärast refreshi ei näitaks
		unset($_SESSION["reply_change_message"]);
	}
	
?>
<?php require("../header.php")?>
<?php require("../CSS.php")?>

<div class="edit" style="padding-left:20px;">
	<div class="col-sm-4 col-md-4"> 
		<h2><a href="topic.php?id=<?php echo $topic_id;?>" style="text-decoration:none"> < Tagasi </a></h2>
		<p><b><?=$reply_change_msg;?></b></p>
		<h1>Muuda või kustuta oma vastus</h1>
		<form method="post" enctype="multipart/form-data" >
			<input type="hidden" name="id" value="<?=$_GET["id"];?>" > 
			<label for="sisu" >Sinu vastus</label><br>
			<textarea class="form-control" id="new_reply" cols="40" rows="5" name="new_reply"><?php echo $reply->content;?></textarea><br><br>
			
			<label>Lisa soovi korral uus pilt:</label>
			<i><input type="file" name="fileToUpload" id="fileToUpload"></i>
			<p><font color="red"><?=$fileError;?></font></p>
			<!--<a href='edit.php?topic=<?php echo $deltopic; ?>&reply=<?php echo $delreply; ?>&deletepic=true'><font color='#cc0000' size='2'> Või kustuta praegune pilt</font></a>-->
			<br><br><br>
			
			<input type="submit" type="button" class="btn btn-success btn-sm" name="update" value="Salvesta muudatus">
			<br><br>
			<div class="inner-addon left-addon">
				<span class='glyphicon glyphicon-trash'></span>
				<input type="submit" type="button" class="btn btn-default btn-xs" style="color:#cc0000;" name="delete" value="Kustuta vastus">
			</div>
		  </form>
	</div>
</div>

<?php require("../footer.php")?>