@php
use App\Model\Quote;
$item_count = 0;
$quoteModel = new Quote();
$items  = $quoteModel ->getQuoteItems();
if(count($items)) {
$item_count = count($items);
}
$customer = session('customer');
$is_logged_in =  $customer['logged_in'];
$name =  $customer['name'];
@endphp
<header>
    <div class="main-header container-fluid">
        <div class="row">
        <span class="logo col-sm-3">
            <a href="/">
                <img src="{{url('images/magelog2.png')}}" style="width:180px" height=" 60px"/>
            </a>
        </span>
            <span class="search-box col-sm-5 navbar-form">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search">
                <div class="input-group-btn">
                  <button class="btn btn-default" type="submit">
                    <i class="fa fa-search "></i>
                  </button>
                </div>
              </div>
        </span>
            <span class="top-menu col-sm-3">
            <nav class="top-links ">
                <li class="cartMenus"> <a href="/cart"><i class="fa fa-shopping-cart fa-2x"></i><span
                                class="cart badge">{{$item_count }}</span></a></li>
                @if(isset($is_logged_in))
                    <li> <i class="fa fa-heart fa-2x" style="color: #fff"></i> </li>
                    <li class="customerMenu">
                    <div class="dropdown">
                          <span class="dropdown-toggle" data-toggle="dropdown">
                             <i class="fa fa-user fa-2x"></i><span class="customer-name"> {{$name}}</span>
                          <span class="caret"></span></span>
                          <ul class="dropdown-menu account-menu">
                            <li><i class="fa fa-dashboard"></i><a href="/customer">My Account</a></li>
                            <li><i class="fa fa-reorder"></i><a href="/customer#orders">Orders</a></li>
                            <li><i class="fa fa-cart-plus fa-2x"></i><a href="/cart">My Cart</a></li>
                            <li><i class="fa fa-power-off"></i><a href="/customer/logout">Logout</a></li>
                          </ul>
                        </div>
                    </li>
                @else
                    <li><i class="fa fa-user fa-2x"></i><a href="/customer/login">Login</a></li>
                    <li><i class="fa fa-user-plus fa-2x"></i><a href="/customer/create">Sign Up</a></li>
                @endif
            </nav>
        </span>
        </div>
    </div>
</header>
@include('home/megamenu')
<div class = "messages">
@if(session('success'))
    <div class="page-message alert alert-success alert-dismissable text-center"><i class="fa fa-check-square-o" style="font-size: 25px;"></i> {{session('success')}}</div>
@endif
@if(session('error'))
    <div class="page-message alert alert-warning alert-dismissable text-center"><i class="fa fa-close" style="color:red;font-size: 25px;"></i>{{session('error')}}</div>
@endif
</div>

<div id="loader" class="loader-wrapper">
    <div class="loader"></div>
</div>

<script>
$('body').click(function(){
    $('.account-menu').hide();
})
$('.customerMenu').hover(function(){
    $('.account-menu').show();
})

$(".customerMenu").mouseleave(function(){
   $('.account-menu').hide();
});
 </script>