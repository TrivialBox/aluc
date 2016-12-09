/*jshint esversion: 6 */

function sendRequestReservas(form, action, success) {
    sendRequest(
        form,
        'post',
        "/reservas/" + action,
        success
    );
}

function loadLaboratorio() {
    $.ajax({
        'type': 'post',
        'url': '/laboratorios',
        'data': $('#form-laboratorio').serialize(),
        'beforeSend': function () {
            $('.loader-container').show();
        },
        'success': function (data, status) {
            if (data.status && data.status === 'error') {
                showAlert('alert-danger', data.description);
            } else {
                $('#laboratorio-content').html(data);
            }
        },
        'error': function () {
            showAlert('alert-danger', 'Ups, algo inesperado ocurrió.');
        }
    });
}


sendRequestReservas('#form-add-reserva', 'nueva', function (data, status) {
    showAlert('alert-success', 'Reserva creada.');
    $('#modal-add-reserva').modal('hide');
    $('#form-add-reserva')[0].reset();
    $('#laboratorios').trigger('change');
});

sendRequestReservas('#form-cancel-reserva', 'cancelar', function (data, status) {
    showAlert('alert-success', 'Reserva cancelada.');
    $('#modal-confirm-cancel-reserva').modal('hide');
    $('#laboratorios').trigger('change');
});


$('#laboratorios').on(
    'change',
    function (e) {
        loadLaboratorio();
        $('#reservas-nuevas-tab').trigger('show.bs.tab');
    }
);


$(document).ready(function () {
    $('#laboratorios').trigger('change');
});

