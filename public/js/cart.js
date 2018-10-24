/**
 * Created by Nitish on 19 Aug.
 */
$(document).ready(function() {

    var quantitiy=0;
   $('.quantity-right-plus').click(function(e){
        
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());
        
        // If is not undefined
            
            $('#quantity').val(quantity + 1);

          
            // Increment
        
    });

     $('.quantity-left-minus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());
        
        // If is not undefined
      
            // Increment
            if(quantity>0){
            $('#quantity').val(quantity - 1);
            }
    });

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

    $('.right-filter input[type="checkbox"] ').click(function (e) {
        var filter_val = 1;//$(this).attr('value');
        $.ajax({
            url: '/cart/remove/',
            type: 'POST',
            data: {'product_id': filter_val},
            dataType: 'JSON',
            success: function (data) {
                if (data.success) {
                    location.reload();
                }
            }
        });
    });
});