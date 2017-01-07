


<html>
<head>   
</head>
<link href="calendar.css" type="text/css" rel="stylesheet" />
<body>

<input type="button" value="My profile" onclick="location='myprofile'" />
<br>
<a href="?logout=1"> Log out</a>

<?php
include '../class/Calendar.class.php';
 
$calendar = new Calendar();
 
echo $calendar->show();


?>
</body>

</html>  