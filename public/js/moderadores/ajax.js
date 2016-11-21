function sendRequestModeradores(form, action, success) {
    $(form).submit(function (e) {
        $.post(
            "/admin/moderadores/" + action,
            $(this).serialize(),
            function (data, status) {
                if (data.status && data.status === 'error') {
                    showAlert('alert-danger', data.description);
                } else {
                    success(data, status);
                }
            }
        );
        e.preventDefault();
    });
}

function addNewRowModerador(moderador) {
    var newRow = $('<tr>');
    newRow.append($('<td>', {
        'value': moderador.id,
        'html': moderador.id
    }));
    newRow.append($('<td>', {
        'html': moderador.nombre
    }));
    laboratorio = moderador.laboratorio;
    newRow.append($('<td>', {
        'value': laboratorio.id,
        'html': laboratorio.nombre + '(' + laboratorio.id + ')'
    }));
    newRow.append($('<td>', {
        'html': `
            <div value=${moderador.id} class="btn-group" role="group">
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-moderador">
                    Editar
                </button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-confirm-delete-moderador">
                    Eliminar
                </button>
            </div>`
    }));
    $('table tbody').prepend(newRow);
    $('.tip-container').remove();
}

sendRequestModeradores('#form-add-moderador', 'nuevo', function (data, status) {
    showAlert('alert-success', 'Nuevo moderador agregado.');
    addNewRowModerador(data);
    $('#modal-add-moderador').modal('hide');
});
