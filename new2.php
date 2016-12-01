<html>
<head>
<meta charset="UTF-8"> 
<title>
</title>
</head>
<body>
<form method="POST" action="new2.php">
<input type="text" name="Pole"> 
<input type="submit" name="button" value="OK">
</form>
<?php

/*
$k=1;
while($k<=5){
if($a==$k)
echo "<font color='green'>".$k." - СЛУЧАЙНОЕ ЧИСЛО </font><br>";
else 
echo $k."<br>";
$k++;
}*/
if(!empty($_POST['Pole']) && is_numeric($_POST['Pole'])){
echo $_POST['Pole']."<br><br>";
}
else
echo "Not correct!<br><br>";
$a=rand(1,5);
while($a==$_POST['Pole']){

}
for($i=1;$i<=5;$i++){

if ($a==$i){
	if ($_POST['Pole']==$a)
		echo "<font color='green'>".$i." - СЛУЧАЙНОЕ ЧИСЛО(верно) </font><br>";

	else 
	echo "<font color='green'>".$i." - СЛУЧАЙНОЕ ЧИСЛО </font><br>";
}
else 
if($_POST['Pole']==$i)
echo $i." - ВЫБРАННОЕ ЧИСЛО<br>";
else
echo $i."<br>";
}



?>
</body>
</html>