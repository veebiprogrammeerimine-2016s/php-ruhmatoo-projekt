<!DOCTYPE html>
<html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>


<head>
<style>
.dropbtn {
    background-color: #FFFFFF;
    color: black;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
	font-family: 'Open Sans', sans-serif;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #ffffff;
    min-width: 160px;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
    background-color: #f1f1f1;
}
</style>
</head>
<body>
<div class="container-fluid">
<div class="row">
  <div class="col-sm-4"></div>
  <div class="col-sm-4"></div>
  <div align="right">
  <div class="col-sm-4">
		<a href="signup.php" class="dropbtn">Sign up</a>
	</div>
</div>
</div>
<div class="container-fluid">
<div class="row">
<div class="col-sm-4">
	<img src="../Trifuse.png">
</div>
<div align="center">
<div class="col-sm-4">
	<div class="dropdown"> 
	  <button href="home.php" class="dropbtn">Home</button>
	</div>

<div class="dropdown">
  <button class="dropbtn">Pictures</button>
  <div class="dropdown-content">
    <a href="pictures_nature.php">Nature</a>
    <a href="pictures_arts.php">Arts</a>
  </div>
</div>

<div class="dropdown">
  <button class="dropbtn">Gifs</button>
  <div class="dropdown-content">
    <a href="gifs_nature.php">Nature</a>
    <a href="gifs_arts.php">Arts</a>
  </div>
</div>

<div class="dropdown">
  <button class="dropbtn">Videos</button>
  <div class="dropdown-content">
    <a href="videos_nature.php">Nature</a>
    <a href="videos_arts.php">Arts</a>
  </div>
</div>

<div class="dropdown">
  <button class="dropbtn">Sounds</button>
  <div class="dropdown-content">
    <a href="sounds_nature.php">Nature</a>
    <a href="sounds_arts.php">Arts</a>
  </div>
 </div>

<div class="col-sm-4"></div>
</div>
</div>
</div>
</div>
</div>
</body>
</html>