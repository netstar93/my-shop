@php $path  = url("media/banners/"); @endphp
<div id="my-home-slider" class="carousel slide" data-ride="carousel">

    <ol class="carousel-indicators">
        @foreach($banner_coll as $key=> $banner )
            <li data-target="#myCarousel" data-slide-to="{{$key}}" class="{{$key == 0 ? 'active' : ''}}"></li>
        @endforeach
    </ol>

    <div class="carousel-inner">
        @foreach($banner_coll as $key=> $banner )
            @php
                $image_path  = $path."/".$banner ->path;
            @endphp
            <div class="item {{$key == 0 ? 'active' : ''}}">
                <img src="{{$image_path}}" style="width:100%" data-src="holder.js/900x500/auto/#7cbf00:#fff/text: "
                     alt="First slide">
            <div class="container">
                <div class="carousel-caption">
                    <h2>{{$banner ->name}}</h2>
                    {{--<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>--}}
                    {{--<p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>--}}
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{--<a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>--}}
    {{--<a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>--}}
</div>
<style>
    .carousel .item img {
        max-height: 350px;
        min-width: auto;
    }
</style>