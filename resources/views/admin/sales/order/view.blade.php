
@section('title', 'Orders View ')
@extends('admin.layout')
@section('content')

<div class="right-side" >
    <div class="page-header">
        <h4>Order View ## {{$order ->id}}</h4>
    </div>
    <div class="action-bar btn-group-sm float-right">
                <a href="/admin/attribute/new"><button class="btn btn-success btn-responsive"><i class="fa fa-plus" aria-hidden="true"></i>Edit</button></a>
        <button class="btn btn-success btn-responsive"><i class="fa fa-minus" aria-hidden="true"></i>Hold</button>
        <button class="btn btn-info btn-responsive"><i class="fa fa-plus" aria-hidden="true"></i>Cancel</button>
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
                            <a class="nav-link" data-toggle="tab" href="#payment" role="tab" aria-controls="messages">Payment</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#process" role="tab" aria-controls="messages">Process</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#comment" role="tab" aria-controls="messages">Comments</a>
                        </li>

                     </ul>
                  </span>
                   <div class="tab-content order-tabs col-xs-12 col-lg-12">
                     <div class="tab-pane active col-lg-12" id="summary" role="tabpanel">
                        @include('admin.sales.order.order_info')
                     </div>

                     <div class="tab-pane col-lg-12" id="shipping" role="tabpanel">
                        @include('admin.sales.order.shipping_info')
                    </div>

                       <div class="tab-pane col-lg-12" id="payment" role="tabpanel">
                           @include('admin.sales.order.payment_info')
                       </div>
                       <div class="tab-pane col-lg-12" id="process" role="tabpanel">
                           @include('admin.sales.order.process')
                       </div>
                       <div class="tab-pane col-lg-12" id="comment" role="tabpanel">
                           @include('admin.sales.order.comment')
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
    height: 2px;
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

.btn3d {
    position: relative;
    border: 0;
    border-radius: 3px;
    margin: 15px 10px 0 0;
    transition: all .09s linear;
    box-shadow: 0 0 0 1px transparent inset, 0 0 0 2px rgba(255, 255, 255, 0.15) inset, 6px 6px 0 0 #ccc, 6px 6px 0 1px rgba(0, 0, 0, 0.2), 6px 6px 3px 0px rgba(0, 0, 0, 0.3);
    outline: medium none;
    -moz-outline-style: none;
}

.btn3d:active {
    top: 7px;
}

.btn3d:focus {
    outline: medium none;
    -moz-outline-style: none;
}

.btn3d.btn-default {
    background-color: #f5f5f5;
}

/* for social colors */
.btn-facebook {
    background-color: #3b5998;
    color: #fff;
}

.btn-google {
    background-color: #dd4b39;
    color: #fff;
}

.btn-twitter {
    background-color: #2ba9e1;
    color: #fff;
}

.btn-pinterest {
    background-color: #cb2027;
    color: #fff;
}

.btn-tumblr {
    background-color: #2c4762;
    color: #fff;
}

.btn-facebook:hover, .btn-facebook:focus,
.btn-twitter:hover, .btn-twitter:focus,
.btn-google:hover, .btn-google:focus,
.btn-tumblr:hover, .btn-tumblr:focus,
.btn-pinterest:hover, .btn-pinterest:focus {
    color: #ebebeb;
}


</style>