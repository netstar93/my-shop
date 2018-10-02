/**
 * Created by Nitish on 19 Aug.
 */
$(document).ready(function() {

$('.cart-item-remove').click(function(e) {
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    var product_id = $(this).attr('value');
    $.ajax({
        url: '/cart/remove/',
        type: 'POST',
        data: {'product_id' : product_id},
        dataType: 'JSON',
        success: function (data) {
            if(data.success){
                location.reload();
            }
        }
    });
});
});