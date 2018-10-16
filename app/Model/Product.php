<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Model\Attribute;
use App\Model\Attributeset;
use App\Model\ProductImage;
use App\Helpers\Image;

class Product extends Model
{
    protected $table = "catalog_product_main";
    public $timestamps = false;
    protected $image_model;

	public function _construct(){
        $this->image_model = new ProductImage();
	}

    public function getCollection()
    {
        $collection = DB::table('catalog_product_main')
            ->join('catalog_product_data', 'catalog_product_main.id', '=', 'catalog_product_data.main_id');
//                                       ->select('catalog_product_data.product_id');
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

    public function getConfigurableData($product_id)
    {
        $data = array();
        $product_ids = $this->getConfigurableProductIds($product_id);
        if (count($product_ids)) {  
            foreach ($product_ids as $product_id) {
                $tmp_data = $this->getCollection()
                    ->where('product_id', $product_id)
                    ->where('status', 1)
                    ->get()->first();
                if(isset($tmp_data)){ 
                   $data[$product_id] = $tmp_data;
                   $data[$product_id]->config_attributes = $this->getCustomAttribute($product_id);
                }
            }
        }
        return $data;
    }

    public function getCustomAttribute($product_id)
    {
        $data = DB::table('product_configurable_data')->where('product_id', $product_id)->get();
        if (isset($data->first()->config_attributes)) {
            return json_decode($data->first()->config_attributes, true);
        }
        return array();
    }

    public function getConfigurableProductIds($product_id)
    {
        $data = DB::table('catalog_configurable_data')->where('product_id', $product_id)->get();
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
//        _log($data);
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

        $gallery = Image::saveGalleryImages($data);
        $filename = isset($gallery[0]) ? $gallery[0] : null;
        $id_data = DB::table('catalog_product_data')->where('product_id', $data['product_id'])->limit(1)
            ->update([
                'brand' => '1clickpick',
                'base_price' => $data['base_price'],
                'image' => $filename,
                'sku' => $data['sku']
            ]);
        $imageModel = new ProductImage();
        $imageModel->saveProductImages($id_data, $gallery);
        return true;
    }

    public function saveChildProduct($data = array(),$image_name ,$parent_product_id = null) {           
            $saved_product_array = array();
        if(empty($data['child_item'][0]['price']) ) {
            return false;
        }
        $new_price =  0;
        $attributeModel = new Attribute();
        $attribute_color = Attribute:: where('name', 'color')->get()->first();
        $attribute_size = Attribute:: where('name', 'size')->get()->first();
        $color_options = $attributeModel->getAttributeOptions('color');

            foreach ($data['child_item'] as $key => $child_item) {
                $new_attribute_values = $child_item;
                if(isset($data['custom'])){
                    $new_attribute_values = $child_item + $data['custom'];
                }
                $new_price = $child_item["'price'"];

                $id_main = DB::table('catalog_product_main')->insertGetId([
                    'name' => $data['name'] . " - " . $color_options[$child_item[$attribute_color->id]],
                    'desc' => $data['description'],
                    'short_desc' => $data['short_description'],
                    'attribute_set_id' => $data['attributeset'],
                    'category_id' => $data['category'],
                    'child_ids' => "na",
                    'attribute_values' => json_encode($new_attribute_values),
                    'seller_id' => $data['seller_id'],
                    'status' => $data['status']
            ]);

            if ($id_main > 0) {

                $id_data = DB::table('catalog_product_data')->insertGetId([
                        'main_id' => $id_main,
                        'visibility' => 0,
                        'brand' => '1clickpick',
                    'base_price' => $new_price,
                        'image' => $image_name,
                    'sku' => $data['sku'] . "-" . $color_options[$child_item[$attribute_color->id]]
                    ]); 
                }

                if(isset($id_data) && $id_data > 0) {
                
                        $id_config = DB::table('product_configurable_data')->insertGetId([
                            'product_id' => $id_data,
                                'config_attributes' => json_encode($child_item)
                            ]);  
                    if($id_config){
                        $saved_product_array[] = $id_data;
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
