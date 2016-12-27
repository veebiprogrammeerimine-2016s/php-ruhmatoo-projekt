<?php

require("../functions.php");

// Logout
if (isset($_GET["logout"])) {
    session_destroy();
    header("Location: admin.php");
    exit();
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
                    <li class="active"><a href="#">Tunniplaan</a></li>
                </ul>
                <!-- Navbar right side -->
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="admin.php">Admin</a></li>
                    <?php if (isset($_SESSION["userId"])) {
                        echo('
                           <li><a href = "?logout=1" > Logout</a ></li >
                           ');
                    }
                    ?>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <!-- Dropdown for Table -->

    <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="true">
            Vali rühm
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li><a href="#">1-rühm</a></li>
            <li><a href="#">2-rühm</a></li>
            <li><a href="#">3-rühm</a></li>
            <li><a href="#">4-rühm</a></li>
        </ul>
    </div>
    <br>

    <!-- Table for subjects -->
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>John</td>
            <td>Doe</td>
            <td>john@example.com</td>
        </tr>
        <tr>
            <td>Mary</td>
            <td>Moe</td>
            <td>mary@example.com</td>
        </tr>
        <tr>
            <td>July</td>
            <td>Dooley</td>
            <td>july@example.com</td>
        </tr>
        </tbody>
    </table>

</div>

<?php require "../parts/footer.php"; ?>