var load = 0;


rePopulatePeopleSelect();
$('#rooms').on('change', function () {
    rePopulatePeopleSelect();
});

$('#people').on('change', function () {
    calculatePrice();
});


function rePopulatePeopleSelect(){
    numPeople = $('#rooms option:selected').data('people');
    $('#people').find('option').remove();
    for (i = 1; i <= numPeople; i++) {
        $('#people').append($('<option>', {value:i, text:i}));
    }
    calculatePrice();

}

function calculatePrice(){
    numPeople = parseInt($('#people').val());
    price = parseInt($('#rooms option:selected').data('price'));

    if($('#arrival').val().length === 0 || $('#departure').val().length === 0){
        total = price * numPeople;
        updatePrice(total);
    }
    else{
        var data = $('#form-reservation').serializeArray();
        data.push({name : 'price', value: price});
        $.ajax({
            url: '/reservation/generate-price',
            type: 'GET',
            data: data,
            success: function (data) {
                console.log(data);
                updatePrice(data);
            },
            error: function (data) {
                console.log('Error:', data);
            }

        });
        return false;
    }
}



function updatePrice(total){

    $('#price').text(total);
    if(load > 0){
        var element = $('#price').parents('.form-group');
        var el2 = element.clone(true);
        element.before( el2 ).remove();
        el2.removeClass('bounceIn').addClass('bounceIn');
    }
    load += 1;
}


$('.submit-res').click(function () {
    var url = '/reservation';
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

///
var nowTemp = new Date();
var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

var checkin = $('#arrival').datepicker({
    onRender: function(date) {
        return date.valueOf() < now.valueOf() ? 'disabled' : '';
    }
}).on('changeDate', function(ev) {
    if (ev.date.valueOf() > checkout.date.valueOf()) {
        var newDate = new Date(ev.date)
        newDate.setDate(newDate.getDate() + 1);
        checkout.setValue(newDate);
    }
    checkin.hide();
    $('#departure')[0].focus();
}).data('datepicker');

var checkout = $('#departure').datepicker({
    onRender: function(date) {
        return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
    }
}).on('changeDate', function(ev) {
    checkout.hide();
    calculatePrice();
}).data('datepicker');
