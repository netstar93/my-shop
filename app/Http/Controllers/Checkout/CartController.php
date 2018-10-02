<?php

namespace App\Http\Controllers\Checkout;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers;
use  App\Model\Product;
use  App\Model\Quote;

class CartController extends Controller
{
    public function index() {
        $model =  new Quote();
        $cart_data  = $model ->getQuoteItems();
        return view('checkout/cart', ['items' => $cart_data]);
    }

    public function checkout() {
        $model =  new Quote();
        $cart_data  = $model ->getQuoteItems();
        return view('checkout/checkout',['items' => $cart_data]);
    }

    public function delete(Request $request)  {
        $product_id = $request ->get('product_id');
        $quoteModel =  new Quote();
        $result = $quoteModel ->removeItem($product_id);
        if($result){
            return json_encode(array('success' => true));
        }
    }

    public function getProductAttributes($id){
        $data = Product ::find($id)->where('id','=',$id)
            ->join('catalog_product_data', 'catalog_product_main.id', '=', 'catalog_product_data.product_id')
            ->get()->first();
        return json_decode($data->attribute_values,true);
    }

}
