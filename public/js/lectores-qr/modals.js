// Modal add-lector-qr
$('#modal-add-lector-qr').on(
    'shown.bs.modal',
    function (e) {
        $('#modal-add-lector-qr #mac').focus();
});

// Modal confirm-delete-lector-qr
$('#modal-confirm-delete-lector-qr').on(
    'show.bs.modal',
    function (e) {
        var mac = $(e.relatedTarget).parent().parent().parent().data('mac');
        $('#modal-confirm-delete-lector-qr #mac-lector-qr').html(mac);
        $('#form-delete-lector-qr #mac').val(mac);
});

$('#modal-confirm-delete-lector-qr').on(
    'shown.bs.modal',
    function (e) {
        $('#modal-confirm-delete-lector-qr .btn-secondary').focus();
});

// Modal edit-lector-qr
$('#modal-edit-lector-qr').on(
    'show.bs.modal',
    function (e) {
        var row = $(e.relatedTarget).parent().parent().parent();
        var mac = row.data('mac');
        var ip = row.data('ip');
        var id_laboratorio = row.data('laboratorio-id');
        var form = $('#form-edit-lector-qr');
        form.find('#mac').val(mac);
        form.find('#ip').val(ip);
        form.find('#id_laboratorio').val(id_laboratorio);
});

$('#modal-edit-lector-qr').on(
    'shown.bs.modal',
    function (e) {
        $('#modal-edit-lector-qr #ip').focus();
});

// Modal update-token-lector-qr
$('#modal-confirm-update-token-lector-qr').on(
    'show.bs.modal',
    function (e) {
        var mac = $(e.relatedTarget).parent().parent().parent().parent().parent().data('mac');
        $('#modal-confirm-update-token-lector-qr #mac-lector-qr').html(mac);
        $('#form-update-token-lector-qr #mac').val(mac);
});

$('#modal-confirm-update-token-lector-qr').on(
    'shown.bs.modal',
    function (e) {
        $('#modal-confirm-update-token-lector-qr .btn-secondary').focus();
});

// Show and hide tokens
$('table').on(
    'click',
    '.collapse-token',
    function () {
        console.log('hola');
        $(this).parent().parent().parent().find('.collapse').collapse('toggle');
    }
);
