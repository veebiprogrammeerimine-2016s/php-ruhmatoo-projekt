<?php
session_name("scraper");
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "simple_html_dom.php";
require_once("functions.php");
require_once(__DIR__ . "/vendor/autoload.php");
mb_internal_encoding("iso-8859-1");

if(isset($_GET["logout"])){
    session_destroy();
    echo("<br><a href='scraper.php'>Log in again</a><br>");
    exit();
} else {
    echo("<a href='scraper.php?logout=1'>LOG OUT</a><br>");
}
echo ("<br><a href='scraper.php?time=" . time() . "'>Täna</a> <br>");

define('APPLICATION_NAME', 'Izipäevik');
define('SCOPES', implode(' ', array(
        Google_Service_Calendar::CALENDAR)
));
define('CREDENTIALS_PATH', '~/.credentials/calendar-php-quickstart.json');
define('CLIENT_SECRET', '####');
define('CLIENT_ID', "####");
define('DEVELOPER_KEY', "####");
define('REDIRECT_URI', "http://####/scraper/scraper.php");

$client = new Google_Client();
$client->setApplicationName(APPLICATION_NAME);
$client->setClientId(CLIENT_ID);
$client->setClientSecret(CLIENT_SECRET);
$client->setRedirectUri(REDIRECT_URI);
$client->setDeveloperKey(DEVELOPER_KEY);
$client->setScopes(SCOPES);

////!!!FOR LOCAL DEVELOPMENT!!!
//$client->setHttpClient(new \GuzzleHttp\Client(array(
//    'verify' => false,
//)));

if (isset($_SESSION["accessToken"])) {
    $accessToken = $_SESSION["accessToken"];
    if (isset($_GET["code"])){
        //Remove google auth code from GET
        header("Location: scraper.php");
    }
} else {
    if (!isset($_GET["code"])){
        // Request authorization from the user.
        $authUrl = $client->createAuthUrl();
        header("Location:" . $authUrl);
    } else {
        $authCode = trim($_GET["code"]);
    }
}


if (isset($authCode) && !isset($_SESSION["accessToken"])){
    // Exchange authorization code for an access token.
    $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
    $_SESSION["accessToken"] = $accessToken;
}

if(isset($accessToken) && !empty($accessToken)){
    // Refresh the token if it's expired.
    $client->setAccessToken($accessToken);
    if ($client->isAccessTokenExpired()) {
        $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
    }
}


$service = new Google_Service_Calendar($client);

// Specialization
if (isset($_GET["ryhm"]) && !isset($_SESSION["ryhm"])) {
    $ryhm = $_GET["ryhm"];
} else if (!isset($_SESSION["ryhm"])) {
    $ryhm = "IFIFB-1";
} else {
    $ryhm = $_SESSION["ryhm"];
}

// Current date in MASIO - Unix time
// 1485856800 for IFIFB-1 Semester 2
if (isset($_GET["time"]) && !isset($_SESSION["time"])) {
    $time = $_GET["time"];
} else if (!isset($_SESSION["time"])) {
    $time = time();
} else {
    $time = $_SESSION["time"];
}

$url = 'http://www.tlu.ee/masio/index.php?id=ryhm&ryhm=' . $ryhm . '&time=' . $time . '#MASIO';
$html = file_get_html($url);
// GET DATES
$year = date("Y", $time);
foreach ($html->find('div.dayname') as $dates) {

    //$spans = $dates->find("span");
    //echo $spans[1];
    //remove HTML tags
    $dates = substr(strstr($dates, " "), 17);
    $dates = substr($dates, 0, -6);

    $datesExplode = explode(' ', $dates);
    array_shift($datesExplode); // Remove day name 
    $dateData = monthToDate($datesExplode);
    $datesExplode[1] = monthToDate($datesExplode[1]);
    $datesFinished = implode($datesExplode); // Rename full month name to number
}

foreach ($html->find('div#mASIO')[0]->children() as $div) {
    if ($div->getAttribute('class') == "dayname") {
        $div = strip_tags($div);
        $dayExplode = explode(' ', $div);
        array_shift($dayExplode);
        $dayExplode[0] = str_replace(".", "", $dayExplode[0]);
        $dayExplode[1] = monthToDate($dayExplode[1]);
        $dayFinished = $year . "-" . $dayExplode[1] . "-" . $dayExplode[0];

    } else {
        $spans = $div->find("span");
        if (count($spans) > 0) {
            $lessonTime = $spans[0]->innertext;
            $lessonTime = explode("-", $time);
            $timeStart = $lessonTime[0];
            $timeEnd = $lessonTime[1];
            $timeStart = $dayFinished . "T" . $timeStart;
            $timeEnd = $dayFinished . "T" . $timeEnd;
            $room = $spans[1]->innertext;
            $subject = $spans[2]->innertext;

            //lesson code
            $subject = explode(" ", $subject);
            $lessonCode = $subject[0];
            array_shift($subject);
            $subject = implode($subject, " ");

            $subject = explode("(", $subject);
            $lessonName = $subject[0];
            array_shift($subject);
            $subject = implode($subject, " ");

            $subject = explode(")", $subject);
            if (strpos(utf8_encode($subject[0]), "rühm") !== false) {
                $group = filter_var($subject[0], FILTER_SANITIZE_NUMBER_INT);
                $teacher = $subject[1];
            } else {
                $group = "ALL";
                $teacher = $subject[0];
            }
            $subject = array_shift($subject);
            //echo "Rühm " . $group . " | ";
            //echo "START: " . $timeStart . " | END: ". $timeEnd . " | ";
            //echo $lessonCode . " | ";
            //echo $lessonName . " | ";
            //echo $teacher . " | ";
            //echo $room . "<br>";

            echo "<br>";

            $summary = $lessonCode . " " . $lessonName;
            $event = new Google_Service_Calendar_Event(array(
                'summary' => $summary,
                'location' => "Tallinn University",
                'description' => 'Ruum: ' . $room . '. Õppejõud: ' . $teacher,
                'start' => array(
                    'dateTime' => $timeStart,
                    'timeZone' => 'Europe/Tallinn',
                ),
                'end' => array(
                    'dateTime' => $timeEnd,
                    'timeZone' => 'Europe/Tallinn',
                ),
            ));

            if ($grupp = 'ALL') {
                $event = $service->events->insert('grupp1', $event);
                $event = $service->events->insert('grupp2', $event);
                $event = $service->events->insert('grupp3', $event);
                $event = $service->events->insert('grupp4', $event);
            } else {
                $groupName = 'grupp' . $group;
                $event = $service->events->insert($groupName, $event);
            }

            printf('Event created: %s\n', $event->htmlLink);
        }

    }

}