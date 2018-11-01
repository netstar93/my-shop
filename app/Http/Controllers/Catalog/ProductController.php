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
    protected $filter_params;

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
                    'product' => $this->getData(),
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
        $shipping_charge = Quote::shipping_charge;
        $error = false;
        $id = $request->product_id;
        $productModel = new Product();
        $quoteModel = new Quote();

        $data = $productModel->load($id)->first();
        $data ->qty  = 1;
        //GET LOGGED IN CUSTOMER CART DATA
        if (session('customer')) {
                $cart = $quoteModel->getCart();  //get items
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
                            'status' => 'pending'
                        ]);
                        if (!$item_id) $error = true;
                    } else{
                        $cart = session('cart');
                        $cart_items = $cart['items'];
                        $cart_items[$data->product_id] = $data;
                    }
        //UPDATE GRAND TOTAL
        $totals  = $quoteModel ->getTotals(); 
        $quoteModel ->updateQuote($quote_id,$totals['grand_total']);

        } else {
                $cart = session('cart');
            if(isset($cart)) {
                $cart_items = $cart['items'];
            }
            $cart_items[$data->product_id] = $data;
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

    public function filter(Request $request){
        $html = '';
        $this ->filter_params  = $request ->filters;//json_encode(array(35 =>0));

        $categoryProducts = $this ->model ->getCategoryProductCollection(2)->toArray();        
        $product_collection = array_filter($categoryProducts,array($this, '_filter_product'));
        
        foreach ($product_collection as $key => $product) {
            $html .= $this ->getProductListHtml($product);            
        }

        return json_encode(array('html' => $html ,'success' => true));
    }

    public function _filter_product($product) {
        $filters_arr = json_decode($this ->filter_params, true);
        _log($this ->filter_params);
        $product_attr_values = json_decode( $product ->attribute_values , true );
        foreach ($filters_arr as $filter_id => $value) {
            if(array_key_exists($filter_id , $product_attr_values)) {
               foreach ($product_attr_values as $key => $attr) {
                  if($attr == $value) return true;
                  else  return false;
               }            
             }
         }         
    }

    public function getProductListHtml($product) {        
        return '<div class="col-xs-6 col-lg-3 category-list-item">
                        <div class="img-box">
                            <a href="/catalog/product/view/'.$product ->id.'" title='.$product ->name.'>
                            <img class="group list-group-image" src="http://localhost:8000/media/product/thumb/'.$product ->image.'" width="150px" alt="">
                            </a>
                        </div>
                        <div class="caption product-info">
                            <h5 class="group inner product-name">
                                <a href="/catalog/product/view/'.$product ->id.'">
                                    '.$product ->name.'</a>
                            </h5>
                            <hr>
                            <div class="price-section">
                                <span class="lead final-price">'.renderPrice($product ->base_price).'</span>
                                
                            </div>
                        </div>
                    </div>';
    }
}
