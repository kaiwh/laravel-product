+ function($) {
    $.fn.cartStore = function(options) {
        var $this = $(this)
        var data = {
            product_id: (options.product_id && options.product_id != 'undefined') ? options.product_id : 0,
            option_id: (options.option_id && options.option_id != 'undefined') ? options.option_id : 0,
        };
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/product/cart/store',
            dataType: 'json',
            data: data,
        }).done(function(data) {
            if (data.error) {
                alert(data.error);
            } else if (data.success) {
                alert(data.success);
            }
        }).fail(function(data) {
            console.log(data);
        });
    }
}(jQuery); 