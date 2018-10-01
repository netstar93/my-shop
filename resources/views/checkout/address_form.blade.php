<div class="customer_address_form">
    <div class="page-title">Shiping Adddress</div>
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

    @php 
    use App\Helpers\Helper;
    $helper = new Helper;
    $addresses = $helper ->getAddresses();
   // echo "<pre>"; print_r($addresses); die;
    @endphp

    @if(count($addresses)> 0)
    <div class="address-list">
      <form class="side-form form" name="shipping-address" id="shipping-address" method="post" role="form" aria-hidden="true">
            <ul class="address-list" style="list-style: none">
            @foreach($addresses  as $address)
             <li>
                <input type="radio" name="address" value="{{$address ->id}}" required="true"> <b>{{$address ->name}}</b>  
                <div class="addr-content">{{$address ->state}}</div>
                </input>                
             </li>
            @endforeach
        </ul>
        <div class="invalid-feedback hidden">Oops, you missed this one.</div>
    </form>
    </div>

    @else

    <form class="side-form form" name="shipping-form" id="shipping-form" method="post" role="form" aria-hidden="true">
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
    @endif

     <button class="btn btn-primary" id="shipping-next">Next</button>
</div>