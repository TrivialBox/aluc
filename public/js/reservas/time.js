$(function () {
    $('#date-picker-reserva').datetimepicker({
        locale: 'es',
        format: 'DD-MM-YYYY'
    });
});

$(function () {
    $('#hora-inicio-reserva').datetimepicker({
        locale: 'es',
        format: 'LT'
    });
    $('#hora-fin-reserva').datetimepicker({
        locale: 'es',
        format: 'LT',
        useCurrent: false //Important! See issue #1075
    });
    $("#hora-inicio-reserva").on("dp.change", function (e) {
        $('#hora-fin-reserva').data("DateTimePicker").minDate(e.date);
    });
    $("#hora-fin-reserva").on("dp.change", function (e) {
        $('#hora-inicio-reserva').data("DateTimePicker").maxDate(e.date);
    });
});

