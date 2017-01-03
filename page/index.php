<?php
    require("functions.php");
    require("../class/User.class.php");
    $User = new User($mysqli);

    // Kui on sisse loginud, siis suunan data lehele.
    if(isset($_SESSION["userEmail"])){
        header("Location: data.php");
        exit();
    }
?>




<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Sign-Up/Login Form</title>
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

    <link rel="stylesheet" href="../style_script/css/style.css">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">


    <!-- Font Awesome and Pixeden Icon Stroke icon fonts-->
    <link rel="stylesheet" href="../style_script/css/font-awesome.min.css">
    <link rel="stylesheet" href="../style_script/css/pe-icon-7-stroke.css">
    <!-- Google fonts - Roboto-->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,700">
    <!-- lightbox-->
    <link rel="stylesheet" href="../style_script/css/lightbox.min.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="../style_script/css/style.default.css" id="theme-stylesheet">
    <!-- Favicon-->
    <link rel="shortcut icon" href="../style_script/img/favicon.png">

    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  -->
</head>

<body>
<div class="jumbotron main-jumbotron">
    <div class="container">
        <div class="content">
            <link rel="stylesheet" href="../style_script/css/style.css">
            <h1><b>UNILIFE</b></h1>
            <div>
                <div class="form">

                    <ul class="tab-group">
                        <li class="tab active"><a href="#login">Logi sisse</a></li>
                        <li class="tab"><a href="#signup">Loo kasutaja</a></li>
                    </ul>



                    <div class="tab-content">
                        <div id="login">

                            <form action="login.php" method="post">

                                <div class="field-wrap">
                                    <label for="loginEmail">E-mail<span class="req">*</span></label>
                                    <input type="email" name="loginEmail" required autocomplete="off"/>
                                </div>

                                <div class="field-wrap">
                                    <label for="loginPassword">Parool<span class="req">*</span></label>
                                    <input type="password" name="loginPassword" autocomplete="off"/>
                                </div>

                                <button class="button button-block">Logi sisse</button>

                            </form>

                        </div>
                        <div id="signup">


                            <form action="login.php" method="post">



                                <div class="top-row">

                                    <div class="field-wrap">
                                        <label for="signupFirstname">Eesnimi<span class="req">*</span></label>
                                        <input type="text" name="signupFirstname" autocomplete="off" required/>
                                    </div>


                                    <div class="field-wrap">
                                        <label for="signupLastname">Perekonnanimi<span class="req">*</span></label>
                                        <input type="text" name="signupLastname" autocomplete="off" required/>
                                    </div>

                                </div>



                                <div class="field-wrap">
                                    <label for="signupEmail">E-mail<span class="req">*</span></label>
                                    <input type="email" name="signupEmail" autocomplete="off" required/>
                                </div>



                                <div class="field-wrap">
                                    <label for="signupPassword">Parool<span class="req">*</span></label>
                                    <input type="password" name="signupPassword" autocomplete="off" required/>
                                </div>


                                <button type="submit" class="button button-block">Loo kasutaja</button>

                            </form>

                        </div>



                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="../style_script/js/index.js"></script>
<script src="sweetalert-master/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="sweetalert-master/dist/sweetalert.css">
<?php
if(isset($_SESSION["madeaccount"]) && !empty($_SESSION["madeaccount"])){
    echo("<script>swal('Kasutaja loomine õnnestus.');</script>");
    $_SESSION["madeaccount"] = "";
}
if(isset($_SESSION["error"]) && !empty($_SESSION["error"])){
    $error = $_SESSION["error"];
    echo("<script>swal('$error')</script>");
    $_SESSION["error"] = "";
}
?>
</body>