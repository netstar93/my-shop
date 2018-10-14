
<div class="form-group ">   

    @if(!isset($data ->is_configurable))
    <button id="addMoreProduct" class="btn">Add More Product </button><hr/>
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
                        <td></td>
                        <td></td>
                        <td>
                            <a class="btn-success iframe btn-sm"
                               data-src="/admin/product/edit/{{$pro_data ->product_id}}" href="javascript:;">Edit </a>
                        </td>
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