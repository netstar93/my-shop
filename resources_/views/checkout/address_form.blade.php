<div class="customer_address_form">
    <div class="page-title">Adddress Form</div>
    @if(count($errors))
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.
            <br/>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="side-form" name="shipping-form" id="shipping-form" method="post">
        {{ csrf_field() }}
         <div class="address-left" style="float:left;margin:10px">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="state">State:</label>
                <input type="text" class="form-control" id="state" name="state">
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" class="form-control" id="city" name="city">
            </div>            
            <div class="form-group">
                <label for="email">PinCode:</label>
                <input type="text" class="form-control" id="pincode" name="pincode">
            </div>
            <div class="form-group">
                <button style="cursor:pointer" id="address-submit" class="btn btn-primary">Submit</button>
            </div>
        </div>        
    </form>
</div>