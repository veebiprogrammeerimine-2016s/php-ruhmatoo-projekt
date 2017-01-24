<?php
class Products {
		private $connection;
		function __construct($mysqli){
			$this->connection=$mysqli;

		}
		
		
			
	/* uue kuulutuse lisamine	createpost.php */

	function saveproduct ($postid, $heading, $condition, $description, $price, $status) {
		
		$stmt = $this->connection->prepare("INSERT INTO prod_postinfo (postid, heading, productcondition, description, price, status) VALUES (?, ?, ?, ?, ?, ?)");
		echo $this->connection->error;
		$stmt->bind_param("isssis", $postid, $heading, $condition, $description, $price, $status);
		
		if($stmt->execute()) {
			echo "salvestamine õnnestus";
		} else {
			echo "ERROR".$stmt->error;
		}
		$stmt->close();
	}
		/*andmebaasi loomine	data.php */	
	function createNewPost() {
		$stmt = $this->connection->prepare("INSERT INTO prod_posts (poststarted, status, userid) VALUES (NOW(), 0, ?)");
		echo $this->connection->error;
		$stmt->bind_param("i", $_SESSION["userId"]);
		$stmt->execute();
		$stmt->close();
	}
		
		/*tõe või väära väärtuse loomine 0,1 */

	function ifUserHasCreatedPost() {
		$stmt = $this->connection->prepare("SELECT COUNT(max) AS postcheck FROM (SELECT MAX(id) AS max FROM prod_posts WHERE userid = ?) AS t");
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
	
	/*viimane rida andmebaasist	data.php, createpost.php */

	function getNewPostId() {
		$stmt = $this->connection->prepare("SELECT id, status FROM prod_posts WHERE userid = ? ORDER BY id DESC LIMIT 1");
		echo $this->connection->error;
		$stmt->bind_param("i", $_SESSION["userId"]);
		$stmt->bind_result($id, $status);
		$stmt->execute();
		
		$postId = new StdClass();
		
		if($stmt->fetch()) {
			$postId->id = $id;
			$postId->status = $status;
		} else {
			echo $stmt->error." error";
		}
		$stmt->close();
		return $postId;
	}
	
	/*väärtuse tekitamine	createpost.php */
	function ifUserHasCreatedPostInfo($currentid) {
		$stmt = $this->connection->prepare("SELECT COUNT(*) AS postcheck
												FROM (SELECT * FROM prod_postinfo WHERE postid = ? ORDER BY id DESC LIMIT 1) AS i
												JOIN (SELECT * FROM prod_posts WHERE userid = ?) AS p ON i.postid=p.id");
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
	
	function checkModifiedPost($currentid) {
		$stmt = $this->connection->prepare("SELECT COUNT(*) AS postcheck
												FROM (SELECT * FROM prod_posts WHERE userid = ?) AS p
												JOIN (SELECT * FROM prod_postinfo WHERE postdeleted IS NULL AND postid = ?) AS i ON p.id=i.postid");
		echo $this->connection->error;
		$stmt->bind_param("ii", $_SESSION["userId"], $currentid);
		$stmt->bind_result($postcheck);
		$stmt->execute();
		
		$postCheck = new StdClass();
		
		if($stmt->fetch()) {
			$postCheck->postcheck = $postcheck;
		} else {
			echo $stmt->error." vale andmed";
		}
		$stmt->close();
		return $postCheck;		
	}
	
	/*viimane ridaandmebaasist	createpost.php */

	function getRecentPostId($currentid) {
		$stmt = $this->connection->prepare("SELECT postid, i.status
												FROM (SELECT * FROM prod_postinfo WHERE postid = ? ORDER BY id DESC LIMIT 1) AS i
												JOIN (SELECT * FROM prod_posts WHERE userid = ?) AS p ON i.postid=p.id");
		echo $this->connection->error;
		$stmt->bind_param("ii", $currentid, $_SESSION["userId"]);
		$stmt->bind_result($postid, $status);
		$stmt->execute();
		
		$postInfoId = new StdClass();
		
		if($stmt->fetch()) {
			$postInfoId->postid = $postid;
			$postInfoId->status = $status;
		} else {
			echo $stmt->error." valed andmed..";
		}
		$stmt->close();
		return $postInfoId;
	}
	
	
	/*update	createpost.php */	

	function updatePostStatus($updatestatus, $postid) {
		$stmt = $this->connection->prepare("UPDATE prod_postinfo SET status = ? WHERE postid = ? ORDER BY id DESC LIMIT 1");
		echo $this->connection->error;
		$stmt->bind_param("ii", $updatestatus, $postid);
		$stmt->execute();
		$stmt->close();
	}

	
/*esilehel nähtav 	createpost.php */	

	function finishPost($postid) {
		$stmt = $this->connection->prepare("UPDATE prod_posts SET postcompleted = NOW(), status = 1 WHERE userid = ? AND id = ?");
		echo $this->connection->error;
		$stmt->bind_param("ii", $_SESSION["userId"], $postid);
		if($stmt->execute()) {
			echo "Kuulutus loodi";
		}
		$stmt->close();
	}

	
/*delete post 	createpost.php */

	function finishDeletedPost($postid) {
		$stmt = $this->connection->prepare("UPDATE prod_posts SET status = 1 WHERE userid = ? AND id = ?");
		echo $this->connection->error;
		$stmt->bind_param("ii", $_SESSION["userId"], $postid);
		if($stmt->execute()) {
			echo "";
		}
		$stmt->close();
	}
	
 
/*pooleli oleva kuulutuse kustutamine	createpost.php, editpost.php */

	function deleteUnfinishedPost($postid) {
		$stmt = $this->connection->prepare("UPDATE prod_postinfo SET postdeleted = NOW() WHERE postid = ? ORDER BY id DESC LIMIT 1");
		echo $this->connection->error;
		$stmt->bind_param("i", $postid);
		if($stmt->execute()) {
			echo "Kuulutus on kustutatud";
		}
		$stmt->close();
	}


/*info kättesaamine 	data.php, createpost.php */

	function getRecentPostInfo($postid) {
		$stmt = $this->connection->prepare("SELECT id, heading, productcondition, price, description, status FROM prod_postinfo WHERE postid = ? ORDER BY id DESC LIMIT 1");
		echo $this->connection->error;
		$stmt->bind_param("i", $postid);
		$stmt->bind_result($id, $heading, $condition, $price, $description, $status);
		$stmt->execute();
		
		$recentPost = new StdClass();
		if($stmt->fetch()) {
			$recentPost->id = $id;
			$recentPost->heading = $heading;
			$recentPost->condition = $condition;
			$recentPost->price = $price;
			$recentPost->description = $description;
			$recentPost->status = $status;
	
			
		} else {
			echo "Ei saanud andmeid ";
		}
		$stmt->close();
		return $recentPost;
	}
	

	function deletePreviousPostVersions($postid, $recentid) {
		$stmt = $this->connection->prepare("UPDATE prod_postinfo SET postdeleted = NOW() WHERE postid = ? AND id < ?");
		echo $this->connection->error;
		$stmt->bind_param("ii", $postid, $recentid);
		$stmt->execute();
		$stmt->close();
	}

	
/*Pildi üleslaadimine* 	createpost.php */
	
	function uploadImages($name, $postid) {
		$stmt = $this->connection->prepare("INSERT INTO prod_uploads (name, postid, primarypic) VALUES (?, ?, 1)");
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
		$stmt = $this->connection->prepare("SELECT COUNT(max) AS imagecheck FROM (SELECT MAX(id) AS max FROM prod_uploads WHERE postid = ?) AS t");
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
		$stmt = $this->connection->prepare("SELECT id, name, postid FROM prod_uploads WHERE postid = ? ORDER BY id DESC LIMIT 1");
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
		$stmt = $this->connection->prepare("UPDATE prod_uploads SET picdeleted = NOW() WHERE postid = ? AND id < ?");
		echo $this->connection->error;
		$stmt->bind_param("ii", $postid, $recentid);
		$stmt->execute();
		$stmt->close();
	}
	
/* 	productmarket.php */

	function getAllPosts($q) {
		if($q==""){
			$stmt=$this->connection->prepare("SELECT i.postid, heading,productcondition, price, description, name
				FROM (SELECT * FROM prod_posts WHERE postcompleted IS NOT NULL) AS p
				JOIN (SELECT * FROM prod_postinfo WHERE postdeleted IS NULL) AS i ON p.id=i.postid
				JOIN (SELECT * FROM prod_uploads WHERE primarypic = 1 AND picdeleted IS NULL) AS u ON p.id=u.postid"
		);
		} else {
			$searchword="%".$q."%";
			$stmt=$this->connection->prepare("
			SELECT * FROM (SELECT i.postid, heading, productcondition, price, description, name
			FROM (SELECT * FROM prod_posts WHERE postcompleted IS NOT NULL) AS p
			JOIN (SELECT * FROM prod_postinfo WHERE postdeleted IS NULL) AS i ON p.id=i.postid
			JOIN (SELECT * FROM prod_uploads WHERE primarypic = 1 AND picdeleted IS NULL) AS u ON p.id=u.postid) AS m
			WHERE (heading LIKE  ? OR price LIKE ?)
		");
		
		$stmt->bind_param("ss", $searchword, $searchword);
		
		}
		
		echo $this->connection->error;
		$stmt->bind_result($postid, $heading, $condition, $price, $description, $imgname);
		$stmt->execute();
		
		$result = array();
		
		while($stmt->fetch()) {
			
			$productPost = new StdClass();
			
			$productPost->postid = $postid;
			$productPost->heading = $heading;
			$productPost->condition = $condition;
			$productPost->price = $price;
			$productPost->description = $description;
			$productPost->name = $imgname;
			
			array_push($result, $productPost);
		}
		$stmt->close();
		return $result;
	}
	

/*kindla kuulutse andmed 	post.php */

	function getSinglePostData($currentid) {
		
		$stmt = $this->connection->prepare("SELECT i.postid, heading, productcondition, price, description, name
												FROM (SELECT * FROM prod_posts WHERE postcompleted IS NOT NULL) AS p
												JOIN (SELECT * FROM prod_postinfo WHERE postdeleted IS NULL AND postid = ?) AS i ON p.id=i.postid
												JOIN (SELECT * FROM prod_uploads WHERE primarypic = 1 AND picdeleted IS NULL) AS u ON p.id=u.postid");
		echo $this->connection->error;
		$stmt->bind_param("i", $currentid);
		$stmt->bind_result($postid, $heading,$condition, $price, $description, $imgname);
		$stmt->execute();
		
		$singlePostData = new StdClass();
		
		if($stmt->fetch()) {
			
			$singlePostData->postid = $postid;
			$singlePostData->heading = $heading;
			$singlePostData->condition = $condition;
			$singlePostData->price = $price;
			$singlePostData->description = $description;
			$singlePostData->name = $imgname;

			
		} else {
			echo " ilmnes tõrge";
		}
		$stmt->close();
		return $singlePostData;
	}
	
	
/*kasutja postitused 	myposts.php */

	function getAllMyPosts($sort, $direction) {
		$allowedSortOptions = ["heading", "price", "description"];
		if(!in_array($sort, $allowedSortOptions)) {
			$sort = "campsite";
		}
		$orderBy = "ASC";
		if($direction == "descending") {
			$orderBy = "DESC";
		}		
		
		$stmt = $this->connection->prepare("SELECT i.postid, heading, price, description, name
												FROM (SELECT * FROM prod_posts WHERE postcompleted IS NOT NULL AND userid = ?) AS p
												JOIN (SELECT * FROM prod_postinfo WHERE postdeleted IS NULL) AS i ON p.id=i.postid
												JOIN (SELECT * FROM prod_uploads WHERE primarypic = 1 AND picdeleted IS NULL) AS u ON p.id=u.postid
												ORDER BY $sort $orderBy");
		echo $this->connection->error;
		
		$stmt->bind_param("i", $_SESSION["userId"]);
		$stmt->bind_result($postid, $heading, $price, $description, $imgname);
		$stmt->execute();
		
		$result = array();
		while($stmt->fetch()) {
			
			$myProductPost = new StdClass();
			$myProductPost->postid = $postid;
			$myProductPost->heading = $heading;
			$myProductPost->price = $price;
			$myProductPost->description = $description;
			$myProductPost->name = $imgname;
			array_push($result, $myProductPost);
		}
		$stmt->close();
		return $result;
	}
	
	/*kommentaaride jaoks*/
	function postComment($currentid, $comment) {
		
		$stmt = $this->connection->prepare("INSERT INTO prod_comments (postid, userid, comment) VALUES (?, ?, ?)");
		echo $this->connection->error;
		$stmt->bind_param("iis", $currentid, $_SESSION["userId"], $comment);
		
		if($stmt->execute()) {
			echo "salvestamine õnnestus";
		} else {
			echo "ERROR".$stmt->error;
		}
		$stmt->close();
	}
	
	

	/*kommentaaride nägemine*/
	function getAllComments($currentid) {
		
		$stmt = $this->connection->prepare("SELECT username, comment
												FROM (SELECT * FROM prod_comments WHERE postid = ?) AS c
												JOIN prod_users AS u ON c.userid=u.id;");
		echo $this->connection->error;
		$stmt->bind_param("i", $currentid);
		$stmt->bind_result($username, $comment);
		$stmt->execute();
		
		$result = array();
		
		while($stmt->fetch()) {
			
			$allComments = new StdClass();
			
			$allComments->username = $username;
			$allComments->comment = $comment;
			
			array_push($result, $allComments);
		}
		$stmt->close();
		return $result;
	}
}
?>
	
	