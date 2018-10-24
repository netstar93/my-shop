<!-- provide the csrf token -->
<meta name="csrf-token" content="{{ csrf_token() }}"/>

@extends('layout')
@section('title', 'My Cart')
@section('middle_content')
    <link href="{{asset('css/product_view.css')}}" rel="stylesheet" type="text/css"/>
    <script src="{{  asset('/js/cart.js') }}"></script>
    <div class="checkout_cart_index container-fluid">
        @php 
        use App\Model\Product;
        $model = new Product;
        @endphp
        <div class="page-title">Shopping Cart</div>
        @if(count($items)  > 0)
            <div class="cart-items">
                <table class="cart-item table">
                    <tr><th>Image</th><th>Name</th><th>Qty</th><th>Date</th><th>Subtotal</th></tr>
                    @foreach($items as $item_data)
                       @include('checkout/item',['data' =>$item_data, 'productModel' => $model])
                    @endforeach
                </table>
            </div>
            <div class="cart-sidebar">
                <div class="title">ORDER SUMMARY</div>
                                
                <!-- <div class="price"><span class="">Price ({{$totals['item_count']}} items) : </span> <span class="price">Rs. 200</span></div> -->
                
                <div class="subtotal"><span class="">Subtotal : </span> <span class="price">{{renderPrice($totals['subtotal'])}}</span></div>

                <div class="delivery"><span class="">Delivery Charges : </span> <span class="price">{{renderPrice($totals['shipping_amount'])}}</span></div>                
                
                <div class="grand-total">Grand Total : {{renderPrice($totals['grand_total'])}}   </div>
            </div>

            <div class="action-wrapper" align="center">
                <a href="{{ URL::previous() }}"><button class="btn-shopping">Continue Shopping</button> </a>
                <a href="/cart/checkout"><button class="btn-shopping">Place Order</button> </a>
            </div>
            @else
            <div class="no-cart-item">No Item Found.Please shop items.</div>
        @endif
    </div>

@endsection
