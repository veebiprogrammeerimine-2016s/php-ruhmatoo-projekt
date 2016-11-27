<?php 
	//ühendan sessiooniga
	//kuradi git ma ütlen!
	//require("../functions.php");
	
	include("../functions.php");
	//sanitize post value
	
	if(isset($_GET["page"])){
		$page = $_GET["page"];
	}else{
		$page = 1;
	}
	$item_per_page = 5;
	
	$page_number = filter_var($page, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
	//echo $page_number;
	//throw HTTP error if page number is not valid
	if(!is_numeric($page_number)){
		header('HTTP/1.1 500 Invalid page number!');
		exit();
	}

	//get current starting point of records
	$position = (($page_number-1) * $item_per_page);

	//fetch records using page position and item per page. 
	$results = $mysqli->prepare("SELECT submissions.id, caption, imgurl, email 
	FROM submissions 
	join user_sample on submissions.author=user_sample.id
	ORDER BY id DESC LIMIT ?, ?");

	//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
	//for more info https://www.sanwebe.com/2013/03/basic-php-mysqli-usage
	$results->bind_param("dd", $position, $item_per_page); 
	$results->execute(); //Execute prepared Query
	$results->bind_result($id, $name, $message, $author); //bind variables to prepared statement
	
	//output results from database
	while($results->fetch()){ //fetch values
		echo '<div>';
		echo '<table>';
		echo '<tr><h2>'.$name.'</h2></tr>';
		echo '<td>'."<img src=".$message." >".'</td>';
		echo '</table>';
		echo "Posted by: " . $author;
		echo '<br><br><br><br>';
		echo '</div>';
	}
?>