<?php 
	if($_GET['logout']==1){
		$_SESSION['login']= "";
	}
	if($_POST['username']=='admin' && $_POST['psw']=='12345'){
	$_SESSION['login']= "OK";
		echo "Correct!<br>";
		}
	else 
	if(isset($_POST['psw']))
		echo "Passord error!";

if(	$_SESSION['login'] == "OK"){
echo "Hello admin!";
echo "<form method='post' action='index.php?p=admin&logout=1'>";
echo "<input type='submit' value='Log out'>";
echo "</form>";}

else{
echo '<form method="post" action="index.php?p=admin">';
echo '<input type="text" value="admin" name="username"><br>';
echo '<input type="password" value="12345" name="psw"><br>';
echo '<input type="submit" value="Log in">';
echo '</form>';}
?>