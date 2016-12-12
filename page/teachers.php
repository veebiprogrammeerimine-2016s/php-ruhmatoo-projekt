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
        <li class="current"><a href="teachers.php">Õpetajad</a></li>

    </ul>
</nav>

<div class="container">

    <p>
        <a href="?logout=1">Logi vÃ¤lja</a>
    </p>

</div>

<section>
    Õpetajad:
</section>

</body>
</html>
