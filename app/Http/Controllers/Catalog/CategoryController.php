<?php

namespace App\Http\Controllers\Catalog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\Model\Category;
use  App\Model\Product;
use Illuminate\Support\Facades\DB;
class CategoryController extends Controller
{
    protected $category ;
    protected $id ;
    protected $productCollection ;

     public function __construct(Request $request) {
         $id = $request->get('id');
         $this ->id = $id;
        $this ->category = Category::find($id);
     }

     public function view(){
         return view('catalog/category/view',['data'=>$this ->category ,'items' => $this ->getProductCollection()]);
     }
     /*
      * product collection filtered by category id
      */
     public function getProductCollection(){
//         return $this ->productCollection = Product :: where('category_id',$this ->id) ->with(['product_data' => function ($category) {
//             $category->where('status', 1);
//         }])->get();
         $productModel = new Product();
//         echo "<pre>"; print_r($productModel ->getCollection()); die;
         return $productModel ->getCollectionData($this ->id);
     }
}
