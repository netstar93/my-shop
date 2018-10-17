<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Model\ProductImage;
use Illuminate\Http\Request;
use DB;
use App\Model\Product;
use App\Model\Category;
use App\Model\Order;
use App\Model\Attributeset;
use App\Model\Attribute;

class OrderController extends Controller
{
    protected $model;
    protected $image_model;
    protected $_product;

    public function __construct(){
     $this ->model = new Order();
    }

	public function index(){
		$collection = $this ->model ->getOrderCollectionData();
		return view('admin.sales.order.grid')->with([
			'collection' =>$collection]
		);
	}

    public function view(Request $request)
    {
        $order = Order:: find($request->id);
        return view('admin.sales.order.view')->with([
                'order' => $order
            ]
        );
    }

}