$(document).ready(function () {
    $(".iframe").fancybox({
        type: 'iframe',
        autoscale: false
    });

    $('#loader').hide();
    $('#loader').ajaxStart(function () {
        $(this).show();
    });
    $("#loader").ajaxStop(function () {
        $(this).hide();
    });

    $(window).keydown(function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            //     return false;
        }
    });
    $(document).on('change', '.btn-file :file', function () {
        var input = $(this),
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
    });

    $('.btn-file :file').on('fileselect', function (event, label) {
        var input = $(this).parents('.input-group').find(':text'),
            log = label;
        if (input.length) {
            input.val(log);
        } else {
            if (log) alert(log);
        }
    });

    function readURL(input) {
        // if (input.files && input.files[0]) {
        //     var reader = new FileReader();
        //     reader.onload = function (e) {
        //         $('#img-upload').attr('src', e.target.result);
        //     }
        //     reader.readAsDataURL(input.files[0]);
        // }
    }

    $("#imgInp").change(function () {
        readURL(this);
    });

    setTimeout(function () {
            $('.page-message').hide()
        }, 5000
    );

    $('.date').datepicker({  

       format: 'mm-dd-yyyy',
       autoclose: true

     }); 

});
