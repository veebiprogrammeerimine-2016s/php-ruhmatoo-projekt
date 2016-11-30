<?php
mb_internal_encoding("ISO-8859-13");
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
    $time = 1480703647;
}

// Group if exists for filtering results
if (isset($_GET["grupp"])) {
    $grupp = $_GET["grupp"];
} else {
    $grupp = 1;
}

$url = 'http://www.tlu.ee/masio/index.php?id=ryhm&ryhm=' . $ryhm . '&time=' . $time . '#MASIO';

function curl($url)
{
    $options = Array(
        CURLOPT_RETURNTRANSFER => TRUE, //Return website data
        CURLOPT_FOLLOWLOCATION => TRUE, //Follow "location" headers
        CURLOPT_AUTOREFERER => TRUE, // Set referrer as the "location" header address
        CURLOPT_CONNECTTIMEOUT => 120, // Seconds in which the request times out
        CURLOPT_TIMEOUT => 30, // Maximum amount of time per query
        CURLOPT_MAXREDIRS => 10, // Maximum amount of redirects
        CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:50.0) Gecko/20100101 Firefox/50.0 Waterfox/50.0",
        CURLOPT_URL => $url //Where to scrape from
    );
    $ch = curl_init();
    curl_setopt_array($ch, $options);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

function scrape_between($data, $start, $end)
{
    $data = stristr($data, $start);
    $data = substr($data, strlen($start));
    $stop = stripos($data, $end);
    $data = substr($data, 0, $stop);
    return $data;
}

/*TODO
 * Get current date from MASIO "Täna" link.
 *
 */
$scraped_page = curl($url);
$scraped_data = scrape_between($scraped_page, "<div class=\"dayname\">", "<table style=\"border-top:solid 3px #b50001;width:100%;\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">");
echo $scraped_data;





