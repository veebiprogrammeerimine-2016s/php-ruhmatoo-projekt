<?php
require("functions.php");
require("classes/tyrefitting_class.php");
$TyreFitting = new TyreFitting($mysqli);

$days = array(
    1 => "Esmapäev",
    2 => "Teisipäev",
    3 => "Kolmapaäev",
    4 => "Neljapäev",
    5 => "Reede",
    6 => "Laupäev",
    0 => "Pühapäev"
);

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

if (isset($_GET['id'])) {
    $fitterId = $_GET['id'];
} else {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
    foreach ($days as $num => $day) {
        if (isset($_POST[$num."-isWorking"])) {
            $dayNumber = $num;
            $open = $_POST[$num.'-open'];
            $close = $_POST[$num.'-close'];
            $TyreFitting->addTyreFitterWorkingTime($dayNumber, $open, $close, $fitterId);
        } else {
            $TyreFitting->addTyreFitterWorkingTime($num, null, null, $fitterId);
        }
    }
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
    <title>Lisa rehvivahetus punkti tööajad</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css"
          integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd"
          crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/office.css">

    <style>
        #confirm {
            float: right;
        }
    </style>

</head>
<body>
<?php require("office-nav.php") ?>
<div class="container" style="margin-top:100px;">
    <div class="col-md-offset-2 col-md-8">
        <form method="post">
            <table class="table">
                <tr>
                    <th>Päev</th>
                    <th>Avatud</th>
                    <th>Kinni</th>
                    <th>Töötab</th>
                </tr>


                <?php



                    foreach ($days as $num => $day) {
                        $html = "<tr>";
                        $html .= "<td>".$day."</td>";
                        $html .= "<td><select name='".$num."-open'>";
                        $html .= generateDates($num, true);
                        $html .= "</select></td>";

                        $html .= "<td><select name='".$num."-close'>";
                        $html .= generateDates($num, false);
                        $html .= "</select></td>";

                        if ($num == 0) {
                            $html .= "<td><input type='checkbox' name='".$num."-isWorking' /></td>";
                        } else {
                            $html .= "<td><input type='checkbox' name='".$num."-isWorking' checked /></td>";
                        }

                        $html .= "</tr>";
                        echo $html;
                    }

                ?>

            </table>

            <input type="submit" name="submit" class="btn btn-primary" id="confirm" value="Kinnita" />

        </form>
    </div>





</div>
<?php require("office-footer.php") ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js"
        integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7"
        crossorigin="anonymous"></script>
<script>

</script>
</body>
</html>


<?php
    function generateDates($dayNumber, $open) {
        $value = "";
        $start = strtotime("00:00");
        $end = strtotime("23:30");
        while ($start !== $end) {
            $start = strtotime('+30 minutes', $start);
            if ($dayNumber == 0) {
                return "<option value='closed' selected disabled>Closed</option>";
            } else if ($dayNumber == 6) {
                if ($open == true && $start == strtotime("10:00")) {
                    $value .= "<option value='".date('H:i:s', $start)."' selected>".date('H:i', $start)."</option>";
                } else if ($open == false && $start == strtotime("18:00")) {
                    $value .= "<option value='".date('H:i:s', $start)."' selected>".date('H:i', $start)."</option>";
                } else {
                    $value .= "<option value='".date('H:i:s', $start)."'>".date('H:i', $start)."</option>";
                }
            } else {
                if ($open == true && $start == strtotime("8:00")) {
                    $value .= "<option value='".date('H:i:s', $start)."' selected>".date('H:i', $start)."</option>";
                } else if ($open == false && $start == strtotime("20:00")) {
                    $value .= "<option value='".date('H:i:s', $start)."' selected>".date('H:i', $start)."</option>";
                } else {
                    $value .= "<option value='".date('H:i:s', $start)."'>".date('H:i', $start)."</option>";
                }
            }
        }
        return $value;
    }
?>











