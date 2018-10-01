@include('admin.components.head') 
<div class="right-side editform-wrapper">
    <div class="page-header">        
       <h3>Editing {{ucfirst($formData['name'])}}</h3>        
    </div>
    <div class="actions">
    	<span class="breadcrump col-lg-8" style="display: inline-block;float:left">Admin/Attribute/Edit</span>
    	<span class="action-buttons col-lg-4">
	    	<span class="action-btn"><button type="submit" class="btn btn-success" id="editSave" >Save</button></span>
	    	<span class="action-btn"><button class="btn btn-primary" id="cancel" >Cancel</button></span>
    	</span>
	</div>
    <div class="form-wrapper">
	    <div class="container form-content">
			<form class="form" role="form" action="/admin/attribute/save" id="attribute-form" novalidate="" method="POST" enctype="multipart/form-data">
				        s{!! csrf_field() !!}
                <input type="hidden"  value="{{$formData['id']}}" name="id">
                
                <div class="form-group form-inline">                        
                    <label for="name">Enable</label>
                    <input type="checkbox" checked data-style="ios" class="form-control required" value ="1" name="status" required="true">
                    <div class="invalid-feedback">Oops, you missed this one.</div>
                </div>

                <div class="form-group form-inline">                        
                    <label for="name">Name</label>
                    <input type="text"  value="{{$formData['name']}}" class="form-control form-control-lg" name="name" required="">
                    <div class="invalid-feedback">Oops, you missed this one.</div>
                </div>

                <div class="form-group form-inline">                        
                   <label for="name">Type</label>
                   <select name="type">
                       <option value= "text">Textbox</option>
                       <option value= "boolean">Yes/No</option>
                       <option value= "checkbox">Checkbox</option>
                   </select>
                    <div class="invalid-feedback">Oops, you missed this one.</div>
                </div>

                <div class="form-group form-inline">                        
                    <label for="name">Fill Options</label>
                    <input type ="checkbox" name="attributes[0]" value="1"> Size
                    <input type ="checkbox" name="attributes[1]" value="2"> Color
                </div>	
	    	</form>
            </div>
    	<div>
	</div>
  <style>
  .editform-wrapper{
  width: 100% !important;
  }
</style>