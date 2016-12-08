<?php

function logIn($user, $pass) {
	echo "Starting log in.";
	echo "Done.";
	
	session_register("user");
	$_SESSION['login_user'] = $user;
	
}

?>
