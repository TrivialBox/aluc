$('#reservas-nuevas-tab').on(
    'show.bs.tab',
    function (e) {
        var laboratorio_id = $('#laboratorios').val();
        $.ajax({
            'type': 'get',
            'url': 'reservas',
            'data': {
                'type': 'new',
                'laboratorio_id': laboratorio_id
            },
            'beforeSend': function () {
                $('.loader-container').show();
            },
            'success': function (data, status) {
                if (data.status && data.status === 'error') {
                    showAlert('alert-danger', data.description);
                } else {
                    $('#reservas-content').html(data);
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
        var laboratorio_id = $('#laboratorios').val();
        $.ajax({
            'type': 'get',
            'url': 'reservas',
            'data': {
                'type': 'old',
                'laboratorio_id': laboratorio_id
            },
            'beforeSend': function () {
                $('.loader-container').show();
            },
            'success': function (data, status) {
                if (data.status && data.status === 'error') {
                    showAlert('alert-danger', data.description);
                } else {
                    $('#reservas-content').html(data);
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
