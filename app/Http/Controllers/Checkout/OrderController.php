<?php

namespace App\Http\Controllers\Checkout;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers;
use  App\Model\Product;
use  App\Model\Order;
use  App\Model\Quote;
use  App\Model\Order_item;
use  App\Model\Prepaid_payment;
use  Softon\Indipay\Facades\Indipay;
use  DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    const shipping_charge = 40;
    protected $order_id ;

    public function __construct(){

    }

    public function save(Request $request) {        
        $quoteModel = new Quote(); 
        $addr_id = $request ->address_id;
        $payment_method = $request ->payment_type;
        $orderModel = new Order();
        $customer = session('customer');
        $quote = Quote::where('cust_id',$customer['id']) ->get() ->first();
        $quote_id = $quoteModel -> getCustomerQuoteId();
        $cart_items = $quoteModel -> getCartItems();
        $orderModel ->customer_id = $customer['id'];
        $orderModel ->address_id = $addr_id;
        $orderModel ->payment_method = $payment_method;
        $orderModel ->total_amount = $quote ->total_amount;
        $orderModel ->shipping_amount = 30;
        $orderModel ->status = 1;
        $orderModel ->save();
        $order_id =  $orderModel ->id;
        if($order_id > 0) {
            $order_items = array();
            foreach ($cart_items  as $item) {
                $item = Order_item::insertGetId([
                    'order_id' => $order_id,
                    'item_id' => $item ->product_id,
                    'amount' => $item ->amount,
                    'shipping_method' => $addr_id,
                    'qty' => $item ->qty
                ]);
                $order_items[] = $item;
            }

            $this ->order_id = $order_id;
            session()->put('last_order_id',$order_id);

            if($payment_method == 'pay-online') {
                  $parameters = $this ->getParameters($orderModel);             
                  // gateway = CCAvenue / PayUMoney / EBS / Citrus / InstaMojo / ZapakPay / Mocker      
                  $order = Indipay::gateway('PayUMoney')->prepare($parameters);
                  return Indipay::process($order);
            }

            $is_paid =  $this ->processPayment($quote,$order_id,$payment_method);
            if($is_paid){
                $quoteModel->clearQuote();                
                return redirect('/cart/order/success')->with(['success_pay' => "COD Done.",'order_id' =>$order_id ]);
            }
            else{
                return redirect('/cart/order/success')->with(['error'=>"something went wrong"]);
            }
        }
    }
    public function processPayment($quote,$order_id,$method = null){
        if(!$method) return false;      
        $pay_id= DB :: table('order_payment') ->insertGetId([
            'order_id' =>$order_id,
            'method' => $method,
            'paid_amount' =>$quote ->total_amount
        ]);
        if($pay_id > 0 ){ return true;} else{ return false;}
    }


    public function getParameters($order) {        
        $customer = session('customer');
        $parameters = [
            'firstname' => $customer['name'],
            'email'  => $customer['email_address'],
            'phone' => '8888888888',
            'productinfo' => 'P01,P02',      
            'tid' => $order ->id,            
            'order_id' => $order ->id,            
            'amount' => $order ->total_amount,        
            ];
        return $parameters;
    }

    public function pay_response(Request $request) {
        $quoteModel = new Quote();
        $response = $request ->all();
        $order_id = session()->get('last_order_id');
        if(count($response) > 0 ){

           try{
            $status = $response['status'];
            $txnid = $response['txnid'];
            $amount = isset($response['amount']) ?  $response['amount'] : 0;
            $discount = isset($response['discount']) ? $response['discount'] : 0;
            $PG_TYPE = $response['PG_TYPE'];
            $net_amount_debit = isset($response['net_amount_debit']) ? $response['net_amount_debit'] : 0;

            $pay_id = DB :: table('order_payment') ->insertGetId([
                'order_id' => $order_id,
                'method' => 'prepaid',
                'paid_amount' => $net_amount_debit
            ]);

           // ADD FILLABLES FOR MORE FIELDS
            $info = Prepaid_payment :: create([
                'order_id' => $order_id,
                'transaction_id' => $txnid,
                'discount' =>$discount,
                'card_info' => isset($response['cardnum'])   ? $response['cardnum'] : '',
                'status' => $status
            ]);

            if($pay_id > 0 && $status != 'success') {                
                return redirect('/cart/order/success')->with(['error'=>"Payment Not Done"]);
            }

            if($pay_id > 0 && $status == 'success') {
                $this ->updateOrderPayment(1,$order_id);
                $quoteModel->clearQuote();   
                return redirect('/cart/order/success')->with(['success_pay' => "PayUMoney Payment Done.",'order_id' =>$order_id ]);
            }
        }
        catch(ErrorException $e) {
            Log :: debug("PayUMoney : ".$e ->getMessage());
        }

        } else{

            return redirect('/cart/order/success')->with(['error' => "Something Missing !!"]);

        }
    }

    public function updateOrderPayment($status,$order_id) {
        $table = DB :: table('order_payment') ->where('order_id' , $order_id);
        $fills = array('payment_status'  => $status);
        $table ->update($fills);
    }
}
;