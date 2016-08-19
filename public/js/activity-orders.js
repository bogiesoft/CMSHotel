$(document).ready(function () {

    var departure = $('input[name=departure]').val();
    $('.date').datepicker({
        format: "yyyy-mm-dd",
        startDate: "Today",
        endDate: departure
    });
});