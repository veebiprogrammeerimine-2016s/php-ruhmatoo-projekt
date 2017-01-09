<?php
require("../functions.php");
require("../class/User.class.php");
$User = new User($mysqli);

require("../class/Helper.class.php");
$Helper = new Helper();

// If active session found
if (isset($_SESSION["userId"])) {
    header("Location: addhomework.php");
    exit();
}

// Login
$error = "";
if (isset($_POST["loginEmail"]) && isset($_POST["loginPassword"]) && !empty($_POST["loginPassword"]) && !empty($_POST["loginEmail"])) {
    $error = $User->login($Helper->cleanInput($_POST["loginEmail"]), $Helper->cleanInput($_POST["loginPassword"]));
}

?>

<?php require "../parts/header.php"; ?>

<div class="container">
    <!-- Signin -->
    <form method="POST" class="form-signin">
        <h2 class="form-signin-heading">Lõpuboss</h2>
        <p style="color:red;"><?= $error; ?></p> <!-- if error -->

        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus
               name="loginEmail">

        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Parool" required
               name="loginPassword">

        <button class="btn btn-lg btn-primary btn-block" type="submit">Use salt</button>
    </form>
</div> <!-- /container -->

<?php require "../parts/footer.php"; ?>
