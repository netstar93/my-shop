@php

@endphp

<div class="form-group ">
    <button id="addMore" class="btn">Add Subproduct </button><hr/>

    <form class="subproductForm" method="post">
        <table class="table-bordered subproduct_table">
                <tr>
                    <td><label for="uname1">Color</label> <input value="red" type="text" name="child_item[0]['color']"  /></td> 
                </tr>
                <tr>    
                    <td><label for="uname1">Size</label><input value="M" type="text" name="child_item[0]['size']"  /></td>
                 </tr>
                 <tr>   
                    <td><label for="uname1">Price</label><input value="299" type="text" name="child_item[0]['price']"  /></td>
                 </tr>
                 <tr>   
                    <td><label for="uname1">Images</label><input type="file" name="child_item[0]['image']"  /></td>
                </tr>
                <tr>   
                    <td><button class="btn btn-primary subproductForm-submit center">Save</button></td>
                </tr>
        </table>
     </form>
</div>             

<script type="text/javascript">


</script>

<style type="text/css">
    .subproduct_table label{
        min-width: 25%;
    }
</style>