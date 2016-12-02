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
    var target = $('table tbody [data-mac="' + mac + '"]');
    target.addClass("bg-danger");
    target.fadeOut(700, function () {
        $(this).remove();
    });
}

function addRowLector(data) {
    $('table tbody').prepend(data);
    var target = $('table tbody tr:first');
    target.addClass("bg-success");
    setTimeout(function () {
        target.removeClass("bg-success");
    }, 900);
}

sendRequestLectores('#form-add-lector-qr', 'nuevo', function (data, status) {
    showAlert('alert-success', 'Lector QR agregado.');
    addRowLector(data);
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
    addRowLector(data);
    $('#modal-edit-lector-qr').modal('hide');
});

sendRequestLectores('#form-update-token-lector-qr', 'actualizar-token', function (data, status) {
    showAlert('alert-success', 'Token renovado.');
    var mac = $('#form-update-token-lector-qr #mac').val();
    deleteRowLector(mac);
    addRowLector(data);
    $('#modal-confirm-update-token-lector-qr').modal('hide');
});
