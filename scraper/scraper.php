<?php
echo "<title>TLÜ MASIO SCRAPER</title>";
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
    echo ("<br><a href='scraper.php?time=" . time() . "'>Täna</a> <br>");
}

define('APPLICATION_NAME', 'Izipäevik');
define('SCOPES', implode(' ', array(
        Google_Service_Calendar::CALENDAR)
));
define('CREDENTIALS_PATH', '~/.credentials/calendar-php-quickstart.json');
define('CLIENT_SECRET', '####');
define('CLIENT_ID', "####");
define('DEVELOPER_KEY', "####");
define('REDIRECT_URI', "http://####/scraper/scraper.php");
$groupAddresses = array(
    "grupp1" => "####@group.calendar.google.com",
    "grupp2" => "####@group.calendar.google.com",
    "grupp3" => "####@group.calendar.google.com",
    "grupp4" => "####@group.calendar.google.com"
);

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

//$file = fopen("completed_days.txt", "a+");
////or exit("Unable to open file!");
//if (exec("grep " .escapeshellarg($time).' ./completed_days.txt')){
//    fclose($file);
//    exit("See kuupäev on juba kalendris!");
//}

// Current date in MASIO - Unix time
// 1485856800 for IFIFB-1 Semester 2
if (isset($_GET["time"])) {
    $time = $_GET["time"];
    $_SESSION["time"] = $time;
} else if (isset($_SESSION["time"])) {
    $time = $_SESSION["time"];
} else {
    $time = time();
    $_SESSION["time"] = $time;
}

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
    try{
        $client->setAccessToken($accessToken);
    } catch (Exception $e){
        header("Location: scraper.php");
        exit();
    }
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

$url = 'http://www.tlu.ee/masio/index.php?id=ryhm&ryhm=' . $ryhm . '&time=' . $time . '#MASIO';
$html = file_get_html($url);
// GET DATES
$year = date("Y", $time);

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
            $timeStart = $dayFinished . "T" . $timeStart . ":00+02:00";
            $timeEnd = $dayFinished . "T" . $timeEnd . ":00+02:00";
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
            if (strpos($subject[0], "moodul") !== false) {
                $module = $subject[0];
                array_shift($subject);
            }
            $subject = implode($subject, " ");
            $subject = explode(" ", $subject);

            if ($subject[2] === "ja") {
                $group1 = $subject[1];
                $group1 = rtrim($group1, ".");
                $group2 = $subject[3];
                // Replacement unicode characters in text. No encoding works to fix this.
                $group2 = $group2[0];

                array_shift($subject);
                while (true) {
                    if ($subject[0] === "") {
                        array_shift($subject);
                        break;
                    } else {
                        array_shift($subject);
                    }
                }
                $teacher = implode($subject, " ");
            } else if ($subject[0] === "valikaine") {
                // Elective courses not added to calendar
                continue;
            } else if (strpos($subject[0], "rühm") !== false) {
                $group = $subject[1];
                $group = $group[0];
                $teacher = $subject[3] . " " . $subject[4];
            } else if ($subject[1] === "moodul" || $subject[2] === "moodul") {
                $subject = implode($subject, " ");
                $subject = explode(")", $subject);
                $module = $subject[0];
                array_shift($subject);
                $subject = implode($subject, " ");
                $subject = explode(" ", $subject);
                $group = $subject[0];
                $teacher = $subject[1] . " " . $subject[2];
            } else if (strpos($subject[1], ".") !== false) {
                $group = $subject[1];
                $group = $group[0];
                $teacher = $subject[3] . " " . $subject[4];
            } else {
                $group = "ALL";
                $teacher = $subject[0] . " " . $subject[1];
            }

            $summary = $lessonCode . " " . $lessonName;

            try {
                $event = new Google_Service_Calendar_Event(createEvent($summary, $room, $teacher, $timeStart, $timeEnd));
                if (isset($group1) && isset($group2)) {
                    //echo $group1 . "+ | " . $timeStart . " | " . $timeEnd . " | " . $summary . " | " . $room . " | " . $teacher . "<br>";
                    $eventOne = $service->events->insert($groupAddresses["grupp" . $group1], $event);

                    //echo $group2 . "+; | " . $timeStart . " | " . $timeEnd . " | " . $summary . " | " . $room . " | " . $teacher . "<br>";
                    $eventTwo = $service->events->insert($groupAddresses["grupp" . $group2], $event);

                    unset($eventOne);
                    unset($eventTwo);
                } else if (isset($group)) {
                    //echo $group . " | " . $timeStart . " | " . $timeEnd . " | " . $summary . " | " . $room . " | " . $teacher . "<br>";
                    if ($group == 'ALL') {
                        $counter = 1;
                        while (true) {
                            $eventAll = $service->events->insert($groupAddresses["grupp" . $counter], $event);
                            if ($counter == 4) break;
                            $counter = $counter + 1;
                            unset($eventAll);
                        }
                    } else {
                        $eventSingle = $service->events->insert($groupAddresses["grupp" . $group], $event);
                        unset($eventSingle);
                    }

                }

            } catch (Exception $e) {
                if ($e->getCode() == "404") {
                    echo "Teil puuduvad õigused kalendri muutmiseks või kasutajal puuduvad vajalikud kalendrid . <br>";
                } else {
                    echo "<br>ERROR " . $e->getCode() . ":" . "<br>";
                    echo $e->getMessage() . "<br>";
                }
                exit();
            }

            unset($teacher);
            unset($group);
            unset($group1);
            unset($group2);
            unset($event);
            unset($timeStart);
            unset($timeEnd);
            //fwrite($file, $time . "\n");
        }

    }

}

//fclose($file);
