<?php
class Upload {

	private $connection;
	
	//funktsioon käivitatakse siis kui on 'new User(see jõuab siia)'
	function __construct($mysqli){
	//'this' viitab sellele klassile ja klassi muutujale
	$this->connection=$mysqli;
	}
	

	
	
	function uploadPicture($userid,$caption,$imgurl) {
		
			function compressPicture($source_url, $destination_url, $quality) {
			
			$info = getimagesize($source_url);
		 
			if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url);
			elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
			elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);
		 
			//save it
			imagejpeg($image, $destination_url, $quality);
			
			
			include('src/abeautifulsite/SimpleImage.php');

			try {
				$img = new abeautifulsite\SimpleImage($destination_url);
				$img->best_fit(400, 400)->save($destination_url);
			} catch(Exception $e) {
				echo 'Error: ' . $e->getMessage();
			}
			
			
			
			
			//return destination file url
			return $destination_url;
			}
		
		
		
		$ext = substr($_FILES["fileToUpload"]["name"], strrpos($_FILES["fileToUpload"]["name"], "."));
		$_FILES["fileToUpload"]["name"] = uniqid() . $ext;
		//$_FILES["fileToUpload"]["name"]=uniqid();
		$target_dir = "/home/gregness/public_html/php-ruhmatoo-projekt/page/uploads/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$target_file_corrected = "/~gregness/php-ruhmatoo-projekt/page/uploads/" . basename($_FILES["fileToUpload"]["name"]);
		
		
		

		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed. ";
			$uploadOk = 0;

		}
		

		$uploadOk = 1;

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
		/*if (file_exists($target_file)) {
			$uploadOk = 0;
			header("Location: upload.php?exists");
		}*/
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 5000000) {
			$uploadOk = 0;
			header("Location: upload.php?large");
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
				
				compressPicture($target_file,$target_file,40);
				
				
				$stmt = $this->connection->prepare("INSERT INTO submissions (author,caption,imgurl,date) values (?,?,?,now() )");
				
				echo $this->connection->error;
				// s -string
				// i - int
				// d- double
				//
				
				$stmt->bind_param("sss",$userid, $caption, $target_file_corrected);
				
				
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
	
	
	function getPictures() {

			$stmt = $this->connection->prepare("
				SELECT submissions.id,caption,imgurl,email
				FROM submissions 
				join user_sample on submissions.author=user_sample.id
				WHERE deleted is NULL
			
			");
			
		
		$stmt->bind_result($id,$caption,$imgurl,$email);
		$stmt->execute();

		$results = array();
		
		//tsükeldab nii mitu korda kui mitu rida SQL lausega tuleb
		while ($stmt->fetch()) {
			
			$pictureTable = new StdClass();
			$pictureTable->id = $id;
			$pictureTable->caption = $caption;
			$pictureTable->imgurl = $imgurl;
			$pictureTable->author = $author;
			
			array_push($results, $pictureTable);
			
		}
		
		return $results;
		
	}
}
?>