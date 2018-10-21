<?php

namespace App\Http\Controllers;

use App\Model\ProductImage;
use Illuminate\Http\Request;
use DB;
use App\Model\Product;
use App\Model\Category;
use App\Model\Attributeset;
use App\Model\Attribute;
use App\Helpers\Image;

class productController extends Controller
{
    protected $model;
    protected $image_model;
    protected $_product;

    public function __construct(){
        $this ->model = new Product();
        $this->image_model = new ProductImage();
    }

    public function index($type =null, $type_value=null){
        $collection  = $this ->model ->getCollectionData();
        return view('admin.catalog.product.index')->with([
            'collection' => $collection
        ]);
    }

    public function new()
    {
        $images = array();
        $attributeModel = new Attribute();
        $collection = $this->model->getCollectionData();
        $attributeset_coll = Attributeset:: all();
        $category_coll = Category::all()->where('status', 1);
        // $set_id = $attributeset_coll ->first() ->id;
        $other_attributes = array();//$attributeModel ->getOtherAttributes($set_id);
        return view('admin.catalog.product.new')->with([
            'attributeset_coll' => $attributeset_coll,
            'cat_coll' => $category_coll,
            'other_attributes' => $other_attributes,
            'images' => $images
        ]);
    }

    public function edit(Request $request){
        $id = $request ->id;
        $attributeModel = new Attribute();
        $error = '';
        $product = $this->model->load($id);
//        session('admin_product' , $product);
        $collection = $product->first();
        $set_id = $collection->attribute_set_id;
        $other_attributes = $attributeModel->getOtherAttributes($set_id);
        $attributeset_coll = Attributeset:: all();
        $category_coll = Category::all();
        $imageModel = new ProductImage();
        $images = $imageModel->getProductImages($id);
        $config_product_data = $this->model->getConfigurableData($id);
        return view('admin.catalog.product.new')->with([
            'formData' => $collection,
            'attributeset_coll' => $attributeset_coll,
            'cat_coll' => $category_coll,
            'other_attributes' => $other_attributes,
            'config_product_data' => $config_product_data,
            'images' => $images
        ]);
    }

    public function save(Request $request){
        $id_data = $id_main = '';
        $is_configurable = 0;
        $id_data_diff = [];
        $data = $request ->all();
        $data['is_configurable']  = 0;
        $data['seller_id'] = 1;
        $data['category'] = json_encode($data['category_id']);
        if (isset($data['custom']) && count($data['custom']) > 0) {
            $data['custom_attr'] = json_encode($data['custom']);
        } else{
            $data['custom_attr'] = '';
        }
        if(isset($data['child_item']) && !empty($data['child_item'][0]["'price'"] )) {
            $data['is_configurable']  = 1;
        }

        if (isset($request->id)) {
            $id_data = $this->model->updateProduct($data);
            return redirect('admin/product/index')->with('success', 'Product Succcessfully Updated');
        } else {
            $child_item = array();
            $filename = array();
            $diff_att = '';

            try{
                $id_main = DB::table('catalog_product_main')->insertGetId([
                    'name' => $data['name'],
                    'desc' => $data['description'],
                    'short_desc' => $data['short_description'],
                    'attribute_set_id' => $data['attributeset'],
                    'category_id' => $data['category'],
                    'is_configurable' => $data['is_configurable'],
                    'child_ids' => "na",
                    'attribute_values' => $data['custom_attr'],
                    'seller_id' => $data['seller_id'],
                    'status' => $data['status'],
                    'featured_product' => $data['featured_product']
                ]);

                if ($id_main > 0) {
                    $gallery = Image::saveGalleryImages($data);
                    $filename = isset($gallery[0]) ? $gallery[0] : null;
                    $id_data = DB::table('catalog_product_data')->insertGetId([
                        'main_id' => $id_main,
                        'brand' => '1clickpick',
                        'base_price' => $data['base_price'],
                        'image' => $filename,
                        'sku' => $data['sku']
                    ]);
                }
            } catch(Exception $e){
                $error = $e->getMessage();
            }

            if (isset($id_data)) {
                $this->image_model->saveProductImages($id_data, $gallery);
                $this->model->saveChildProduct($data, $filename, $id_data);
                return redirect('admin/product/index')->with('success', 'product succcessfully saved');
            } else {
                return json_encode(array('error' => $error));
            }
        }
    }

    public function delete(Request $request){
        $data = $request ->all();
        if(isset($data['id'])){
            //REMOVE DATA
            $model = DB::table('catalog_product_data') ->where('product_id',$data['id']);
            $main_id = $model->get() ->first() ->main_id;
            $model->delete();

            //REMOVE MAIN
            $data_model = DB::table('catalog_product_main') ->where('id',$main_id);
            if($data_model ->get()->count() >  0){
                $main_model = DB::table('catalog_product_main') ->where('id',$main_id);
                $main_model ->delete();
            }

            $configurable_model = DB::table('product_configurable_data')->where('product_id', $data['id']);
            if ($configurable_model->get()->count() > 0) {
                $configurable_model->delete();
            }

            $catalog_configurable_model = DB::table('catalog_configurable_data')->where('product_id', $data['id']);
            if ($catalog_configurable_model->get()->count() > 0) {
                $catalog_configurable_model->delete();
            }

            $image_model = DB::table('product_image')->where('product_id', $data['id']);
            if ($image_model->get()->count() > 0) {
                $image_model->delete();
            }

            if($model) {
                return json_encode(array('error' => false));
            }
        }
        return json_encode(array('error' => true));
    }

    public function duplicate(Request $request){
        $data = $request ->all();
        $product_id = $data['product_id'];
        if(isset($product_id)) {
            // $model = DB::table('catalog_product_data') ->where('product_id',$product_id)->get();
            $model = Product ::find(47);
            $copiedModel = $model ->replicate()->save();
die;
            if($model) {
                return json_encode(array('error' => false));
            }
        }
        return json_encode(array('error' => true));
    }


    public function getFormHtml(Request $request) {
        $count = array();
        $html = '';
        $count = $request ->count;
        $html .= view('admin.catalog.product.childProductForm') ->with(['count' =>$count])->render();
        return json_encode(array('html' => $html));
    }


    public function saveGalleryImages($image) {

        $image_name = time().'_banner.'.$image->getClientOriginalExtension();

        $destinationPath = public_path('media\product');
        File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);
        try{
            $img = Image::make($image->getRealPath());
            $img->resize(1000, 400, function ($constraint) {
                $constraint->aspectRatio();
            })
                //      ->resizeCanvas(1000, 350)
                ->save($destinationPath . '/' . $image_name);
        } catch(Exception $e){

        }
    }
}
