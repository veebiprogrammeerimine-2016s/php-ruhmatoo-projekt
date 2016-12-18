
<?php

require("../../config.php");

session_start();

$database ="if16_stanislav";
$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);

// INSERT ORDER

function placeOrder($name, $email, $phone,
                    $note, $service, $carnumber,
                    $booktime, $tyreFittingId )
{

    $database = "if16_stanislav";
    $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
    $stmt = $mysqli->set_charset("utf8");
    // sqli rida
    $stmt = $mysqli->prepare("INSERT INTO p_orders (name,email,phone,note,service,carnumber,booktime,tyre_fitting_id)VALUES (?,?,?,?,?,?,?,?)");


    echo $mysqli->error;

    // stringina üks täht iga muutuja kohta (?), mis tüüp
    // string - s
    // integer - i
    // float (double) - d
    $stmt->bind_param("sssssssi",$name, $email, $phone,
        $note, $service, $carnumber,
        $booktime, $tyreFittingId);

    //täida käsku
    if($stmt->execute())
    {
        //salvestamine õnnestunud
        return true;
    }
    else
    {
        echo "ERROR ".$stmt->error;
        return false;
    }

    //panen ühenduse kinni
    $stmt->close();

}

function sendEmail($reciever)
{

    $to = $reciever;


    //mail($to,$subject,$txt,$headers);
    //ob_clean();
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    $pdf->SetFont('helvetica', '', 10);

    // add a page
    $pdf->AddPage();

    $html = "<h1>Tere</h1>";
    $html .= "<br><br><br><br><br><br>";
    $html .= "<p>".$reciever."</p>";

    // output the HTML content
    $pdf->writeHTML($html, true, false, true, false, '');

    // reset pointer to the last page
    $pdf->lastPage();

    // ---------------------------------------------------------

    //Close and output PDF document
    $pdf->Output("", "S");

    $from = "info@rehvivahetus.ee";
    $subject = "send email with pdf attachment";
    $message = "<p>Palun kontrollige andmed manuses.</p>";

// a random hash will be necessary to send mixed content
    $separator = md5(time());

    // carriage return type (we use a PHP end of line constant)
    $eol = PHP_EOL;

    // attachment name
    $filename = "test.pdf";

    // encode data (puts attachment in proper format)
    $pdfdoc = $pdf->Output("", "S");
    $attachment = chunk_split(base64_encode($pdfdoc));

    // main header
    $headers  = "From: ".$from.$eol;
    $headers .= "MIME-Version: 1.0".$eol;
    $headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";

    // no more headers after this, we start the body! //

    $body = "--".$separator.$eol;
    $body .= "Content-Transfer-Encoding: 7bit".$eol.$eol;
    $body .= "See on automaatselt saadetud kiri, mis sisaldab Teie broneeringu info.".$eol;

    // message
    $body .= "--".$separator.$eol;
    $body .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
    $body .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
    $body .= $message.$eol;

    // attachment
    $body .= "--".$separator.$eol;
    $body .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol;
    $body .= "Content-Transfer-Encoding: base64".$eol;
    $body .= "Content-Disposition: attachment".$eol.$eol;
    $body .= $attachment.$eol;
    $body .= "--".$separator."--";

    // send message
    if(mail($to, $subject, $body, $headers)){
        return true;
    }

    return false;


}

?>