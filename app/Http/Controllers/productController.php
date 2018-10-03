<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\Product;

class productController extends Controller
{
    protected $model;

	public function __construct(){
        $this ->model = new Product();
	}

	public function index($type =null,$type_value=null){
		$collection  = $this ->model ->getCollectionData();   	
    	return view('admin.catalog.product.index') ->with('collection',$collection );
    }
    
    public function new(){
    	return view('admin.catalog.product.new');
    }

    public function edit(Request $request){
      $id = $request ->id;
      $collection =  $this ->model ->load($id)->first();
      return view('admin.catalog.product.new',['formData' => $collection]);
    }

    public function save(Request $request){
    	$id_data = $id_main = '';
    	$id_data_diff = [];
    	$data = $request ->all();
        if(isset($request ->id)){
           $id_data  = $this ->model ->updateProduct($request);
        }
        else{
    	$child_item = $request ->child_item;

    	$data['seller_id'] = 1;
		$filename = '';
		$diff_att = '';


		//IMAGE SAVE LOGIC
    	$destination ='media/product';
        $image = $request->file('base_image'); 
        if(isset($image)) {
       		$filename = $image->getClientOriginalName();
        	$image->move($destination, $filename);
        	$location=$destination.'/'.$filename;
		}

        $id_main  = DB::table('catalog_product_main') ->insertGetId([
        	'name'=> $data['name'],
        	'desc'=> $data['description'],
        	'short_desc'=> $data['short_description'],
        	'attribute_set_id'=> $data['attributeset'],
        	'category_id'=> $data['category'], 
        	'child_ids'=> "na",   
        	'attribute_values'=> "na",    	
        	'seller_id'=> $data['seller_id'],
        	'status'=> $data['status']
        ]);

        if($id_main > 0){
        	
        	if(count($child_item) > 0 ){
        		
        		foreach ($child_item as $id => $item) {
        		$diff_att = json_encode($item);
        		$id_diff  = DB::table('catalog_product_data') ->insertGetId([
					'main_id'=> $id_main,
					'brand'=> '1clickpick',
					'base_price'=> $data['base_price'],
					'image'=> $filename,
					'sku'=>$data['sku']	,
		        	'diff_attr_values'=> $diff_att		        	
        		]);
				if($id_diff > 0){
					$id_data_diff[] = $id_diff;
				}
        	}
        	}
        	else{
        		$id_data  = DB::table('catalog_product_data') ->insertGetId([
					'main_id'=> $id_main,
					'brand'=> '1clickpick',
					'base_price'=> $data['base_price'],
					'image'=> $filename,
					'sku'=>$data['sku']			        		        	
        	]);
        	}
        }
    }

       if($id_data > 0 || count($child_item) == count($id_data_diff)) {
       	return redirect('admin/product/index')->with('success','product succcessfully saved');
       }
       else{
       	return redirect('admin/product/index')->with('error','product not succcessfully saved');
       }
    }

}
