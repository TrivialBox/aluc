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
