@php
    //                _log($order ->Comments() ->get() ->toArray() );
@endphp
<div class="col-lg-12 col-xs-10 card cta cta--featured">
    <div class="car-block">
        <h5 class="card-title no-margin-top"><span class="fa fa-map pad-right text-primary"></span>Comment History</h5>
    </div>
    <span class="header-line gradient-color-1"></span>
    <div class="card-block">
        <div class="comment-list">
            <table class="table">
                @foreach($order ->Comments()->get() as $comment)
                    <tr>
                        <td>{{$comment ->id}} </td>
                        <td>{{$comment->comment}}</td>
                        <td>{{$comment->creation_date}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

<div class="col-lg-12 col-xs-10 card cta cta--featured pt-3">
    <div class="car-block">
        <h6 class="card-title no-margin-top"><span class="fa fa-map pad-right text-primary"></span>New Comment</h6>
    </div>
    <span class="header-line gradient-color-1"></span>
    <div class="card-block">
        <div class="comment-box">
            <div class="form-group">
                {{Form ::label('Add Comment')}}
                {{ Form :: textarea('comment' , null, array('id' => 'comment' ,'class' => 'form-control col-lg-6' ,'rows '=> 3) ) }}
            </div>
            <div class="form-group">
                {{Form :: checkbox('notify' ,  1 , true) }}   {{ Form ::label('Notify Customer') }}
                {{Form :: button('Add', array('class' => 'btn btn-success', 'id' => 'addComment')) }}
            </div>
        </div>
    </div>
</div>