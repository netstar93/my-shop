<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class customer_address extends Model
{
    protected $table = 'customer_address';
    protected $fillable = ['customer_id','name','city','state','pincode'];
//    protected $guarded = ['price']
    protected $primaryKey = 'id';
    public $timestamps  = false;
}
