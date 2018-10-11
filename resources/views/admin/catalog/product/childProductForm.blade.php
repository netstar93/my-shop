@if(!isset($count))
$count = 0; 
@endif

<table class="table-bordered subproduct_table" style ="margin-bottom : 20px;">
                
<tbody><tr>
    <td><label for="uname1">Color</label> <input value="red" type="text" name="child_item[{{$count}}]['color']"></td> 
</tr>
<tr>    
    <td><label for="uname1">Size</label><input value="M" type="text" name="child_item[{{$count}}]['size']"></td>
 </tr>
 <tr>   
    <td><label for="uname1">Price</label><input value="299" type="text" name="child_item[{{$count}}]['price']"></td>
 </tr>
                               
</tbody>
</table>
<hr/>