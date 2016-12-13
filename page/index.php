<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Sign-Up/Login Form</title>
  <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  
      <link rel="stylesheet" href="../style_script/css/style.css">

  
</head>

<body>
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
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="../style_script/js/index.js"></script>
</body>
</html>