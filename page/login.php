<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  require "../parts/header.php";
?>

<body>
<!-- Signin -->
    <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
    <script>
      function onSignIn(googleUser) {
        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile();
        if (!/@tlu.ee\s*$/.test(profile.getEmail())){
          signOut();
          document.getElementById("error").innerHTML = "Palun sisene Tallinna Ülikooli kasutajaga.";
        }
        console.log("ID: " + profile.getId()); // Don't send this directly to your server!
        console.log('Full Name: ' + profile.getName());
        console.log('Given Name: ' + profile.getGivenName());
        console.log('Family Name: ' + profile.getFamilyName());
        console.log("Image URL: " + profile.getImageUrl());
        console.log("Email: " + profile.getEmail());

        // The ID token you need to pass to your backend:
        var id_token = googleUser.getAuthResponse().id_token;
        console.log("ID Token: " + id_token);
      };

      function signOut() {
      var auth2 = gapi.auth2.getAuthInstance();
      auth2.signOut().then(function () {
      console.log('User signed out.');
        });
      };
    </script>
<!-- Signout -->
<a href="#" onclick="signOut();">Sign out</a>
<p id="error"></p>
</body>

<?php require "../parts/footer.php";?>