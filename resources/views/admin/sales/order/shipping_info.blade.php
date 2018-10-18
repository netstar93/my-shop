<div class="col-lg-12 col-xs-10 card cta cta--featured">
  <div class="car-block">
    <h3 class="card-title no-margin-top"><span class="fa fa-map pad-right text-primary"></span>Order Items</h3>
  </div>
   <span class="header-line gradient-color-1"></span>
  <div class="card-block">
   
   <table class="table">
     <tbody>
        <tr><th>Item ID</th><th>Image</th><th>Product Name</th><th>Price</th><th>Shipping Method</th></tr>
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