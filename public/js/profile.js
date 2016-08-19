$(document).ready(function () {
    $('.receipt-button').popover({
        container: 'body',
        content: function() {
            return $("#receipt-popover" + $(this).val()).html();
        }
    });

    function setCurrentRating(group){
        var rating = group.attr('data-rating');
        if(rating == 0){
            group.find('button').each(function () {
                $(this).find('span').removeClass('fa-star').addClass('fa-star-o');
                $(this).addBack().nextAll().find('span').removeClass('fa-star').addClass('fa-star-o');
            });
        }
        else{
            var btn = $('.rating' + rating, group);
            btn.nextAll().find('span').removeClass('fa-star').addClass('fa-star-o');
            btn.prevAll().addBack().children('span').removeClass('fa-star-o').addClass('fa-star');
        }

    }

    $('.rating-disabled > button').each(function () {
        $(this).removeClass('change-rating').addClass('disabled');
        $(this).attr('title', 'You can rate this reservation after your stay');
    });

    $('.change-rating').hover(
        //mouseover
        function () {
            $(this).prevAll().addBack().find('span').removeClass('fa-star-o').addClass('fa-star');
            $(this).nextAll().find('span').removeClass('fa-star').addClass('fa-star-o');
        },
        //mouseout
        function(){
            setCurrentRating($(this).parent('.btn-group'));
        }
    );


    $('.change-rating').click(function () {
        var btn = $(this);
        var form = btn.closest('form');
        var formData = form.serializeArray();
        var id = form.find('.reservation-id').val();
        formData.push({ name: "rating", value: btn.val() });
        $.ajax({
            url:  form.attr('action'),
            type: 'post',
            data: formData,
            success: function (data) {
                var group = $('#'+ form.data('type') +'-rating-group' + id);
                group.attr('data-rating', btn.val());
                setCurrentRating(group);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
        return false;
    });
});