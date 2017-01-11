<?php require("../header.php"); ?>
<?php
$conn = mysql_connect("localhost", "if16", "ifikad16");
mysql_select_db("if16_gerltoom");
$sql = "SELECT imageId FROM pictures_animals_output_images ORDER BY imageId DESC"; 
$result = mysql_query($sql);
?>
<HTML>
<HEAD>
<TITLE>List BLOB Images</TITLE>
<link href="imageStyles.css" rel="stylesheet" type="text/css" />
</HEAD>
<BODY>

<div class="row">
	<div align="center">
		<?php
		while($row = mysql_fetch_array($result)) {
		?>
		<br><img style="max-height:500px" src="pictures_animals_imageView.php?image_id=<?php echo $row["imageId"]; ?>" /><br>
		<?php		
		}
		mysql_close($conn);
		?>
	</div>
</div>
</BODY>
</HTML>
