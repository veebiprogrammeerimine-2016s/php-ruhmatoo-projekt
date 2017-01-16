<?php

require("functions.php");
require("classes/order_class.php");
$order = new Order($mysqli);

if (!isset($_SESSION["userId"])){
    header("Location: index.php");
    exit();
}

if (isset($_GET["logout"])) {
    session_destroy();
    header("Location: index.php");
    exit();
}


$orderArray = $order->getOrdersByOwnerId($_SESSION['userId']);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tellimused</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css"
          integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd"
          crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/tyre-fitter.css">
</head>
<body>
<?php require("office-nav.php") ?>

<div class="container" style="margin-top:150px;">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nimi</th>
                <th>Telefon</th>
                <th>Auto nr.</th>
                <th>Broneering</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $html = "";
                if ($orderArray != null) {
                    foreach ($orderArray as $key => $order) {
                        $key += 1;
                        $html .= "<tr data-id='$order->id'>";
                        $html .= "<td>".$key."</td>";
                        $html .= "<td>".$order->name."</td>";
                        $html .= "<td>".$order->phone."</td>";
                        $html .= "<td>".$order->carNubmer."</td>";
                        $html .= "<td>".$order->booktime."</td>";
                        $html .= "</tr>";
                    }
                } else {
                    $html .= "Tellimuse ei ole!";
                }
                echo $html;
            ?>
        </tbody>
    </table>




</div>

<?php require("office-footer.php") ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js"
        integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7"
        crossorigin="anonymous"></script>
<script>
    $(function () {

    });
</script>
</body>
</html>