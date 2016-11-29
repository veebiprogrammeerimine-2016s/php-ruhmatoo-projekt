<?php
require("../../config.php");
require("functions.php");

if (isset($_SESSION["userId"])) {
    //suunan sisselogimise lehele
    header("Location: data.php");


    exit();
}
if (isset($_POST["regPassword"]) && isset($_POST["regUsername"])) {
    if (!empty($_POST["regPassword"]) && !empty($_POST["regUsername"])) {

        signUP($_POST["regUsername"], $_POST["regPassword"]);

        ?>
        <script>alert("Kasutaja on tehtud!");</script>
        <?php

    }

}

if (isset($_POST["username"]) && isset($_POST["password"])) {

    login($_POST["username"], $_POST["password"]);
    if (!isset($_SESSION["userId"])) {
        ?>
        <script> alert("Vale parool või kasutaja nimi"); </script> <?php
    }

}
$tyreFittings = getAllTyreFittings();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Rehvivahetus Online</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css"
          integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd"
          crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body id="home" data-spy="scroll" data-targer=".navbar" data-offset="200"> <!-- !!!! -->
<!-- navbar -->
<nav class="navbar navbar-fixed-top navbar-dark bg-primary">
    <div class="">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#home">Esileht <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#about">Meist</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#tirechanger">Rehvitöökoda</a>
            </li>
        </ul>
        <a class="navbar-brand pull-sm-right m-r-0 hidden-sm-down" href="http://www.tlu.ee">Presented by TLÜ
            team</a>
        <ul class="nav navbar-nav ">
            <li class="nav-item pull-xs-right mrg">
                <a class="nav-link" data-toggle="modal" data-target="#login" style="cursor:pointer">Logi sisse</a>
            </li>
        </ul>
    </div>
</nav>
<!-- /navbar-->
<!-- jumbotron -->

<div class="jumbotron jumbotron-fluid bg-info">
    <div class="container text-sm-center p-t-3">
        <h1 class="display-2 hidden-xs-down">Rehvivahetus Online</h1>
        <h1 class="hidden-sm-up">Rehvivahetus Online</h1>
        <p class="lead">Me tahame, et Sinu rehvid oleksid kindlalt auto all</p>
        <div class="btn-group m-t-2" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#register">Liitu
                Meiega
            </button>
            <a class="btn btn-secondary btn-lg" href="#tirechanger">Tutvu Partneritega</a>

        </div>
    </div>

</div>

<!-- /jumbotron-->
<div class="container p-t-2">
    <!-- about -->
    <div id="about" class="row">

        <div class="col-lg-4 col-lg-push-4">
            <h3 class="m-b-2">Meie Partnerid</h3>
            <p>Meie valitud ja kõrgelt hinnatud partnerid on kahtlemata oma ala professionaalid ning pakuvad meile
                ning ka teile ainult parimat ja kvaliteetsemat teenust.</p>

        </div>
        <div class="col-lg-4 col-lg-pull-4">
            <h3 class="m-b-2">Rehvivahetus Online</h3>
            <p>Esimene keskkond, kes pakub broneerida rehvivahetus erinevates kohtades!</p>
            <p>Pakume klientidele kõiki rehvivahetusega seotuid teenuseid.</p>
        </div>
        <div class="col-lg-4">
            <h3 class="m-b-2">Miks valida meid?</h3>
            <div class="list-group">
                <a class="list-group-item"><strong>Asukoht</strong>: Kõik on ühes kohas</a>
                <a class="list-group-item"><strong>Hind</strong>: Vali endale parem hind </a>
                <a class="list-group-item"><strong>Partnerid</strong>: Ainult paremad rehvitöökodat</a>
                <a class="list-group-item"><strong>Järjekord</strong>: Sa ei pea ootama. Vali endale sobiv aeg ja
                    koht</a>
            </div>
        </div>
    </div> <!-- /about -->

    <!-- speakers -->
    <div class="container">
        <h1 id="tirechanger" class="display-4 text-xs-center m-y-3 text-muted hidden-xs-down">Rehvitöökoda</h1>
        <h1 id="tirechanger" class="text-xs-center m-y-3 text-muted hidden-sm-up">Rehvitöökoda</h1>
        <div class="row">

            <?php
            $html = "";
            foreach ($tyreFittings as $tyreFitting) {
                $html .= "<div class='col-md-6 col-lg-4'>";
                $html .= "<div class='card'>";
                $html .= "<img class='card-img-top img-fluid' src='" . $tyreFitting->logo . "' alt='Partneri logo'>";
                $html .= "<div class='card-block'>";
                $html .= "<h4 class='card-title'>" . $tyreFitting->name . "</h4>";
                $html .= "<p class='card-text'>" . $tyreFitting->description . "...</p>";
                $html .= "<a href='details.php?id=" . $tyreFitting->id . "' class='btn btn-primary'>Tutvu lähemalt</a>";
                $html .= "</div>";
                $html .= "</div>";
                $html .= "</div>";

            }

            echo $html;
            ?>
        </div><!-- /speakers -->
    </div>

    <!-- callout button-->
    <button type="button" class="btn btn-info-outline btn-lg center-block m-y-3" data-toggle="modal"
            data-target="#register">Ära oota. Hakka Partneriks!
    </button>
    <!-- /callout button-->
    <!-- signup form -->
    <?php
    require("modals.php");
    require("footer.php");
    ?>
    <!-- jQuery first, then bootstrap js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js"
            integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7"
            crossorigin="anonymous"></script>
    <!-- our scripts -->
    <script type="text/javascript" src="js/sc.js"></script>
</div>
</body>
</html>
