

<html>
<head>   
</head>
<link href="calendar.css" type="text/css" rel="stylesheet" />
<body>
<?php
include '../class/Calendar.class.php';
 
$calendar = new Calendar();
 
echo $calendar->show();
?>
</body>
</html>  