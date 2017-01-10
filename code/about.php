	<!DOCTYPE HTML>
<link rel="stylesheet" href="pikaday.css">
<html>
	<head>
		<title>e-Diary | About Us</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<div class="inner">
					<a href="index.html" class="logo">e-Diary</a>
					<nav id="nav">
						<a href="login.php">Home</a>
						<a href="about.php">About</a>
					</nav>
				</div>
			</header>
			<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>

		<!-- Main -->
		<section id="banner">
				<div class="inner">
					<header class="major special">

<form method="POST">					
		<!-- One -->
			<section id="one">
				<div class="inner">
					<header>
					
						<h2>About us</h2>
					</header>
					<p><font color="white">Sign-Up for free and carry your e-diary everywhere you go! You can access to your scheduled tasks and contacts from computer, mobile and even from Smart-TV. You dont have to worry anymore by just remembering things what you need to do on next week or next month. You can simply add in e-Diary your scheduled tasks or contacts. Sign-Up for free and enjoy! Your Brain is not a trashcan! 
					Developer: Andry Zagars
					Estonia, Tallinn </font></p>
					<ul class="actions">

					</ul>
				</div>
			</section>

	
</form>



		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script src="moment.js"></script>
<script src="pikaday.js"></script>
<script>
    var picker = new Pikaday({
        field: document.getElementById('datepicker'),
        format: 'YYYY-MM-D',
        onSelect: function() {
            console.log(this.getMoment().format('Do MMMM YYYY'));
        }
    });
</script>