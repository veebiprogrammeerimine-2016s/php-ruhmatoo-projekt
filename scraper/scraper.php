<?php

error_reporting(E_ALL);
include "simple_html_dom.php";
require_once("functions.php");
require_once "vendor/autoload.php";
mb_internal_encoding("iso-8859-1");
session_start();

if ((isset($_SESSION)) && (!empty($_SESSION))) {
    print_r($_SESSION);
}

$client = new Google_Client();
$client->setApplicationName("Izipäevik");
$client->setClientId("####");
$client->setClientSecret(__DIR__ . "/client_secret.json");
$client->setRedirectUri("####");
$client->setDeveloperKey("####");
$authUrl = $client->createAuthUrl();

$cal = new Google_Service_Calendar($client);

// Specialization
if (isset($_GET["ryhm"])) {
    $ryhm = $_GET["ryhm"];
} else {
    $ryhm = "IFIFB-1";
}

// Current date in MASIO - Unix time
if (isset($_GET["time"])) {
    $time = $_GET["time"];
} else {
    $time = time();
}

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
        $dayExplode[1] = monthToDate($dayExplode[1]);
        $dayFinished = implode($dayExplode);
        //echo "////////" . $dayFinished . "\\\\\\\\\\\\\\\\<br>";
    } else {
        $spans = $div->find("span");
        if (count($spans) > 0) {
            $time = $spans[0]->innertext;
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

            //$subject = array_shift($subject);
            //echo "Rühm " . $group . " | ";
            //echo "Kell " . $time . " | ";
            //echo $lessonCode . " | ";
            //echo $lessonName . " | ";
            //echo $teacher . " | ";
            //echo $room . "<br>";

            //echo "<br>";
        }

    }

}

//clear_all($html);
//var_dump($data["G1"]);








