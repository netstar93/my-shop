<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Model\Customer;
use App\Model\Customer_address;

class Order extends Model
{
    protected $table = "sales_order";
    protected $customer_id ;
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';
    protected $customerModel;

	public function __construct(){
        $customer = session('customer');
        $this->customer_id  = session() ->getId();
        
        if($customer) {
            $this->customer_id = $customer['id'];
        }
        $this ->customerModel = new Customer();
	}

    /*ALL QUOTE FUNCTIONS*/

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

/*ALL ORDER FUNCTIONS*/

    public function getOrderCollection($seller_id= null){
        return self::get(); 
    }

    public function getOrderCollectionData(){
        $orders = $this ->getOrderCollection() ->toArray();
        $new_orders = array();
        $new_orders = array_map(array($this, 'renderOrderData'), $orders);
        return $new_orders;
        // _log($new_orders);
    }

    public function renderOrderData($order) {
        $tmp = array();
        $tmp = (object)$order;
        $customer =  $this ->getCustomer($order['customer_id']);

        if(isset($customer)){
            $tmp->customer_name = $customer ->name;
            $tmp->address = $this ->getShippingAddress($order['address_id']);
        }
        return $tmp;        
    }

    public function getCustomer($customer_id){
        return $this ->customerModel->load($customer_id);
    }

    public function getShippingAddress($address_id){
        return $this ->customerModel ->getShippingAddressData($address_id) ->address;
    }
}
