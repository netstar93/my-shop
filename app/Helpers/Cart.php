<?php
namespace App\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\Model\Product;
/**
 * Created by PhpStorm.
 * User: Nitish
 * Date: 09 Sep
 * Time: 10:48 AM
 */
class Cart
{
    /**
     * Helper constructor.
     */
    public function __construct()
    {

    }
    public static function getCartItems()
    {
        $cart_data = array();
        $cart_items = array();
        if (session('cart_items')) {
            $cart_data = session('cart_items');
        }
        return $cart_data;
    }
    public static function getCartItemData(){
        $cart_data = array();
        $cart_items = array();
        if (session('cart_items')) {
            $cart_data = session('cart_items');
        }
        foreach ($cart_data as $item ){
            $cart_items[$item] =  self :: getProductAttributes($item);
        }
        return $cart_items;
    }
    public static function getProductAttributes($id){
        $data = Product ::find($id)->where('id','=',$id)
            ->join('catalog_product_data', 'catalog_product_main.id', '=', 'catalog_product_data.product_id')
            ->get()->first();
        return json_decode($data->attribute_values,true);
    }
}