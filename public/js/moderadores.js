var timeOutAlert = 0;

$('#form-add-moderador').submit(function (e) {
        $.post(
            "/admin/moderadores/nuevo",
            $('form').serialize(),
            function (data, status) {
                if (data['status'] && data['status'] === 'error') {
                    $('#wrongAlertMessage').html(data['description']);
                    var alert_wrong = $('#wrongAlert');
                    alert_wrong.show();
                    timeOutAlert = window.setTimeout(function () {
                            alert_wrong.hide();
                        },
                        3000
                    );
                } else {
                    var alertBootstrap = $('#successAlert');
                    $('#successAlertMessage').html('Nuevo moderador agregado.');
                    alertBootstrap.show();
                    timeOutAlert = window.setTimeout(function () {
                            alertBootstrap.hide();
                        },
                        3000
                    );
                    $('#table-moderadores tbody tr:first').before('<tr>' +
                        '<td>'+ data['id'] + '</td>' +
                        '<td>' + data['nombre'] + '</td>' +
                        '<td>' + data['laboratorio']['nombre'] + '(' + data['laboratorio']['id'] + ')' + '</td>' +
                        '<td>' + '<button type="button" class="btn btn-warning">Editar</button> <button type="button" class="btn btn-danger"> Eliminar </button>' +'</td>' +
                        '</tr>');
                    $('#addModerador').modal('hide');
                }
            }
        );
        e.preventDefault();
    }
);

$('.alert .close').click(function (e) {
    $('.alert').hide();
    window.clearTimeout(timeOutAlert);
});

