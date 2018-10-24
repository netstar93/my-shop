<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Quote extends Model
{
    const shipping_charge = 30;

    protected $table = "sales_quote";
    public $timestamps = false;
    protected $fillable = ['customer_id','total_amount'];
    protected $customer_id ;
    protected $loaded_quote;

	public function __construct(){
        $customer = session('customer');
        if(isset($customer)) {
            $this->customer_id = $customer['id'];
        }
        else{
            $this->customer_id  = session() ->getId();
        }
	}

	public function getCollection(){
        $collection =  $this -> get();
        return $collection;
    }

    /*
     * RETURN ALL PRODUCT WITH CHILD PRODUCTS
     */

	public function getQuoteData(){
        $collection = DB::table('sales_quote_item')
                        ->join('sales_quote','sales_quote.id' ,'=','sales_quote_item.quote_id')
                        ->get();
        return $collection;
    }

    public function getQuote($customer_id = null){
        if($this->customer_id > 0 ){
            return Quote::where('cust_id',$this->customer_id);
        }
    }

    public function load($id = null){
        if(!$id) return false;
        $data = $this ->getCollection()->filter(function ($value, $key) use ($id) {
            	return $value->id == $id;
            });
        return $data;
    }

    public function getQuoteItemCollection($id = null){
        if(!$id) return false;
        $data = $this ->getQuoteData()->filter(function ($value, $key) use ($id) {
            return $value->quote_id == $id;
        });
        return $data;
    }

    public function saveQuote() {
        $cart  = session('cart');
        $quote_id = 0;
        $cart_items  = $cart['items'];
        if (isset($cart) && count($cart_items) > 0) {

            //SAVE QUOTE
            $newQuote = Quote::where('cust_id', $this->customer_id) ->first();        
            if(isset($newQuote ->id)) {
                $quote_id = $newQuote ->id;
            }else{
                $newQuote  = new \App\Model\Quote;
                $newQuote ->total_amount  = $cart['grand_total'];
                $newQuote ->cust_id  = $this->customer_id;            
                $newQuote ->save();
                $quote_id = $newQuote ->id;
            }

            //RENEW CUSTOMER SESSION WITH QUOTE ID
             $customer = session('customer');
            //SAVE QUOTE ITEMS
            foreach ($cart_items as $item) {
                $item_id = DB::table('sales_quote_item')->insertGetId([
                    'quote_id' => $quote_id,
                    'product_id' => $item->product_id,
                    'amount' => $item->base_price,
                    'options' => $item->diff_attr_values,
                    'status' => 'pending'
                ]);
            }
        }
    }

    public function clearQuote() {
        //DELETE QUOTE ITEM
        $this ->removeAlItem();
      //DELETE QUOTE
      $this ->find($this ->getCustomerQuoteId()) ->delete();
        session()->forget('cart');
    }

   public function removeAlItem() {
       DB::table('sales_quote_item')->where('quote_id',$this ->getCustomerQuoteId()) ->delete();
    }

    public function removeItem($product_id) {
        $grand_total = 0;
	    if($this ->isLoggedIn()) {
            return DB::table('sales_quote_item')->where('quote_id', $this->getCustomerQuoteId())->where('product_id', $product_id)->delete();
        }
        $cart = session('cart');
        $cart_items =  $cart['items'];
        unset($cart_items[$product_id]);

        foreach ($cart_items as $item) {
            $grand_total += ($item->base_price + 30);
        }

        session(['cart' => [
            'items' => $cart_items,
            'grand_total' => $grand_total
            ]]);
        return true;
//        $this ->updateTotals();
    }

    public function getCartData($customer_id = null) {
        $data = DB::table('sales_quote_item')->where('quote_id',$this ->getCustomerQuoteId()) ->get();
        return $data;
    }

    /*
     * GET LOGGED IN CUSTOMER ITEMS
     */
    public function getCartItems() {
        $data = $this ->getCart() ->get();
        return $data;
    }

    public  function getTotals() {
        $cart_data = array();
        $totals = array(); 
        $subtotal = 0;
        $shipping_amount = 30;

        //GET LOGGED IN CUSTOMER CART DATA
        if(session('customer')) {   // && session('cart')  
            $customer = session('customer');
            $cart_data = $this ->getCart() ->get()->toArray();
        }

        if (!session('customer') && session('cart')) {
            $cart = session('cart');
            $cart_data = $cart['items'];
        }
        foreach ($cart_data as $key => $item) { //_log($item);
            if(isset($item ->amount)){
                $subtotal += $item ->qty * $item->amount;
            }

            if(isset($item ->base_price)){
                $subtotal += $item ->qty * $item->base_price;
            }            
        }
        // _log($subtotal);
        $totals['subtotal']= $subtotal;
        $totals['shipping_amount']= $shipping_amount;
        $totals['grand_total']= $subtotal + $shipping_amount;
        $totals['item_count']= count($cart_data);
        return $totals;
    }

    public  function getQuoteItems()  {
        $cart_data = array();
        //GET LOGGED IN CUSTOMER CART DATA
        if(session('customer')) {   // && session('cart')
            $model =  new Quote();
            return $model ->getCartItems();
        }

        //GET VISITOR CART DATA
        if (session('cart')) {
            $cart = session('cart');
            if(isset( $cart['items']))
            return $cart['items'];
        }
        return $cart_data;
    }

    public function getCart() {
        $data = DB::table('sales_quote_item')->where('quote_id',$this ->getCustomerQuoteId());
        return $data;
    }

    public function getCustomerQuoteId() { 
        $quote = Quote::where('cust_id' , '=', $this->customer_id);
        if($quote ->count() > 0 ) {
          return  $quote->first()->id;
        }
        return false;
    }

    public function updateTotals() {
        $grand_total = 0;
        if (session('cart')) {
            $cart = session('cart');
            foreach ($cart['items'] as $item) {
                $grand_total += ($item->base_price + 30);
            }

            session(['cart' => [
                'grand_total' => $grand_total
            ]]);
        }
    }
    public function isLoggedIn(){
        $customer = session('customer');
        if(isset($customer)) {
             return true;
        }
        return false;
    }
}
