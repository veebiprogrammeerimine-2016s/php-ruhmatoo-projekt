<?php

    require("functions.php");
    require("../class/User.class.php");

    $User = new User($mysqli);

    // Kui on sisse loginud, siis suunan data lehele.
    if(isset($_SESSION["userId"])){

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
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="../style_script/css/style.default.css" id="theme-stylesheet">

  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">

  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="../style_script/css/bootstrap.min.css">

  <!-- Google fonts - Roboto-->
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,700">

  <!-- lightbox-->
  <link rel="stylesheet" href="../style_script/css/lightbox.min.css">

  <!-- theme stylesheet-->
  <link rel="stylesheet" href="../style_script/css/style.blue.css" id="theme-stylesheet">

  <!-- Favicon-->
  <link rel="shortcut icon" href="../style_script/img/favicon.png">

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
              <li class="tab active"><a href="#signup">Loo kasutaja</a></li>
              <li class="tab"><a href="#login">Logi sisse</a></li>
            </ul>



            <div class="tab-content">
              <div id="signup">


                <form action="login.php" method="post" name="signupform" id="signupform" >



                    <div class="top-row">

                        <div class="field-wrap">
                            <label for="signupFirstname">Eesnimi<span class="req">*</span></label>
                            <input type="text" id="signupFirstname" name="signupFirstname" autocomplete="off"/>
                        </div>


                        <div class="field-wrap">
                            <label for="signupLastname">Perekonnanimi<span class="req">*</span></label>
                            <input type="text" id="signupLastname" name="signupLastname" autocomplete="off"/>
                        </div>

                    </div>



                    <div class="field-wrap">
                      <label for="signupEmail">E-mail<span class="req">*</span></label>
                      <input type="text" id="signupEmail" name="signupEmail" autocomplete="off"/>
                    </div>



                    <div class="field-wrap">
                      <label for="signupPassword">Parool<span class="req">*</span></label>
                      <input type="password" id="signupPassword" name="signupPassword" autocomplete="off"/>
                    </div>



                    <div class="field-wrap">
                      <label for="passwordAgain">Sisesta parool uuesti<span class="req">*</span></label>
                      <input type="password" id="passwordAgain" name="passwordAgain" autocomplete="off"/>
                    </div>

                    <button type="submit" class="button button-block">Loo kasutaja</button>

                </form>

                  <!--
                  <script type="text/javascript">

                      $("#signupform").validate({

                          rules: {
                              signupFirstname: {required: true},
                              signupLastname: {required: true},
                              signupEmail: {required: true, email: true},
                              signupPassword: {required: true},
                              passwordAgain: {required: true, equalTo: "#signupPassword"}

                          },

                          messages:{
                              signupFirstname: {required: "Palun sisestage eesnimi."},
                              signupLastname: {required: "Palun sisestage oma perekonnanimi."},
                              signupEmail: {required: "Palun sisestage oma email", email: "Palun sisestage korrektne email"},
                              signupPassword: {required: "Palun sisestage parool."},
                              passwordAgain: {required: "Sisestage kontroll parool", equalTo: "Paroolid ei ühti"}
                          }});

                  </script>
                  -->


              </div>

              <div id="login">

                <form action="login.php" method="post">

                  <div class="field-wrap">
                  <label for="loginEmail">
                    E-mail<span class="req">*</span>
                  </label>
                  <input type="email" name="loginEmail" id="loginEmail" required autocomplete="off"/>
                </div>

                <div class="field-wrap">
                  <label for="loginPassword">
                    Parool<span class="req">*</span>
                  </label>
                  <input type="password" name="loginPassword" id="loginPassword" autocomplete="off"/>
                </div>


                <button class="button button-block">Logi sisse</button>

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
</body>
</html>