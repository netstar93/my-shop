<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Catalog_rule extends Model
{
    protected $table = "catalog_rule";
    public $timestamps = false;
    protected $fillable = ['name','status','description','from','to','usage_per_customer','discount_type','discount_amount'];
    protected $guarded = ['id'];
    
	public function __construct(){
        
	}

	public function getCollection(){
        $collection =  $this -> get();
        return $collection;
    }

    public function load($id = null){
        if(!$id) return false;
        $data = $this ->getCollection()->filter(function ($value, $key) use ($id) {
            	return $value->id == $id;
            });
        return $data;
    }

    public function isAdminLoggedIn(){
        $admin = session('admin');
        if(isset($admin)) {
             return true;
        }
        return false;
    }
}
