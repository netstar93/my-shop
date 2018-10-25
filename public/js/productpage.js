/**
 * Created by Nitish on 08 Sep.
 */
var selected_color = false;
$(document).ready(function() {
    $('.selection li').click(function (e) {
        selected_color = true;
    });

    
    var tick = "<i class=\"fa fa-check-circle\" style=\"font-size:32px;float:right\"></i>";
    
    $('[data-fancybox="images"]').fancybox({
    afterLoad : function(instance, current) {
        var pixelRatio = window.devicePixelRatio || 1;

        if ( pixelRatio > 1.5 ) {
            current.width  = current.width  / pixelRatio;
            current.height = current.height / pixelRatio;
        }
    }
});

    var product_id = parseInt($('#productId' +
        '').val());
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $('#addtocart').click(function(){        
        var is_configurable_product = $('#is_configurable').val();
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
                $('#successModal').removeClass('hide');
                $.fancybox.open({
                    src  : '#successModal',
                    type : 'inline',
                    opts : {
                        afterShow : function( instance, current ) {
                            console.info( 'done!' );
                        }
                    }
                });
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

    $(document).on('click', '#shipping-next', function (e) {
        // $('#shipping-next').click(function(e) {
        var shipping_id = $("input[name='address']:checked"). val();
        if(!shipping_id){
          $('.customer_address_form .error-validation').show();
         }
        else{
            $('section.shipping label').append(tick);
            $('.customer_address_form .error-validation').hide();
        $("#address_id").val(shipping_id);
        $('section.shipping label').trigger('click');
        $('section.summary label').trigger('click'); 
        $('section.summary').addClass('active');       
        $('.main_content').css('height','10px');
     }
    });

    $('#summary-next').click(function(e) {
        $('section.summary label').append(tick);
        $('section.summary label').trigger('click');
        $('section.payment label').trigger('click');    
         $('section.payment').addClass('active');  
        $('.orderBtn').removeClass('hidden');
    });
 
    $('#address-submit').click(function(e) {
        e.preventDefault();
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var formData = $('#shipping-form').serialize();
        var emptyFields = $('#shipping-form input, #shipping-form textarea, #shipping-form select').filter(function () {
            return $(this).val() === "";
        }).length;
        if (emptyFields > 0) {
            $('.customer_address_form .error-validation').show();
            $('#shipping-form .form-control').css('border-color', 'red');
            return false;
        } else {
            $('.customer_address_form .error-validation').hide();
        }
        $.ajax({
            url: '/customer/address/save',
            type: 'POST',
            data: formData,
            dataType: 'JSON',
            success: function (data) {
                if (data.success) {
                    $("#address_id").val(data.id);
                    appendAddress();
                    $('section.shipping label.step').append(tick);
                    $('section.shipping label').trigger('click');
                    $('section.summary').addClass('active');
                    $('section.summary label').trigger('click');
                }
            }
        });
    });

    function appendAddress() {
        $.ajax({
            url: '/customer/address/getAddress_html',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) {
                if (data.address_html) {
                    $('.customer_address_form').append(data.address_html);
                    $('#shipping-form').hide();
                }
            }
        });
    }

    $('#checkout_login_submit').click(function(e) {
        e.preventDefault();
        var form = $('#checkout_login_form');
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var formData = $('#checkout_login_form').serialize();
        if ($('input[name="email"]').val() == '' || $('input[name="password"]').val() == '') {
          $('.error-validation').show(); return false;
        }else{ $('.error-validation').hide();}
        
        $('#loader').show();
        
        $.ajax({           
            url: '/customer/checklogin',
            type: 'POST',            
            data: formData,
            dataType: 'JSON',            
            success: function (data) {
                $('#loader').hide();
                if (data.success) {
                    $('section.account label.step').append(tick);
                    $('section.account label.step').trigger('click');
                    $('section.account label').css('pointer-events', 'none')
                    $('section.shipping label').trigger('click');
                    $('form#checkout_login_form').hide();
                    appendAddress();
                }else{                    
                    $('.error-validation').text('Invalid Credentials !!'); 
                    $('.error-validation').show();
                }
            },
            error: function(request, status, error) {
                if(request.status == 422) {
                   var error_msg  = $.parseJSON(request.responseText);
                   $('#loader').hide();
                   $('.error-validation').text(error_msg.email); 
                   $('.error-validation').show();
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
            $('#payment-method .error-validation').hide();
            form .submit();          
        }else{          
          event.preventDefault();
          event.stopPropagation();
         $('#payment-method .error-validation').show();
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