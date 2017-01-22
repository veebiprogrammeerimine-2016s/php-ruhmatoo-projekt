<?php
class Pictures{

    private $connection;

    function __construct($mysqli)
    {

        $this->connection = $mysqli;

    }
}
    /*FUNKTSIOONID*/
function addPicURL($picname) {

	$database = "if16_ege";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);

		$username = $_SESSION['userName'];

		$query = "INSERT INTO user_tv_pics VALUES ('', '$username', '$picname')";
		$myData = $mysqli->query($query);

	$mysqli->close();

}

function updatePicUrl($username, $picname) {

   $database = "if16_ege";
   $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);

        $query = $mysqli->prepare("UPDATE user_tv_pics
                              SET url=? WHERE username=?");

        $query->bind_param("ss", $picname, $username);

        if ($query->execute()) {
             //õnnestus
            //echo "Your profile picture has been updated!";
        }

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


		$myData->close();

	$mysqli->close();

	echo $url;

}
?>