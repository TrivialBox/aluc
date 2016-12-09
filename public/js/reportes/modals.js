$('#fecha').change(function (e) {
    if ($(this).val() === "other") {
        $('#custom-date').collapse('show');
    } else {
        $('#custom-date').collapse('hide');
    }
});

function exportReport(type) {
    window.open('/escritorio/reportes/exportar' + '?' + $('#filter-form').serialize() + '&type=' + type, '_blank');
}

$('#export-pdf').on(
    'click',
    function (e) {
        exportReport('pdf');
        e.preventDefault();
    }
);

$('#export-csv').on(
    'click',
    function (e) {
        exportReport('csv');
        e.preventDefault();
    }
);


$(document).ready(function () {
    $('#fecha').trigger('change');
});

