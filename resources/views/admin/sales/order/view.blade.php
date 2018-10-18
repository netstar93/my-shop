@section('title', 'Orders View ')
@extends('admin.layout')
@section('content')

<div class="right-side" >
    <div class="page-header">        
        <h3>Order View ## {{$order ->id}}</h3>
    </div>
    <div class="action-bar">            
        <span class="add-new" style="position:relative;float:right;right:5px">
                <a href="/admin/attribute/new"><button class="btn btn-success btn-responsive"><i class="fa fa-plus" aria-hidden="true"></i>Edit</button></a>
        </span>
    </div>
        
    <div class="content">
           
                   <span class="col-xs-4 col-lg-4 order-tabs-column">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#summary" role="tab" aria-controls="summary">Order
                                Summary</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#shipping" role="tab" aria-controls="shipping">Shipping Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#address" role="tab" aria-controls="messages">Payment</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#address" role="tab" aria-controls="messages">Status</a>
                        </li>

                     </ul>
                  </span>
                   <div class="tab-content order-tabs col-xs-12 col-lg-12">
                     <div class="tab-pane active col-lg-12" id="summary" role="tabpanel">
                        @include('admin.sales.order.order_info')
                     </div>

                     <div class="tab-pane active col-lg-12" id="shipping" role="tabpanel">
                        @include('admin.sales.order.shipping_info')
                    </div>

                   </div>               
    </div>

</div>    

@endsection

<style>
.text-center{
  text-align: center;
}
.card-img-top{
  width: 100%;
}
/*Call to Action*/

.header-line {
  height: 5px;
  width: 100%;
  content: '';
  display: block;
}
.gradient-color-1{
     background: -webkit-linear-gradient(left,#fc636b 0,#ff6d92 60%,#fd9a00 100%);
    background: linear-gradient(to right,#fc636b 0,#ff6d92 60%,#fd9a00 100%);
}
.gradient-color-2{
    background: #3be8b0;
    background: -webkit-linear-gradient(bottom left,#3be8b0 0,#02ceff 100%);
    background: linear-gradient(to top right,#3be8b0 0,#02ceff 100%);
}
/**/
/*Utility Class*/
.text-white{
  color: white;
}
.no-margin{
  margin:0;
}
.no-margin-top{
  margin-top:0;
}
.pad-right{
  margin-right: 0.5em;
}
/**/
    </style>