<?php 
	
	require("../functions.php");
	
	//kui ei ole kasutaja id'd
	if (!isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: login.php");
		exit();
	}
	
	
	//kui on ?logout aadressireal siis login välja
	if (isset($_GET["logout"])) {
		
		session_destroy();
		header("Location: login.php");
		exit();
	}
	$animal = $Animal->getSingle($_GET["id"]);
	$id=$animal->id;
	$type=$animal->type;
	$name=$animal->name;
	$age=$animal->age;
	$url=$animal->url;
	$shelter=$animal->shelter;
?>
<?php require("../header.php"); ?>
<a href="animals.php">tagasi</a>

<body style='background-color:Silver'>
<h2>See <?php echo $type; ?> nimega <?php echo $name; ?> on absoluutselt imeline isend! </h2>
<img width="30%" src="<?php echo $url; ?>" alt="<?php echo $name; ?>";>
<br><br>
<h3>Tema praegune kodu on <?php echo $shelter; ?></h3>
<h3>Kui sa soovid seda looma nimega <?php echo $name; ?> rentida, siis vajuta nupule "Broneeri" </h3><br>
<a class='btn btn-default btn-sm' href='booking.php?id=<?php echo $id; ?>'><span class='glyphicon glyphicon'></span>Broneeri</a>

<?php require("../footer.php"); ?>