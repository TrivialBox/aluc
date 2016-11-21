function createAlert(type, msg) {
    var alertBootstrap = $('<div>', {
        'class': 'alert fade in alert-dismissible' + ' ' + type,
        'role': 'alert',
        'hidden': 'hidden'
    });
    var closeButton = $('<button>', {
        'class': 'close',
        'type': 'button',
        'data-dismiss': 'alert',
        'html': '<span>&times;</span>'
    });
    var alertMessage = $('<span>', {
        'class': 'alert-message',
        'html': '<span class="glyphicon glyphicon-ok text-muted"></span> ' + msg
    });
    alertBootstrap.append(closeButton);
    alertBootstrap.append(alertMessage);
    $('#container-alert').append(alertBootstrap);
    return alertBootstrap;
}

function showAlert(type, msg) {
    var alertBootstrap = createAlert(type, msg);
    alertBootstrap.show();
    alertBootstrap.delay(3000).slideUp(300, function () {
        $(this).alert('close');
    });
}
