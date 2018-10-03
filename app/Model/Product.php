<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Product extends Model
{
    protected $table = "catalog_product_main";
    public $timestamps = false;

	public function _construct(){

	}

	public function getCollection(){
        $main_collection = DB::table('catalog_product_main')
                        // ->leftjoin('catalog_product_data','catalog_product_main.id' ,'=','catalog_product_data.main_id')
                        // ->select('catalog_product_main.*' , 'catalog_product_data.product_id')
                       ->get();

       // $data_collection = $collection
				   //      ->join('catalog_product_data','catalog_product_main.id' ,'=','catalog_product_data.main_id')
				   //      ->select('catalog_product_data.product_id')
				   //      ->get();
	       $collection = $main_collection->map(function ($value, $key) {
			    $value->child_product_ids = array(rand(1,10));
			  	  return $value;
		   });
        return $collection;
    }

    /*
     * RETURN ALL PRODUCT WITH CHILD PRODUCTS
     */

	public function getCollectionData(){
        $collection = DB::table('catalog_product_main')
                        ->join('catalog_product_data','catalog_product_main.id' ,'=','catalog_product_data.main_id')
                        ->get();
        return $collection;
    }

    public function load($id = null){
        if(!$id) return false;
        $data = self::getCollectionData()->filter(function ($value, $key) use ($id) {
            	return $value->product_id == $id;
            });
        return $data;
    }

    public function getCategoryProductCollection($id = null){
        if(!$id) return false;
        $data = $this ->getCollectionData()->filter(function ($value, $key) use ($id) {
            return $value->category_id == $id;
        });
        return $data;
    }

    public function updateProduct($data) {
        $params = $data ->all();

        $id_main  = DB::table('catalog_product_main') ->insertGetId([
            'name'=> $data['name'],
            'desc'=> $data['description'],
            'short_desc'=> $data['short_description'],
            'attribute_set_id'=> $data['attributeset'],
            'category_id'=> $data['category'], 
            'child_ids'=> "na",   
            'attribute_values'=> "na",      
            'seller_id'=> $data['seller_id'],
            'status'=> $data['status']
        ]);
        
    }
}
