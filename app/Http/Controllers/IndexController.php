<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Model\Quote;
use  App\Model\Product;
use  App\Model\Banner;
use Image;
use Softon\Indipay\Facades\Indipay;  
use Illuminate\Support\Facades\Log;
use DB;

class IndexController extends Controller
{
    /**

     * Constructor.

     *

     * @return void

     */

    public function __construct()
    {
        //  $this->middleware('bootstrap');
    }

    public function index  (){
        $productModel = new Product();
        $featured_product = $productModel->getCollection()->where('featured_product', 1)->take(5);
        $top_product = $productModel->getCollection()->take(5);
//        _log($featured_product ->get()->toarray());
        $banner = Banner:: where('status', 1)->get();
        return view('index')->with([
            'banner_coll' => $banner,
            'featured_product' => $featured_product->get(),
            'top_product' => $top_product->get()
        ]);
    }

    public function test(Request $request){

        $table = DB :: table('order_payment') ->where('order_id' , 28);// ->first();
        $fill = array('payment_status'  => 28);
$table ->update($fill);
//$table ->save(); 
die;

        $parameters = [
            'firstname' => 'Nick',
            'email'  =>'nidfid@gmail.com',
            'phone' => '888888888888',
            'productinfo' => 'P01,P02',
      
        'tid' => '1233999923322',
        
        'order_id' => '16553220',
        
        'amount' => '10.00',
        
      ];
      
      // gateway = CCAvenue / PayUMoney / EBS / Citrus / InstaMojo / ZapakPay / Mocker
      
      $order = Indipay::gateway('PayUMoney')->prepare($parameters);
      return Indipay::process($order);

    }

    public function response(Request $request)
    
    {
        // For default Gateway
        $response = Indipay::response($request);
        
        // For Otherthan Default Gateway
        $response = Indipay::gateway('PayUMoney')->response($request);

        _log($response);
    
    } 
}
