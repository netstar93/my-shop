<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $product;
    protected $id;
    protected $productCollection;
    protected $model;

    public function __construct(Request $request)
    {
        $id = $request->id;
        $this->id = $id;
        $this ->model = new Product();
        $this->product = Product::find($this->id);
    }

    public function view()
    {  
        return view('catalog/product/product_view', [
                    'data' => $this->getData(),
                    'config_data' => $this ->model ->getConfigurableData($this->id),    
                    'custom_attributes'=> $this ->model ->getCustomAttribute($this->id) ]);
    }

    /*
     * ADD TO CART
     */
    public function addtocart(Request $request)
    {
        $cart_items = array();
        $grand_total = 0;
        $error = false;
        $id = $request->product_id;
        $productModel = new Product();
        $quoteModel = new Quote();

        $data = $productModel->load($id)->first();
        //GET LOGGED IN CUSTOMER CART DATA
        if (session('customer')) {
                $cart = $quoteModel->getCart();  //get items
                $loaded_quote = $quoteModel->getQuote();  //get quote
                $customer = session('customer');
                //SAVE QUOTE
                $newQuote = DB::table('sales_quote')->where('cust_id', $customer['id']) ->first();
                if(isset($newQuote ->id)) {
                    $quote_id = $newQuote ->id;
                }else{
                    $newQuote  = new \App\Model\Quote;
                    $newQuote->total_amount = $grand_total;
                    $newQuote ->cust_id  = $customer['id'];
                    $newQuote ->save();
                    $quote_id = $newQuote ->id;
                }
                $cart_items[$data->product_id] = $data;
                    //AVOID DUPLICACY
                    $item_exist= $cart->where('product_id', $data->product_id)->get()->first();
                    if (!isset($item_exist->id)) {
                        $cart_items[$data->product_id] = $data;
                        $item_id = DB::table('sales_quote_item')->insertGetId([
                            'quote_id' => $quote_id,
                            'product_id' => $data->product_id,
                            'amount' => $data->base_price,
                            'options' => $data->diff_attr_values,
                            'status' => 'pending'
                        ]);
                        if (!$item_id) $error = true;
                    } else{
                        $cart = session('cart');
                        $cart_items = $cart['items'];
                        $cart_items[$data->product_id] = $data;
                    }
        } else {
                $cart = session('cart');
            if(isset($cart)) {
                $cart_items = $cart['items'];
            }
            $cart_items[$data->product_id] = $data;
        }
        foreach ($cart_items as $item) {
            $grand_total += ($item->base_price + 30);
        }

        session(['cart' => [
            'items' => $cart_items,
            'grand_total' => $grand_total
        ]]);

        $response = array(
            'status' => 'success'
        );
        return response()->json($response);
    }

    /**
     * @return mixed|static
     */
    public function getData($id = null)
    {
        $productModel = new Product();
        $data = $productModel->load($this->id)->first();
        session('current_product', $data);
        return $data;
    }
}
