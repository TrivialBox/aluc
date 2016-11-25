/*jshint esversion: 6 */

function sendRequestReservas(form, action, success) {
    sendRequest(
        form,
        'post',
        "/reservas/" + action,
        success
    );
}

// Cambio de laboratorio
$('#laboratorios').change(
    function (e) {
        $.ajax({
            'type': 'get',
            'url': 'escritorio',
            'data': {'id_laboratorio': $(this).val()},
            'beforeSend': function () {
                $('.loader-container').show();
            },
            'success': function (data, status) {
                if (data.status && data.status === 'error') {
                    showAlert('alert-danger', data.description);
                } else {
                    $('#reservas-content').html(data);
                }
            },
            'error': function () {
                showAlert('alert-danger', 'Ups, algo inesperado ocurrió.');
            },
            'complete': function () {
                $('.loader-container').hide();
            }
        });
    }
);

sendRequestReservas('#form-cancel-reserva', 'cancelar', function (data, status) {
    showAlert('alert-success', 'Reserva cancelada.');
    $('#modal-confirm-cancel-reserva').modal('hide');
    $('#laboratorios').trigger('change');
});
