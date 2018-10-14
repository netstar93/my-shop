@php
    use App\Model\Attribute;
        $attribute_color = Attribute :: where('name', 'color') ->get()->first();
        $color_select_values = json_decode($attribute_color->options , true);
        $color_id =  $attribute_color ->id;
        $attribute_size = Attribute :: where('name', 'size') ->get()->first();
        $size_select_values = json_decode($attribute_size->options , true);
        $size_id =  $attribute_size ->id;
@endphp
@if(!isset($count))
$count = 0; 
@endif
<table class="table-bordered subproduct_table" style ="margin-bottom : 20px;">
<tbody><tr>
    <td>
        <label for="uname1">Color</label> {{ Form::select( "child_item[$count][$color_id]",  $color_select_values, null  , ['required' =>true] )  }}
    </td>
</tr>
<tr>
    <td>
        <label for="uname1">Size</label>{{ Form::select( "child_item[$count][$size_id]",  $size_select_values, null  , ['required' =>true] )  }}
    </td>
</tr>
<tr>
    <td><label for="uname1">Price</label><input type="text" name="child_item[{{$count}}]['price']"></td>
</tr>

</tbody>
</table>
<hr/>