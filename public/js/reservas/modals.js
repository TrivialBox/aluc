// Modal add-moderador
$('#modal-add-reserva').on(
    'shown.bs.modal',
    function (e) {
        $('#modal-add-reserva #id_laboratorio').focus();
    }
);
