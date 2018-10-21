<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Order_comment extends Model
{
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';
    protected $table = "order_comments";
    protected $fillable = ['order_id', 'comment',];

    public function Order()
    {
        return $this->belongsTo('App\Model\Order');
    }
}
