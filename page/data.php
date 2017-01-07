<?php
	//kui midagi ei tööta, kommenteeri headerid välja!!! Siis kui viga siis näitab, muidu lihtsalt suunab
	
	require("../functions.php");
	
	require("../class/Topic.class.php");
	$Topic = new Topic($mysqli);
	
	require("../class/Helper.class.php");
	$Helper = new Helper($mysqli);
	
	$newHeadlineError = "";
	$newContentError = "";
	
	$category = "general";
	
	$newHeadline = "";	
	
	$sort = "created";
	$order = "DESC";
	
	//kas on sisse loginud, kui ei ole, siis suunata login lehele
	
	if (!isset($_SESSION["userId"])) { //kui ei ole session userId, suuna login lehele 
	//ehk data.php sisestades ribale, pole sisse logind, suunadb login.php lehele
		
		header("Location:login.php");
		exit(); // If you don't put exit() after your header('Location: ...') your script may continue resulting in unexpected behaviour. This may for example result in content being disclosed that you actually wanted to prevent with the redirect.
	}
	
	//kas ?logout on aadressireal
	if (isset($_GET["logout"])) {
		
		session_destroy();
		header("Location:login.php");
		exit();
	}
	
	if (isset ($_POST["headline"]) ){ 
		if (empty ($_POST["headline"]) ){ 
			$newHeadlineError = "<font style='color:red;'>See väli on kohustuslik!</font>";
		} else {
			$newHeadline = $_POST["headline"];
		}
	}
	
	if (isset ($_POST["content"]) ){ 
		if (empty ($_POST["content"]) ){ 
			$newContentError = "<font style='color:red;'>See väli on kohustuslik!</font>";
		} else {
			$newContent = $_POST["content"];
		}
	}
	
	if (isset ($_POST["category"]) ){ 
			$category = $_POST["category"];
	}
	
	$topic_msg = "";
	if(isset($_SESSION["topic_message"])){
		$topic_msg = $_SESSION["topic_message"];
		
		//kui ühe näitame siis kustuta ära, et pärast refreshi ei näitaks
		unset($_SESSION["topic_message"]);
	}
	
	$topic_del_msg= "";
	if(isset($_SESSION["topic_del_message"])){
		$topic_del_msg = $_SESSION["topic_del_message"];
		
		unset($_SESSION["topic_del_message"]);
	}
	
	$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

	/*if($pageWasRefreshed ) {
		$topic_msg = "";
	} else {
		//do nothing;
	}*/
	
	$fileError = "";
	if (isset ($_POST["headline"]) && 
		isset ($_POST["content"]) && 
		/*!empty ($_POST["headline"]) && 
		!empty ($_POST["content"])*/
		empty($newHeadlineError)&&
		empty($newContentError)
		){
			if(empty($_FILES["fileToUpload"]["name"]))
				{
					$Topic->createNew ($Helper->cleanInput($_POST["headline"]), $Helper->cleanInput($_POST["content"]), $_SESSION["userName"], $_SESSION["userId"], $category);
					header("Location:data.php");
					exit();
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
						$Topic->addTopicAndFile ($Helper->cleanInput($_POST["headline"]), $Helper->cleanInput($_POST["content"]), $_SESSION["userName"], $_SESSION["userId"], $category, $target_file);
						header("Location:data.php");
						exit();
						
					} else {
						$fileError = "Midagi läks faili üleslaadimisel valesti.";
					}
				}
			} /*else{
				echo "Please select the file that you want to upload!";
			}*/
	} 
	
	//kas keegi otsib
	if(isset($_GET["q"])){
		//Kui otsib, võtame otsisõna aadressirealt
		$q = $_GET["q"];
		//otsisõna funktsiooni sisse
	} else {
		//otsisõna tühi
		$q = "";
	}
	
	if(isset($_GET["sort"]) && isset($_GET["order"])) {
		$sort = $_GET["sort"];
		$order = $_GET["order"];
	}
	
	$generalTopics = $Topic->addToGeneralArray($q, $sort, $order);
	$partnerTopics = $Topic->addToPartnerArray($q, $sort, $order);
	
	$sort_name = "";
	if(!isset($_GET["sort"])){
		$sort_name = "teema lisamise kuupäeva";
	} else {
		if($_GET["sort"] == "topic"){
			$sort_name = "teema";
		}
		if($_GET["sort"] == "username"){
			$sort_name = "kasutaja";
		}
		if($_GET["sort"] == "created"){
			$sort_name = "teema lisamise kuupäeva";
		}
	}
	
?>

<?php require("../header.php")?>
<?php require("../CSS.php")?>
<div class="data" style="padding-left:20px;padding-right:20px">
		<p align="center"><b>
			Tere tulemast <?=$_SESSION["firstName"];?> <?=$_SESSION["lastName"];?>! <a href="user.php">Mine treeningpäevikusse &rarr;</a>
		</b></p>
		<h1 align="center">Foorum</h1>	
		<br><br>
		
		<div class="row">
			<div class="col-sm-3 col-md-3">
	
				<p> <b> <?=$topic_del_msg;?> </b> </p>
				<p> <b> <?=$topic_msg;?> <font color="red"><?=$fileError;?></font> </b> </p>
				<h2>Loo uus teema</h2>
				<form method="POST" enctype="multipart/form-data">
					<label>Kategooria:</label>
					<?php if($category == "general") { ?>
					<input type="radio" name="category" value="general" checked>Üldine
					<?php } else { ?>
					<input type="radio" name="category" value="general">Üldine
					<?php } ?>
					<br>
					<?php if($category == "partner") { ?>
					<input type="radio" name="category" value="partner" checked>Leia endale treeningpartner
					<?php } else { ?>
					<input type="radio" name="category" value="partner">Leia endale treeningpartner
					<?php } ?>
					<br><br>
					<label>Pealkiri:</label>
					<input type="text" class="form-control" name="headline" value="<?=$newHeadline;?>"> <?php echo $newHeadlineError; ?>
					<br><br>
					<label>Sisu:</label>
					<textarea class="form-control" cols="40" rows="5" name="content" <?=$newContent = ""; if (isset($_POST['content'])) { $newContent = $_POST['content'];}?> ><?php echo $newContent; ?></textarea> <?php echo $newContentError; ?> <!--Textareal pole eraldi value, sinna sisse kirjutada-->
					<br><br>
					<label>Lisa soovi korral pilt:</label>
					<i><input type="file" name="fileToUpload" id="fileToUpload"></i>
					<br>
					<input type="submit" value = "Postita teema" class="btn btn-success btn-sm">
				</form>
				<br><br>
				
		</div>
		
		<div class="col-sm-9 col-md-9">
		
			<form>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-9">
						<input type="search" class="form-control input-sm" name="q" value="<?=$q;?>"> 
					</div> 
					<div class="col-sm-3">
					<input type="submit" class="form-control btn-sm" value="Otsi teemat">
					</div> 
				</div>
			</div>
			</form>
		
			<p>
			<b>Kategooriate sorteerimine <font class="sort" color="green"> <?=$sort_name;?> </font>järgi.</b>
			</p>
			<p>
			<?php
				$html = "<table class='table table-hover'>";
					$html .= "<tr>"; 
						$topicOrder = "ASC";
						$userOrder = "ASC";
						$dateOrder = "ASC";
						$topicArrow = "&larr;";
						$userArrow = "&larr;";
						$dateArrow = "&olarr;";
						
						if (isset($_GET["sort"]) && $_GET["sort"] == "topic") {
							if (isset($_GET["order"]) && $_GET["order"] == "ASC") {
								$topicOrder="DESC"; 
								$topicArrow = "&rarr;";
							}
						}
						
						if (isset($_GET["sort"]) && $_GET["sort"] == "username") {
							if (isset($_GET["order"]) && $_GET["order"] == "ASC") {
								$userOrder="DESC";
								$userArrow = "&rarr;";
							}
						}
						
						if (isset($_GET["sort"]) && $_GET["sort"] == "created") {
							if (isset($_GET["order"]) && $_GET["order"] == "ASC") {
								$dateOrder="DESC";
								$dateArrow = "&orarr;";					
							}
						}
					
					$html .= "<thead class='bg-success'>";
					$html .= "<th>
						<a href='?q=".$q."&sort=topic&order=".$topicOrder."' style='text-decoration:none'>
						<font size='2'>Teema</font><br><font size='2'>A</font>".$topicArrow."</th>";
						$html .= "<th>
						<a href='?q=".$q."&sort=username&order=".$userOrder."' style='text-decoration:none'>
						<font size='2'>Kasutaja</font><br><font size='2'>A</font>".$userArrow."</th>";
						$html .= "<th>
						<a href='?q=".$q."&sort=created&order=".$dateOrder."' style='text-decoration:none'>
						<font size='2'>Lisamise kuupäev</font><br><font size='2'>&#128336;</font>".$dateArrow."</th>";
					$html .= "</tr>";
					$html .= "</thead>";
					
					$html .= "<thead class='thead-default'>";
					$html .= "<th><font size='2'>ÜLDINE</font></th>";
					$html .= "<th></th>";
					$html .= "<th></th>";
					$html .= "</thead>";
				
				
				foreach($generalTopics as $gt){
					$html .= "<tbody>";
					$html .= "<tr>";
						$html .= "<td font size='20'><a href='topic.php?id=".$gt->id."' style='text-decoration:none'><font size='4'>".$gt->subject."</font></a></td>";
						$html .= "<td>".$gt->username."</td>";
						$html .= "<td>".$gt->created."</td>";
					$html .= "</tr>";
					$html .= "</tbody>";
				} 
					
					$html .= "<thead class='thead-default'>";
					$html .= "<th><font size='2'>LEIA ENDALE TREENINGPARTNER</font></th>";
					$html .= "<th></th>";
					$html .= "<th></th>";
					$html .= "</thead>";
					
				foreach($partnerTopics as $pt){
					$html .= "<tbody>";
					$html .= "<tr>";
						$html .= "<td font size='20'><a href='topic.php?id=".$pt->id."' style='text-decoration:none'><font size='4'>".$pt->subject."</font></a></td>";
						$html .= "<td>".$pt->username."</td>";
						$html .= "<td>".$pt->created."</td>";
					$html .= "</tr>";
					$html .= "</tbody>";
				} 
				
				$html .= "</table>";
				echo $html;
				
			?>
			<br>
		</div>
	</div>
</div>
<?php require("../footer.php")?>
