/*jshint esversion: 6 */

function sendRequestReservas(form, action, success) {
    sendRequest(
        form,
        'post',
        "/reservas/" + action,
        success
    );
}

sendRequestReservas('#form-add-reserva', 'nueva', function (data, status) {
    showAlert('alert-success', 'Reserva creada.');
    $('.tip-container').remove();
    $('#modal-add-reserva').modal('hide');
    $('#form-add-reserva')[0].reset();
});
