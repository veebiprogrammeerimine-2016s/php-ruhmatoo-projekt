<?php



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

<div class="container">
    <!-- Signin -->
    <form class="form-signin">
        <h2 class="form-signin-heading">Lõpuboss</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Parool" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Use salt</button>
    </form>

</div> <!-- /container -->

<?php require "../parts/footer.php"; ?>
