<?php
require("../functions.php");
require("../class/User.class.php");
$User = new User($mysqli);

require("../class/Helper.class.php");
$Helper = new Helper();

// If active session found
if (isset($_SESSION["userId"])) {
    header("Location: homework.php");
    exit();
}

// Login
$error = "";
if (isset($_POST["loginEmail"]) && isset($_POST["loginPassword"]) && !empty($_POST["loginPassword"]) && !empty($_POST["loginEmail"])) {
    $error = $User->login($Helper->cleanInput($_POST["loginEmail"]), $Helper->cleanInput($_POST["loginPassword"]));
}

?>

<?php require "../parts/header.php"; ?>

<div class="container-fluid">
    <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                </button>
                <a class="navbar-brand" href="../index.php">Izipäevik</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="homework.php">Kodused tööd</a></li>
                    <li><a href="curriculum.php">Tunniplaan</a></li>
                </ul>
                <!-- Navbar right side -->
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="#">Admin</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
</div> <!-- /container -->
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
