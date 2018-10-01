<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Category extends Model
{
    protected $table = "catalog_category_data";
    protected $primaryKey = 'cat_id';
    public $timestamps = false;

    protected $fillable = ['name', 'parent_cat_id', 'description','other_attributes','level','status','visibility','url_key'];


	public function _construct(){

	}

	public function getCollection(){
        $collection = App/Model/Category::all();
        return $collection;
    }

	public function getCollectionData(){
        $collection = DB::table('catalog_category_main')
                        ->join('catalog_product_data','catalog_product_main.id' ,'=','catalog_product_data.main_id')
                        ->get();
        return $collection;
    }

    public function load($id = null){
        if(!$id) return false;

        $data = $this ->getCollection()->filter(function ($value, $key) use ($id) { 
            	return $value->cat_id == $id;
            });
        return $data;
    }

    public static function getRootCategoryCollection(){
        $collection = DB::table('catalog_category_main') ->get();
        return $collection;
    }
}
