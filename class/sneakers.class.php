<?php
class Sneakers {
	
		private $connection;
		
		function __construct($mysqli){
			
			$this->connection=$mysqli;

		}



/****** UUE KUULUTUSE ANDMETE SISESTAMINE ******
	createpost.php
*/
	function savesneaker ($postid, $heading, $model, $description, $price, $status) {
		
		$stmt = $this->connection->prepare("INSERT INTO sm_postinfo (postid, heading, model, description, price, status) VALUES (?, ?, ?, ?, ?, ?)");
		echo $this->connection->error;
		$stmt->bind_param("isssii", $postid, $heading, $model, $description, $price, $status);
		
		if($stmt->execute()) {
			echo "salvestamine õnnestus";
		} else {
			echo "ERROR".$stmt->error;
		}
		$stmt->close();
	}
	
	
	
	
	function getallsneakers($q, $sort, $direction) {
		
		$allowedSortOptions=["contactemail","description","price"];
		if(!in_array($sort, $allowedSortOptions)){
			$sort = "contactemail";
		}
		echo "Sorteerin: ".$sort." ";
		
		$orderBy="ASC";
		if($direction == "descending"){
			$orderBy="DESC";
		}
		echo "Jarjekord: ".$orderBy." ";
		
		
	
		if($q==""){
			echo "Ei otsi";
			$stmt=$this->connection->prepare("
			SELECT contactemail, description, price
			FROM sneakers
			ORDER BY $sort $orderBy
		");
		} else {
			echo "Otsib: ".$q;
			$searchword="%".$q."%";
			$stmt=$this->connection->prepare("
			SELECT contactemail, description, price
			FROM sneakers
			WHERE (description LIKE ? OR price LIKE ?)
			ORDER BY $sort $orderBy
		");
		
		$stmt->bind_param("ss", $searchword, $searchword);
		
		}
		
		
	
		
		$stmt->bind_result($contactemail, $description, $price);
		$stmt->execute();
		
		$result=array();
		
		while($stmt->fetch()) {
			
			$sneaker= new stdclass();
			
			$sneaker->contactemail=$contactemail;
			$sneaker->description=$description;
			$sneaker->price=$price;
			
			array_push($result, $sneaker);
		}
		
		$stmt->close();
		
		return $result;
	}
	
	function getallusersneakers() {
		
		$stmt=$this->connection->prepare("
			SELECT contactemail, description, price FROM sneakers WHERE user=?");
		
		$stmt->bind_param("s", $_SESSION["userEmail"]);
		$stmt->bind_result($contactemail, $description, $price);
		$stmt->execute();
		
		$result=array();
		
		while($stmt->fetch()) {
			
			$sneaker= new stdclass();
			
			$sneaker->contactemail=$contactemail;
			$sneaker->description=$description;
			$sneaker->price=$price;
			
			array_push($result, $sneaker);
		}
		
		$stmt->close();
		
		return $result;
	}

	
	
	
/* ************ */
	
/****** UUE KUULUTUSE LOOMINE ANDMEBAASI ******
	data.php
*/	
	function createNewPost() {
		$stmt = $this->connection->prepare("INSERT INTO sm_posts (poststarted, status, userid) VALUES (NOW(), 0, ?)");
		echo $this->connection->error;
		$stmt->bind_param("i", $_SESSION["userId"]);
		$stmt->execute();
		$stmt->close();
	}
	
/****** VAJALIK 1 VÕI 0 VÄÄRTUSE TEKITAMISEKS ******
	data.php
*/
	function ifUserHasCreatedPost() {
		$stmt = $this->connection->prepare("SELECT COUNT(max) AS postcheck FROM (SELECT MAX(id) AS max FROM sm_posts WHERE userid = ?) AS t");
		echo $this->connection->error;
		$stmt->bind_param("i", $_SESSION["userId"]);
		$stmt->bind_result($postcheck);
		$stmt->execute();
		
		$userPostCheck = new StdClass();
		if($stmt->fetch()) {
			$userPostCheck->postcheck = $postcheck;
		} else {
			echo "ei saanud postchecki";
		}
		$stmt->close();
		return $userPostCheck;
	}
	
	
/****** VÕTAB KASUTAJA POOLT LOODUD VIIMASE REA 'sm_posts' ANDMEBAASIST ******
	data.php, createpost.php
*/
	function getNewPostId() {
		$stmt = $this->connection->prepare("SELECT id, status FROM sm_posts WHERE userid = ? ORDER BY id DESC LIMIT 1");
		echo $this->connection->error;
		$stmt->bind_param("i", $_SESSION["userId"]);
		$stmt->bind_result($id, $status);
		$stmt->execute();
		
		$postId = new StdClass();
		
		if($stmt->fetch()) {
			$postId->id = $id;
			$postId->status = $status;
		} else {
			echo $stmt->error." Oli mingi tõrge..";
		}
		$stmt->close();
		return $postId;
	}
	
	
/****** VAJALIK 1 VÕI 0 VÄÄRTUSE TEKITAMISEKS ******
	createpost.php
*/
	function ifUserHasCreatedPostInfo($currentid) {
		$stmt = $this->connection->prepare("SELECT COUNT(*) AS postcheck
												FROM (SELECT * FROM sm_postinfo WHERE postid = ? ORDER BY id DESC LIMIT 1) AS i
												JOIN (SELECT * FROM sm_posts WHERE userid = ?) AS p ON i.postid=p.id");
		echo $this->connection->error;
		$stmt->bind_param("ii", $currentid, $_SESSION["userId"]);
		$stmt->bind_result($postcheck);
		$stmt->execute();
		
		$postCheck = new StdClass();
		
		if($stmt->fetch()) {
			$postCheck->postcheck = $postcheck;
		} else {
			echo $stmt->error." Oli mingi kamm postcheckiga..";
		}
		$stmt->close();
		return $postCheck;
	}
	

/****** VÕTAB KASUTAJA POOLT LOODUD VIIMASE REA 'sm_postinfo' ANDMEBAASIST ******
	createpost.php
*/
	function getRecentPostId($currentid) {
		$stmt = $this->connection->prepare("SELECT postid, i.status
												FROM (SELECT * FROM sm_postinfo WHERE postid = ? ORDER BY id DESC LIMIT 1) AS i
												JOIN (SELECT * FROM sm_posts WHERE userid = ?) AS p ON i.postid=p.id");
		echo $this->connection->error;
		$stmt->bind_param("ii", $currentid, $_SESSION["userId"]);
		$stmt->bind_result($postid, $status);
		$stmt->execute();
		
		$postInfoId = new StdClass();
		
		if($stmt->fetch()) {
			$postInfoId->postid = $postid;
			$postInfoId->status = $status;
		} else {
			echo $stmt->error." Oli mingi kamm..";
		}
		$stmt->close();
		return $postInfoId;
	}
	
	
	
	function updatePostStatus($updatestatus, $postid) {
		$stmt = $this->connection->prepare("UPDATE sm_postinfo SET status = ? WHERE postid = ? ORDER BY id DESC LIMIT 1");
		echo $this->connection->error;
		$stmt->bind_param("ii", $updatestatus, $postid);
		$stmt->execute();
		$stmt->close();
	}

	
	
	function finishPost($postid) {
		$stmt = $this->connection->prepare("UPDATE sm_posts SET postcompleted = NOW(), status = 1 WHERE userid = ? AND id = ?");
		echo $this->connection->error;
		$stmt->bind_param("ii", $_SESSION["userId"], $postid);
		if($stmt->execute()) {
			echo "Kuulutus on loodud";
		}
		$stmt->close();
	}
	
	
	function finishDeletedPost($postid) {
		$stmt = $this->connection->prepare("UPDATE sm_posts SET status = 1 WHERE userid = ? AND id = ?");
		echo $this->connection->error;
		$stmt->bind_param("ii", $_SESSION["userId"], $postid);
		if($stmt->execute()) {
			echo "";
		}
		$stmt->close();
	}
	
	
	function deleteUnfinishedPost($postid) {
		$stmt = $this->connection->prepare("UPDATE sm_postinfo SET postdeleted = NOW() WHERE postid = ? ORDER BY id DESC LIMIT 1");
		echo $this->connection->error;
		$stmt->bind_param("i", $postid);
		if($stmt->execute()) {
			echo "Kuulutus on kustutatud";
		}
		$stmt->close();
	}




/* funktsioon kasutaja viimase postituse andmete kättesaamiseks andmebaasist 'sm_postinfo'
	data.php
*/
	function getRecentPostInfo($postid) {
		$stmt = $this->connection->prepare("SELECT id, heading, model, price, description, status FROM sm_postinfo WHERE postid = ? ORDER BY id DESC LIMIT 1");
		echo $this->connection->error;
		$stmt->bind_param("i", $postid);
		$stmt->bind_result($id, $heading, $model, $price, $description, $status);
		$stmt->execute();
		
		$recentPost = new StdClass();
		if($stmt->fetch()) {
			$recentPost->id = $id;
			$recentPost->heading = $heading;
			$recentPost->model = $model;
			$recentPost->price = $price;
			$recentPost->description = $description;
			$recentPost->status = $status;
		} else {
			echo "Ei saanud andmeid kätte..";
		}
		$stmt->close();
		return $recentPost;
	}
	
	
	
	function deletePreviousPostVersions($postid, $recentid) {
		$stmt = $this->connection->prepare("UPDATE sm_postinfo SET postdeleted = NOW() WHERE postid = ? AND id < ?");
		echo $this->connection->error;
		$stmt->bind_param("ii", $postid, $recentid);
		$stmt->execute();
		$stmt->close();
	}

	
	


/****** PILTIDE ÜLESLAADIMINE ******
	data.php
*/	
	function uploadImages($name, $postid) {
		$stmt = $this->connection->prepare("INSERT INTO sm_uploads (name, postid, primarypic) VALUES (?, ?, 1)");
		echo $this->connection->error;
		$stmt->bind_param("si", $name, $postid);
		
		if($stmt->execute()) {
			echo "Salvestamine õnnestus";
		} else {
			echo "ERROR".$stmt->error;
		}
		$stmt->close();
	}
	
	
	function ifUserUploadedImage($currentid) {
		$stmt = $this->connection->prepare("SELECT COUNT(max) AS imagecheck FROM (SELECT MAX(id) AS max FROM sm_uploads WHERE postid = ?) AS t");
		echo $this->connection->error;
		$stmt->bind_param("i", $currentid);
		$stmt->bind_result($imagecheck);
		$stmt->execute();
		
		$imageCheck = new StdClass();
		
		if($stmt->fetch()) {
			$imageCheck->imagecheck = $imagecheck;
		} else {
			echo "pildiga on mingi jama";
		}
		$stmt->close();
		return $imageCheck;
	}

	
	function getImageData($currentid) {
		$stmt = $this->connection->prepare("SELECT id, name, postid FROM sm_uploads WHERE postid = ? ORDER BY id DESC LIMIT 1");
		echo $this->connection->error;
		$stmt->bind_param("i", $currentid);
		$stmt->bind_result($id, $name, $postid);
		$stmt->execute();
		
		$imageInfo = new StdClass();
		
		if($stmt->fetch()) {
			$imageInfo->id = $id;
			$imageInfo->name = $name;
			$imageInfo->postid = $postid;
		} else {
			echo "pildiga on mingi jama";
		}
		$stmt->close();
		return $imageInfo;
	}
	
	
	function deletePreviousImages($postid, $recentid) {
		$stmt = $this->connection->prepare("UPDATE sm_uploads SET picdeleted = NOW() WHERE postid = ? AND id < ?");
		echo $this->connection->error;
		$stmt->bind_param("ii", $postid, $recentid);
		$stmt->execute();
		$stmt->close();
	}

	

	
/****** FUNKTSIOON ESILEHEL KUVATAVATE KUULUTUSTE ANDMETE JAOKS ******
	sneakermarket.php

	kontrollida:
	1 - kas tulevad kõikide kasutajate kuulutused, kus:
		1.1 - primarypic (ehk pilt, mida kuvatakse kuulutuse esilehel) on 1
		1.2. - deleted on NULL
	2 - mis saab, kui kasutaja kustutab pildi (deleted ei ole NULL)? - mida kuvatakse?
	3 - kas kasutaja saab muuta primarypici?
*/

/*
	function getAllPosts() {
		
		$stmt = $this->connection->prepare("SELECT p.postid, heading, model, price, description, name FROM sm_postinfo p
											JOIN (SELECT * FROM sm_uploads WHERE primarypic=1 AND picdeleted IS NULL) u ON p.id=u.postid");
		echo $this->connection->error;
		$stmt->bind_result($postid, $heading, $model, $price, $description, $imgname);
		$stmt->execute();
		
		$result = array();
		
		while($stmt->fetch()) {
			
			$sneakerPost = new StdClass();
			
			$sneakerPost->postid = $postid;
			$sneakerPost->heading = $heading;
			$sneakerPost->model = $model;
			$sneakerPost->price = $price;
			$sneakerPost->description = $description;
			$sneakerPost->name = $imgname;
			
			array_push($result, $sneakerPost);
		}
		$stmt->close();
		return $result;
	}
*/


	function getAllPosts() {
		
		$stmt = $this->connection->prepare("SELECT i.postid, heading, model, price, description, name
												FROM (SELECT * FROM sm_posts WHERE postcompleted IS NOT NULL) AS p
												JOIN (SELECT * FROM sm_postinfo WHERE postdeleted IS NULL) AS i ON p.id=i.postid
												JOIN (SELECT * FROM sm_uploads WHERE primarypic = 1 AND picdeleted IS NULL) AS u ON p.id=u.postid");
		echo $this->connection->error;
		$stmt->bind_result($postid, $heading, $model, $price, $description, $imgname);
		$stmt->execute();
		
		$result = array();
		
		while($stmt->fetch()) {
			
			$sneakerPost = new StdClass();
			
			$sneakerPost->postid = $postid;
			$sneakerPost->heading = $heading;
			$sneakerPost->model = $model;
			$sneakerPost->price = $price;
			$sneakerPost->description = $description;
			$sneakerPost->name = $imgname;
			
			array_push($result, $sneakerPost);
		}
		$stmt->close();
		return $result;
	}
	




/****** ANDMED KINDLA KUULUTUSE JAOKS ******
	post.php
*/

/*
	function getSinglePostData($singlepostid) {
		
		$stmt = $this->connection->prepare("SELECT postid, heading, model, price, description, name FROM sm_postinfo p
											JOIN (SELECT * FROM sm_uploads WHERE primarypic=1 AND picdeleted IS NULL AND postid = ?) u ON p.id=u.postid");
		echo $this->connection->error;
		$stmt->bind_param("i", $singlepostid);
		$stmt->bind_result($postid, $heading, $model, $price, $description, $imgname);
		$stmt->execute();
		
		$singlePostData = new StdClass();
		
		if($stmt->fetch()) {
			
			$singlePostData->postid = $postid;
			$singlePostData->heading = $heading;
			$singlePostData->model = $model;
			$singlePostData->price = $price;
			$singlePostData->description = $description;
			$singlePostData->name = $imgname;
			
		} else {
			echo "andmete kättesaamisel ilmnes tõrge";
		}
		$stmt->close();
		return $singlePostData;
	}
*/
	
	
	function getSinglePostData($currentid) {
		
		$stmt = $this->connection->prepare("SELECT i.postid, heading, model, price, description, name
												FROM (SELECT * FROM sm_posts WHERE postcompleted IS NOT NULL) AS p
												JOIN (SELECT * FROM sm_postinfo WHERE postdeleted IS NULL AND postid = ?) AS i ON p.id=i.postid
												JOIN (SELECT * FROM sm_uploads WHERE primarypic = 1 AND picdeleted IS NULL) AS u ON p.id=u.postid");
		echo $this->connection->error;
		$stmt->bind_param("i", $currentid);
		$stmt->bind_result($postid, $heading, $model, $price, $description, $imgname);
		$stmt->execute();
		
		$singlePostData = new StdClass();
		
		if($stmt->fetch()) {
			
			$singlePostData->postid = $postid;
			$singlePostData->heading = $heading;
			$singlePostData->model = $model;
			$singlePostData->price = $price;
			$singlePostData->description = $description;
			$singlePostData->name = $imgname;
			
		} else {
			echo "andmete kättesaamisel ilmnes tõrge";
		}
		$stmt->close();
		return $singlePostData;
	}
	
	
	
	

/*
	function getAllMyPosts() {
		
		$stmt = $this->connection->prepare("SELECT postid, heading, model, price, description, name
												FROM (SELECT * FROM sm_postinfo WHERE postdeleted IS NULL AND userid = ?) AS p
												JOIN (SELECT * FROM sm_uploads WHERE primarypic = 1 AND picdeleted IS NULL) AS u ON p.id=u.postid");
		echo $this->connection->error;
		$stmt->bind_param("i", $_SESSION["userId"]);
		$stmt->bind_result($postid, $heading, $model, $price, $description, $imgname);
		$stmt->execute();
		
		$result = array();
		
		while($stmt->fetch()) {
			
			$mySneakerPost = new StdClass();
			
			$mySneakerPost->postid = $postid;
			$mySneakerPost->heading = $heading;
			$mySneakerPost->model = $model;
			$mySneakerPost->price = $price;
			$mySneakerPost->description = $description;
			$mySneakerPost->name = $imgname;
			
			array_push($result, $mySneakerPost);
		}
		$stmt->close();
		return $result;
	}
*/

	function getAllMyPosts() {
		
		$stmt = $this->connection->prepare("SELECT i.postid, heading, model, price, description, name
												FROM (SELECT * FROM sm_posts WHERE postcompleted IS NOT NULL AND userid = ?) AS p
												JOIN (SELECT * FROM sm_postinfo WHERE postdeleted IS NULL) AS i ON p.id=i.postid
												JOIN (SELECT * FROM sm_uploads WHERE primarypic = 1 AND picdeleted IS NULL) AS u ON p.id=u.postid");
		echo $this->connection->error;
		$stmt->bind_param("i", $_SESSION["userId"]);
		$stmt->bind_result($postid, $heading, $model, $price, $description, $imgname);
		$stmt->execute();
		
		$result = array();
		
		while($stmt->fetch()) {
			
			$mySneakerPost = new StdClass();
			
			$mySneakerPost->postid = $postid;
			$mySneakerPost->heading = $heading;
			$mySneakerPost->model = $model;
			$mySneakerPost->price = $price;
			$mySneakerPost->description = $description;
			$mySneakerPost->name = $imgname;
			
			array_push($result, $mySneakerPost);
		}
		$stmt->close();
		return $result;
	}


















































}
?>