@php
    //_log($config_product_data);
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
            <table class="table table-striped">
                <tr>
                    <th>PRODUCT ID</th>
                    <th>Name</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Action</th>
                </tr>
                @foreach($config_product_data as $pro_data)
                    @php
                        $attr = $pro_data ->config_attributes;
                    @endphp
                    <tr>
                        <td>{{$pro_data ->id}}</td>
                        <td>{{$pro_data ->name}}</td>
                        <td>$attr["'color'"]</td>
                        <td>$attr["'size'"]</td>
                        <td><a target="_blank" href="/admin/product/edit/{{$pro_data ->product_id}}"> EDIT</a></td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>

    @endif      

</div>             

<style type="text/css">
    .subproduct_table label{
        min-width: 25%;
    }
</style>