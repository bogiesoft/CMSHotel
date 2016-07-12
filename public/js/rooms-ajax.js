$(document).ready(function(){
    var url = '/dashboard/rooms';

    $('.delete-room').click(function () {
        var room_id = $(this).val();
        var token = $(this).data('token');
        $.ajax({
            url: url + '/' + room_id,
            type: 'delete',
            data: {_method: 'delete', _token: token},
            success: function (data) {
                console.log(data);
                $("#room" + room_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});