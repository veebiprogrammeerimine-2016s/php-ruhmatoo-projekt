<?php
class Series{

    private $connection;

    function __construct($mysqli)
    {

        $this->connection = $mysqli;

    }
}
    /*FUNKTSIOONID*/
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



function saveSeries ($tv_show) {
		
		$database = "if16_ege";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		$stmt = $mysqli->prepare("INSERT INTO user_tv_shows (tv_show) VALUES (?)");
		
		//kirjutab ette kus täpselt viga on 
		echo $mysqli->error;
		
		$stmt->bind_param("s", $tv_show);
		
		if($stmt->execute()) {
			echo "salvestamine õnnestus";
		} else {
		 	echo "ERROR ".$stmt->error;
		}
		
	}

	function getAllSeries() {
		
		$database = "if16_ege";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		$stmt = $mysqli->prepare("SELECT id, userid, tv_show FROM user_tv_shows");
		
		$stmt->bind_result($id, $userid, $tv_show);
		$stmt->execute();
		
		//tekitan massiivi
		$result = array();
		
		//while tingimus-tee seda kuni on rida andmeid
		//mis vastab select lausele
		// while järgne sulu sisu määrab kaua korratakse
		while($stmt->fetch()) {
			
			//tekitan objekti
			$tvshow = new StdClass();
			$tvshow->id = $id;
			$tvshow->tv_show = $tv_show;
			
			//echo $plate."<br>";
			//igakord massiivi lisan juurde numbrimärgi
			array_push($result, $tvshow);
			
		}
		
		$stmt->close();
		$mysqli->close();
		
		return $result;
	}

function addSeriesToDb ($userid, $series){

    $database = "if16_ege";
    $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);

    $stmt = $mysqli->prepare("INSERT INTO user_tv_shows (userid, tv_show) VALUES (?, ?)");
    echo $mysqli->error;

    $stmt->bind_param("is", $userid, $series);

    if ($stmt->execute()) {
        echo "Saved!";
    } else {
        echo "ERROR " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();

}

function getSeriesByDay($userid, $date){
	
	$database = "if16_ege";
    $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
	
	$stmt = $mysqli->prepare("SELECT user_tv_shows.tv_show, user_tv_db.season, user_tv_db.episode
								FROM user_tv_shows, user_tv_db
								WHERE user_tv_shows.userid=? AND user_tv_db.date=?
								AND user_tv_shows.tv_show=user_tv_db.title");
	
	echo $mysqli->error;
	$stmt->bind_param("is", $userid, $date);
	$stmt->execute();
	$stmt->bind_result($tv_show, $season, $episode);
	$result = array();
	
	while($stmt->fetch()) {
		
		$tvshow = new StdClass();
		$tvshow->tv_show = $tv_show;	
		$tvshow->season = $season;
		$tvshow->episode = $episode;
		array_push($result, $tvshow);
	}
	return $result;
}
?>