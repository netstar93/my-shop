<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Model\Customer;
use App\Model\Product;
use App\Model\Customer_address;

class Order extends Model
{
    protected $table = "sales_order";
    protected $customer_id ;
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';
    protected $customerModel;
    protected $productModel;

	public function __construct(){
        $customer = session('customer');
        $this->customer_id  = session() ->getId();
        
        if($customer) {
            $this->customer_id = $customer['id'];
        }
        $this ->customerModel = new Customer();
        $this ->productModel = new Product();
	}

    public function items()
    {
        return $this->hasMany('App\Model\Order_item');
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

    public function getOrder($id = null){
        $order = self :: find($id);
        $order ->grand_total = $this ->calculateGrandTotal($order);
        return $order;
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
    }

    public function getAllItems($order_id,$withData = false)
    {
        $items = Order:: find($order_id)->items;
        if($withData){
            return array_map(array($this,'renderItemData') , $items ->toArray());
        }
        return $items;
    }

    public function renderOrderData($order) {
        $tmp = $pro_name = array();
        $tmp = (object)$order;
        $customer =  $this ->getCustomer($order['customer_id']);
        if(isset($customer)){
            $tmp->customer_name = $customer ->name;
            $tmp->address = $this ->getShippingAddress($order['address_id']);
        }
        $productModel = new Product();
        foreach ($this->getAllItems($order['id']) as $item) {
            $product = $this ->productModel->load($item->item_id);
            if ($product->first()) {
                $pro_name[] = $product->first()->name;
            } else {
                $pro_name[] = 'NA';
            }
        }
        $tmp->product_name = $pro_name;
        return $tmp;
    }

    public function renderItemData($item_arr){
        $item = array();
        $item = (object)$item_arr;       
        $product = $this ->productModel->load($item ->item_id);
        // _log($product);
        if($product) {
            $item ->name = $product ->first()->name;
            $item ->image = $product ->first()->image;
        }
        return $item;
    }

    public function getCustomer($customer_id){
        return $this ->customerModel->load($customer_id);
    }

    public function getShippingAddress($address_id){
        return $this ->customerModel ->getShippingAddressData($address_id) ->address;
    }

    public function getExtraCharges($order) {      
        return $order->shipping_amount;
    }

    public function calculateGrandTotal($order) {
        $total = 0;
        $extra_charges = (int)$this ->getExtraCharges($order);
        $total += (int)$order->total_amount + $extra_charges;
        return $total;
    }
}
