@php
    use App\Model\Attribute;
    $attributeModel = new Attribute();
    //$attribute_color = Attribute:: where('name', 'color')->get()->first();
    //$attribute_size = Attribute:: where('name', 'size')->get()->first();
    $color_options = $attributeModel->getAttributeOptions('color');
    $size_options = $attributeModel->getAttributeOptions('size');
    $fabric_options = $attributeModel->getAttributeOptions('fabric');
@endphp

<div class="title">Filters</div>
<div class="panel price-filter panel-success">
    <div class="control-label panel-heading">Price</div>
    <div class="">
        <input id="ex2" type="text" data-slider-id='ex2' class="slider form-control" data-slider-handle="square"
               value="" data-slider-min="10" data-slider-max="1000" data-slider-step="5" data-slider-value="[250,450]"/>
    </div>
</div>
@if(count($color_options))
<div class="panel panel-success">
    <div class="panel-heading">Color</div>
    <div class="panel-body">
        <ul>
            @foreach($color_options as $id => $color_name)
                <li><span>  {{Form :: checkbox('color' , $id)}} </span>
                    <span class="field">{{$color_name}}</span> <span class="colorBox"
                                                                     style="background-color: {{$color_name}}"></span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endif
@if(count($size_options))
<div class="panel panel-success">
    <div class="panel-heading">Size</div>
    <div class="panel-body">
        <ul>
            @foreach($size_options as $id => $size_name)
                <li><span>  {{Form :: checkbox('size' , $id)}} </span>
                    <span class="field">{{$size_name}}</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endif
@if(count($fabric_options))
<div class="panel panel-success">
    <div class="panel-heading">Fabrics</div>
    <div class="panel-body">
        <ul>
            @foreach($fabric_options as $id => $fabric)
                <li><span>  {{Form :: checkbox('size' , $id)}} </span>
                    <span class="field">{{$fabric}}</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endif