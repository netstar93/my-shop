<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Prepaid_payment extends Model
{
    public $timestamps = false;
    protected $table = "prepaid_payment_info";
    protected $fillable = ['order_id','transaction_id','discount','card_info','status'];

    public function Payment()
    {
        return $this->belongsTo('App\Model\Order_payment');
    }

    public function getCollection()
    {
        $collection = self::all();
        return $collection;
    }
}
