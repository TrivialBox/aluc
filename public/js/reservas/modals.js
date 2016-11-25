// Modal add-moderador
$('#modal-add-reserva').on(
    'shown.bs.modal',
    function (e) {
        $('#modal-add-reserva #id_laboratorio').focus();
    }
);


// Modal confirm-cancel-reserva
$('#modal-confirm-cancel-reserva').on(
    'show.bs.modal',
    function (e) {
        var id = $(e.relatedTarget).parent().data('id');
        $('#form-cancel-reserva #id').val(id);
});

$('#modal-confirm-cancel-reserva').on(
    'shown.bs.modal',
    function (e) {
        $('#modal-confirm-cancel-reserva .btn-secondary').focus();
});

// QR code
$('#modal-show-qr').on(
    'show.bs.modal',
    function (e) {
        var id = $(e.relatedTarget).parent().data('id');
        $.ajax({
            'type': 'get',
            'url': '/reservas/codigo-qr',
            'data': {'id': id},
            'beforeSend': function () {
                $('.loader-container').show();
            },
            'success': function (data, status) {
                if (data.status && data.status === 'error') {
                    showAlert('alert-danger', data.description);
                } else {
                    $('#qr-code-img').html(data);
                    var img_src = $('#qr-code-img img').attr('src');
                    $('#btn-download-qr').attr('href', img_src);
                }
            },
            'error': function () {
                showAlert('alert-danger', 'Ups, algo inesperado ocurrió.');
            },
            'complete': function () {
                $('.loader-container').hide();
            }
        });
    }
);


// Tabs
$('#reservas-nuevas-tab').on(
    'show.bs.tab',
    function (e) {
        $.ajax({
            'type': 'get',
            'url': 'reservas',
            'data': {'type': 'new'},
            'beforeSend': function () {
                $('.loader-container').show();
            },
            'success': function (data, status) {
                if (data.status && data.status === 'error') {
                    showAlert('alert-danger', data.description);
                } else {
                    $('#reservas-nuevas-content').html(data);
                }
            },
            'error': function () {
                showAlert('alert-danger', 'Ups, algo inesperado ocurrió.');
            },
            'complete': function () {
                $('.loader-container').hide();
            }
        });
    }
);

$('#reservas-pasadas-tab').on(
    'show.bs.tab',
    function (e) {
        $.ajax({
            'type': 'get',
            'url': 'reservas',
            'data': {'type': 'old'},
            'beforeSend': function () {
                $('.loader-container').show();
            },
            'success': function (data, status) {
                if (data.status && data.status === 'error') {
                    showAlert('alert-danger', data.description);
                } else {
                    $('#reservas-pasadas-content').html(data);
                }
            },
            'error': function () {
                showAlert('alert-danger', 'Ups, algo inesperado ocurrió.');
            },
            'complete': function () {
                $('.loader-container').hide();
            }
        });
    }
);
