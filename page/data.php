<?php 
	// et saada ligi sessioonile
	require("../functions.php");
	
    require("../class/Helper.class.php");
	$Helper = new Helper();
		require("functions.php");
	require("../class/Note.class.php");
	$Note = new Note($mysqli);
	$Nature = new Note($mysqli);
	
	//ei ole sisseloginud, suunan login lehele
	if(!isset ($_SESSION["userId"])) {
		header("Location: login.php");
		exit();
	}
	
	//kas kasutaja tahab välja logida
	// kas aadressireal on logout olemas
	if (isset($_GET["logout"])) {
		
		session_destroy();
		
		header("Location: login.php");
		exit();
	}
	
	if (	isset($_POST["note"]) && 
			isset($_POST["color"]) && 
			!empty($_POST["note"]) && 
			!empty($_POST["color"]) 
	) {
		
		$note = $Helper->cleanInput($_POST["note"]);
		$color = $Helper->cleanInput($_POST["color"]);
		
		$Note->saveNote($note, $color);
		
	}
	if(isset($_POST["description"]) && 
	isset($_POST["location"]) &&
	isset($_POST["date"]) &&
	isset($_POST["url"]) &&
	!empty($_POST["description"]) &&
	!empty($_POST["location"]) &&
	!empty($_POST["date"])&& 
	!empty($_POST["url"]))	{
		tabelisse2 ($_POST["description"], $_POST["location"], $_POST["date"],$_POST["url"]);
	
	}
	
	
	
	
	$q= "";
	if(isset($_GET["q"])){
		$q=$Helper->cleanInput($_GET["q"]);
		
	}
	
	$sort = "id";
	$order = "ASC";
	
	if(isset($_GET["sort"]) && isset($_GET["order"])){
		$sort = $_GET["sort"];
		$order = $_GET["order"];
	}
	
	
	$notes = $Note->getAllNotes($q, $sort, $order);
	$nature2= getAllNature();
	
	//echo "<pre>";
	//var_dump($notes);
	//echo "</pre>";

if(isset($_FILES["fileToUpload"]) && !empty($_FILES["fileToUpload"]["name"])){
    $target_dir = "pildid/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            
            // save file name to DB here
            
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}else{
    echo "Please select the file that you want to upload!";
}
?>



?>
<?php require("header2.php");?>


	
<!DOCTYPE html>
<html>
	<head>

		<title>iKala - esileht</title>
		<link rel="stylesheet" type="text/css" href="disain.css">
	</head>
	<body >
	   
<h1>Tere tulemast <a href="user.php"><?=$_SESSION["userEmail"];?></a>!</h1>

<form method="POST" id="sisestus">
<h2>Uus Postitus</h2>
<br>

	<input id="kirjeldus" class ="form-control" name="description" placeholder="Kirjeldus" type="text"> <br>
	<input id="Asukoht"class ="form-control" name="location" placeholder="Asukoht" type="text"> <br>
	<input id="Kuupäev"class ="form-control" name="date" placeholder="Kuupäev" type="text"> <br>
	<input id="Pilt"class ="form-control" name="url" placeholder="Pilt" type="text"> <br>
	<form action="upload.php" method="post" enctype="multipart/form-data">
    Vali pilt mida ülesselaadida:
    <input type="file" name="fileToUpload" id="Pilt">
<br><br>
	<input class="btn btn-success btn-sm hidden-xs" type="submit" name="submit" value="Postita">
</form>





<?php 

	//iga liikme kohta massiivis
	foreach ($notes as $n) {
		
		$style = "width:100px; 
				  float:left;
				  min-height:100px; 
				  border: 1px solid gray;
				  background-color: ".$n->noteColor.";";
		
		echo "<p style='  ".$style."  '>".$n->note."</p>";
	}


?>

 <h2 style="clear:both;">Tabel</h2>
<?php 
	/*$html = "<table class='table'>";
		
		$html .= "<tr>";
		
			$orderId = "ASC";
			
			if (isset($_GET["order"]) && 
				$_GET["order"] == "ASC" && 
				$_GET["sort"] == "id" ){
				
				$orderId = "DESC";
			}
		
			$html .= "<th>
			
						<a href='?q=".$q."&sort=id&order=".$orderId."'>
							id
						</a>
					</th>";
			
			$orderNote = "ASC";
			
			if (isset($_GET["order"]) && 
				$_GET["order"] == "ASC" && 
				$_GET["sort"] == "note" ){
				
				$orderNote = "DESC";
			}
	
		
			$html .= "<th>
			
						<a href='?q=".$q."&sort=note&order=".$orderNote."'>
							Märkus
						</a>
					</th>";
						
			
			
			$orderColor = "ASC";
			
			if (isset($_GET["order"]) && 
				$_GET["order"] == "ASC" && 
				$_GET["sort"] == "color" ){
				
				$orderColor = "DESC";
			}
		
			$html .= "<th>
			
						<a href='?q=".$q."&sort=color&order=".$orderColor."'>
							Värv
						</a>
					</th>";
					
		$html .= "</tr>";
	foreach ($notes as $note) {
		$html .= "<tr>";
			$html .= "<td>".$note->id."</td>";
			$html .= "<td>".$note->note."</td>";
			$html .= "<td>".$note->noteColor."</td>";
			$html .= "<td><a href='edit.php?id=".$note->id."'><span class='glyphicon-pencil>'<span> edit.php</a></td>";
		$html .= "</tr>";
	}
	
	$html .= "</table>";
	
	echo $html;

	
	echo $html;*/

?>
<p class="info">

<?php 
	foreach($nature2 as $n) { ?>
		<div class="row">
		
			<div class="col-md-6 col-md-offset-3">
		
				<h2><?=$n->description;?></h2>
				<br><br>
				
				<img width='600' src="<?=$n->url;?>">
				
				
				<br><br>
				<?=$n->day;?>
				<br><br>
				<?=$n->location;?>
				<a href='edit.php?id=<?=$note->id;?>'><span class='glyphicon-pencil>'<span> edit.php</a>
			</div>
		</div>
	<?php } ?>
</p>
<?php require("../booter.php");?>


