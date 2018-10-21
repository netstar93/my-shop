<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Order_payment extends Model
{
    public $timestamps = false;
    protected $table = "order_payment";

    public function __construct()
    {
    }

    public function Order()
    {
        return $this->belongsTo('App\Model\Order');
    }

    public function getCollection()
    {
        $collection = self::all();
        return $collection;
    }
}
