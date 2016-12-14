<?php 
	//ühendan sessiooniga
	//kuradi git ma ütlen!
	//require("../functions.php");
	
	include("../functions.php");
	//require("../class/Rating.class.php");
	//$Rating = new Rating($mysqli);
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
	
	
	
	$search= "";
	if (isset($_GET["search"]) && !empty($_GET["search"])){
		
		//header("Location: data.php?search=".$_GET["searchPost"]);
		//echo "test";
		$search= $_GET["search"];
		
	}
	
	//var_dump ($_GET);

	if ($search!=""){
		
		$results = $mysqli->prepare("SELECT submissions.id, caption, imgurl, username 
		FROM submissions 
		join user_sample on submissions.author=user_sample.id
		WHERE caption LIKE ? OR username LIKE ? AND deleted is NULL
		ORDER BY id DESC LIMIT ?, ?");
		
		$search ="%".$search."%";
		
		$results->bind_param("ssii", $search ,$search ,$position, $item_per_page);
		
	}else{
		
		$results = $mysqli->prepare("SELECT submissions.id, caption, imgurl, username 
		FROM submissions 
		join user_sample on submissions.author=user_sample.id
		WHERE deleted is NULL
		ORDER BY id DESC LIMIT ?, ?");
		$results->bind_param("ii", $position, $item_per_page); 

	}

	//fetch records using page position and item per page. 


	//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
	//for more info https://www.sanwebe.com/2013/03/basic-php-mysqli-usage
	$results->execute(); //Execute prepared Query
	$results->bind_result($id, $name, $message, $author); //bind variables to prepared statement
	
	//output results from database
	while($results->fetch()){ //fetch values
		echo '<div>';
		echo '<table>';
		echo '<tr><h2>'.$name.'</h2></tr>';
		echo '<td>'."<a href='topic.php?topicid=$id&posted' class='thumbnail'><img src=".$message." ></a>".'</td>';
		echo '<tr><td>'."Posted by: "."<a href='user.php?username=$author';?>$author</a>".'</td>';
		echo '<td align="right">'.'<a href="?addRate='.$id.'"><span class="glyphicon glyphicon-fire">Ignite(rate)</span></a>'.'</td></tr>';
		echo '</table>';
		echo '<br><br>';
		echo '</div>';
	}
	
	
	
?>



