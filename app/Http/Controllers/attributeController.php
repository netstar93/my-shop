<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Attribute;
class attributeController extends Controller
{
	  public function index(){
		  $collection = Attribute::get();
    	return view('admin.attribute.item_grid',['collection' => $collection]);
    }

    public function new(){
    	return view('admin.attribute.item_new');
    }

    public function edit(Request $request){
      $id = $request ->id;
      $collection = Attribute::find($id);
      return view('admin.attribute.item_edit',['formData' => $collection]);
    }

    public function save(Request $request){    	
    	$data = $request ->all();
     if(isset($data['id'])){
      $data['type'] =  json_encode($data['type']);
      $model = Attribute::find($data['id']) ->update($data);
         return "1";
     }

    	$attribute =  new attribute();
    	$attribute ->name = $data['name'];
      $attribute ->type = $data['type'];
    	$attribute ->options = json_encode($data['type']);
    	$attribute ->save();

       if($attribute ->id > 0) {
       	return redirect('admin/attribute/index')->with('success','Succcessfully saved');
       }
       else{
       	return redirect('admin/attribute/index')->with('error','Not succcessfully saved');
       }
    }

    public function delete(Request $request){     
      $data = $request ->all();
       if(isset($data['id'])){        
        $model = Attribute::find($data['id']) ->delete();
        if($model)
          return json_encode(array('error' => false));
       }
       return json_encode(array('error' => true));
   }
}
