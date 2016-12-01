<?php
include "simple_html_dom.php";
require_once ("functions.php");
// Specialization
if (isset($_GET["ryhm"])) {
    $ryhm = $_GET["ryhm"];
} else {
    $ryhm = "IFIFB-1";
}

// Current date in MASIO
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
$data = [];
$url = 'http://www.tlu.ee/masio/index.php?id=ryhm&ryhm=' . $ryhm . '&time=' . $time . '#MASIO';
$html = file_get_html($url);
// GET DATES
foreach ($html->find('div.dayname') as $dates){
    //remove HTML tags
    $dates = substr(strstr($dates, " "), 17);
    $dates = substr($dates,0 , -6);

    $datesExplode = explode(' ', $dates);
    array_shift($datesExplode);
    // Rename full date name to number
    $datesExplode[1] = monthToDate($datesExplode[1]);
    $dates = implode("", $datesExplode);
    array_push($data, $dates);
}

var_dump($data);








