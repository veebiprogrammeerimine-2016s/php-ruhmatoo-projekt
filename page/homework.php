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

<section class="background-gray-lightest">
    <div class="container">
        <div class="breadcrumbs">
            <ul class="breadcrumb">
                <li><a href="data.php">Kodu</a></li>
                <li>Kodutööd</li>
            </ul>
        </div>



        <h1 class="heading">Kodutööd</h1>
        <form class="form-horizontal" method="post" id="homeworkform">
            <fieldset>

                <!-- Form Name -->
                <legend>Kodutööd</legend>


                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="homeworkDescription">Kirjeldus(*)</label>
                    <div class="col-md-4">
                        <input name="homeworkDescription" id="homeworkDescription" type="text" placeholder="Lisa siia lühike kirjeldus" class="form-control input-md">

                    </div>
                </div>


                <!-- Select Basic -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="selectbasic">Klass(*)</label>
                    <div class="col-md-4">
                        <select name="homeworkClass" class="form-control">
                            <option value="Õppimine kõrgkoolis">Õppimine kõrgkoolis</option>
                            <option value="Veebiprogammeerimine">Veebiprogammeerimine</option>
                            <option value="Diskreetsed struktuurid">Diskreetsed struktuurid</option>
                            <option value="Programmeerimise alused">Programmeerimise alused</option>
                        </select>
                    </div>
                </div>


                <!-- Select Basic -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="selectbasic">Tüüp(*)</label>
                    <div class="col-md-4">
                        <select name="homeworkType" class="form-control">
                            <option value="Kodutöö">Kodutöö</option>
                            <option value="Eksam">Eksam</option>
                            <option value="Essee">Essee</option>
                            <option value="Esitlus">Esitlus</option>
                            <option value="Rühmatöö">Rühmatöö</option>
                            <option value="Kontrolltöö">Kontrolltöö</option>
                        </select>
                    </div>
                </div>


                <!-- Select Basic -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="selectbasic">Prioriteet(*)</label>
                    <div class="col-md-4">
                        <select name="homeworkPriority" class="form-control">
                            <option value="Tähtis">Tähtis</option>
                            <option value="Mitte-tähtis">Mitte-tähtis</option>
                            <option value="Meh">Meh</option>
                        </select>
                    </div>
                </div>


                <!-- Date -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="date">Tähtaeg(*)</label>
                    <div class="col-md-4">
                        <input class="form-control" id="date" name="date" placeholder="DD/MM/YYY" type="text"/>
                    </div>
                </div>


                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="singlebutton"></label>
                    <div class="col-md-4">
                        <button class="btn btn-primary" name="sendHomework" type="submit">Salvesta</button>
                    </div>
                </div>


                    <script>
                        $(document).ready(function(){
                            var date_input=$('input[name="date"]'); //our date input has the name "date"
                            var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
                            date_input.datepicker({
                                format: 'dd/mm/yyyy',
                                container: container,
                                todayHighlight: true,
                                autoclose: true,
                                startDate: new Date()
                            })
                        })
                    </script>




            </fieldset>
        </form>

        <script>

            $("#homeworkform").validate({

                debug: true,
                rules: {
                    homeworkDescription: {required: true, minlength: 5},
                    date: {required: true, date: true}},

                messages:{
                    homeworkDescription: {required: "Palun sisesta mingi kirjeldus.", minlength: "Palun sisestage midagi sisukamat."},
                    date: {required: "Palun sisestage tähtaeg."}}
            });

        </script>

        <form class="form-horizontal" method="post" id="readingform">
            <fieldset>

                <!-- Form Name -->
                <legend>Kohustuslik kirjandus</legend>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="bookname">Raamatu nimi(*)</label>
                    <div class="col-md-4">
                        <input id="bookname" name="bookname" type="text" placeholder="" class="form-control input-md">

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="bookauthor">Autor(*)</label>
                    <div class="col-md-4">
                        <input id="bookauthor" name="bookauthor" type="text" placeholder="" class="form-control input-md">

                    </div>
                </div>

                <!-- Select Basic -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="bookclass">Õppeaine(*)</label>
                    <div class="col-md-4">
                        <select id="bookclass" name="bookclass" class="form-control">
                            <option value="1">Õppimine kõrgkoolis</option>
                            <option value="2">Veebiprogrammeerimine</option>
                            <option value="3">Bla bla</option>
                            <option value="4">Dla dla</option>
                        </select>
                    </div>
                </div>

                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="singlebutton"></label>
                    <div class="col-md-4">
                        <button class="btn btn-primary" type="submit">Salvesta</button>
                    </div>
                </div>

            </fieldset>
        </form>

        <script>

            $("#readingform").validate({

                debug: true,
                rules: {
                    bookname: {required: true},
                    bookauthor: {required: true}},

                messages:{
                    bookname: {required: "Palun sisestage raamatu nimi."},
                    bookauthor: {required: "Palun sisestage raamatu autor."}}
            });

        </script>

        <form class="form-horizontal" method="post" id="teacherform" name="teacherform">
            <fieldset>

                <!-- Form Name -->
                <legend>Õpetajad</legend>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="teacher">Nimi(*)</label>
                    <div class="col-md-4">
                        <input id="teacher" name="teacher" type="text" class="form-control input-md" >
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="roomnumber">Ruuminumber(*)</label>
                    <div class="col-md-4">
                        <input id="roomnumber" name="roomnumber" placeholder="(T302)" type="text" class="form-control input-md" >

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="email">Email(*)</label>
                    <div class="col-md-4">
                        <input id="email" name="email" type="text" placeholder="(keegi.õppejõud@tlu.ee)" class="form-control input-md" >

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="material">Kodulehe aadress</label>
                    <div class="col-md-4">
                        <input id="material" name="material" placeholder="(http://www.mingisait.tlu.ee)" type="text" class="form-control input-md">
                    </div>
                </div>

                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for=""></label>
                    <div class="col-md-4">
                        <button class="btn btn-primary" name="sendTeacher" type="submit">Salvesta</button>
                    </div>
                </div>

            </fieldset>
        </form>


        <script>

            $("#teacherform").validate({

                rules: {
                    teacher: {required: true},
                    roomnumber: {required: true},
                    email: {required: true, email: true},
                    material: {url: true}},

                messages:{
                    teacher: {required: "Palun sisestage õpetaja nimi."},
                    bookauthor: {required: "Palun sisestage õppejõu ametiruum."},
                    email: {required: "Palun sisestage õppejõu email", email: "Palun sisestage korrektne email"},
                    material: {url: "Palun sisestage korrektne http link."}
            }});

        </script>



        <form class="form-horizontal" method="post" id="classform" name="classform">
            <fieldset>

                <!-- Form Name -->
                <legend>Õppeaine</legend>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="classname">Nimi(*)</label>
                    <div class="col-md-4">
                        <input id="classname" name="classname" type="text" placeholder="(Andmebaaside programmeerimine)" class="form-control input-md" >

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="classcode">Ainekood(*)</label>
                    <div class="col-md-4">
                        <input id="classcode" name="classcode" placeholder="(IFI6013.DT)" type="text" class="form-control input-md">
                    </div>
                </div>

                <!-- Select Basic -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="classteacher">Õpetaja(*)</label>
                    <div class="col-md-4">
                        <select id="classteacher" name="classteacher" class="form-control">
                            <option value="1">Romil Robtšenkov</option>
                            <option value="2">Tanel Toova</option>
                        </select>
                    </div>
                </div>



                <!-- Button -->
                <div class="form-group">
                    <div class="col-md-4">
                        <button class="btn btn-primary" name="sendClass" type="submit">Salvesta</button>
                    </div>
                </div>

            </fieldset>
        </form>

        <script>

            $("#classform").validate({

                rules: {
                    classname: {required: true},
                    classcode: {required: true}},

                messages:{
                    classname: {required: "Palun sisestage õppeaine nimi."},
                    classcode: {required: "Palun sisestage ainekood."}
                }});

        </script>


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

</body>
</html>