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
    if ($month == "november" || $month == "November") {
        return "11";
    }
    if ($month == "detsember" || $month == "Detsember") {
        return "12";
    }
}