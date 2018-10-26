
@if(isset($address))
    <form class="form" name="addressForm" id="addressForm" method="post" action="/customer/address/saveinline" aria-hidden="true" >
        {{ csrf_field() }}
        <input type="hidden" class="form-control" id="id" value= "{{$address ->id }}" name="id" required >                 
         <div class="address-left" style="float:left;margin:10px">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" value= "{{$address ->name }}" name="name" required >                 
            </div>
            <div class="form-group">
                <label for="state">State:</label>
                <input type="text" class="form-control" id="state" name="state" value= "{{$address ->state }}" required>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" class="form-control" id="city" value= "{{$address ->city}}" name="city">
            </div>            
            <div class="form-group">
                <label for="email">Pincode:</label>
                <input type="text" class="form-control" id="pincode" value= "{{$address ->pincode}}" name="pincode">
            </div>
            <div class="form-group">
                <button type="submit" style="cursor:pointer" id="address-form-submit" class="btn btn-primary">Submit</button>
            </div>
        </div>        
</form>

@else

<form class="form" name="addressForm" id="addressForm" method="post" action="/customer/address/saveinline" aria-hidden="true" >
        {{ csrf_field() }}
         <div class="address-left" style="float:left;margin:10px">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>                 
            </div>
            <div class="form-group">
                <label for="state">State:</label>
                <input type="text" class="form-control" id="state" name="state" required>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" class="form-control" id="city" name="city">
            </div>            
            <div class="form-group">
                <label for="email">Pincode:</label>
                <input type="text" class="form-control" id="pincode" name="pincode">
            </div>
            <div class="form-group">
                <button type="submit" style="cursor:pointer" id="address-form-submit" class="btn btn-primary">Submit</button>
            </div>
        </div>        
</form>

@endif