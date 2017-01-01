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
			$newHeadlineError = "See väli on kohustuslik!";
		} else {
			$newHeadline = $_POST["headline"];
		}
	}
	
	if (isset ($_POST["content"]) ){ 
		if (empty ($_POST["content"]) ){ 
			$newContentError = "See väli on kohustuslik!";
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
	
	if (isset ($_POST["headline"]) && 
		isset ($_POST["content"]) && 
		/*!empty ($_POST["headline"]) && 
		!empty ($_POST["content"])*/
		empty($newHeadlineError)&&
		empty($newContentError)
		){
			$Topic->createNew ($Helper->cleanInput($_POST["headline"]), $Helper->cleanInput($_POST["content"]), $_SESSION["userName"], $_SESSION["userId"], $category);
			header("Location:data.php");
			exit();
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
		<br>
		<p><b>
			Tere tulemast <?=$_SESSION["firstName"];?> <?=$_SESSION["lastName"];?>! <a href="user.php">Mine treeningpäevikusse &rarr;</a>
		</b></p>
		<p> <b> <?=$topic_del_msg;?> </b> </p>
		<h1>Foorum</h1>
		<p> <b> <?=$topic_msg;?> </b> </p>
		<p><b>Loo uus teema</b></p>
		<form method="POST">
			<label>Kategooria:</label>
			<?php if($category == "general") { ?>
			<input type="radio" name="category" value="general" checked>Üldine
			<?php } else { ?>
			<input type="radio" name="category" value="general">Üldine
			<?php } ?>
			
			<?php if($category == "partner") { ?>
			<input type="radio" name="category" value="partner" checked>Leia endale treeningpartner
			<?php } else { ?>
			<input type="radio" name="category" value="partner">Leia endale treeningpartner
			<?php } ?>
			<br><br>
			<label>Pealkiri:</label>
			<input type="text" name="headline" value="<?=$newHeadline;?>"> <?php echo $newHeadlineError; ?>
			<br><br>
			<label>Sisu:</label>
			<textarea cols="40" rows="5" name="content" <?=$newContent = ""; if (isset($_POST['content'])) { $newContent = $_POST['content'];}?> ><?php echo $newContent; ?></textarea> <?php echo $newContentError; ?> <!--Textareal pole eraldi value, sinna sisse kirjutada-->
			<br><br>
			<input type="submit" value = "Postita">
		</form>
		<br><br>
		<form>
			<input type="search" name="q" value="<?=$q;?>"> 
			<input type="submit" value="Otsi teemat">
		</form>
		<br>
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
<?php require("../footer.php")?>
