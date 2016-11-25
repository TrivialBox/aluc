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
