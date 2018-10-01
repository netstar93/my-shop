<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class customers extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id';
    public $timestamps  = false;
}
