<html>

<title>NoTime2Spare</title>

<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<?php 
$s = "";

if(isset($_GET["s"])){
	$s = rawurldecode($_GET["s"]);
	//var_dump($_GET["s"]);
	//var_dump($s);
	
}

//require('styles.css'); ?>

<div class="row">
	<div class="col-md-5">
		<h1>NoTime2Spare</h1>
	</div>
	<div class="col-md-6" style="padding-top: 20px">
		<form method='GET' action='results.php'>
			<input type="search" name="s" value="<?=$s;?>" placeholder="Enter keywords...">
			<button class="btn btn-md btn-info" type="submit" onclick="location.href='results.php';">Search</button>
		</form>		
	</div>
</div>
<script>
function relocate_home()
{
     location.href = "www.yoursite.com";
} 
</script>

</head>

<body style="background-image: url('../448.jpg');">