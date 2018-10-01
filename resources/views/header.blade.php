@php
$customer = session('customer');
$is_logged_in =  $customer['logged_in'];
$name =  $customer['name'];
@endphp
<header>
    <div class="main-header container-fluid">
        <div class="row">
        <span class="logo col-sm-4">
            <a href="/">
                <img src="/images/logo.jpg" style="width:70px" />
            </a>
        </span>
            <span class="search-box col-sm-4 navbar-form">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search">
                <div class="input-group-btn">
                  <button class="btn btn-default" type="submit">
                    <i class="fa fa-search"></i>
                  </button>
                </div>
              </div>
        </span>
            <span class="top-menu col-sm-4">
            <nav class="top-links ">
               <li> <a href="/cart"><i class="fa fa-shopping-cart fa-2x"></i><span class="cart badge">4</span> </a></li>
                @if(isset($is_logged_in))
                    <li>
                    <div class="dropdown">
                          <span class="dropdown-toggle" data-toggle="dropdown">
                             <i class="fa fa-user fa-2x"></i>  Hi ! <span class="">{{$name}}</span>
                          <span class="caret"></span></span>
                          <ul class="dropdown-menu account-menu">
                            <li><i class="fa fa-power-off"></i><a href="/customer">My Account</a></li>
                            <li> <i class="fa fa-power-off"></i><a href="/customer#orders">Orders</a></li>
                            <li> <i class="fa fa-power-off"></i><a href="/cart">My Cart</a></li>
                            <li><i class="fa fa-power-off"></i><a href="/customer/logout">Logout</a></li>
                          </ul>
                        </div>
                    </li>
                @else
                    <li><i class="fa fa-power-off"></i><a href="/customer/login">Login</a></li>
                    <li><i class="fa fa-power-off"></i><a href="/customer/create">Sign Up</a></li>
                @endif
            </nav>
        </span>
        </div>
    </div>
</header>
@include('home/megamenu')
@if(session('success'))
    <div class="page-message alert alert-success">{{session('success')}}</div>
@endif
@if(session('error'))
    <div class="page-message alert alert-warning">{{session('error')}}</div>
@endif