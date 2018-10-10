<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Model\Attribute;
use App\Model\Attributeset;

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

    /*
     *  load by product_id
     */
    public function load($id = null){
        if(!$id) return false;
        $data = self::getCollectionData()->filter(function ($value, $key) use ($id) {
            	return $value->product_id == $id;
            });
        return $data;
    }

    public function getCategoryProductCollection($id = null){
       if(!$id) return false;
       $data = self::getCollectionData() ->where('status',1)
            ->filter(function ($value, $key) use ($id) {
                
             $array = json_decode($value ->category_id , true);
             return in_array($id, $array);
            });

        return $data;
    }

    public function updateProduct($data)
    {
//        $data = $params ->all();
        $data['seller_id']  = 1;
        $diff_att = '';

        $id_data_diff = [];
        $id = $data['id'];
        $child_item = array();
        $filename = '';
        $id_main  = DB::table('catalog_product_main') ->where('id', $id)  ->limit(1)
            ->update([
            'name'=> $data['name'],
            'desc'=> $data['description'],
            'short_desc'=> $data['short_description'],
            'attribute_set_id'=> $data['attributeset'],
            'category_id'=> $data['category'], 
            'child_ids'=> "na",
            'attribute_values' => $data['custom_attr'],
            'seller_id'=> $data['seller_id'],
            'status'=> $data['status']
        ]);

        if($id_main > 0) {
            if (count($child_item) > 0) {
                foreach ($child_item as $id => $item) {
                    $diff_att = json_encode($item);
                    $id_diff = DB::table('catalog_product_data')->where('product_id',$data['product_id'])->update([
                        'brand' => '1clickpick',
                        'base_price' => $data['base_price'],
                        // 'image' => $filename,
                        'sku' => $data['sku'],
                        'diff_attr_values' => $diff_att
                    ]);
                }
            }
        }
        if($id_main > 0) return true;
    }
    
}
