<?php 
    //session_start();
	require("../functions.php");

    // $current_user = $_SESSION['user_username'];
    // $user_username = mysqli_real_escape_string($database,$_REQUEST['user_username']);
    // $profile_username=$rws['user_username'];

	//kui ei ole kasutaja id'd
if (!isset($_SESSION["userId"])) {

	//suunan sisselogimise lehele
	header("Location: login.php");
	exit();

}

//kui on ?logout aadressi real siis login välja
if(isset ($_GET["logout"])) {

	session_destroy();
	header("Location:login.php");
	exit();
}




//parooli muutmine
$error = [
"old_password_error" => '',
"new_password_error" => '',
"confirm_password_error" => ''
];
 
$form_data = [
"old_password" => '',
"new_password" => '',
"confirm_password" => ''
];
 
if(!empty($_SESSION['error']))
{
    $error = $_SESSION['error'];
}
 
if(!empty($_SESSION['form_data']))
{
    $form_data = $_SESSION['form_data'];
}
 
//





	
?>

<!DOCTYPE html>
<h1>Your profile</h1>
<html>
<body>
<p>
<img style="height: 200px; width: auto; " src="../profilepics/<?php getProfileURL(); ?>">

<form action="" method="post" enctype="multipart/form-data">
		<h3>Change your profile picture:</h3>
		<input type="file" name="fileToUpload">
		<button type="submit" name="submit">Upload</button>
	</form>
<h3>Username: <?=$_SESSION["userName"];?></h3>
<h3>Age: <?=$_SESSION["userAge"]?></h3>
<h3>E-mail: <?=$_SESSION["userEmail"]?></h3>
<h3>Change password: </h3>
<?php
//<input name="signupPassword" type="password" >
//<input type="submit" value="Save">
?>





<form action="change-password.php" method="post" onsubmit="return validate();" id="form_submission_ajax">
        <table class="form-table">
             
            <tr>
                <td><label>Old password:</label></td>
                <td><input type="password" name="old_password" id="old_password" value="<?php echo $form_data['old_password']; ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td id="old_password_error" class="error"><?php echo $error['old_password_error']; ?></td>
            </tr>
 
            <tr>
                <td><label>New Password:</label></td>
                <td><input type="password" name="new_password" id="new_password" value="<?php echo $form_data['new_password']; ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td id="new_password_error" class="error"><?php echo $error['new_password_error']; ?></td>
            </tr>
 
            <tr>
                <td><label>Confirm Password:</label></td>
                <td><input type="password" name="confirm_password" id="confirm_password" value="<?php echo $form_data['confirm_password']; ?>"></td>
            </tr>
 
            <tr>
                <td></td>
                <td id="confirm_password_error" class="error"><?php echo $error['confirm_password_error']; ?></td>
            </tr>
 
            <tr>
                <td></td>
                <td>
                    <input type="hidden" name="user_id" id="user_id" value="1">
                    <input type="submit" name="submit" value="Submit">
                </td>
            </tr>
        </table>
    </form>
</body>
 
<script>
function validate()
{
    var valid = true;
    var old_password = $('#old_password').val();
    var new_password = $('#new_password').val();
    var confirm_password = $('#confirm_password').val();
 
    if(old_password=='' || old_password==null)
    {
        valid=false;
        $('#old_password_error').html("* This field is required.");
    }
    else
    {
        $('#old_password_error').html("");  
    }
 
    if(new_password=='' || new_password==null)
    {
        valid=false;
        $('#new_password_error').html("* This field is required.");
    }
    else
    {
        $('#new_password_error').html("");
    }
 
    if(confirm_password=='' || confirm_password==null)
    {
        valid=false;
        $('#confirm_password_error').html("* This field is required.");
    }
    else
    {
        $('#confirm_password_error').html("");
    }
 
    if(new_password != '' && confirm_password != '')
    {
        if(new_password != confirm_password)
        {
            valid = false;
            $('#confirm_password_error').html("* Confirm password is same as new password.");
        }
 
        if(new_password == confirm_password)
        {
            $('#confirm_password_error').html("");          
        }
    }
 
    if(valid==true)
    {
        return true;
    }
    else
    {
        return false;
    }
}
</script>
</html>   
 
<?php 
$_SESSION['error'] = "";
$_SESSION['form_data'] = "";
?>






</body>
</html>
<br><br>
<input type="button" value="Back to calendar" onclick="location='calendar.php'" />
<br><br>
<a href="?logout=1"> Log out</a>
</p>