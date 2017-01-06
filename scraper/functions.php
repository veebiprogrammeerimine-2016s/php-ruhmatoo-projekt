<?php
/**
 * @author Alar Aasa <alar@alaraasa.ee>
 */

function monthToDate($month)
{
    if ($month == "jaanuar" || $month == "Jaanuar") {
        return "01";
    }
    if ($month == "veebruar" || $month == "Veebruar") {
        return "02";
    }
    if ($month == "märts" || $month == "Märts") {
        return "03";
    }
    if ($month == "aprill" || $month == "Aprill") {
        return "04";
    }
    if ($month == "mai" || $month == "Mai") {
        return "05";
    }
    if ($month == "juuni" || $month == "Juuni") {
        return "06";
    }
    if ($month == "juuli" || $month == "Juuli") {
        return "07";
    }
    if ($month == "august" || $month == "August") {
        return "08";
    }
    if ($month == "september" || $month == "September") {
        return "09";
    }
    if ($month == "oktoober" || $month == "Oktoober") {
        return "10";
    }
    if ($month == "november") {
        return "11";
    }
    if ($month == "detsember") {
        return "12";
    }
}

function expandHomeDirectory($path) {
    $homeDirectory = getenv('HOME');
    if (empty($homeDirectory)) {
        $homeDirectory = getenv('HOMEDRIVE') . getenv('HOMEPATH');
    }
    return str_replace('~', realpath($homeDirectory), $path);
}

function createEvent($summary, $room, $teacher, $timeStart, $timeEnd){
    if(!isset($timeStart)){
        echo "Puudub alguse aeg!";
        exit();
    }
    if(!isset($timeEnd)){
        echo "Puudub lõppaeg!";
        exit();
    }
    return array(
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
    );
}