<?php

    require_once("tcpdf.php");


    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    $pdf->SetFont('helvetica', '', 10);

    // add a page
    $pdf->AddPage();
    
    $html = "<h1>".$_GET['name']."</h1>";
    $html .= "<br><br><br><br><br><br>";
    $html .= "<p>".$_GET['result']."</p>";

    // output the HTML content
    $pdf->writeHTML($html, true, false, true, false, '');

    // reset pointer to the last page
    $pdf->lastPage();

    // ---------------------------------------------------------

    //Close and output PDF document
    $pdf->Output('romil.pdf', 'I');
        
?>