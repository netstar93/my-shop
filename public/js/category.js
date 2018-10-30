/**
 * Created by Nitish on 29 OCT.
 */
$(document).ready(function() {
	var filters = [];

$('.right-filter li input[type="checkbox"]'). click(function() {
	var filterVal = $(this) .val();
	var filterName = $(this) .attr('name');
	var fil_tmp = [];
	fil_tmp[filterName] = filterVal;
	filters.push(fil_tmp);

	JSON.stringify(filters);
	//filterProduct(filters);
})

function filterProduct(paramString) {
	var formData = {"filters" : JSON.stringify(paramString)};
		$.ajax({
            url: '/catalog/product/filter',
            type: 'GET',
            data: formData,
            dataType: 'JSON',
            success: function (data) {
                if (data.success) {
                   $('.category-list').html(data.html); 
                }
            }
        });
}

})