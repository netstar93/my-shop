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
        $cart_items =  array();
        $cart_data  = $this ->getCartItems();
        return view('checkout/cart', ['items' => $cart_data]);
    }

    public function checkout() {
        $cart_data  = $this ->getCartItems();
        return view('checkout/checkout',['items' => $cart_data]);
    }

    public  function getCartItems()
    {
        $cart_data = array();
        
        //GET LOGGED IN CUSTOMER CART DATA
        if(session('customer') && session('cart')){  dd(session('cart'));
            $model =  new Quote();
            return $model ->getCartItems();
        }

        //GET VISITOR CART DATA
        if (session('cart')) {
            $cart = session('cart');
            return $cart['items'];
        }
        return $cart_data;
    }

    public function getProductAttributes($id){
        $data = Product ::find($id)->where('id','=',$id)
            ->join('catalog_product_data', 'catalog_product_main.id', '=', 'catalog_product_data.product_id')
            ->get()->first();
        return json_decode($data->attribute_values,true);
    }

}
