<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Order_comment extends Model
{
    public $timestamps = false;
    protected $table = "order_status";

    public function Order()
    {
        return $this->belongsTo('App\Model\Order');
    }
}
