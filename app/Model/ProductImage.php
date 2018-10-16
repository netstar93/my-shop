<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Banner;
use App\Model\Product;
use DB;

class ProductImage extends Model
{
    public $timestamps = false;
    protected $table = 'product_image';
    protected $fillable = ['product_id', 'path'];

    /**
     * @param $product_id
     * @param $images
     */
    public function saveProductImages($product_id, $images)
    {
        if(!$images) return false; 
        if (isset($images[0])) unset($images[0]);

        foreach ($images as $image_name) {
            self:: create([
                'product_id' => $product_id,
                'path' => $image_name
            ]);
        }
    }

    public function getProductImages($product_id)
    {
        $image_collection = $image_array = $more_images = array();
        $image_collection = DB::table('catalog_product_data')->where('product_id', $product_id)->select('image as path', 'product_id as id')->get()->toArray();
        foreach ($image_collection as $key => $val) {
            $image_array[] = (array)$val;
        }
        $more_images = self:: where('product_id', $product_id)->get()->toArray();
        $all_images = array_merge($image_array, $more_images);
        return $all_images;
//        _log($sports);
    }
}
