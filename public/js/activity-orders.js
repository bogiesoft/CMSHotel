$(document).ready(function () {

    var departure = $('input[name=departure]').val();
    $('.date').datepicker({
        format: "yyyy-mm-dd",
        startDate: "Today",
        endDate: departure
    });

    $('.btn-place-order').on('click', function () {
        var form = $('#form-reservation');
        var data = form.serializeArray();
        var url = form.attr('action');
        $.ajax({
            url: url,
            type: form.attr('method'),
            data: data,
            beforeSend: function(){
                $('.alert').hide();
                $('.loading-div').show();
                $('.fog').show();
            },
            complete: function(){
                $('.loading-div').hide();
                $('.fog').hide();
            },
            success: function (data) {
                var alert = $('.alert');
                if(data['success']){
                    alert.removeClass('alert-danger').addClass('alert-success');
                    alert.find('p').text(data['success']);
                    alert.show();
                }
                else if(data['error']){
                    console.log(data);
                    alert.removeClass('alert-success').addClass('alert-danger');
                    alert.find('p').text(data['error']);
                    alert.show();
                }

            },
            error: function (data) {
                console.log('Error:', data);
            }

        });
        return false;
    });
});