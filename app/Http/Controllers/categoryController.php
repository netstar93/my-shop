<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use DB;

class categoryController extends Controller
{
   protected $model;

  public function __construct(){
        $this ->model = new Category();
  }
    public function index(){
    	$collection = Category::all();
    	return view('admin.catalog.category.index',['collection' => $collection]);
    }

    public function add(){
    	return view('admin.catalog.category.new');
    }

    public function edit(Request $request){
      $id = $request ->id;
      $collection =  $this ->model ->load($id)->first();
      return view('admin.catalog.category.new',['formData' => $collection]);
    }

    public function save(Request $request){
    	$data = $request->all();
        if (isset($request->cat_id)) {
            $id_data = Category:: findOrFail($request->cat_id)->update($data);
            return redirect('admin/category/index')->with('success', 'Category succcessfully updated');
        }

        $id = Category:: create($data)->cat_id;
        if ($id > 0) {
       	return redirect('admin/category/index')->with('success','Category succcessfully saved');
       }
       else{
       	return redirect('admin/category/index')->with('error','Category not succcessfully saved');
       }
    }

    public function delete(Request $request){
        $data = $request ->all();
        if(isset($data['id'])){
            $model = DB::table('catalog_category_data') ->where('cat_id',$data['id']);
            $model->delete();
            return json_encode(array('error' => false));
        }
        return json_encode(array('error' => true));
      }
}
