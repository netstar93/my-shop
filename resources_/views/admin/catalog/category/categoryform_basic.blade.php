<!-- <input type="hidden" name="status" value = "1" class="checkbox" /> -->


<div class="form-group form-inline">                        
    <label for="name">Enable</label>
    <input type="checkbox" class="form-control form-control-lg" value ="1" name="status" required="true">
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>

<div class="form-group form-inline">                        
    <label for="name">Name</label>
    <input type="text" class="form-control form-control-lg" name="name" required="">
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>

<div class="form-group form-inline">                        
    <label for="name">Show on FrontEnd</label>
    <input type="radio" class="form-control form-control-lg" value ="1" name="visibility" required="true"> Yes
    <input type="radio" class="form-control form-control-lg" value ="0" name="visibility" required="true"> No
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>

<div class="form-group form-inline">                        
    <label for="description">Description</label>
    <input type="text" class="form-control form-control-lg" name="description" required="">
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>

<div class="form-group form-inline">                        
    <label for="name">URL Key</label>
    <input type="text" class="form-control form-control-lg" name="url_key" required="">
    <div class="invalid-feedback">Oops, you missed this one.</div>
</div>

<div class="form-group form-inline">                        
    <label for="name">Parent Category</label>
    <input type ="radio" name="parent_cat_id" id="parent_cat_id" value="1"> Men
    <input type ="radio" name="parent_cat_id" id="parent_cat_id" value="2"> Women
    <input type ="radio" name="parent_cat_id" id="parent_cat_id" value="3"> Electronics
</div>