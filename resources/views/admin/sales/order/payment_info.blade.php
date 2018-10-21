@php $payment =  $order ->Payment @endphp
<div class="col-lg-12 col-xs-10 card cta cta--featured">
    <div class="car-block">
        <h5 class="card-title no-margin-top"><span class="fa fa-map pad-right text-primary"></span>Payment</h5>
    </div>
    <span class="header-line gradient-color-1"></span>
    <div class="card-block">
        <table class="table">
            <tbody>
            <tr>
                <td>Payment Mode</td>
                <td>{{$payment ->method}}</td>
            </tr>
            <tr>
                <td>Total Paid Amount</td>
                <td>{{renderPrice($payment->paid_amount)}}</td>
            </tr>
            @if($payment ->method !== 'cod')
                <tr>
                    <td>Cashback</td>
                    <td>{{renderPrice($payment->cashback)}}</td>
                </tr>
                <tr>
                    <td>Transaction ID</td>
                    <td>{{renderPrice($payment->transaction_id)}}</td>
                </tr>
            @endif
            <tr>
                <td>Total Refunded</td>
                <td>{{renderPrice($payment->refunded_amount)}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>