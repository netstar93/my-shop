<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = "product_attribute";
    public $timestamps = false;
    protected $fillable = ['name','type','options'];    
}
