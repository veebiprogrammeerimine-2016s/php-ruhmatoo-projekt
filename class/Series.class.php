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

?>