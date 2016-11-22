// SMOOTH EFFECT 
    $(function() {
  $('a[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top - 100
        }, 1000);
        return false;
      }
    }
  });
});

// USERNAME LENGTH IN REGISTRATION FORM MUST BE GREATHER THAN 0
$(document).ready(function(){
    $('#butt').attr('disabled',true);
    $('#exampleInputEmail1').keyup(function(){
        if($(this).val().length !=0)
            $('#butt').attr('disabled', false);            
        else
            $('#butt').attr('disabled',true);
    })
});
// PASSWORD LENGTH IN REGISTRATION FORM MUST BE GREATHER THAN 8
$(document).ready(function(){
    $('#butt').attr('disabled',true);
    $('#exampleInputPassword1').keyup(function(){
        if($(this).val().length < 8)
            $('#butt').attr('disabled', true);            
        else
            $('#butt').attr('disabled',false);
    })
});
		