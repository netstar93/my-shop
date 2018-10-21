<div class="col-lg-5 col-xs-5 card cta cta--featured d-inline-block">
  <div class="car-block">
      <h5 class="card-title no-margin-top"><span class="fa fa-map pad-right text-primary"></span>Order</h5>
  </div>
   <span class="header-line gradient-color-1"></span>
  <div class="card-block">
   
   <table class="table d-inline-block">
     <tr><td>ORDER NO.</td><td>{{$order ->id}}</td></tr>
     <tr><td>Ordered Date</td><td>{{$order ->creation_date}}</td></tr>
     <tr><td>Last Update Date</td><td>{{$order ->last_update}}</td></tr>
     <tr><td>Current Status</td><td>{{ucfirst($order ->status)}}</td></tr>
     <tr><td>Payment Method</td><td>{{ucfirst($order ->payment_method)}}</td></tr>
  </table>

  </div>
</div>
<div class="col-lg-5 col-xs-5 card cta cta--featured d-inline-block">
  <div class="card-block">
      <h5 class="card-title no-margin-top"><span class="fa fa-map pad-right text-primary"></span>Customer</h5>
  </div>
  <span class="header-line gradient-color-1"></span>
  <div class="card-block">
    <table class="table d-inline-block">
     <tr><td>ID</td><td>{{$customer ->id}}</td></tr>
     <tr><td>Name</td><td>{{$customer ->name}}</td></tr>
     <tr><td>Email Address</td><td><a href="mailto:{{$customer ->email_address}}" >{{$customer ->email_address}}</a></td></tr>
     @if(!empty($customer ->mobile_number))
     <tr><td>Mobile Number</td><td>{{$customer ->mobile_number}}</td></tr>
     @endif
     <tr><td>Other Info</td><td>##</td></tr>
    </table>                            
  </div>
</div>

<div class="col-lg-12 col-xs-10 card cta cta--featured">
  <div class="car-block">
      <h5 class="card-title no-margin-top"><span class="fa fa-map pad-right text-primary"></span>Order Items</h5>
  </div>
   <span class="header-line gradient-color-1"></span>
  <div class="card-block">
   
   <table class="table">
     <tbody>
     <tr>
         <th>Item ID</th>
         <th>Image</th>
         <th>Product Name</th>
         <th>Shipping Method</th>
         <th>Price</th>
     </tr>
     @foreach($items as $item)
     <tr>
        <td>{{$item->id}}</td>
        <td>
         <img src="{{url('media/product/thumb/') .'/'.$item ->image}}" style="max-width: 35px"/>
        </td>
        <td>{{$item ->name}}</td>                                
        <td>{{$item ->shipping_method}}</td>
        <td>{{renderPrice($item ->amount)}}</td>
       </tr>
     @endforeach
     </tbody>
  </table>
  </div>
</div>
<div class="col-lg-12 col-xs-10 card cta cta--featured mt-1">
    <div class="car-block">
        <h5 class="card-title no-margin-top"><span class="fa fa-map pad-right text-primary"></span>Totals</h5>
    </div>
     <span class="header-line gradient-color-1"></span>
    <div class="card-block">

    <table class="table table-bordered">
      <tr><td>Total Amount</td><td>{{renderPrice($order ->total_amount)}}</td></tr>
       <tr><td>Shipping Amount</td><td>{{renderPrice($order ->shipping_amount)}}</td></tr>
       <tr class="bg-success text-white"><td>Grand Total</td><td><b>{{renderPrice($order ->grand_total)}}</b></td></tr>
    </table>
</div>
</div>