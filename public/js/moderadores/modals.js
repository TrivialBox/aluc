$('#modal-add-moderador').on(
    'shown.bs.modal',
    function (e) {
        $('#modal-add-moderador #id').focus();
});

$('#modal-confirm-delete-moderador').on(
    'shown.bs.modal',
    function (e) {
        var id = $(e.relatedTarget).parent().parent().parent().data('id');
        $('#modal-confirm-delete-moderador #id-moderador').html(id);
        $('#form-delete-moderador #id').val(id);
        $('#modal-confirm-delete-moderador .btn-secondary').focus();
});

$('#modal-edit-moderador').on(
    'shown.bs.modal',
    function (e) {
        var id = $(e.relatedTarget).parent().parent().parent().data('id');
        $('#form-edit-moderador #id').val(id);
        $('#modal-edit-moderador #id_laboratorio').focus();
});
