<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Customer_address extends Model
{
    protected $table = 'customer_address';
    protected $fillable = ['customer_id','name','city','state','pincode'];
//    protected $guarded = ['price']
    public $timestamps  = false;

    public function Customer(){
		return $this ->belongsTo('App\Model\Customer');
	}
}
