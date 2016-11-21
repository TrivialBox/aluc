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

function addNewRowModerador(moderador) {
    var laboratorio = moderador.laboratorio;
    var newRow = $('<tr>', {
        'data-id': moderador.id,
        'html': `
            <td>
                ${moderador.id}
            </td>
            <td>
                ${moderador.nombre}
            </td>
            <td>
                ${laboratorio.nombre} (${laboratorio.id})
            </td>
            <td>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-moderador">
                        Editar
                    </button>

                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-confirm-delete-moderador">
                        Eliminar
                    </button>
                </div>
            </td>`
    });
    $('table tbody').prepend(newRow);
    $('.tip-container').remove();
}

function deleteRowModerador(id) {
    $('table tbody [data-id="' + id + '"]').remove();
}

sendRequestModeradores('#form-add-moderador', 'nuevo', function (data, status) {
    showAlert('alert-success', 'Nuevo moderador agregado.');
    addNewRowModerador(data);
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
