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


<!DOCTYPE html>
<html lang="en">
<head>
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
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
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
                    <li><a href="data.php">Kodu</a></li>
                    <li><a href="timetable.php">Tunniplaan</a></li>
                    <li><a href="homework.php">Kodutööd</a></li>
                    <li class="active"><a href="compulsory_literature.php">Kohustuslik kirjandus</a></li>
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle">Materjalid <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="https://www.tlu.ee/asio/kalenterit2/index.php?guest=intranet/tu&lang=est">ASIO</a></li>
                            <li><a href="https://ois2.tlu.ee/tluois/uus_ois2.tud_leht">ÕIS2</a></li>
                            <li><a href="http://www.tlu.ee/et/Digitehnoloogiate-instituut/Oppetoo/Dokumendid">Juhendid</a></li>
                            <li class="dropdown-submenu"><a tabindex="-1" href="#" data-toggle="dropdown" class="dropdown-toggle" >Õpetajate lehed <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="http://www.cs.tlu.ee/IFI6209/">Tanel Toova</a></li>
                                    <li><a tabindex="-1" href="https://github.com/romilrobtsenkov">Romil Rõbtšenkov</a></li>
                                    <li><a tabindex="-1" href="http://www.cs.tlu.ee/~inga/progbaas/">Inga Petuhhov</a></li>
                                    <li><a tabindex="-1" href="http://minitorn.tlu.ee/~jaagup/kool/java/">Jaagup Kippar</a></li>
                                    <li><a tabindex="-1" href="http://www.tlu.ee/~kivik/">Kalle Kivi</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="teachers.php">Kontaktid</a></li>
                </ul><a href="?logout=1" data-toggle="modal" data-target="#login-modal" class="btn navbar-btn btn-ghost"><i class="fa fa-sign-out"></i>Logi välja</a>
            </div>
        </div>
    </div>
</header>

<section class="background-gray-lightest">
    <div class="container">
        <div class="breadcrumbs">
            <ul class="breadcrumb">
                <li><a href="data.php">Kodu</a></li>
                <li>Kohustuslik kirjandus</li>
            </ul>
        </div>
        <h1 class="heading">Kohustuslik kirjandus</h1>
        <p class="lead">Võibolla lisada mingi tekst</p>
    </div>
</section>

<footer class="footer">
    <div class="footer__block">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <h4 class="heading">Mingi tekst</h4>
                    <p>Tekst, tekst</p>
                    <p>Tekst, tekst</p>
                </div>
                <div class="col-md-4 col-sm-12">
                    <h4 class="heading">Kontaktid</h4>
                    <h5>Tallinna Ülikool</h5>
                    <p> Narva mnt 25<br />10120 Tallinn<br />+372 6409101</p>
                    <p> <a href="mailto:tlu@tlu.ee">tlu@tlu.ee</a></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <h4 class="heading">Tekst</h4>
                    <ul>
                        <li><a href="category.html">tekst</a></li>
                        <li><a href="category.html">tekst</a></li>
                        <li><a href="category.html">tekst</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-6">
                    <h4 class="heading">Liitu meiega</h4>
                    <p class="social social--big"><a href="https://www.facebook.com/groups/420958561444474/?ref=bookmarks" data-animate-hover="pulse" class="external facebook"><i class="fa fa-facebook"></i></a><a href="https://twitter.com/tallinnaylikool" data-animate-hover="pulse" class="external twitter"><i class="fa fa-twitter"></i></a><a href="https://www.flickr.com/photos/tallinnuniversity/sets/" data-animate-hover="pulse" class="external flickr"><i class="fa fa-flickr"></i></a></p>
                </div>
                <div class="col-md-4 col-sm-12">
                    <h4 class="heading">Uudised</h4>
                    <p>Liitu uudiskirjaga ja saad esimesena teada uutest postitustest ja uudistest.</p>
                    <form class="footer__newsletter">
                        <div class="input-group">
                            <input type="text" placeholder="Palun sisesta siia oma e-maili aadress." class="form-control"><span class="input-group-btn">
                    <button type="button" class="btn btn-default"><i class="fa fa-send"></i></button></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="footer__copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>&copy;2017 </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Javascript files-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></>
<script src="../style_script/js/bootstrap.min.js"></>
<script src="../style_script/js/jquery.cookie.js"> </>
    <script src="../style_script/js/lightbox.min.js"></>
        <script src="../style_script/js/front.js"></>

        </body>
        </html>