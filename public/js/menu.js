$(document).ready(function () {

    $('.submit-order').on('click', function (e) {

        var url = '/meal-order';
        var token = $(this).data('token');
        $.ajax({
            url: url,
            type: 'POST',
            data: $('#meal-order-form').serializeArray(),
            beforeSend: function(){
                $('.success-res').hide();
                $('.loading-div').show();
                $('.fog').show();
            },
            complete: function(){
                $('.loading-div').hide();
                $('.fog').hide();
            },
            success: function (data) {
                console.log(data);
                if(data['success']){
                    $('.success-res p').text(data['message']);
                    $('.success-res').show();
                }
                else{
                    $('.success-res p').text(data['message']);
                    $('.success-res').addClass('alert-danger').removeClass('alert-success').show();
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }

        });
        return false;
    });
});