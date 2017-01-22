<!-- LOGIN -->

<?php

require ("../functions.php");

$loginEmail = "";
$loginNotice = "";
$signupEmail = "";
$signupNotice = "";
$signupGender = "male";
$signupBday= date('Y-m-d');


if (isset ($_SESSION["userId"])){
    header("Location: index.php");
}
if (isset ($_POST ["loginEmail"])){
    $loginEmail = $_POST["loginEmail"];
}
if(isset($_POST["loginEmail"]) && isset($_POST['loginPassword']) && !empty($_POST["loginEmail"]) && !empty($_POST['loginPassword'])){
    $loginNotice = $Users->login($Helper->cleanInput($_POST["loginEmail"]), $Helper->cleanInput($_POST['loginPassword']));
}
if (isset ($_POST ["signupEmail"])){
    $signupEmail = $_POST["signupEmail"];
}
if (isset ($_POST ["signupBday"])){
    $signupBday = $_POST["signupBday"];
}

if (isset ($_POST['signupPassword'])
    && isset ($_POST['signupEmail']) && isset ($_POST['signupBday'])
    && isset ($_POST['signupGender'])){

    $password = hash("sha512", $_POST["signupPassword"]);
    $signupNotice = $Users->signup($Helper->cleanInput($signupEmail), $Helper->cleanInput($password), $signupBday, $signupGender);
    $signupEmail = "";
    $signupGender = "male";
    $signupBday= date('Y-m-d');
}

require ("../header.php");
?>


<title>Log in // Garagediary</title>

<!--JUMBOTRON-->
<div class="jumbotron jumbotron-loginpage text-center">
    <div class="row text-center">
        <div class="col-sm-offset-4 col-sm-4">
            <img class="img-responsive" alt="Garagediary" src="../img/logo.png">
        </div>
    </div>
    <br><br>
    <div class="header-text btn">
        <h5><span class="typedlogin"></span></h5>
</div>
</div>
<!--CONTENT-->

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-3">
            <form method="post" role="form" data-toggle="validator">
                <div class="row">
                    <div class="col-md-9 text-center">
                        <h2 class="text-center">Log in:</h2>
                        <br>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="loginEmail">E-mail:<span class="redtext">*</span></label>
                    </div>
                    <div class="col-md-6">
                        <input id="loginEmail" name = "loginEmail" type ="email" class="form-control input-sm" placeholder="E-mail" data-error="E-mail is required!" required value="<?=$loginEmail?>">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="loginPassword">Password:<span class="redtext">*</span></label>
                    </div>
                    <div class="col-md-6">
                        <input id="loginPassword" name = "loginPassword" type ="password" class="form-control input-sm" placeholder = "Password" data-error="Password is required!" required>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-3 text-center">
                        <input class = "btn btn-success btn-sm btn-block" type ="submit" value = "Log in">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-9 text-center">
                        <p class="text-danger"><?=$loginNotice;?></p>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-sm-3">
            <form method="post" role="form" data-toggle="validator">
                <div class="row">
                    <div class="col-md-9 text-center">
                        <h2 class="text-center">Create account:</h2>
                        <br>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="signupEmail">E-mail:<span class="redtext">*</span></label>
                    </div>
                    <div class="col-md-6">
                        <input id="signupEmail" name = "signupEmail" type ="email" class="form-control input-sm" placeholder="E-mail"  data-error="E-mail is required!" required value="<?=$signupEmail;?>">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="signupPassword">Password:<span class="redtext">*</span></label>
                    </div>
                    <div class="col-md-6">
                        <input id="signupPassword" name = "signupPassword" data-minlength="8" type ="password" class="form-control input-sm" placeholder = "Password" data-error="Password must be >8 symbols!" required>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="signupBday">Birthday<span class="redtext">*</span></label>
                    </div>
                    <div class="col-md-6">
                        <input class="form-control input-sm" id="signupBday" name="signupBday" type ="date" min="1900-01-01" max = "<?=date('Y-m-d'); ?>" placeholder="YYYY-MM-DD" data-error="Birthday date is required!" required>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="signupGender">Gender:<span class="redtext">*</span></label>
                    </div>
                    <div class="col-md-6">
                        <label style="font-weight:normal"><input type="radio" name="signupGender" value="male" checked> Male</label><br>
                        <label style="font-weight:normal"><input type="radio" name="signupGender" value="female"> Female</label><br>
                        <label style="font-weight:normal"><input type="radio" name="signupGender" value="unspecified"> Doesn't matter...</label><br>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-3 text-center">
                        <input class = "btn btn-success btn-sm btn-block" type ="submit" value = "Create">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-9 text-center">
                        <p class="text-danger"><?=$signupNotice;?></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require ("../footer.php");?>
