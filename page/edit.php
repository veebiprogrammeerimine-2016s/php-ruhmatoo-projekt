<?php
	//edit.php
	require("../functions.php");
	
    require("../class/Helper.class.php");
	$Helper = new Helper();

	require("../class/Note.class.php");
	$nature2 = new nature2($mysqli);
	
	/// kas aadressireal on delete
	if(isset($_GET["delete"])){
		// saadan kaasa aadressirealt id
		$nature2->deleteNote($_GET["id"]);
		header("Location: data.php");
		exit();
		
	}
	
	//kas kasutaja uuendab andmeid
	if(isset($_POST["update"])){
		
		$nature2->updateNote($Helper->cleanInput($_POST["id"]), $Helper->cleanInput($_POST["description"]), $Helper->cleanInput($_POST["location"]), $Helper->cleanInput($_POST["date"]), $Helper->cleanInput($_POST["url"]));
		
		header("Location: edit.php?id=".$_POST["id"]."&success=true");
        exit();	
		
	}
	function upload(){
	
	var_dump($_FILES);
	if(isset($_FILES["fileToUpload"]) && !empty($_FILES["fileToUpload"]["name"])){
		$target_dir = "../pildid/";
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
			
			
			$target_file = $target_dir.uniqid().".".$imageFileType;
			
			
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
				
				// save file name to DB here
				$a = new StdClass();
				$a->name = $target_file;
				return $a;
				
			} else {
				return "Sorry, there was an error uploading your file.";
			}
		}
	}else{
		return "Please select the file that you want to upload!";
	}
	
}
	//saadan kaasa id
	$c = $nature2->getSingleNoteData($_GET["id"]);
	//var_dump($c);

	
?>
<?php require("header3.php");?>
<br><br>
<a href="data.php"> tagasi </a>

<h2>Muuda kirjet</h2>
<br>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<input type="hidden" name="id" value="<?=$_GET["id"];?>" > 
  	<label for="kirjeldus" >Märkus</label><br>
	<textarea  id="kirjeldus" name="kirjeldus"><?php echo $c->description;?></textarea><br>
  	<label for="asukoht" >Asukoht</label><br>
	<input id="asukoht" name="asukoht" type="asukoht" value="<?=$c->location;?>"><br><br>
    <label for="date" >Kuupäev</label><br>
	<input id="date" name="date" type="date" value="<?=$c->date;?>"><br><br>
  	<label for="url" >url</label>
	<br>
	<img width='300' src="<?=$c->url;?>">
	 Muuda pilti:
    <input type="file" name="fileToUpload" id="Pilt">
<br><br>

	<textarea  id="url" name="url"><?php echo $c->url;?></textarea><br>
  	
	<input type="submit" name="update" value="Salvesta">
  </form>
  
<br>
<br>
<a href="?id=<?=$_GET["id"];?>&delete=true">kustuta</a>
  
  <?php require("../booter.php");?>
  
  
  
  