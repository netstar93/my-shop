<?php

namespace App\Http\Controllers\Catalog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\Model\Category;
use  App\Model\Product;
use  DB;
class CategoryController extends Controller
{
    protected $category ;
    protected $id ;
    protected $productCollection;
    protected $filter;

     public function __construct(Request $request) {
         $id = $request->id;
         $this ->id = $id;
         $this ->filters = $request ->filters;
         //_log($this ->filters);
         $this ->category = Category::find($id);
     }

     public function view(){
         return view('/catalog/category/view',['data'=>$this ->category ,'items' => $this ->getProductCollection()]);
     }
     /*
      * product collection filtered by category id
      */
     public function getProductCollection(){;
         $productModel = new Product();
         return $productModel ->getCategoryProductCollection($this ->id);
     }
}
