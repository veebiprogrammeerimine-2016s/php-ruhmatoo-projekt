<?php

    require("../functions.php");
    require("../class/Series.class.php");
    require("../class/Picture.class.php");
    require("../class/User.class.php");
    $User = new User($mysqli);

    //kui ei ole kasutaja id'd
    if (!isset($_SESSION["userId"])) {
        //suunan sisselogimise lehele
        header("Location: login.php");
        exit();

    }

    //kui on ?logout aadressi real siis login välja
    if(isset ($_GET["logout"])) {

        session_destroy();
        header("Location: login.php");
        exit();
    }

    if($_SESSION['newUser']){

        $User->updateLogin($_SESSION['userId']);

    } else {

        //suunan sisselogimise lehele
        header("Location: calendar.php");
    }
    $msg = " ";
    if(isset($_SESSION["message"])) {
        $msg = $_SESSION["message"];

        //kui ühe näitame siis kustuta ära, et pärast refreshi ei näita
        unset($_SESSION["message"]);

    }

    if(isset($_FILES["fileToUpload"]) && !empty($_FILES["fileToUpload"]['name'])){
        $target_dir = "../profilepics/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if(isset($_POST["fileToUpload"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                //echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "File already exists. ";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

                echo "Your profile picture has been uploaded.";

                //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";


                // save file name to DB here
                addPicURL(basename($_FILES["fileToUpload"]["name"]));

            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    if(isset($_POST['user_tv_db'])){

        addSeriesToDb($_SESSION['userId'], $_POST['user_tv_db']);
    }

?>

<?php require("../header.php"); ?>

<h1>TV Show Calendar</h1>
<p>
    <h2>Welcome <?=$_SESSION["userName"];?>!</h2>
    <br>
    <img style="height: 200px; width: auto; " src="../profilepics/<?php getProfileURL(); ?>">

    <h3>For starters, let's add one series to your calender!</h3>
    <form method="POST">
        <select name="user_tv_db">
            <?php getSeriesData() ?>
        </select>
        <input type="submit" value="Submit">
    </form>
    <br><br>
    <h3>Also, let's add a profile image:</h3>
    <form method="POST">
        <input type="file" name="fileToUpload">
        <br>
        <input type="submit" value="Upload Image" name="submit">
    </form>
    <br><br>
    <input type="button" value="Ready!" onclick="location='calendar.php'" />
    <br><br><br><br>
    <a href="?logout=1"> Log out</a>
</p>

<?php require("../footer.php"); ?>
