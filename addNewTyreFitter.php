<?php
    require("functions.php");
    require("classes/tyrefitting_class.php");
    $TyreFitting = new TyreFitting($mysqli);

    $errorName = "";
    $errorDescription = "";
    $errorLocation = "";
    $errorPriceList = "";
    $errorLogo = "";

    if (!isset($_SESSION["userId"])){
        header("Location: index.php");
        exit();
    }

    if (isset($_GET["logout"])) {
        session_destroy();
        header("Location: index.php");
        exit();
    }

    if (isset($_POST['submit'])) {
        $formValid = true;

        if (empty($_POST['tyreFitterName'])) {
            $errorName = "Nimetus peab olema sisestatud!";
            $formValid = false;
        } else {
            $errorName = "";
        }

        if (empty($_POST['description'])) {
            $errorDescription = "Kirjeldus peab olema sisestatud!";
            $formValid = false;
        } else {
            $errorDescription = "";
        }

        if (empty($_POST['location'])) {
            $errorLocation = "Location link peab olema sisestatud!";
            $formValid = false;
        } else {
            $errorLocation = "";
            if (filter_var($_POST['location'], FILTER_VALIDATE_URL) === false) {
                $errorLocation = "Link ei ole õige!";
                $formValid = false;
            }
        }

        if (empty($_POST['priceList'])) {
            $errorPriceList = "Price list link peab olema sisestatud!";
            $formValid = false;
        } else {
            $errorPriceList = "";
            if (filter_var($_POST['priceList'], FILTER_VALIDATE_URL) === false) {
                $errorPriceList = "Link ei ole õige!";
                $formValid = false;
            }
        }

        if (empty($_FILES['logo'])) {
            $errorLogo = "Laadige logo!";
        } else {
            $errorLogo = "";
            $targetDir = "img/";
            $targetFile = $targetDir.basename($_FILES["logo"]["name"]);
            $imageFileType = pathinfo($targetFile, PATHINFO_EXTENSION);

            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $errorLogo = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $formValid = false;
            }

            if ($formValid) {
                if (move_uploaded_file($_FILES["logo"]["tmp_name"], $targetFile)) {
                    $fittingId = $TyreFitting->addNewTyreFitting($_POST['tyreFitterName'], $_POST['description'], $targetFile, $_POST['location'], $_POST['priceList'], $_SESSION['userId']);
                    header("Location: addWorkingTime.php?id=".$fittingId);
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }


    }



?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lisa uus rehvivahetus punkt</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css"
          integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd"
          crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/office.css">

    <style>
        .error {
            color: red;
            text-align: center;
            font-weight: bold;
            padding: 0;
            margin: 0;
        }
    </style>

</head>
<body>
<?php require("office-nav.php") ?>

<div class="container" style="margin-top:100px;">

    <div class="row">
        <div class="jumbotron col-md-offset-2 col-md-8">
            <h3 class="display-4">Lisa uus rehvivahetus punkt</h3>
            <hr class="my-4">

            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <p class="error"><?php echo $errorName; ?></p>
                    <label for="tyreFitterName">Nimetus:</label>
                    <input type="text" class="form-control" name="tyreFitterName" placeholder="Sisesta nimetus" />
                </div>

                <div class="form-group">
                    <p class="error"><?php echo $errorDescription; ?></p>
                    <label for="description">Kirjeldus:</label>
                    <textarea class="form-control" name="description" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <p class="error"><?php echo $errorLogo; ?></p>
                    <label for="logo">Logo:</label>
                    <input type="file" class="form-control-file" name="logo" placeholder="Upload logo" />
                </div>

                <div class="form-group">
                    <p class="error"><?php echo $errorLocation; ?></p>
                    <label for="location">Google maps link:</label>
                    <input type="text" class="form-control" name="location" placeholder="Sisesta google maps link" />
                </div>

                <div class="form-group">
                    <p class="error"><?php echo $errorPriceList; ?></p>
                    <label for="priceList">Price list:</label>
                    <input type="text" class="form-control" name="priceList" placeholder="Sisesta hinna link" />
                </div>

                <input type="hidden" name="ownerId" value="<?php echo $_SESSION['userId']; ?>" />

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
<script>

</script>
</body>
</html>
