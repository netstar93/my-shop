$(document).ready( function() {

		$(".iframe").fancybox({
	        type: 'iframe',
	        autoscale : false
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
		   var pageURL = $(location). attr("href");	
		   if(pageURL.indexOf('new') != -1){
		   	var referrer =  document.referrer;
			window.location.href = referrer; 
		   }else{	
			parent.jQuery.fancybox.getInstance().close();			
		   }
		});

		$('button#save').click(function(event){ 	
			$('form').submit();	
			parent.location.reload();
		});

		$('form').submit(function(event){ 
			var form = $("form");
		    if (form[0].checkValidity() === false) {
		      event.preventDefault();
		      event.stopPropagation();		      
		    }else{ 
		    	parent.jQuery.fancybox.close();
				parent.parent.jQuery.fancybox.close();
						    		
		    }			    
		    form.addClass('was-validated');	
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

    $('button#deleteItem').click(function(e){
    	var userselection = confirm("Are you sure you want to delete?");
    	if(userselection) {
        var item_id = $(this).attr('item_id');
        var entity = $(this).attr('entity');
        var request = $.ajax({
            url: "/admin/"+entity+"/delete",
            type: "GET",
            data: {id : item_id},
            dataType: "json",
            success: function(data){
                if(!data.error)
                    location.reload();
            }
        });
      }
    });

	$('#attributeset').change(function(){
	var attributeset_id = $.trim($(this).val());
	$.ajax(function(){
	});

	});


    var select_count = 1; 
    var select_label = select_count+1;

    $('#addOption').click(function(e){
        e.preventDefault();
        var edit_total = $('#selectOptions').attr('total');
        if(edit_total && edit_total > 0)
        {
        	select_count = parseInt(edit_total); 
            select_label = select_count+1
        }
        var html = '<div class="content"> <span>Value '+select_label +'</span><input name="select_option['+select_count+']" type="text"> <span><i class="fa fa-trash" aria-hidden="true" style="color:red"></i></span></div>';
        $('#selectOptions').append(html);
        select_count++;
        select_label++;
    });

    $('#attr_type').change(function(e){
		var type = $(this).val();
		var selectEntity = $('.selectContent');
		type == 'select' ? selectEntity.show() : selectEntity.hide();
		if(type == 'select'){

		}

    })

	});