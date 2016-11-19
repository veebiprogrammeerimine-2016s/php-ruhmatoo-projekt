<?php
class Upload {
			
	
	private $connection;
	
	//funktsioon k�ivitatakse siis kui on 'new User(see j�uab siia)'
	function __construct($mysqli){
	//'this' viitab sellele klassile ja klassi muutujale
	$this->connection=$mysqli;
	}

	function uploadPicture($caption,$imgurl) {
		
		
		$ext = substr($_FILES["fileToUpload"]["name"], strrpos($_FILES["fileToUpload"]["name"], "."));
		$_FILES["fileToUpload"]["name"] = uniqid() . $ext;
		//$_FILES["fileToUpload"]["name"]=uniqid();
		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is an actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				//echo "Your post was successfully submitted. ";
				//echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}
		// Check if file already exists
		if (file_exists($target_file)) {
			$uploadOk = 0;
			header("Location: upload.php?exists");
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
			echo "Sorry, your file is too large. ";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed. ";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				
				//echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
				
				$stmt = $this->connection->prepare("INSERT INTO submissions (caption,imgurl,date) values (?,?,now() )");
				
				echo $this->connection->error;
				// s -string
				// i - int
				// d- double
				//
				
				$stmt->bind_param("ss", $caption, $target_file);
				
				
				if ($stmt->execute()) {
					header("Location: upload.php?success");
				}
				echo $stmt->error;
				
				
				$stmt->close();
				
			} else {
				echo "Sorry, there was an error uploading your file.";
				$stmt->close();
			}
		

	} 
	}
}
?>