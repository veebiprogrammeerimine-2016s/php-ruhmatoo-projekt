<?php 
	session_start();
?>
<!DOCTYPE html> 
<html> 
<head> 
	<meta charset="UTF-8"> 
	<title>Home Page</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
			<link rel="stylesheet" href="colorbox.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="jquery.colorbox.js"></script>
		<script>
			$(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				$(".group1").colorbox({rel:'group1'});
				$(".group2").colorbox({rel:'group2', transition:"fade"});
				$(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
				$(".group4").colorbox({rel:'group4', slideshow:true});
				$(".ajax").colorbox();
				$(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
				$(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
				$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
				$(".inline").colorbox({inline:true, width:"50%"});
				$(".callbacks").colorbox({
					onOpen:function(){ alert('onOpen: colorbox is about to open'); },
					onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
					onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
					onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
					onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
				});

				$('.non-retina').colorbox({rel:'group5', transition:'none'})
				$('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
				
				//Example of preserving a JavaScript event for inline calls.
				$("#click").click(function(){ 
					$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
			});
		</script>
</head> 
<body> 
<div id="wrapper">  

	<div id="header">
	</div>  

	<div id="container" >  

		<div id="content">  
			<div id="text">
			
				<?php
					if($_GET['p']=="1"){
						require "home.php";
					}
					if($_GET['p']=="2"){
						require('photos.php');
					}
					if($_GET['p']=="3"){
						require('video.php');
					}
					/*
					if($_GET['p']=="4" && !isset($_GET['g'])){
						require('g.php');
					}
					*/
					/*if($_GET['p']=="5"){
						require(".../in_progress/page/login.php");
					}*/
					if(!isset($_GET['p'])){
						require "home.php";
					}
					if($_GET['p']>5){
						require "home.php";
					}
					/*
					if($_GET['g']==1 && $_GET['p']==4)
						require "g1.php";
					if($_GET['g']==2 && $_GET['p']==4)
						require "g2.php";
					*/
					if($_GET['p']=="admin"){
						require "admin.php";
						}
				?>
				
				
			</div>

		</div>  

		<div id="left">
			<div class="buttons">
				<a href="index.php?p=1"><div class="b_home"></div></a>
				<a href="index.php?p=2"><div class="b_photos"></div></a>
				<a href="index.php?p=3"><div class="b_videos"></div></a>
				<a href="index.php?p=4"><div class="b_games"></div></a>
				<a href="index.php?p=5"><div class="b_contact"></div></a>
			</div>
			
			
		</div>  

		
	</div>  

	<div id="footer">
	</div>  

</div>
</body> 
</html>
