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
	$s = $_GET["s"];
	
}

//require('styles.css'); ?>

<div class="row">
	<div class="col-md-5">
		<h1>NoTime2Spare</h1>
	</div>
	<div class="col-md-6" style="padding-top: 20px">
		<div class="input-group">
			<input type="search" name="s" value="<?=$s;?>"class="form-control" placeholder="Enter title, keywords etc...">
				<span class="input-group-btn">
					<button class="btn btn-info" type="submit">Search</button>
					<a class="btn btn-success" type="button" href="results.php?search=".$s>Search</a>
				</span>
		</div>
	</div>
</div>

</head>

<body style="background-color:darkgrey;">
<!-- Lõpu tag-id asuvad footeris!! -->