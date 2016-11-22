/*jshint esversion: 6 */

function sendRequestModeradores(form, action, success) {
    $(form).submit(function (e) {
        $.ajax({
            'type': 'post',
            'url': "/admin/moderadores/" + action,
            'data': $(this).serialize(),
            'beforeSend': function () {
                $('.loader-container').show();
            },
            'success': function (data, status) {
                if (data.status && data.status === 'error') {
                    showAlert('alert-danger', data.description);
                } else {
                    success(data, status);
                }
            },
            'error': function () {
                showAlert('alert-danger', 'Ups, algo inesperado ocurrió.');
            },
            'complete': function () {
                $('.loader-container').hide();
            }
        });
        e.preventDefault();
    });
}

function deleteRowModerador(id) {
    $('table tbody [data-id="' + id + '"]').remove();
}

sendRequestModeradores('#form-add-moderador', 'nuevo', function (data, status) {
    showAlert('alert-success', 'Nuevo moderador agregado.');
    $('table tbody').prepend(data);
    $('.tip-container').remove();
    $('#modal-add-moderador').modal('hide');
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
