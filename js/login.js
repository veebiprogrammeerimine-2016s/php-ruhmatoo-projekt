$('#submit-login').on('click', function (event) {
    event.preventDefault();

    $.ajax({
        type: 'POST',
        url: 'login.php',
        data: $('#log').serialize(),
        success: function (responseData) {
            if (responseData == "ok") {
                $('#log').modal('hide');
                window.location.reload();
            } else {
                $('#login-error').show();
            }
        }
    });


});