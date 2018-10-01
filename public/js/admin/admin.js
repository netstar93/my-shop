$(document).ready( function() {

	$(".iframe").fancybox({
        type: 'iframe'
    });

    $(window).keydown(function(event){

        if(event.keyCode == 13) {

            event.preventDefault();

            return false;

        }

    });

		$("#category_save").click(function(){

		$('#category_form_button').trigger('click');

		});


    	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {
		    
		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;
		    
		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }
	    
		});
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        
		        reader.onload = function (e) {
		            $('#img-upload').attr('src', e.target.result);
		        }
		        
		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#imgInp").change(function(){
		    readURL(this);
		}); 


		//FORM FUNCTIONS		
		$('button#cancel').click(function(event){ 			
			parent.jQuery.fancybox.getInstance().close();			
		});

		$('button#save').click(function(event){ 			
			$('form').submit();			
		});

		$('button#editSave').click(function(event){ 			
			var form  = $('form');
			form.submit();
			if (form[0].checkValidity()){	
		 	   parent.jQuery.fancybox.getInstance().close();	
		 	   parent.location.reload();
			 }			
		});

		$('button#deleteRow').click(function(e){
			var item_id = $(this).attr('item_id');			
			var request = $.ajax({
			  url: "/admin/attribute/delete",
			  type: "GET",
			  data: {id : item_id},
			  dataType: "json",
			  success: function(data){
			  	if(!data.error)
				location.reload();
			  }
			});
			
		});

		$('form').submit(function(event){
			var form = $("form");
		    if (form[0].checkValidity() === false) {
		      event.preventDefault()
		      event.stopPropagation()
		    }		   
		    form.addClass('was-validated');	
		  
		});

		$('#attributeset').change(function(){
		var attributeset_id = $.trim($(this).val());
		$.ajax(function(){
		});

		});
	});