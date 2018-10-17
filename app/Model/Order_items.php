<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order_items extends Model
{
    public $timestamps = false;
    protected $table = 'sales_order_item';

    public function Order()
    {
        return $this->belongsTo('App\Model\Order');
    }
}
