$('#fecha').change(function (e) {
    if ($(this).val() === "other") {
        $('#custom-date').collapse('show');
    } else {
        $('#custom-date').collapse('hide');
    }
});

$(document).ready(function () {
    $('#fecha').trigger('change');
});
