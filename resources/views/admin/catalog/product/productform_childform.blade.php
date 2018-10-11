@php
_log($config_product_data);
@endphp

<div class="form-group ">
    <button id="addMoreProduct" class="btn">Add More Product </button><hr/>

    @if(!isset($data ->is_configurable))
    <div id="productForm" total="0">
        @include('admin.catalog.product.childProductForm',['count' => 0])
    </div>

    @else
    
    <div class="product-list" id="product-list">
        @if($data ->is_configurable)


        @endif
    </div>

    @endif      

</div>             

<style type="text/css">
    .subproduct_table label{
        min-width: 25%;
    }
</style>