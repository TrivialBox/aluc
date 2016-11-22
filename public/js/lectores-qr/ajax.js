/*jshint esversion: 6 */

function sendRequestLectores(form, action, success) {
    sendRequest(
        form,
        'post',
        "/admin/lectores-qr/" + action,
        success
    );
}

function deleteRowLector(mac) {
    $('table tbody [data-mac="' + mac + '"]').remove();
}

sendRequestLectores('#form-add-lector-qr', 'nuevo', function (data, status) {
    showAlert('alert-success', 'Lector QR agregado.');
    $('table tbody').prepend(data);
    $('.tip-container').remove();
    $('#modal-add-lector-qr').modal('hide');
    $('#form-add-lector-qr')[0].reset();
});

sendRequestLectores('#form-delete-lector-qr', 'eliminar', function (data, status) {
    showAlert('alert-success', 'Lector eliminado.');
    var mac = $('#form-delete-lector-qr #mac').val();
    deleteRowLector(mac);
    $('#modal-confirm-delete-lector-qr').modal('hide');
});

sendRequestLectores('#form-edit-lector-qr', 'actualizar', function (data, status) {
    showAlert('alert-success', 'Lector actualizado.');
    var mac = $('#form-edit-lector-qr #mac').val();
    deleteRowLector(mac);
    $('table tbody').prepend(data);
    $('#modal-edit-lector-qr').modal('hide');
});
