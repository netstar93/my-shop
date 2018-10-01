<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Order_item extends Model
{
    protected $table = "sales_order_item";
    protected $customer_id ;
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';
    public $timestamps = false;

	public function __construct(){
        $customer = session('customer');
        $this->customer_id  = session() ->getId();
        
        if($customer) {
            $this->customer_id = $customer['id'];
        }
	}

	public function getCollection(){
        $collection =  App\Model\Quote::get();
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

}
