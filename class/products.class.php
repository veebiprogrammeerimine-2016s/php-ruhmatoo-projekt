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
	
	
	
	
	
	
		
	?>