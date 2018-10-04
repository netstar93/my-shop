@php 
$base_price = $special_price = null;
if($data){
    $base_price = $data ->base_price;
    $special_price = $data ->special_price;
}
@endphp


<div class="form-group form-inline">                        
    <label for="uname1">Material</label>
    <input type="text"  attr_id = "3" class="form-control form-control-lg" value="" name="custom['material']" >
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>
<div class="form-group form-inline">                        
    <label for="uname1">Is Printed</label>
    <select name="custom['is_printed']" attr_id = "4" class="form-control form-control-lg">
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>
      