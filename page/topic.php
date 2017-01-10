<?php	
	require("../functions.php");
	
	require("../class/Topic.class.php");
	$Topic = new Topic($mysqli);
	
	require("../class/Reply.class.php");
	$Reply = new Reply($mysqli);
	
	require("../class/Helper.class.php");
	$Helper = new Helper($mysqli);
	
	if (!isset($_SESSION["userId"])) { 
	
		header("Location: login.php");
		exit(); 
	}
	
	//print_r($_GET);
	//die("stop");
	
	
	$newReplyError = "";
	//$reply_id = "";
	if (isset ($_GET["id"]) ){ 
		unset($_SESSION["topic_message"]);
	}
	
	if (isset ($_POST["reply"]) ){ 
		if (empty ($_POST["reply"]) ){ 
			$newReplyError = "<font style='color:red;'>Palun täida väli!</font>";
		} else {
			$newReply = $_POST["reply"];
		}
	}
	
	$fileError = "";
	if (isset ($_POST["reply"]) && 
		empty($newReplyError)
		){
			if(empty($_FILES["fileToUpload"]["name"]))
				{
					$Reply->createNew($Helper->cleanInput($_POST["reply"]), $Helper->cleanInput($_GET["id"]), $_SESSION["userName"], $_SESSION["userId"]); 	
				}
			if(isset($_FILES["fileToUpload"]) && !empty($_FILES["fileToUpload"]["name"])){
				
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
						$Reply->createNewWithFile($Helper->cleanInput($_POST["reply"]), $Helper->cleanInput($_GET["id"]), $_SESSION["userName"], $_SESSION["userId"], $target_file);
						
					} else {
						$fileError = "Midagi läks faili üleslaadimisel valesti.";
					}
				}
			} 
	} 
	
	$topicDelMsg = $Topic->checkUserForMsg($_GET["id"]);
	if(isset($_GET["delete"]) && isset($_GET["id"])) {
		
		if($topicDelMsg == "yes") {
			//TEEMA KUSTUTATUD sõnum tuleb nüüd aint õigetele kasutajatele
			$Topic->del($_GET["id"], $_SESSION["userId"]);
			header("Location: data.php");
			exit();
		}
 		
 	}
	
	$reply_msg= "";
	if(isset($_SESSION["reply_message"])){
		$reply_msg = $_SESSION["reply_message"];
		
		//kui ühe näitame siis kustuta ära, et pärast refreshi ei näitaks
		unset($_SESSION["reply_message"]);
	}
	
	$reply_del_msg= "";
	if(isset($_SESSION["reply_del_message"])){
		$reply_msg = $_SESSION["reply_del_message"];
		
		unset($_SESSION["reply_del_message"]);
	}
	
	$replies = $Reply->addToArray($_GET["id"]);
	$topic = $Topic->get($_GET["id"]);
	
	$del_topic = $Topic->checkUser($_GET["id"], $_SESSION["userId"]);
	
	$topicimagesource = "";
	if (!empty ($topic->subject)){
		$topicimagesource = "<br><img src='".$topic->filename."' style= 'max-height: 200px' style= 'max-width: 200px'><br><br>";
	}

?>

<?php require("../header.php")?>
	<div class="topic" style="padding-left:20px; padding-right:1.5%;">
		<div class="col-sm-9 col-md-9"> 
			<h2><a href="data.php" style="text-decoration:none"> < Tagasi </a></h2>
			<p><b> <?=$reply_msg;?></b></p>
			<p><b> <?=$reply_del_msg;?></b></p>
				

			<h1><?php echo $topic->subject;?></h1>
			<p style="border:1px; border-style:solid; border-color:#a6a6a6; padding: 0.5em; background-color: white;">
			<?php echo $topic->content;?> <?php echo $topicimagesource; ?>
			<font color="grey"><em>Teema algataja: <?php echo $topic->username;?></em></font>
			<br>
			<font color="grey"><em>Lisamise kuupäev: <?php echo $topic->created;?></em></font>
			</p>
			<?php echo $del_topic; ?>
			<br><br><br>
			<?php
				$html = "<table class='table'>";
					$html .= "<tr class = 'replies_head'>"; 
						$html .= "<th class='thead-default'>Vastajad</th>";
						$html .= "<th class='thead-default'></th>";
						$html .= "<th class='thead-default'></th>";
						$html .= "<th class='thead-default'></th>";
						$html .= "<th class='thead-default'></th>";
					$html .= "</tr>";

				foreach($replies as $r){
					$html .= "<tr class = 'forum_replies'>";
						$html .= "<td>".$r->content."</td>";
						$html .= "<td><br><img src='".$r->filename."' style= 'max-height: 200px' style= 'max-width: 200px'><br><br></td>";
						$html .= "<td> <font color='grey' size='2'><em>".$r->username." </em></font></td>";
						$html .= "<td> <font color='grey' size='2'><em> Vastus lisatud: ".$r->created."</em></font></td>";
						$html .= "<td>".$change_reply = $Reply->checkUser($_GET["id"], $_SESSION["userId"], $r->id)."</td>";
					$html .= "</tr>";
				} 
					
				$html .= "</table>";
				echo $html;
			?>
		</div>
		<div class="col-sm-3 col-md-3" style="padding-top:4.5%;"> 
			<h2>Vasta teemale</h2>
			<form method="POST" enctype="multipart/form-data">
				<textarea class="form-control" cols="40" rows="5" name="reply" <?=$newReply = ""; if (isset($_POST['reply'])) { $newContent = $_POST['reply'];}?> ><?php echo $newReply; ?></textarea> <?php echo $newReplyError; ?> 
				<br><br>
				<label>Lisa soovi korral pilt:</label>
				<i><input type="file" name="fileToUpload" id="fileToUpload"></i>
				<p><font color="red"><?=$fileError;?></font></p>
				<br>
				<input type="submit" value = "Postita oma vastus" class="btn btn-success btn-sm">
			</form>
		</div>
	</div>
<?php require("../footer.php")?>