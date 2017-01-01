<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Javascript files-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../style_script/js/jquery.cookie.js"></script>
    <script src="../style_script/js/bootstrap.min.js"></script>
    <script src="../style_script/js/lightbox.min.js"></script>
    <script src="../style_script/js/front.js"></script>
    <script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.js"></script>

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



    <!-- Bootstrap Date-Picker Plugin -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>



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
                    <li class="active"><a href="homework.php">Kodutööd</a></li>
                    <li><a href="compulsory_literature.php">Kohustuslik kirjandus</a></li>
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