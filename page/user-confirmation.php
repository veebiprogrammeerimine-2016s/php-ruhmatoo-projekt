<html>
<body>
<?php
if(isset($_GET['id']) && isset($_GET['confirmation_code']) && isset($_GET['email']))
{
$id=$_GET['id'];
$code=$_GET['confirmation_code'];
$email=$_GET['email'];
$query=mysql_query("select * from user where id='$id' AND email='$email' AND confirm_id='$code' ");
$row=mysql_num_rows($query);
if($row == 1)
{
$query1=mysql_query("update user set verified='1' where id='$id' AND  email='$email' AND confirm_id='$code'");
if($query1)
{
echo "You have verified your mail ID";
}
}
}
?>
</body>
</html>