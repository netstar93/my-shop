<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Attributeset;
use App\Model\Attribute;
class attributesetController extends Controller
{
	public function index(){
		$collection = Attributeset::get();
    	return view('admin.attribute.set_grid',['collection' => $collection]);
    }

    public function new(){
      $collection = Attributeset::get();
      $attributeColl = Attribute::get();
    	return view('admin.attribute.set_new',['collection' => $collection , 'attribute_col' => $attributeColl ]);
    }

    public function edit(Request $request){
      $id = $request ->id;
      $collection = Attributeset::find($id);
        $attributeColl = Attribute::get();
      return view('admin.attribute.set_new',['formData' => $collection , 'attribute_col' => $attributeColl]);
    }

    public function delete(Request $request){     
      $data = $request ->all();
       if(isset($data['id'])){        
        $model = Attributeset::find($data['id']) ->delete();
        if($model)
          return json_encode(array('error' => false));
       }
       return json_encode(array('error' => true));
   }

    public function save(Request $request){
        $data = $request->all();
        // _log( $data); die;
        $attributes = implode(",", $request->get('attribute_ids'));
        if (isset($data['id'])) {
            $data['attribute_ids'] = $attributes;
            Attributeset::find($data['id'])->update($data);
            return redirect('admin/attributeset/index')->with('success', 'Succcessfully Updated');
        }
    	$attributeset =  new attributeset();
    	$attributeset ->name = $request->get('name');
      $attributeset->attribute_ids = $attributes;
    	$attributeset ->save();

       if($attributeset ->id > 0) {
       	return redirect('admin/attributeset/index')->with('success','Succcessfully saved');
       }
       else{
       	return redirect('admin/attributeset/index')->with('error','Not succcessfully saved');
       }
    }
}
