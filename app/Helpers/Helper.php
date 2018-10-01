<?php
namespace App\Helpers;
use Illuminate\Http\Request;
use  App\Model\Product;
use  App\Model\Category;
use DB;
class Helper
{
    /**
     * Helper constructor.
     */
    public function __construct() {
    }

    
 public static function getCategoryCollection($level=0,$cat_id = null){

        if($level  == 0 || empty($level)) {
            
            $categories = Category::getRootCategoryCollection();
        
        }else {

            $categories = Category::where([
                'parent_cat_id' => $cat_id,
                'level' => $level ,
                'visibility' => 1 ,
                'catalog_category_data.status' => 1,
                'master.status' => 1
                ])

                ->join('catalog_category_main AS master', 'master.id', '=','catalog_category_data.parent_cat_id')

                //SELECT ONLY SUB CATEGORY NAME AND ID
                ->select('catalog_category_data.*' ,'master.name as root_cat_name')
                ->get();
        }
        return $categories;
    }

    public static function getAddresses($customer_id = null){
        if(!$customer_id){
            $customer = session('customer');
            $customer_id = $customer['id'];
        }
        $address = DB :: table('customer_address') -> where('customer_id',$customer_id)->get();
        return $address;
    }

}