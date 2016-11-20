var timeOutAlert = 0;

$('#add_moderador').on(
    "click",
    function () {
        $.post(
            "/admin/moderadores/nuevo",
            $('form').serialize(),
            function (data, status) {
                if (data['status'] && data['status'] === 'error') {
                    $('#wrongAlertMessage').html(data['description']);
                    var alert_wrong = $('#wrongAlert');
                    alert_wrong.show();
                    timeOutAlert = window.setTimeout(function () {
                            alert_wrong.hide();
                        },
                        3000
                    );
                } else {
                    $('#addModerador').hide();
                    $('#successAlertMessage').html('Nuevo moderador agregado.');
                    $('#successAlert').show();
                }
            }
        );
    }
);

$('.alert .close').click(function (e) {
    $('.alert').hide();
    window.clearTimeout(timeOutAlert);
});

