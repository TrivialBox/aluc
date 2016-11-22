/*jshint esversion: 6 */

function sendRequestModeradores(form, action, success) {
    sendRequest(
        form,
        'post',
        "/admin/moderadores/" + action,
        success
    );
}

function deleteRowModerador(id) {
    $('table tbody [data-id="' + id + '"]').remove();
}

sendRequestModeradores('#form-add-moderador', 'nuevo', function (data, status) {
    showAlert('alert-success', 'Moderador agregado.');
    $('table tbody').prepend(data);
    $('.tip-container').remove();
    $('#modal-add-moderador').modal('hide');
    $('#form-add-moderador')[0].reset();
});


sendRequestModeradores('#form-delete-moderador', 'eliminar', function (data, status) {
    showAlert('alert-success', 'Moderador eliminado.');
    var id = $('#form-delete-moderador #id').val();
    deleteRowModerador(id);
    $('#modal-confirm-delete-moderador').modal('hide');
});

sendRequestModeradores('#form-edit-moderador', 'actualizar', function (data, status) {
    showAlert('alert-success', 'Moderador actualizado.');
    var id = $('#form-edit-moderador #id').val();
    deleteRowModerador(id);
    $('table tbody').prepend(data);
    $('#modal-edit-moderador').modal('hide');
});
