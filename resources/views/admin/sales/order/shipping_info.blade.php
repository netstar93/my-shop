<div class="col-lg-12 col-xs-10 card cta cta--featured">
  <div class="car-block">
      <h5 class="card-title no-margin-top"><span class="fa fa-map pad-right text-primary"></span>Address</h5>
  </div>
   <span class="header-line gradient-color-1"></span>
  <div class="card-block">
   <table class="table">
     <tbody>
     <tr>
         <td>Name</td>
         <td>{{$order ->address->name}}</td>
     </tr>
     <tr>
         <td>State</td>
         <td>{{$order ->address->state}}</td>
     </tr>
     <tr>
         <td>City</td>
         <td>{{$order ->address->city}}</td>
     </tr>
     <tr>
         <td>Pincode</td>
         <td>{{$order ->address->pincode}}</td>
     </tr>
     </tbody>
  </table>
  </div>
</div>