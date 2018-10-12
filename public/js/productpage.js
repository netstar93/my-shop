/**
 * Created by Nitish on 08 Sep.
 */

var selected_color = false;

$(document).ready(function() {

$('.selection li').click(function(e){
    selected_color = true;
});

    var product_id = parseInt($('#productId' +
        '').val());
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $('#addtocart').click(function(){
        var is_configurable_product = $('#is_configurable').val();
        console.log(is_configurable_product + "   " +selected_color);
        if(is_configurable_product == 1) {
            if(selected_color == false){
              $('.no-selection-error').removeClass('hide');
              return false;
            }
        }

        $.ajax({
            /* the route pointing to the post function */
            url: '/catalog/product/addtocart',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {_token: CSRF_TOKEN, product_id: product_id},
            dataType: 'JSON',
            success: function (data) {
                $('#myModal').modal('show');
            }
        });
    });

    $('#submit').click(function() {
        var email_id = $.trim($('#email').val());
        var password = $.trim($('#password').val());
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            /* the route pointing to the post function */
            url: '/customer/checklogin',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: { _token : csrf_token,email: email_id,password:password,ajax:true},
            dataType: 'JSON',
            success: function (data) {
                if(data.success){
                    $('section.account label').trigger('click');
                    $('section.shipping label').trigger('click');
                }
            }
        });
    });


    $('#shipping-next').click(function(e) {
        var shipping_id = $("input[name='address']:checked"). val();

        if(!shipping_id){
         alert('Select shipping Address'); return false;
         }
        else{
        $("#address_id").val(shipping_id);
        $('section.shipping label').trigger('click');
        $('section.summary label').trigger('click'); 
        $('section.summary').addClass('active');       
        $('.main_content').css('height','10px');
     }
    });

    $('#summary-next').click(function(e) {
        $('section.summary label').trigger('click');
        $('section.payment label').trigger('click');    
         $('section.payment').addClass('active');  
        $('.orderBtn').removeClass('hidden');
    });
 
    $('#address-submit').click(function(e) {
        e.preventDefault();
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var formData = $('#shipping-form').serialize();
        $.ajax({
            url: '/customer/address/save',
            type: 'POST',
            data: formData,
            dataType: 'JSON',
            success: function (data) {
                if(data.success){
                   $("#address_id").val(data.id);
                    $('section.shipping label').trigger('click');
                    $('section.summary label').trigger('click');
                }
            }
        });
    });

    $('#checkout_login_submit').click(function(e) {
        e.preventDefault();
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var formData = $('#checkout_login_form').serialize();
        if(!formData) alert('Fill Login Form '); return false;
        $.ajax({
            /* the route pointing to the post function */
            url: '/customer/checklogin',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: formData,
            dataType: 'JSON',
            success: function (data) {
                if(data.success){
                    $('section.account label').trigger('click');
                    $('section.account label').css('pointer-events', 'none')
                    $('section.shipping label').trigger('click');
                }
            }
        });
    });

    $('#ordernow').click(function(event) {
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var form = $('#mainForm');

        var payment_type = $("input[name='payment-method']:checked"). val();
        $("#payment_type").val(payment_type);
        var payment_type = $('#payment_type').val();
        var address_id = $('#address_id').val();
        if (payment_type && address_id) {
            form .submit();          
        }else{          
          event.preventDefault();
          event.stopPropagation();
          alert('Checkout Data Missing !!');
        }
        form.addClass('was-validated');
    });

    $('form').submit(function(event){
        var form = $("form");
        if (form[0].checkValidity() === false) {
          event.preventDefault()
          event.stopPropagation()
        }          
        form.addClass('was-validated'); 
    });

});