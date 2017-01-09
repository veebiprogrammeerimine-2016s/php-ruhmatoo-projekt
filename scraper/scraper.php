<?php
echo "<title>TLÜ MASIO SCRAPER</title>";
session_name("scraper");
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "simple_html_dom.php";
require_once("functions.php");
require_once(__DIR__ . "/vendor/autoload.php");
mb_internal_encoding("utf-8");

if (isset($_GET["logout"])) {
    session_destroy();
    echo("<br><a href='scraper.php'>Log in again</a><br>");
    exit();
} else {
    echo("<a href='scraper.php?logout=1'>Logi välja</a><br>");
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

$file = fopen("completed_days.txt", "a+") or exit("Unable to open file!");

if (isset($_GET["reset"])) {
    unset($time);
    unset($_GET["time"]);
    unset($_SESSION["time"]);
}
$nextWeek = time() + 604800;
echo("<br><a href='scraper.php?time=" . time() . "'>Praegune nädal</a> <br>");
echo("<br><a href='scraper.php?time=" . $nextWeek . "'>Järgmine nädal</a> <br>");

// Current date in MASIO - Unix time
// 1485856800 for IFIFB-1 Semester 2
if (isset($_GET["time"])) {
    $time = $_GET["time"];
    $_SESSION["time"] = $time;
} else if (isset($_SESSION["time"])) {
    $time = $_SESSION["time"];
} else {
    echo "
    <br>
    <form method='get'>
        <input type='number' name='time' placeholder='Sisestage UNIX aeg'>
        <input type='submit' value='Sisesta'>
    </form>
    <br>
    ";
    exit();
}

echo("<br><a href='scraper.php?reset=1'>Uus aeg</a><br>");

// 604800 = seconds in a week
// very simple and very stupid
while (($line = fgets($file)) !== false) {
    if ($line < $time + 604799 && $line > $time - 604799) {
        exit("See nädal on kalendrisse juba lisatud!");
    }
}

if (isset($_SESSION["accessToken"])) {
    $accessToken = $_SESSION["accessToken"];
    if (isset($_GET["code"])) {
        //Remove google auth code from GET
        header("Location: scraper.php");
    }
} else {
    if (!isset($_GET["code"])) {
        // Request authorization from the user.
        $authUrl = $client->createAuthUrl();
        header("Location:" . $authUrl);
    } else {
        $authCode = trim($_GET["code"]);
    }
}

if (isset($authCode) && !isset($_SESSION["accessToken"])) {
    // Exchange authorization code for an access token.
    $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
    $_SESSION["accessToken"] = $accessToken;
}

if (isset($accessToken) && !empty($accessToken)) {
    // Refresh the token if it's expired.
    try {
        $client->setAccessToken($accessToken);
    } catch (Exception $e) {
        header("Location: scraper.php?logout=1");
        exit();
    }
    if ($client->isAccessTokenExpired()) {
        $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
    }
}


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
        $dayExplode[1] = monthToDate(utf8_encode($dayExplode[1]));
        $dayFinished = $year . "-" . $dayExplode[1] . "-" . $dayExplode[0];
    } else {
        $spans = $div->find("span");
        if (count($spans) > 0) {
            $lessonTime = $spans[0]->innertext;
            $lessonTime = explode("-", $lessonTime);
            $timeStart = $lessonTime[0];
            $timeEnd = $lessonTime[1];
            $timeStart = $dayFinished . "T" . $timeStart . ":00+02:00";
            $timeEnd = $dayFinished . "T" . $timeEnd . ":00+02:00";
            $room = $spans[1]->innertext;
            $subject = $spans[2]->innertext;

            //lesson code
            $subject = explode(" ", $subject);
            $lessonCode = utf8_encode($subject[0]);
            array_shift($subject);
            $subject = implode($subject, " ");

            $subject = explode("(", $subject);
            $lessonName = utf8_encode($subject[0]);
            array_shift($subject);
            $subject = implode($subject, " ");

            $subject = explode(")", $subject);
            if (stripos($subject[0], "moodul") !== false) {
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
            } else if ($subject[0] === "valikaine" || (stripos($lessonName, "EKSAM") !== false)) {
                // Elective courses not added to calendar
                // Exams not added to calendar
                continue;
            } else if (stripos($subject[0], "rühm") !== false) {
                $group = $subject[1];
                $group = $group[0];
                $teacher = utf8_encode($subject[3]) . " " . utf8_encode($subject[4]);
            } else if ($subject[1] === "moodul" || $subject[2] === "moodul") {
                $subject = implode($subject, " ");
                $subject = explode(")", $subject);
                $module = utf8_encode($subject[0]);
                array_shift($subject);
                $subject = implode($subject, " ");
                $subject = explode(" ", $subject);
                $group = $subject[0];
                $teacher = utf8_encode($subject[1]) . " " . utf8_encode($subject[2]);
            } else if (stripos($subject[1], ".") !== false) {
                $group = $subject[1];
                $group = $group[0];
                $teacher = utf8_encode($subject[3]) . " " . utf8_encode($subject[4]);
            } else {
                $group = "ALL";
                $teacher = utf8_encode($subject[0]) . " " . utf8_encode($subject[1]);
            }

            $summary = $lessonCode . " " . $lessonName;

            $service = new Google_Service_Calendar($client);
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

            try {
                if (isset($group1) && isset($group2)) {
                    //echo $group1 . "+ | " . $timeStart . " | " . $timeEnd . " | " . $summary . " | " . $room . " | " . $teacher . "<br>";
                    $eventInsert = $service->events->insert($groupAddresses["grupp" . $group1], $event);

                    //echo $group2 . "+; | " . $timeStart . " | " . $timeEnd . " | " . $summary . " | " . $room . " | " . $teacher . "<br>";
                    $eventInsert = $service->events->insert($groupAddresses["grupp" . $group2], $event);

                    unset($eventInsert);
                }

                if (isset($group)) {
                    //echo $group . " | " . $timeStart . " | " . $timeEnd . " | " . $summary . " | " . $room . " | " . $teacher . "<br>";
                    if ($group == 'ALL') {
                        $counter = 1;
                        while (true) {
                            $eventInsert = $service->events->insert($groupAddresses["grupp" . $counter], $event);
                            unset($eventInsert);
                            if ($counter == 4) break;
                            $counter = $counter + 1;
                        }
                    } else {
                        $eventSingle = $service->events->insert($groupAddresses["grupp" . $group], $event);
                        unset($eventInsert);
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
        }

    }

}
fwrite($file, $time . "\n");
fclose($file);
