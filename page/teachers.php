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

<!doctype html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Õpetajad</title>
	<link rel="stylesheet" href="../style_script/css/navigationstyle.css">
</head>
<body bgcolor = "#efe3eb">
<header>
    <h1> UNILIFE </h1>
</header>
<nav>
    <ul>
        <li><a href="data.php">Kodutööd</a></li>
        <li><a href="compulsory_literature.php">Kohustuslik kirjandus</a></li>
        <li><a href="timetable.php">Tunniplaan</a></li>
        <li class="current"><a href="teachers.php">Õppejõud</a></li>

    </ul>
</nav>

<div class="container">

    <p>
        <a href="?logout=1">Logi vÃ¤lja</a>
    </p>

</div>


<table align="center" border="4" style="border:#d08fe8 4px solid">

    <tr>
        <th>Nimi</th>
        <th>Amet</th>
        <th>Aine</th>
        <th>Kontaktid</th>
        <th>Ruum</th>
        <th>Materjalid</th>
    </tr>
    <tr>
        <td>Romil Rõbtsenkov</td>
        <td>Tarkvaratehnika õpetaja</td>
        <td>Veebiprogrammeerimine</td>
        <td>romil.robtsenkov@tlu.ee</td>
        <td>A-430</td>
        <td>github.com/veebiprogrammeerimine-2016s</td>
    </tr>
    <tr>
        <td>Jaagup Kippar</td>
        <td>Tarkvaratehnika lektor</td>
        <td>Andmebaaside projekteerimine</td>
        <td>jaagup.kippar@tlu.ee</td>
        <td>A-426</td>
        <td>minitorn.tlu.ee/~jaagup/kool/java/</td>
    </tr>
    <tr>
        <td>Inga Petuhhov</td>
        <td>Tarkvaratehnika õpetaja</td>
        <td>Programmeerimise alused</td>
        <td>inga.petuhhov@tlu.ee</td>
        <td>A-427</td>
        <td>cs.tlu.ee/~inga/progbaas/</td>
    </tr>
    <tr>
        <td>Tanel Toova</td>
        <td>Süsteemiadministraator</td>
        <td>Operatsioonisüsteemide alused</td>
        <td>tanel.toova@tlu.ee</td>
        <td>A-432</td>
        <td>cs.tlu.ee/IFI6209</td>
    </tr>
    <tr>
        <td>Tatjana Tamberg</td>
        <td>Matemaatika dotsent</td>
        <td>Diskreetsed struktuurid</td>
        <td>tatjana.tamberg@tlu.ee</td>
        <td>A-441</td>
        <td>Õisis</td>
    </tr>
</table>

</body>
</html>
