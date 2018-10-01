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

    public function save(Request $request){
    	//echo "<pre>"; print_r($request ->all()); die;
    	$attributes = implode(",",$request->get('attributes'));
    	$attributeset =  new attributeset();
    	$attributeset ->name = $request->get('name');
    	$attributeset ->attributes = $attributes;
    	$attributeset ->save();

       if($attributeset ->id > 0) {
       	return redirect('admin/attributeset/index')->with('success','Succcessfully saved');
       }
       else{
       	return redirect('admin/attributeset/index')->with('error','Not succcessfully saved');
       }
    }
}
