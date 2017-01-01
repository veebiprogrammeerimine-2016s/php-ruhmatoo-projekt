<?php

require("functions.php");

//Kui ei ole kasutaja ID

if(!isset($_SESSION["userId"])){

    //Suuna sisselogimis lehele
    header("Location: login.php");
    exit();
}

//Kui on log out aadressireal, siis login v'lja
if(isset($_GET["logout"])){

    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<?php require("header.php"); ?>

<section class="background-gray-lightest">
    <div class="container">
        <div class="breadcrumbs">
            <ul class="breadcrumb">
                <li><a href="data.php">Kodu</a></li>
                <li>Kontaktid</li>
            </ul>
        </div>
        <h1 class="heading">Kontaktid</h1>
        <p class="lead">Võibolla lisada mingi tekst</p>
    </div>
</section>


<table align="center" class="table table-striped table-hover " color="black">

    <tr>
        <th>Nimi</th>
        <th>Amet</th>
        <th>Aine</th>
        <th>Kontaktid</th>
        <th>Ruum</th>
    </tr>
    <tr>
        <td>Romil Rõbtsenkov</td>
        <td>Tarkvaratehnika õpetaja</td>
        <td>Veebiprogrammeerimine</td>
        <td>romil.robtsenkov@tlu.ee</td>
        <td>A-430</td>
    </tr>
    <tr>
        <td>Jaagup Kippar</td>
        <td>Tarkvaratehnika lektor</td>
        <td>Andmebaaside projekteerimine</td>
        <td>jaagup.kippar@tlu.ee</td>
        <td>A-426</td>
    </tr>
    <tr>
        <td>Inga Petuhhov</td>
        <td>Tarkvaratehnika õpetaja</td>
        <td>Programmeerimise alused</td>
        <td>inga.petuhhov@tlu.ee</td>
        <td>A-427</td>
    </tr>
    <tr>
        <td>Tanel Toova</td>
        <td>Süsteemiadministraator</td>
        <td>Operatsioonisüsteemide alused</td>
        <td>tanel.toova@tlu.ee</td>
        <td>A-432</td>
    </tr>
    <tr>
        <td>Tatjana Tamberg</td>
        <td>Matemaatika dotsent</td>
        <td>Diskreetsed struktuurid</td>
        <td>tatjana.tamberg@tlu.ee</td>
        <td>A-441</td>
    </tr>
</table>

<br><br><br><br>

<?php require("footer.php");