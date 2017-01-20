<?php
	
	require("../functions.php");
	//require("../class/Comment.class.php");
	
	$Upload = new Upload($mysqli);
	//kui ei ole kasutaja id'd
	
	if(!isset ($_SESSION["userId"])){
	
		//suunan sisselogimise lehele 
		header("Location: login2.php");
		exit();
		
	}

	//kui on ?logout aadressireal siis login välja
	if(isset($_GET["logout"])){
		session_destroy();
		header("Location: login2.php");
		exit();
	}
	
	//saan audio andmed
	$audioData = $Upload->getAudio();
	/*echo "<pre>";
	var_dump($audioData);	
	echo "</pre>";
	*/
	
?>



<head>
	<meta charset="utf-8">
	<title>Audify</title>
	<meta name="description" content="Audify">
	

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">


</head>

<header>

<body background="../images/background.jpg" />

	<nav class="navbar navbar-inverse navbar-static-top">
	  <div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="data.php"><img src="../images/audify_600x220.png" height="22px"/></a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		  <ul class="nav navbar-nav">
			<li>

				<a href="upload.php">Upload</a>
			
			</li>
		  </ul>
		  <form class="navbar-form navbar-left">
			<div class="form-group">
			  <input type="text" class="form-control" placeholder="Search">
			</div>
		  </form>
		  <ul class="nav navbar-nav navbar-right">
			
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$_SESSION["userEmail"];?><span class="caret"></span></a>
			  <ul class="dropdown-menu">
				<li><a href="user.php">User profile</a></li>
				<li><a href="settings.php">Settings</a></li>
				<li role="separator" class="divider"></li>
				<li><a href="?logout=1">Sign out</a></li>
			  </ul>
			</li>
		  </ul>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
	
	<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</header>


<body>

		<!--<div class="jumbotron">-->
			<div class="container">
				<center>
				<h1>Trackfeed</h1>
				<h4>Latest uploads from people<h4><br><br>
				</center>

			</div> 
		
<div id="feed" class="col-lg-8 col-sm-offset-2" style="background-color:rgba(0, 0, 0, 0.3)">

		<?php //displays waveform, song name(caption) and uploader(email)..
			foreach(glob('../uploads/*', GLOB_NOSORT) as $sound)   
			{  
				require('../script/wavesurf.php');
				foreach($audioData as $c){
					
					$html = "<table class='table table-hover table-bordered '>";
					$html .= "<tr>";
					$html .= "<td>".$c->caption."</td>"; 
					$html .= "<td align=right>".$c->email."</td>"; 	
					$html .= "</tr>";
					$html .= "</table>";
					echo $html;	
					
				}

				
				
			}  
		?>
		

</div>
		<!--</div> -->

</body>
<footer>
 
 <style>
 .social:hover {
      -webkit-transform: scale(0.7);
      -moz-transform: scale(0.7);
      -o-transform: scale(0.7);
  }
  .social {
      -webkit-transform: scale(0.7);
      /* Browser Variations: */
      
      -moz-transform: scale(0.7);
      -o-transform: scale(0.7);
      -webkit-transition-duration: 0.3s;
      -moz-transition-duration: 0.3s;
      -o-transition-duration: 0.3s;
  }
 
 /*
     Multicoloured Hover Variations
 */
  
  #social-fb:hover {
      color: #3B5998;
  }
  #social-tw:hover {
      color: #4099FF;
  }
  #social-gp:hover {
      color: #d34836;
  }
  #social-em:hover {
      color: #f39c12;
  }
  
  #feed{
	-moz-border-radius:10px;
	-webkit-border-radius:10px;
	padding-top:30px;
	padding-right:30px;
	padding-left:30px;
	height:250px;
}
  
 
 
 </style>
 
 <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
 
 <br />
 
 <nav class="navbar-xs navbar-inverse navbar-fixed-bottom">
       <div class="container">
         <div class="navbar-header">
           <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
             <span class="sr-only">Toggle navigation</span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
           </button>
 		  
         </div>
 		
 		
         <div id="navbar" class="collapse navbar-collapse">
           <ul class="nav navbar-nav">
 			<p class="navbar-text">© 2017 Audify Ltd.</p>
             <li><a href="#about">About</a></li>
 			
 	
 				<!-- // -->
 				<div class="navbar-header">
 					
 						<div class="text-center">
 							<br />
 								<a href="https://www.facebook.com/audify"><i id="social-fb" class="fa fa-facebook-square fa-3x social"></i></a>
 								<a href="https://twitter.com/audify"><i id="social-tw" class="fa fa-twitter-square fa-3x social"></i></a>
 								<a href="https://plus.google.com/+Audify"><i id="social-gp" class="fa fa-google-plus-square fa-3x social"></i></a>
 								<a href="mailto:info@audify.com"><i id="social-em" class="fa fa-envelope-square fa-3x social"></i></a>
 						</div>
 				</div>
 				
 				<br />
             
           </ul>
         </div><!--/.nav-collapse -->
       </div>
 </nav>
 
 </footer>



