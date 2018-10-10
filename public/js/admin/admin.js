$(document).ready( function() {
    var formSubmitted = false;
		//FORM FUNCTIONS		
		$('button#cancel').click(function(event){ 	
		   var pageURL = $(location). attr("href");
            if (pageURL.indexOf('neddw') != -1) {
		   	var referrer =  document.referrer;
			window.location.href = referrer; 
		   }else{	
			parent.jQuery.fancybox.getInstance().close();			
		   }
		});

    $('button#save').click(function (event) {

        if ($('form').submit()) {

		setTimeout(function(){   alert(formSubmitted);
					           
			                parent.jQuery.fancybox.close();
							parent.parent.jQuery.fancybox.close();
			                //location.reload();
			        		          		
			        },4000);
					}
	});

    $('button#saSSSve').click(function(e){ 
    		//e.preventDefault();
			var form = $("form");			
		    if (form[0].checkValidity() === false) {		  
		      event.preventDefault();
		      event.stopPropagation();			 
            }
			var request = $.ajax({
			  url: "/admin/attribute/save",
			  type: "POST",
			  data: form.serialize(),
			  dataType: "json",
			  success: function(data){
			  	alert(data.error);
			  	if(!data.error){}
				//location.reload();
			  }
			});
			
		});

		$('form').submit(function(event){ 
			event.preventDefault();
			var form = $("form");
		    if (form[0].checkValidity() === false) {
		      event.preventDefault();
		      event.stopPropagation(); 
            } else {
            	this.submit();
            	formSubmitted = true;            			    	
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

    /*
    * DYNAMICALLY APPEND OTHER ATTRIBUTES HTML ON PRODUCT FORM
    */
	$('#attributeset').change(function(){
	var attributeset_id = $.trim($(this).val());
	var request = $.ajax({
            url: "/admin/attribute/list",
            type: "GET",
            data: {set_id : attributeset_id},
            dataType: "json",
            success: function(data){
                if(data.html)
                    $('#other_attribute').html(data.html);
                else
                	alert('something wrong');
            }
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