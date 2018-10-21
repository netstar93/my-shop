<div class="home-gallery featured-product list-group-item-success">
    <div class="home-gallery-label">Featured Product</div>
    <ul class="list-group-item-success">
        @foreach($featured_product as $product)
            <li class="item">
                <div class="item-content">
                    <div class="image"><img src="{{ url('media/product/small/'.$product->image) }}" width="200px"/>
                    </div>
                    <div class="title">{{$product ->name}}</div>
                    <div class="final-price text-center">{{ renderPrice($product ->base_price) }}</div>
                    {{--<button class="btn-xs btn-success glyphicon-align-left">Quick Look</button>--}}
                </div>
            </li>
        @endforeach
    </ul>
</div>

<div class="home-gallery list-group-item-success">
    <div class="home-gallery-label">Top Selling Product</div>
    <ul class="list-group-item-success">
        @foreach($top_product as $product)
            <li class="item">
                <div class="item-content">
                    <div class="image"><img src="{{ url('media/product/small/'.$product->image) }}" width="200px"/>
                    </div>
                    <div class="title">{{$product ->name}}</div>
                    <div class="final-price">{{ renderPrice($product ->base_price) }}</div>
                </div>
            </li>
        @endforeach
    </ul>
</div>

<div class="home-gallery list-group-item-success">
    <div class="home-gallery-label">Electronics & More..</div>
    <ul class="list-group-item-success">
        @foreach($top_product as $product)
            <li class="item">
                <div class="item-content">
                    <div class="image"><img src="{{ url('media/product/small/'.$product->image) }}" width="200px"/>
                    </div>
                    <div class="title">{{$product ->name}}</div>
                    <div class="final-price">{{ renderPrice($product ->base_price) }}</div>
                </div>
            </li>
        @endforeach
    </ul>
</div>