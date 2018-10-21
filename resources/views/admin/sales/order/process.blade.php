@php
    $status =  $order ->status;
@endphp
<div class="col-lg-10 col-xs-10 card cta cta--featured">
    <div class="car-block">
        <span class="card-title no-margin-top"><span class="fa fa-map pad-right text-primary"></span>Processes</span>
    </div>
    <span class="header-line gradient-color-1"></span>
    <div class="card-block pt-10 processStatus">
        @if($status == 'pending' || $status == 1)
            {{ Form::button('Packing' , array('id' =>'pack' , 'class' => 'btn btn-success btn3d','status' => 2) ) }}
            {{ Form::button('Generate Invoice' , array('id' =>'createInvoice' , 'class' => 'btn btn-success btn3d' ,'status' => 2) ) }}
            {{ Form::button('Cancel Order' , array('id' =>'cancelOrder' , 'class' => 'btn btn-info btn3d','status' => 3)) }}
            {{ Form::button('Hold' , array('id' =>'hold' , 'class' => 'btn btn-info btn3d','status' => 4)) }}
        @endif

        @if($status == 'packed' || $status == 2)
            {{ Form::button('Ship Now' , array('id' =>'ship' , 'class' => 'btn btn-info btn3d','status' => 5)) }}
            {{ Form::button('Hold' , array('id' =>'hold' , 'class' => 'btn btn-info btn3d','status' => 4)) }}
            {{ Form::button('Cancel Order' , array('id' =>'cancelOrder' , 'class' => 'btn btn-info btn3d','status' => 3)) }}
        @endif

        @if($status == 'shipped' || $status == 5)
            <div class="status-shipped card-header">This order is completed and shipped successfully.</div>
        @endif

        @if($status == 'cancelled' || $status == 3)
            {{ Form::button('Re Order' , array('id' =>'reorder' , 'class' => 'btn btn-info btn3d','status' => 6)) }}
        @endif
        @if($status == 'hold' || $status == 4)
            {{ Form::button('Unhold' , array('id' =>'unhold' , 'class' => 'btn btn-info btn3d','status' => 7)) }}
        @endif

    </div>
</div>
