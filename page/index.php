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
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="../style_script/css/custom.css">
  <!-- Favicon-->
  <link rel="shortcut icon" href="../style_script/img/favicon.png">
  <!-- Tweaks for older IEs--><!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>
<div class="jumbotron main-jumbotron">
  <div class="container">
    <div class="content">
      <link rel="stylesheet" href="../style_script/css/style.css">
      <h1><b>This is UNILIFE</b></h1>
      <div>
        <div class="form">

            <ul class="tab-group">
              <li class="tab active"><a href="#signup">Loo kasutaja</a></li>
              <li class="tab"><a href="#login">Logi sisse</a></li>
            </ul>



            <div class="tab-content">
              <div id="signup">


                <form action="login.php" method="post">



                <div class="top-row">
                  <div class="field-wrap">
                    <label>
                      Eesnimi<span class="req">*</span>
                    </label>
                    <input type="text" name="signupFirstname" required autocomplete="off" />
                  </div>

                  <div class="field-wrap">
                    <label>
                      Perekonnanimi<span class="req">*</span>
                    </label>
                    <input type="text" name="signupLastname" required autocomplete="off"/>

                  </div>
                </div>



                <div class="field-wrap">
                  <label>
                    E-mail<span class="req">*</span>
                  </label>
                  <input type="email" name="signupEmail" required autocomplete="off"/>
                </div>



                <div class="field-wrap">
                  <label>
                    Parool<span class="req">*</span>
                  </label>
                  <input type="password" name="signupPassword" required autocomplete="off"/>
                </div>



                <div class="field-wrap">
                  <label>
                    Sisesta parool uuesti<span class="req">*</span>
                  </label>
                  <input type="password" required autocomplete="off"/>
                </div>

                <button type="submit" class="button button-block"/>Loo kasutaja</button>

                </form>



              </div>

              <div id="login">

                <form action="login.php" method="post">

                  <div class="field-wrap">
                  <label>
                    E-mail<span class="req">*</span>
                  </label>
                  <input type="email" name="loginEmail" required autocomplete="off"/>
                </div>

                <div class="field-wrap">
                  <label>
                    Parool<span class="req">*</span>
                  </label>
                  <input type="password" name="loginPassword" required autocomplete="off"/>
                </div>

                <p class="forgot"><a href="#">Unustasid parooli?</a></p>

                <button class="button button-block"/>Logi sisse</button>

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