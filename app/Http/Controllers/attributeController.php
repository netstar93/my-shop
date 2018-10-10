<?php

namespace App\Http\Controllers;

use App\Model\Attribute;
use Illuminate\Http\Request;

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
        return view('admin.attribute.item_new',['formData' => $collection]);
    }

    public function save(Request $request){
        $data = $request->all();       
        $data['options'] =  json_encode($data['select_option']);

        if($data['type'] != 'select') {
            $data['options'] = null;
        }
        if(isset($data['id'])){
            Attribute::find($data['id'])->update($data);
            return redirect('admin/attribute/index')->with('success','Succcessfully saved');
        }

        $attribute = new attribute();
        $attribute->name = $data['name'];
        $attribute->type = $data['type'];
        $attribute->status = $data['status'];
        $attribute->is_configurable = 0;
        $attribute->options = $data['options'];
        $attribute->save();

        if($attribute ->id > 0) {
            return redirect('admin/attribute/index')->with('success','Succcessfully saved');
        } else{
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

     public function list(Request $request) {
        $attribute_arr = array();
        $html = '';
        $set_id = $request ->set_id;
        $attributeModel = new Attribute();
        $attribute_arr  = $attributeModel ->getOtherAttributes($set_id);  
        $html .= view('admin.catalog.product.productform_other') ->with(['other_attributes' =>  $attribute_arr,'data' => array() ])->render();
        return json_encode(array('html' => $html));
     }
}
