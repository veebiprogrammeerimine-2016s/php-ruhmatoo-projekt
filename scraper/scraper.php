<?php
session_name("scraper");
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "simple_html_dom.php";
require_once("functions.php");
require_once(__DIR__ . "/vendor/autoload.php");
mb_internal_encoding("iso-8859-1");

if (isset($_GET["logout"])) {
    session_destroy();
    exit();
}

define('APPLICATION_NAME', 'Izipäevik');
define('SCOPES', implode(' ', array(
        Google_Service_Calendar::CALENDAR)
));
define('CREDENTIALS_PATH', '~/.credentials/calendar-php-quickstart.json');
define('CLIENT_SECRET_PATH', __DIR__ . '/client_secret.json');
define('CLIENT_ID', "####");
define('DEVELOPER_KEY', "####");
define('REDIRECT_URI', "http://####/scraper/scraper.php");

$client = new Google_Client();
$client->setApplicationName(APPLICATION_NAME);
$client->setClientId(CLIENT_ID);
$client->setClientSecret(CLIENT_SECRET_PATH);
$client->setRedirectUri(REDIRECT_URI);
$client->setDeveloperKey(DEVELOPER_KEY);
$client->setScopes(SCOPES);

////!!!FOR LOCAL DEVELOPMENT!!!
//$client->setHttpClient(new \GuzzleHttp\Client(array(
//    'verify' => false,
//)));

$credentialsPath = expandHomeDirectory(CREDENTIALS_PATH);

// Request authorization from the user.
if (!isset($_GET["code"])){
    // Request authorization from the user.
    $authUrl = $client->createAuthUrl();
    header("Location:" . $authUrl);
} else {
    $authCode = trim($_GET["code"]);
}

if (php_sapi_name() == 'cli') {
    $authCode = trim(fgets(STDIN));
}

if (isset($authCode)){
    // Exchange authorization code for an access token.
    $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
    echo("<br>Access token: ");
    var_dump($accessToken);
    echo ("<br>");
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
if (isset($_GET["time"]) && !isset($_SESSION["time"])) {
    $time = $_GET["time"];
} else if (!isset($_SESSION["time"])) {
    $time = time();
} else {
    $time = $_SESSION["time"];
}
$time = 1473886800;
// Group if exists for filtering results
if (isset($_GET["grupp"])) {
    $grupp = $_GET["grupp"];
} else {
    $grupp = 1;
}

$data = array();

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
            $time = $spans[0]->innertext;
            $time = explode("-", $time);
            $timeStart = $time[0];
            $timeEnd = $time[1];
            $timeStart = $datesFinished . "T" . $timeStart;
            $timeEnd = $datesFinished . "T" . $timeEnd;
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
            //echo "date: " . $dayFinished . " | ";
            //echo "Kell " . $time . " | ";
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
//    if ($date){

//    }

}

//clear_all($html);
//var_dump($data["G1"]);

echo("<a href='scraper.php?logout=1'>END</a>");

?>