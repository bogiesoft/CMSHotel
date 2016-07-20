$('.input-daterange').datepicker({
    format: "dd-mm-yyyy",
    startDate: "Today",
    orientation: "bottom left",
    leftArrow: '<i class="fa fa-long-arrow-left"></i>',
    rightArrow: '<i class="fa fa-long-arrow-right"></i>',
    datesDisabled: ['today'],
    todayHighlight:"true"
});

rePopulatePeopleSelect();
updatePrice();
$('#rooms').on('change', function () {
    rePopulatePeopleSelect();
    updatePrice();
});

$('#people').on('change', function () {
    updatePrice();
})

function rePopulatePeopleSelect(){
    numPeople = $('#rooms option:selected').data('people');
    $('#people').find('option').remove();
    for (i = 1; i <= numPeople; i++) {
        $('#people').append($('<option>', {value:i, text:i}));
    }

}

function updatePrice(){
    numPeople = parseInt($('#people').val());
    price = parseInt($('#rooms option:selected').data('price'));
    total = price * numPeople;
    $('#price').text(total);
}

$('.submit-res').click(function () {
    var url = '/reservation';
    var token = $(this).data('token');
    $.post({
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
                //$('#reservation-info').show();
                console.log(data);
                $('.success-res p').text(data['message']);
                $('.success-res').show();
            }
            else{
                console.log(data);
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