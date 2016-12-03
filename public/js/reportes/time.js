$(function () {
    $('#fecha-inicio').datetimepicker({
        locale: 'es',
        format: 'DD-MM-YYYY',
    });
    $('#fecha-fin').datetimepicker({
        locale: 'es',
        format: 'DD-MM-YYYY',
        useCurrent: false //Important! See issue #1075
    });
    $("#fecha-inicio").on("dp.change", function (e) {
        $('#fecha-fin').data("DateTimePicker").minDate(e.date);
    });
    $("#fecha-fin").on("dp.change", function (e) {
        $('#fecha-inicio').data("DateTimePicker").maxDate(e.date);
    });
});
