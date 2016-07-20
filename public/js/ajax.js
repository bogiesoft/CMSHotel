$(document).ready(function(){


    $('.delete-meal').click(function () {
        var url = '/dashboard/meals';
        var id = $(this).val();
        var token = $(this).data('token');
        $.ajax({
            url: url + '/' + id,
            type: 'delete',
            data: {_method: 'delete', _token: token},
            success: function (data) {
                console.log(data);

                $("#meal" + id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $('.delete-meal-type').click(function () {
        var url = '/dashboard/meal-types';
        var id = $(this).val();
        var token = $(this).data('token');
        $.ajax({
            url: url + '/' + id,
            type: 'delete',
            data: {_method: 'delete', _token: token},
            success: function (data) {
                console.log(data);

                $("#meal-type" + id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });



    $('.delete-room').click(function () {
        var url = '/dashboard/rooms';
        var id = $(this).val();
        var token = $(this).data('token');
        $.ajax({
            url: url + '/' + id,
            type: 'delete',
            data: {_method: 'delete', _token: token},
            success: function (data) {
                console.log(data);
                $("#room" + id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $('.delete-drink').click(function () {
        var url = '/dashboard/drinks';
        var id = $(this).val();
        var token = $(this).data('token');
        $.ajax({
            url: url + '/' + id,
            type: 'delete',
            data: {_method: 'delete', _token: token},
            success: function (data) {
                console.log(data);
                $("#drink" + id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $('.delete-table').click(function () {
        var url = '/dashboard/tables';
        var id = $(this).val();
        var token = $(this).data('token');
        $.ajax({
            url: url + '/' + id,
            type: 'delete',
            data: {_method: 'delete', _token: token},
            success: function (data) {
                console.log(data);
                $("#table" + id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $('.submit-res').click(function () {
        var url = '/reservation';
        var token = $(this).data('token');
        $.post({
            url: url,
            type: 'POST',
            data: $('#form-reservation').serialize(),
            beforeSend: function(){
                $('.alert-res').hide();
                $('.loading-div').show();
                $('.fog').show();
            },
            complete: function(){
                $('.loading-div').hide();
                $('.fog').hide();
            },
            success: function (data) {
                if(data == 'success'){
                    $('#form-reservation').hide();
                    $('#reservation-info').show();
                }
                if(data != 'success'){
                    $('.alert-res p').text(data);
                    $('.alert-res').show();
                }
                
            },
            error: function (data) {
                console.log('Error:', data);
            }

        });
        return false;
    });

});