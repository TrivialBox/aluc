// Modal add-moderador
$('#modal-add-moderador').on(
    'shown.bs.modal',
    function (e) {
        $('#modal-add-moderador #id').focus();
});

// Modal confirm-delete-moderador
$('#modal-confirm-delete-moderador').on(
    'show.bs.modal',
    function (e) {
        // Tatara tatara...
        var id = $(e.relatedTarget).parent().parent().parent().data('id');
        $('#modal-confirm-delete-moderador #id-moderador').html(id);
        $('#form-delete-moderador #id').val(id);
});

$('#modal-confirm-delete-moderador').on(
    'shown.bs.modal',
    function (e) {
        $('#modal-confirm-delete-moderador .btn-secondary').focus();
});

// Modal edit-moderador
$('#modal-edit-moderador').on(
    'show.bs.modal',
    function (e) {
        var row = $(e.relatedTarget).parent().parent().parent();
        var id = row.data('id');
        var id_laboratorio = row.data('laboratorio-id');
        var form = $('#form-edit-moderador');
        form.find('#id').val(id);
        form.find('#id_laboratorio').val(id_laboratorio);
});

$('#modal-edit-moderador').on(
    'shown.bs.modal',
    function (e) {
        $('#modal-edit-moderador #id_laboratorio').focus();
});
