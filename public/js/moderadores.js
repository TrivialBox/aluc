function addModerador() {
    var id = $('#id').val();
    var laboratorio_id = $('#laboratorio_id').val();
    $.post(
        "/admin/moderadores/nuevo",
        {
            'id': id,
            'laboratorio_id': laboratorio_id
        },
        function (data, status) {
            alert(data);
        }
    );
}

