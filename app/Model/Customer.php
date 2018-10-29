<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Customer_address;

class Customer extends Model
{
    protected $table = 'customers';
    public $timestamps  = false;

	public function Address(){
		return $this ->hasMany('App\Model\Customer_address');
	}

    public function Orders(){
        return $this ->hasMany('App\Model\Order');
    }

    public function getCollection()
    {
        $collection = self::get();
        return $collection;
    }

    /*
     *  load by id
     */
    public function load($id = null,$include_address = false){
    	$customer = self::find($id);
    	if($include_address)
    	$customer['addresses'] = $customer->Address;
        return $customer;
    }

    public function getShippingAddressData($address_id){
        return Customer_address :: find($address_id);
    }

    public function getOrderWithItems()
    {
        $items = array();
        foreach ($this->getOrders() as $key => $order) {
            $items[] = $order->items()->get();
        }
        return $items;
    }

    public function getOrders($customer_id = null) {
        return $this->getCustomer($customer_id)->Orders;
    }

    public function getCustomer($id = null) {
        if(session() ->get('customer')) {
            $cus = session() ->get('customer');
            return Customer :: find($cus['id']);
        }
        else{
            return Customer :: find($id);
        }         
    }
}
