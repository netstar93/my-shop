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
        $('form').submit();
	});

	$('button#duplicate').click(function(e){  
		var product_id = $.trim($('#product_id').val());					
		var request = $.ajax({
		  url: "/admin/product/duplicate",
		  type: "POST",
		  data: {'product_id' : product_id},
		  dataType: "json",
		  success: function(data){
		  	alert(data.error);
		  	if(!data.error){}
			 location.reload();
		  }
		});			
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
	var attributeset_text = $.trim($('#attributeset :selected').text());
	var child_product_tab_entity = $('#child_product_tab');
	
	//HARD CODED ATTRIBUTE SET NAME
	attributeset_text == 'Clothes' || attributeset_text == 'Shoes' ? child_product_tab_entity. show() : child_product_tab_entity. hide();


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
    var product_count = 1; 
    var product_label = product_count+1;


    $('#addOption').click(function(e){
        e.preventDefault();
        var edit_total = $('#selectOptions').attr('total');
        if(edit_total && edit_total > 0)
        {
        	select_count = parseInt(edit_total); 
            select_label = select_count+1
        }
        var html = '<div class="value"> <span>Value '+select_label +' </span><input name="select_option['+select_count+']" type="text"> <span><i class="fa fa-trash" aria-hidden="true" style="color:red"></i></span></div>';
        $('#selectOptions').append(html);
        select_count++;
        select_label++;
    });

    $('#addMoreProduct').click(function(e){
        e.preventDefault();
        var html = '';
        var edit_total = $('#productForm').attr('total');
        if(edit_total && edit_total > 0)
        {
        	product_count = parseInt(edit_total); 
            product_label = product_count+1
        }

		var request = $.ajax({
            url: "/admin/product/getFormhtml",
            type: "GET",
            data: {count : product_count},
            dataType: "json",
            success: function(data){
                if(data.html)
                   $('#productForm').append(data.html);
                else
                	alert('something wrong');
            }
        });

              
        product_count++;
        product_label++;
    });

    var default_type = $('#attr_type').val();
    if (typeof default_type != 'undefind') {
        var selectEntity = $('.selectContent');
        default_type == 'select' ? selectEntity.show() : selectEntity.hide();
    }

    $('#attr_type').change(function (e) {
        var type = $(this).val();
        var selectEntity = $('.selectContent');
        type == 'select' ? selectEntity.show() : selectEntity.hide();
    });

    $('#addComment').click(function (e) {
        var formData = {'comment': $('#comment').val(), 'notify': $('#notify').val()};
        $.ajax({
            url: "/admin/order/add_comment",
            type: 'post',
            data: formData,
            dataType: "json",
            success: function (data) {
                if (!data.error) {
                    showMessage('Comment added');
                    window.location.reload();
                }
                else
                    showMessage('Something wrong happend !!', 'error');
            }
        })
    })

    $('.processStatus button').click(function (e) {
        var status = $(this).attr('status');
        var title = $(this).text();
        swal({
            title: "Are you sure?",
            text: "You cannot undo this action !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55  ",
            confirmButtonText: "Yes, Do Now!",
            closeOnConfirm: false
        }, function () {
            var formData = {'status': status, 'title': title};
            $.ajax({
                url: "/admin/order/update",
                type: 'post',
                data: formData,
                dataType: "json",
                success: function (data) {
                    if (!data.error) {
                        swal('Done', 'Order successfully updated to Status ' + title, 'success');
                    }
                    else
                        swal('Sorry !!', 'Not Done', 'error');
                }
            })
        });
    })

    $('#cancelOrdeXXr').on('click', function () {
        swal({
            title: "Are you sure?",
            text: "You cannot undo this action !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55  ",
            confirmButtonText: "Yes, Cancel Now!",
            closeOnConfirm: false
        }, function () {
            var formData = {'status': $('#comment').val()};
            $.ajax({
                url: "/admin/order/update",
                type: 'post',
                data: formData,
                dataType: "json",
                success: function (data) {
                    if (!data.error) {
                        swal('Cancelled', 'Order cancelled now', 'success');
                    }
                    else
                        swal('Not Cancelled', 'Sorry cannot cancel', 'error');
                }
            })
        });
    });

    $('body').on('click', '.sa-button-container .confirm', function () {
        // window.location.reload();
    })

    function showMessage(msg, type = 'success') {
        var html = '<div class=\"page-message alert alert-success alert-dismissable text-center\">' +
            '<i class=\"fa fa-check-square-o\" style=\"font-size: 25px;\"></i>' + msg + '</div>';
        $('.messages').append(html);
    }
	});