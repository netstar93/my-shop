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

    public function getConfigurableData($product_id) {
        $data = DB::table('catalog_configurable_data') ->where('product_id',$product_id)->get();
        if(isset($data)) {
            if(!empty($data->first() ->child_product_ids))
            {
                return explode(',',$data->first() ->child_product_ids);
            }
        }
        return array();
    }

    public function updateProduct($data)
    {
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
        if($id_main > 0) 
            {               
              return true;
            }
    }

    public function saveChildProduct($data = array(),$image_name ,$parent_product_id = null) {           
            $saved_product_array = array();
            if(count($data['child_item']) <= 0 ) {
                return false;
            }

            foreach ($data['child_item'] as $key => $child_item) {

                $id_main = DB::table('catalog_product_main')->insertGetId([
                    'name' => $data['name'] ." - ".$child_item["'color'"],
                    'desc' => $data['description'],
                    'short_desc' => $data['short_description'],
                    'attribute_set_id' => $data['attributeset'],
                    'category_id' => $data['category'],
                    'child_ids' => "na",
                    'attribute_values' => $data['custom_attr'],
                    'seller_id' => $data['seller_id'],
                    'status' => $data['status']
            ]);

            if ($id_main > 0) {

                $id_data = DB::table('catalog_product_data')->insertGetId([
                        'main_id' => $id_main,
                        'visibility' => 0,
                        'brand' => '1clickpick',
                        'base_price' => $child_item["'price'"],
                        'image' => $image_name,
                        'sku' => $data['sku']."-".$child_item["'color'"]
                    ]); 
                }

                if(isset($id_data) && $id_data > 0) {
                
                        $id_config = DB::table('product_configurable_data')->insertGetId([
                                'product_id' => $id_main,
                                'config_attributes' => json_encode($child_item)
                            ]);  
                    if($id_config){
                        $saved_product_array[] = $id_main;
                    }
                }
          }

        //SAVE ALL CHILD PRODUCT ID TO CONFIGURABLE PRODUCT
        $id_config = DB::table('catalog_configurable_data')->insertGetId([
            'product_id' => $parent_product_id,
            'child_product_ids' => implode(',',$saved_product_array)
        ]);  

        }
    
}
