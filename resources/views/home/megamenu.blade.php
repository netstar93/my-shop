@php
    $category_arr = App\Helpers\Helper :: getCategoryCollection(0);
@endphp
<link href="{{asset('css/megamenu/main.css')}}" rel="stylesheet" />
<div class="menu-container megamenu-wrapper" id="main" role="main">
    <ul class="menu">
        <li><a href="#">Home</a></li>
        @foreach ($category_arr as $id => $cat)
            <li><a href="#s1">{{ucfirst($cat ->name)}} </a>
                @php
                    $sub_category_arr = App\Helpers\Helper :: getCategoryCollection(1,$cat ->id);                    
                @endphp
                @if(count($sub_category_arr))
                <ul class="submenu">
                    @foreach ($sub_category_arr as $id => $cat)
                        <li><a href="/catalog/category/view/{{$cat ->cat_id}}">{{ucfirst($cat ->name)}}</a></li>
                     @endforeach
                </ul>
                 @endif
            </li>
        @endforeach
    </ul>
</div>