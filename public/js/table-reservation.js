$('.date').datepicker({
    format: "yyyy-mm-dd",
    startDate: "Today",
});

$('.submit-res').click(function () {
    var url = '/table-reservation';
    var token = $(this).data('token');
    $.ajax({
        url: url,
        type: 'POST',
        data: $('#form-reservation').serialize(),
        beforeSend: function(){
            $('.alert-res').hide();
            $('.success-res').hide();
            $('.loading-div').show();
            $('.fog').show();
        },
        complete: function(){
            $('.loading-div').hide();
            $('.fog').hide();
        },
        success: function (data) {
            if(data['success']){
                console.log(data['success']);
                $('.success-res p').text(data['message']);
                $('.success-res').show();
            }
            else{
                console.log(data['success']);
                $('.alert-res p').text(data['message']);
                $('.alert-res').show();
            }

        },
        error: function (data) {
            console.log('Error:', data);
        }

    });
    return false;
});