@php
    $product_custom_attr = array();
    
    if(count(array($data))  && isset($data -> attribute_values)) {
        $product_custom_attr = json_decode($data -> attribute_values , true);
    }
@endphp
<table>
    @foreach($other_attributes as $attribute)
        @php
            $value = null;
            if(isset($product_custom_attr[$attribute->id])) {
              $value = $product_custom_attr[$attribute->id];
            }
        @endphp
        <div class="form-group form-inline">
            @if($attribute ->type == 'text')
                @php
                        @endphp
                <tr>
                    <td> {{  Form::label($attribute ->name) }} </td>
                    <td> {{  Form::text("custom[$attribute->id]" , $value , array('class' => '') ) }}  </td>
                </tr>
                <div class="invalid-feedback">Oops, you missed this one.</div>
            @endif

            @if($attribute ->type == 'select')
                @php
                    $select_values = json_decode($attribute->options , true);
                     array_unshift($select_values, '' );
                @endphp
                <tr>
                    <td> {{  Form::label($attribute ->name) }} </td>
                    <td>  {{ Form::select( "custom[$attribute->id]",  $select_values, $value  , ['required' =>true] )  }} </td>
                </tr>
                <div class="invalid-feedback">Oops, you missed this one.</div>
            @endif

            @if($attribute ->type == 'radio')
                @php
                        @endphp
                <tr>
                    <td> {{  Form::label($attribute ->name) }} </td>
                    <td>  {{ Form :: radio( "custom[$attribute->id]" , 1  , $value) }} Yes</td>
                    <td>  {{ Form :: radio( "custom[$attribute->id]" , 0  , $value) }} No</td>
                </tr>
                <div class="invalid-feedback">Oops, you missed this one.</div>
            @endif

            @if($attribute ->type == 'boolean')
                <tr>
                    <td> {{  Form::label($attribute ->name) }} </td>
                    <td>  {{ Form::select( "custom[$attribute->id]",  array(1 => 'Yes' , 0 => 'No'), $value  , [ ] )  }} </td>
                </tr>
                <div class="invalid-feedback">Oops, you missed this one.</div>
            @endif

        </div>

    @endforeach
</table>