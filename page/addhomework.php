<?php
/**
 * Created by PhpStorm.
 * User: hinrek
 * Date: 09/01/2017
 * Time: 18:07
 */
require("../functions.php");
require_once("../scraper/vendor/autoload.php");

// Google login
define('APPLICATION_NAME', 'addevent');
define('SCOPES', implode(' ', array(
        Google_Service_Calendar::CALENDAR)
));
define('CREDENTIALS_PATH', '~/.credentials/calendar-php-quickstart.json');
define('CLIENT_SECRET', '####');
define('CLIENT_ID', "####");
define('DEVELOPER_KEY', "####");
define('REDIRECT_URI', "http://####/page/addhomework.php");
$groupAddresses = array(
    "grupp1" => "####",
    "grupp2" => "####",
    "grupp3" => "####",
    "grupp4" => "####"
);

$client = new Google_Client();
$client->setApplicationName(APPLICATION_NAME);
$client->setClientId(CLIENT_ID);
$client->setClientSecret(CLIENT_SECRET);
$client->setRedirectUri(REDIRECT_URI);
$client->setDeveloperKey(DEVELOPER_KEY);
$client->setScopes(SCOPES);

// Logout
if (isset($_GET["logout"])) {
    session_destroy();
    header("Location: admin.php");
    exit();
}

if (isset($_SESSION["accessToken"])) {
    $accessToken = $_SESSION["accessToken"];
    if (isset($_GET["code"])) {
        //Remove google auth code from GET
        header("Location: addhomework.php");
    }
} else {
    if (!isset($_GET["code"])) {
        // Request authorization from the user.
        $authUrl = $client->createAuthUrl();
        header("Location:" . $authUrl);
    } else {
        $authCode = trim($_GET["code"]);
    }
}

if (isset($authCode) && !isset($_SESSION["accessToken"])) {
    // Exchange authorization code for an access token.
    $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
    $_SESSION["accessToken"] = $accessToken;
}

if (isset($accessToken) && !empty($accessToken)) {
    // Refresh the token if it's expired.
    try {
        $client->setAccessToken($accessToken);
    } catch (Exception $e) {
        header("Location: addhomework.php?logout=1");
        exit();
    }
    if ($client->isAccessTokenExpired()) {
        $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
    }
}

if (isset($_POST["time"])) {
    $time = $_POST["time"];
}

if (isset($_POST["eventname"])) {
    $eventname = $_POST["eventname"];
}

if (isset($_POST["description"])) {
    $description = $_POST["description"];
}

$service = new Google_Service_Calendar($client);
if (isset($time) && isset($eventname) && isset($description) && isset($_GET["ryhm"])) {
    $event = new Google_Service_Calendar_Event(array(
        'summary' => $eventname,
        'location' => "Tallinn University",
        'description' => $description,
        'start' => array(
            'date' => $time,
            'timeZone' => 'Europe/Tallinn',
        ),
        'end' => array(
            'date' => $time,
            'timeZone' => 'Europe/Tallinn',
        ),
    ));
    $eventInsert = $service->events->insert($groupAddresses["grupp" . $_GET["ryhm"]], $event);
}

?>
<?php require "../parts/header.php"; ?>
    <!-- Dropdown for Calendar -->
    <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="true">
            Vali rühm
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li><a href="addhomework.php?ryhm=1">1-rühm</a></li>
            <li><a href="addhomework.php?ryhm=2">2-rühm</a></li>
            <li><a href="addhomework.php?ryhm=3">3-rühm</a></li>
            <li><a href="addhomework.php?ryhm=4">4-rühm</a></li>
        </ul>
    </div>
    <br>
    <!-- Form start -->
    <?php
        if (isset($_GET["ryhm"])) {
            echo '
            <form method="post">
                <div class="form-group">
                    <label for="time">Aeg:</label>
                    <p>Formaat YYYY-MM-DD</p>
                    <input name="time" type="text" class="form-control" id="time">
                </div>
                <div class="form-group">
                    <label for="eventname">Nimetus:</label>
                    <input name="eventname" type="text" class="form-control" id="eventname">
                </div>
                <div class="form-group">
                    <label for="description">Kirjeldus:</label>
                    <input name="description" type="text" class="form-control" id="description">
                </div>
                <button type="submit" class="btn btn-default">Sisesta</button>
            </form>';
        }
    ?>

</div>

<?php require "../parts/footer.php"; ?>
