<?php

require("functions.php");
require("classes/tyrefitting_class.php");
$TyreFitting = new TyreFitting($mysqli);

if (!isset($_SESSION["userId"])){
    header("Location: index.php");
    exit();
}

if (isset($_GET["logout"])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

$fitterId = "";
if (isset($_GET["id"])) {
    $fitterId = $_GET["id"];
}



if (isset($_POST['submit'])) {
    $name = $_POST['serviceName'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $size = $_POST['size'];
    $price = $_POST['price'];
    $result = $TyreFitting->addNewService($name, $description, $category, $size, $price, $fitterId);
    header("Location: tyre-fitter.php?id=".$fitterId);
}



?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lisa uus teenus</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css"
          integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd"
          crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/tyre-fitter.css">
</head>
<body>
<?php require("office-nav.php") ?>

<div class="container" style="margin-top:100px;">
    <div class="row">
        <div class="jumbotron col-md-offset-2 col-md-8">
            <h3 class="display-4">Lisa uus teenus</h3>
            <hr class="my-4">

            <form method="post">
                <div class="form-group">
                    <label for="serviceName">Nimetus</label>
                    <input type="text" class="form-control" id="serviceName" name="serviceName" placeholder="Sisestage nimetus" required>
                </div>

                <div class="form-group">
                    <label for="description">Kirjeldus</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label for="category">Teenuse kategooria</label>
                    <select name="category" id="category" class="form-control" required>
                        <option value="plekkvelg">Plekkvelg</option>
                        <option value="valuvelg">Valuvelg</option>
                    </select>

                </div>

                <div class="form-group">
                    <label for="size">Suurus</label>
                    <select class="form-control" name="size" id="size" required>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="custom">Eri suurus</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="price">Teenuse hind</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="Sisestage hind" required>
                </div>

                <button name="submit" class="btn btn-primary" style="float: right; margin-top: 15px;" type="submit">LISA</button>
            </form>
        </div>
    </div>
</div>

<?php require("office-footer.php") ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js"
        integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7"
        crossorigin="anonymous"></script>
<script src="https://use.fontawesome.com/330cd91718.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<script>
    $(function () {

    });
</script>
</body>
</html>