<!--- FOOTER --->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.js"></script>
<script src="../js/typed.js"></script>
<script>
    $(function(){
        $(".typedlogin").typed({
            strings: ["Keep all your maintenance details in one place...", "Upload and store photos of you car...", "Calculate your expenditures...", "Start your journey now!" ],
            contentType: 'text',
            typeSpeed: 20,
            backSpeed: 0
        });
    });
</script>

<script>
    $(document).ready(function(){
      // Initialize Tooltip
      $('[data-toggle="tooltip"]').tooltip();
      
      // Add smooth scrolling to all links in navbar + footer link
      $(".navbar a, footer a[href='#home']").on('click', function(event) {

        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {

          // Prevent default anchor click behavior
          event.preventDefault();

          // Store hash
          var hash = this.hash;

          // Using jQuery's animate() method to add smooth page scroll
          // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
          $('html, body').animate({
            scrollTop: $(hash).offset().top
          }, 300, function(){
       
            // Add hash (#) to URL when done scrolling (default click behavior)
            window.location.hash = hash;
          });
        } // End if
      });
    })
    </script>
</body>

</html>