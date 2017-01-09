<?php

require("/home/egenoor/config.php");

session_start();

$database = "if16_ege";
$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);

require("class/Helper.class.php");
$Helper = new Helper();




function getUserShows($username) {
	
	//Võtab kasutajanime põhjal andmebaasist kõik sarjade id'd
	
	
	
	
}


function addPicURL($picname) {
	
	$database = "if16_ege";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
	
		$username = $_SESSION['userName'];
	
		$query = "INSERT INTO user_tv_pics VALUES ('', '$username', '$picname')";
		$myData = $mysqli->query($query);
		
	$mysqli->close();
	
}




function getProfileURL() {

	$database = "if16_ege";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
	
		$username = $_SESSION['userName'];
		
		$query = "SELECT url FROM user_tv_pics WHERE username = '$username'";
		$myData = $mysqli->query($query);

			$myDataRow = $myData->fetch_assoc();
			$url = $myDataRow['url'];
			
			//if (empty($url)) $url = "profilepics/defaultPic.jpg";


		$myData->close();
		
	$mysqli->close();
	
	echo $url;
	
}

function getSeriesData() {
	$database = "if16_ege";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
	
		$query = "SELECT * FROM user_tv_db GROUP BY title";
		$myData = $mysqli->query($query);
		
		$length = $myData->num_rows;
		
		for($i = 0; $i < $length; $i++) {
			$myData->data_seek($i);
			$myDataRow = $myData->fetch_assoc();
			$tvTitles[$i] = $myDataRow['title'];
			$tvDate[$i] = $myDataRow['date'];	
		}
		
		$myData->close();
		
	$mysqli->close();
	
	for($i = 0; $i < $length; $i++) {
		echo '<option value="' . $tvTitles[$i] . '">' . $tvTitles[$i] . '</option>';
	}	
	
}





?>