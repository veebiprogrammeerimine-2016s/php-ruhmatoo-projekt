<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  require "../parts/header.php";
?>

<body>
<!-- Signin -->

<!-- Signout -->
<a href="#" onclick="signOut();">Sign out</a>
<script>
  function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
    });
  }
</script>
</body>

<?php require "../parts/footer.php";?>