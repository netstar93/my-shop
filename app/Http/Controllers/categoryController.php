<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
class categoryController extends Controller
{
    public function index(){
    	$collection = Category::all();
    	return view('admin.catalog.category.index',['collection' => $collection]);
    }

    public function add(){
    	return view('admin.catalog.category.new');
    }

    public function save(Request $request){
    	$data = $request->all();
    	$id = Category :: create($data) ->id;  
    	if($id > 0 ) {
       	return redirect('admin/category/index')->with('success','Category succcessfully saved');
       }
       else{
       	return redirect('admin/category/index')->with('error','Category not succcessfully saved');
       }
    }
}
