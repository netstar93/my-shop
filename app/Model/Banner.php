<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Banner;

class Banner extends Model
{
	public $timestamps = false;
	protected $model;

    public function getCollection(){
    	return self :: all();
    }
}
