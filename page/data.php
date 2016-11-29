<?php

require("../functions.php");

require("../class/Helper.class.php");
$Helper = new Helper();

require("../class/Rides.class.php");
$Rides = new Rides($mysqli);

//kui ei ole sisseloginud, suunan login lehele
if (!isset($_SESSION["userId"])) {
  header("Location: login.php");
  exit();
}

//kas aadressireal on logout
if (isset($_GET["logout"])) {

  session_destroy();

  header("Location: login.php");
  exit();

}

//Check if forms are filled
$startLocation = "";
$startTime = "";
$arrivalLocation = "";
$arrivalTime = "";
$freeSeats = "";

$emptyStartL = "*";
$emptyStartT = "*";
$emptyArrivalL = "*";
$emptyArrivalT = "*";
$emptySeats = "*";

if (isset ($_POST["startLocation"])) {
    if (empty ($_POST["startLocation"])) {
        $emptyStartL = "* Please fill in starting location!";
    } else {
        $startLocation = $_POST["startLocation"];
    }
}

if (isset ($_POST["startTime"])) {
    if (empty ($_POST["startTime"])) {
        $emptyStartT = "* Please fill in start time!";
    } else {
        $startTime = $_POST["startTime"];
    }
}

if (isset ($_POST["arrivalLocation"])) {
    if (empty ($_POST["arrivalLocation"])) {
        $emptyArrivalL = "* Please fill in arrival location!";
    } else {
        $arrivalLocation = $_POST["arrivalLocation"];
    }
}

if (isset ($_POST["arrivalTime"])) {
    if (empty ($_POST["arrivalTime"])) {
        $emptyArrivalT = "* Please fill in arrival time!";
    } else {
        $arrivalTime = $_POST["arrivalTime"];
    }
}

if (isset ($_POST["freeSeats"])) {
    if (empty ($_POST["freeSeats"])) {
        $emptySeats = "* Please fill in number of seats!";
    } else {
        $freeSeats = $_POST["freeSeats"];
    }
}

//If forms are filled
if (isset($_POST["start_location"]) &&
isset($_POST["start_time"]) &&
isset($_POST["arrival_location"]) &&
isset($_POST["arrival_time"]) &&
isset($_POST["free_seats"]) &&

!empty($_POST["start_location"]) &&
!empty($_POST["start_time"]) &&
!empty($_POST["arrival_location"]) &&
!empty($_POST["arrival_time"]) &&
!empty($_POST["free_seats"])
)


{
    //echo = "Saved";
    //$Rides->save($Helper->cleanInput($_POST["price"]), $start_location, $startTime, $arrivalLocation, $arrivalTime, $freeSeats);
 }


?>

<h1>Data</h1>

<p>

    Welcome <?=$_SESSION["userEmail"];?>!
    <a href="?logout=1">log out</a>

</p>


<h2>Register a ride</h2>
<form method="POST" >

    <label>Start location</label><br>
    <input name="start_location" type="text">

    <br><br>
    <label>Start time</label><br>
    <input name="start_time" type="text">

    <br><br>
    <label>Arrival location</label><br>
    <input name="arrival_location" type="text">

    <br><br>
    <label>Arrival time</label><br>
    <input name="arrival_time" type="text">

    <br><br>
    <label>Free seats</label><br>
    <input name="free_seats" type="number">

    <br><br>
    <label>Price</label><br>
    <input name="price" type="number">

    <br><br>
    <input type="submit" value="Submit">

</form>