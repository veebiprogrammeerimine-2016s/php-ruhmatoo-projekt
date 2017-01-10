	<?php
		require("functions.php");
		if(isset($_POST["update"])){
			
			update(cleanInput($_POST["id"]), cleanInput($_POST["contact"]));
			
			header("Location: editcontact.php?id=".$_POST["id"]."&success=true");
			exit();	
			
		}
		
		//kustutan
		elseif(isset($_POST["delete"])){
			deletetask ($_POST["id"]);
		header("Location: user.php");
		exit();
	}
		
		// kui ei ole id'd aadressireal siis suunan
		if(!isset($_GET["id"])){
			header("Location: user.php");
			exit();
		}	
		$s = getSingleContact($_GET["id"]);
		
	?>
<h1><a href="about.php"> About</a><a href="data.php"> Home</a> <a href="user.php"> Contacts</a> <?=$_SESSION["userEmail"];?>!</a>
	<a href="?logout=1">Logout</a></h1>

	<h2><a href="user.php"> Back </a> Change </h2>
	 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
				<input type="hidden" name="id" value="<?=$_GET["id"];?>" > 
				<label>Contact</label><br>
				<input name="contact" type="text" value="<?=$s->contact;?>">
				<br>			
				<input a href="user.php" type="submit" name="update" value="Save">
				<input type="submit" name="delete" value="Delete">
	</form>
	  
<head>
<link rel="stylesheet" href="pikaday.css">
<link rel="stylesheet" href="site.css">
<link rel="stylesheet" href="theme.css">
<link rel="stylesheet" href="triangle.css">
</head>

