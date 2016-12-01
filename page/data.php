<?php

require("../functions.php");

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
    <title>Navigation</title>
    <link rel="stylesheet" href="../css/navigationstyle.css">
</head>
<body>
    <header>
        <h1> UNILIFE </h1>
    </header>
    <nav>
        <ul>
            <a href="#"><li>Kodut��d</li></a>
            <a href="#"><li>Kohustuslik kirjandus</li></a>
            <a href="#"><li>Tunniplaan</li></a>
            <a href="#"><li>�petajad</li></a>
        </ul>
    </nav>

    <div class="container">
        
        <p>
            Tere tulemast <a href="user.php"><?=$_SESSION["userEmail"];?>!</a>
            <br>
            <a href="?logout=1">Logi vÃ¤lja</a>
        </p>

    </div>

    <section>
        siia tulevad tabelid ja muud asjad
    </section>

</body>
</html>

