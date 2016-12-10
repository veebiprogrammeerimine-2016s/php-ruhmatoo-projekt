<!DOCTYPE html>
<html>
<head>

	
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	

<link rel="stylesheet" type="text/css" href="../page/style.css">



<script data-main="scripts/main" src="../page/java.js"></script>

<!----http://www.flowers-wallpapers.com/backgrounds/buckets-flowers-color-potted.jpg--->
</head>
<body background = "https://s-media-cache-ak0.pinimg.com/originals/9b/f3/c3/9bf3c3ea7184a7879c4c94efce4f11c9.jpg">

<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
	  
        <div  class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
           <a class="navbar-brand" href="login.php">
			FacePlänt
		  </a>
        </div>
		
        <div id="navbar"  class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li <?php if(isset($pageName) && $pageName == "care"){ echo "class='active'"; } ?> ><a href="<?php if(isset($pageName) && $pageName == "login"){ echo 'care.php'; } ?> <?php if(isset($pageName) && $pageName == "data"){ echo 'userCare.php'; } ?>">Taimehooldus<span class="sr-only"></span></a></li>
				<li><a href="#">Meist<span class="sr-only"></span></a></li>
			</ul>
            
            
		  <?php if(isset($pageName) && $pageName == "login"){ ?>
          <form class="navbar-form navbar-right" method="POST">
            <div class="form-group">
              <input type="text" name="signupEmail" placeholder="E-maili aadress" class="form-control" value="<?=$signupEmail;?>">
            </div>
            <div class="form-group">
              <input type="password" name="signupPassword" placeholder="Parool" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Logi sisse</button>
          </form>
		  <?php } ?>
            
            <?php if(isset($pageName) && $pageName == "care"){ ?>
          <form class="navbar-form navbar-right" method="POST">
            <div class="form-group">
              <input type="text" name="signupEmail" placeholder="E-maili aadress" class="form-control" value="<?=$signupEmail;?>">
            </div>
            <div class="form-group">
              <input type="password" name="signupPassword" placeholder="Parool" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Logi sisse</button>
          </form>
		  <?php } ?>
            
            
		   <?php if(isset($pageName) && $pageName == "data"){ ?>
		   <form id="logoutNavbar" class="navbar-form navbar-right">
				<a href="login.php">Logi välja</a>
			</form>	
		  <?php } ?>
            
            <?php if(isset($pageName) && $pageName == "userCare"){ ?>
		   <form id="logoutNavbar" class="navbar-form navbar-right">
				<a href="login.php">Logi välja</a>
			</form>	
		  <?php } ?>
        </div><!--/.navbar-collapse -->
   
    <!--<div id="logo" class="navbar-left" ">
      <a class="navbar-brand" href="login.php">FacePlänt</a>
    </div>
	<span class="menu-trigger">MENU</span>
    
    <div class="nav-menu">
      <ul class="clearfix">
        <li><a href="care.php">Taimehooldus<span class="sr-only"></span></a></li>
		<li><a href="#">Meist<span class="sr-only"></span></a></li>
        <div class="navbar-right"><li>	<form method=post class="colform">
                    <div class="form-group">
                        <input type="text" class="form-control" name="signupEmail" placeholder="E-maili aadress">
                    
                   
                        <input type="password" class="form-control" name="signupPassword" placeholder="Parool">
                    </div>
                    <button type="submit" class="btn btn-default">Logi sisse</button>
                <span class="sr-only"></form></li></div>
      </ul>
			
      
      
    </div><!-- /.navbar-collapse -->
	
  </div><!-- /.container-fluid -->
</nav>