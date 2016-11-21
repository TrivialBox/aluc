$('#modal-add-moderador').on(
    'shown.bs.modal',
    function () {
        $('#modal-add-moderador #id').focus();
});

$('#modal-confirm-delete-moderador').on(
    'shown.bs.modal',
    function () {
        $('#modal-confirm-delete-moderador .btn-secondary').focus();
});
