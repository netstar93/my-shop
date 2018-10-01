<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Attributeset extends Model
{
    protected $table = "attribute_set";
    public $timestamps = false;
    protected $fillable = ['name','attributes'];
    
}
