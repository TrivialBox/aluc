$(document).ready( function () {
    $('#table-lectores-qr').DataTable({
        order: [[2, 'asc']],
        columns: [
            null,
            null,
            null,
            { "searchable": false, "orderable": false},
            { "searchable": false, "orderable": false}
        ],
        lengthMenu: [[10, 50, 100, -1], [10, 50, 100, "Todo"]],
        pageLength: -1,
        language: translattionTable
})});
