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
    var target = $('table tbody [data-id="' + id + '"]');
    target.addClass("bg-danger");
    target.fadeOut(700, function () {
        $(this).remove();
    });
}

function addRowMoredador(data) {
    $('table tbody').prepend(data);
    var target = $('table tbody tr:first');
    target.addClass("bg-success");
    setTimeout(function () {
        target.removeClass("bg-success");
    }, 900);
}

sendRequestModeradores('#form-add-moderador', 'nuevo', function (data, status) {
    showAlert('alert-success', 'Moderador agregado.');
    addRowMoredador(data);
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
    addRowMoredador(data);
    $('#modal-edit-moderador').modal('hide');
});
