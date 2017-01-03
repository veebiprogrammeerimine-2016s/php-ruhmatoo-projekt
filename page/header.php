<?php

require("functions.php");

if(!isset($_SESSION["userEmail"])){
    header("Location: login.php");
    exit();
}
if(isset($_GET["logout"])){
    session_destroy();
    header("Location: login.php");
    exit();
}

require("../class/Teacher.class.php");
require("../class/Lesson.class.php");
require("../class/Reading.class.php");
require("../class/Homework.class.php");

$Teacher = new Teacher($mysqli);
$allTeachers = $Teacher->get($_SESSION["userEmail"]);

$Lesson = new Lesson($mysqli);
$allLessons = $Lesson->get($_SESSION["userEmail"]);

$Reading = new Reading($mysqli);
$allReading = $Reading->get($_SESSION["userEmail"]);

$Homework = new Homework($mysqli);
$allHomework = $Homework->get($_SESSION["userEmail"]);


?>

<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Javascript files-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.js"></script>
    <script src="../style_script/js/jquery.cookie.js"></script>
    <script src="../style_script/js/bootstrap.min.js"></script>
    <script src="../style_script/js/lightbox.min.js"></script>
    <script src="../style_script/js/front.js"></script>

    <!-- Bootstrap Date-Picker Plugin -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UNILIFE</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="../style_script/css/bootstrap.min.css">
    <!-- Font Awesome and Pixeden Icon Stroke icon fonts-->
    <link rel="stylesheet" href="../style_script/css/font-awesome.min.css">
    <link rel="stylesheet" href="../style_script/css/pe-icon-7-stroke.css">
    <!-- Google fonts - Roboto-->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,700">
    <!-- lightbox-->
    <link rel="stylesheet" href="../style_script/css/lightbox.min.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="../style_script/css/style.blue.css" id="theme-stylesheet">
    <!-- Favicon-->
    <link rel="shortcut icon" href="../style_script/img/favicon.png">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<body>
<!-- navbar-->
<header class="header">
    <div role="navigation" class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header"><a href="data.php" class="navbar-brand">UNILIFE</a>
                <div class="navbar-buttons">
                    <button type="button" data-toggle="collapse" data-target=".navbar-collapse" class="navbar-toggle navbar-btn">Menüü<i class="fa fa-align-justify"></i></button>
                </div>
            </div>
            <div id="navigation" class="collapse navbar-collapse navbar-right">
                <ul class="nav navbar-nav">
                    <?=$Helper->returnActivePage(basename($_SERVER["SCRIPT_FILENAME"], '.php'));?>
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle">Materjalid <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="https://www.tlu.ee/asio/kalenterit2/index.php?guest=intranet/tu&lang=est">ASIO</a></li>
                            <li><a href="https://ois2.tlu.ee/tluois/uus_ois2.tud_leht">ÕIS2</a></li>
                            <li><a href="http://www.tlu.ee/et/Digitehnoloogiate-instituut/Oppetoo/Dokumendid">Juhendid</a></li>
                            <li class="dropdown-submenu"><a tabindex="-1" href="#" data-toggle="dropdown" class="dropdown-toggle" >Õpetajate lehed <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <?php
                                        $html = "";
                                        foreach($allTeachers as $teacher){
                                            $html .= "<li><a tabindex='-1' href='$teacher->material'>$teacher->name</a></li>";
                                        }
                                        echo($html);
                                    ?>

                                </ul>
                            </li>
                        </ul>
                    </li>

                </ul><a href="?logout=1" class="btn navbar-btn btn-ghost"><i class="fa fa-sign-out"></i>Logi välja</a>
            </div>
        </div>
    </div>
</header>