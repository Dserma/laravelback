$(document).ready(function () {
    $(".form-login").submit(function(event) {
        login($(this));
        event.preventDefault();
    });
});

function login($this) {
    $.ajax({
        url: $this.data('action'),
        headers: {
            'X-CSRF-Token': $('meta[name=_token]').attr('content')
        },
        async: true,
        method: 'POST',
        data: $this.serialize(),
        success: function (data) {
            $('body').removeClass('load');
            if (data == 'OK') {
                window.location.href = routes.ajax.home;
            } else {
                swal({
                    title: 'Oops...',
                    text: data,
                    type: 'error'
                });
            }
        },
        beforeSend: function () {
            $('body').addClass('load');
        },
        complete: function () {
        }
    });
}

