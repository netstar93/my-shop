<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\Product;
use App\Model\Category;
use App\Model\Attributeset;

class productController extends Controller
{
    protected $model;

	public function __construct(){
        $this ->model = new Product();
	}

	public function index($type =null,$type_value=null){
		$collection  = $this ->model ->getCollectionData();
        return view('admin.catalog.product.index')->with([
            'collection' => $collection
        ]);
    }
    
    public function new(){
        $set_id = 1;
        $collection = $this->model->getCollectionData();
        $attributeset_coll = Attributeset:: all();
        $category_coll = Category::all()->where('status', 1);
        $other_attributes = $this->model->getOtherAttributes($set_id);
        return view('admin.catalog.product.new')->with([
            'attributeset_coll' => $attributeset_coll,
            'cat_coll' => $category_coll,
            'other_attributes' => $other_attributes
        ]);
    }

    public function edit(Request $request){
        $id = $request ->id;
        $error = '';
        $collection = $this->model->load($id)->first();
        $set_id = $collection->attribute_set_id;
        $other_attributes = $this->model->getOtherAttributes($set_id);
        $attributeset_coll = Attributeset:: all();
        $category_coll = Category::all();
        return view('admin.catalog.product.new')->with([
            'formData' => $collection,
            'attributeset_coll' => $attributeset_coll,
            'cat_coll' => $category_coll,
            'other_attributes' => $other_attributes
        ]);
    }

    public function save(Request $request){

    	$id_data = $id_main = '';
    	$id_data_diff = [];
    	$data = $request ->all();
        $data['category'] = json_encode($data['category_id']);
        if (isset($data['custom']) && count($data['custom']) > 0) {
            $data['custom_attr'] = json_encode($data['custom']);
        }
        if (isset($request->id)) {
            $id_data = $this->model->updateProduct($data);
            return redirect('admin/product/index')->with('success', 'Product Succcessfully Updated');
        }
        else {
            $child_item = array();
            $data['seller_id'] = 1;
            $filename = '';
            $diff_att = '';

            //IMAGE SAVE LOGIC
            $destination = 'media/product';
            $image = $request->file('base_image');
            if (isset($image)) {
                $filename = $image->getClientOriginalName();
                $image->move($destination, $filename);
                $location = $destination . '/' . $filename;
            }
try{
            $id_main = DB::table('catalog_product_main')->insertGetId([
                'name' => $data['name'],
                'desc' => $data['description'],
                'short_desc' => $data['short_description'],
                'attribute_set_id' => $data['attributeset'],
                'category_id' => $data['category'],
                'child_ids' => "na",
                'attribute_values' => $data['custom_attr'],
                'seller_id' => $data['seller_id'],
                'status' => $data['status']
            ]);

            if ($id_main > 0) {

                if (count($child_item) > 0) {

                    foreach ($child_item as $id => $item) {
                        $diff_att = @json_encode($item);
                        $id_diff = DB::table('catalog_product_data')->insertGetId([
                            'main_id' => $id_main,
                            'brand' => '1clickpick',
                            'base_price' => $data['base_price'],
                            'image' => $filename,
                            'sku' => $data['sku'],
                            'diff_attr_values' => $diff_att
                        ]);
                        if ($id_diff > 0) {
                            $id_data_diff[] = $id_diff;
                        }
                    }
                } else {
                    $id_data = DB::table('catalog_product_data')->insertGetId([
                        'main_id' => $id_main,
                        'brand' => '1clickpick',
                        'base_price' => $data['base_price'],
                        'image' => $filename,
                        'sku' => $data['sku']
                    ]);
                }
            }
}
catch(Exception $e){
   
    $error = $e->getMessage();
}
            if (isset($id_data) || isset($id_diff)) {
                return redirect('admin/product/index')->with('success', 'product succcessfully saved');
            } else {
                return json_encode(array('error' => $error));
            }
        }
    }

    public function delete(Request $request){
        $data = $request ->all();
        if(isset($data['id'])){
            $model = DB::table('catalog_product_data') ->where('product_id',$data['id']);
            $main_id = $model->get() ->first() ->main_id;
            $model->delete();

            $data_model = DB::table('catalog_product_data') ->where('main_id',$main_id);
            if($data_model ->get()->count() ==  0){
                $main_model = DB::table('catalog_product_main') ->where('id',$main_id);
                $main_model ->delete();
            }

            if($model) {       
                return json_encode(array('error' => false));
                }       
            }
            return json_encode(array('error' => true));
        }

    public function attribute(Request $request)
    {
        $set_id = $request->get('set_id');
        return $this->model->getOtherAttributes($set_id);
    }
}
