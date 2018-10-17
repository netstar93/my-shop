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
}
