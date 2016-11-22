/*jshint esversion: 6 */

function sendRequest(form, method, url, success) {
    $(form).submit(function (e) {
        $.ajax({
            'type': method,
            'url': url,
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
