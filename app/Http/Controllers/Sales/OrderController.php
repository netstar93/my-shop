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
use Session;

class OrderController extends Controller
{
    protected $model;
    protected $image_model;
    protected $_product;
    protected $_order;

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
        $order = $this ->model ->getOrder($request->id);
//                _log($order ->Comments() ->get() ->toArray() );
        $customer = \App\Model\Customer:: find($order->customer_id);
        $itemData = $this ->model ->getAllItems($request->id , true);
        $this ->_order = $order;
        Session::put('admin_edit_order_id' , $order ->id);
        Session::put('edit_order' , $order);
        return view('admin.sales.order.view')->with([
                'order' => $order,
                'customer' => $customer,
                'items' => $itemData
            ]
        );
    }

public function addComment(Request $request){
        $error = false;
        $data = array();
        if(!empty(Session  :: get('admin_edit_order_id'))) {
            $order_id = Session  :: get('admin_edit_order_id');
        }
        $comment = $request ->comment;
        $request ->order_id = $order_id;
       $error = $this ->model ->addComment($order_id, $comment );
        if(!$error) return json_encode(array('error' => false));
        return json_encode(array('error' => true)) ;
    }

    public function update(Request $request) {
        $data = $request ->all();
        $title = $data['title'];
        $status = $data['status'];
        $status = $status == 7 || $status == 6 ? 1 : $status;
        $order_id = Session  :: get('admin_edit_order_id');
        $order =  Order::find($order_id);
        $order ->status = $status;
        $orderupdated = $order ->save();

        //Add Order Message
        $error = $this ->model ->addComment($order_id, "Order update :: ".ucfirst($title ));

        if(isset($orderupdated)) return json_encode(array('error' => false));
        return json_encode(array('error' => true)) ;
//        return redirect(url()->current()) ->withSuccess('Order cancelled');
    }
}