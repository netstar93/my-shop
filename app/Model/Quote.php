<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Model\Quote;

class Quote extends Model
{
    const shipping_charge = 40;

    protected $table = "sales_quote";
    public $timestamps = false;
    protected $fillable = ['customer_id','total_amount'];
    protected $customer_id ;
    protected $loaded_quote;

	public function __construct(){
        $customer = session('customer');
        $this->customer_id  = session() ->getId();
        
        if($customer) {
            $this->customer_id = $customer['id'];
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

        if(count($cart_items) > 0) {

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

            // $newQuote = Quote::firstOrCreate(
            //     ['customer_id' => $this->customer_id]
            // );
            //RENEW CUSTOMER SESSION WITH QUOTE ID
            $customer = session('customer');
            $customer['quote_id'] = $quote_id;
            session('customer' , $customer);
            // $this ->loaded_quote = $newQuote;

            //SAVE QUOTE ITEMS
            foreach ($cart_items as $item) {
                $item_id = DB::table('sales_quote_item')->insertGetId([
                    'quote_id' => $quote_id,
                    'product_id' => $item->product_id,
                    'amount' => $item->base_price,
                    'options' => $item->diff_attr_values
                ]);
            }
        }
    }

    public function clearQuote() {      
      //DELETE QUOTE ITEM
       DB::table('sales_quote_item')->where('quote_id',$this ->getCustomerQuoteId()) ->delete();
      //DELETE QUOTE
      $this ->find($this ->getCustomerQuoteId()) ->delete();
    }

   public function removeQuoteItem() {

    }

    public function getCartData($customer_id = null) {
        $data = DB::table('sales_quote_item')->where('quote_id',$this ->getCustomerQuoteId()) ->get();
        return $data;
    }

    public function getCartItems() {
        $data = DB::table('sales_quote_item')->where('quote_id',$this ->getCustomerQuoteId()) ->get();
        return $data;
    }

    public function getCustomerQuoteId() { 
        $quote_id = Quote::where('cust_id' , '=', $this->customer_id) ->first()->id;
        return $quote_id;
    }
}
