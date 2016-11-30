<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  require "../parts/header.php";
?>

<body>
<!-- Signin -->
    <div class="g-signin2" data-onsuccess="onSignIn" data-onfailure="onFailure" data-theme="dark" id="login" style="float:left"></div>
    <script>
      function onSignIn(googleUser) {
        // Useful data for your client-side scripts:
        var domain = googleUser.getHostedDomain();
        if (/tlu.ee\s*$/.test(domain)) {
          console.log(domain);
          var profile = googleUser.getBasicProfile();   
          console.log("ID: " + profile.getId()); // Don't send this directly to your server!
          console.log('Full Name: ' + profile.getName());
          console.log('Given Name: ' + profile.getGivenName());
          console.log('Family Name: ' + profile.getFamilyName());
          console.log("Image URL: " + profile.getImageUrl());
          console.log("Email: " + profile.getEmail());

          // The ID token you need to pass to your backend:
          var id_token = googleUser.getAuthResponse().id_token;
          console.log("ID Token: " + id_token);
          document.getElementById("login").style.display = "none";
          document.getElementById("logout").style.display = "initial";
        } else {
          console.log("Wrong domain");
        }
        
      };

      function onFailure(){
          document.getElementById("error").innerHTML = "Palun sisene TLÜ kasutajaga";
      }
    </script>
    <div id="error"></div>
<!-- Signout -->

<a href="#" onclick="signOut();" id="logout" class="btn btn-info btn-lg" style="display: none";>
  <span class="glyphicon glyphicon-log-out"></span>
    Sign out
</a>


<script>
  function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
      document.getElementById("login").style.display = "initial";
      document.getElementById("logout").style.display = "none";

    });
  }
</script>
</body>

<?php require "../parts/footer.php";?>