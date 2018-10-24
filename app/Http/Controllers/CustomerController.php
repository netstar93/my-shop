<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Customer;
use App\Model\Customer_Address;
use App\Model\Quote;
use League\Flysystem\Exception;
use App\Helpers\Helper;

class CustomerController extends Controller
{
    public function index(){
        return view('customer/dashboard');
    }

	public function create(){
	 return view('customer/register');
	}

	public function login(){
	 return view('customer.login');
	}
    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:30',
            'password' => 'required'
        ]);

        $Customers = new Customer();
        $Customers->name = $request->name;
        $Customers->password =  bcrypt($request->password);
        $Customers->email_address = $request->email_address;
        $Customers->mobile_number = $request->mobile;
        $Customers->address = 'empty';//$request->address;
        $Customers->city = 'empty';//$request->city;
        $Customers->state = 'empty';//$request->city;
        $Customers->profile_image = 'empty';//$request->city;
        $Customers->save();
        return redirect()->back()->withSuccess('You are successfully registered!');
    }
    public function checklogin(Request $request){
       $error  = $this->validate($request,[
           'email' => 'required|max:30|email',
           'password' => 'required'
       ]);

        $ajax =  $request->ajax;
        $customer = array();
        $email_id =  $request->email;
        $pass =  $request->password;       
        $customer = Customer::where('email_address', '=', $email_id)->get();

        if(!$customer ->first()) {
            return $this ->errorResponse($ajax);    
        } else{
            $customer = $customer->first()->toArray();
        }        
        $customer['logged_in'] =  true;
        // _log($customer);
        if( \Illuminate\Support\Facades\Hash::check($pass, $customer['password']) != false) {
            session(['customer' =>$customer]);
            //SAVE QUOTE
            $this ->saveQuote();            
            return $this ->successResponse($ajax);            
        }else{
            return $this ->errorResponse($ajax);  
        }
      
    }

    public function errorResponse($ajax) {
        if(!$ajax) {
                return redirect('customer/login')->with('error','Incorrect EmailID/password.');
                           }else{ return response()->json(array('success' => false));
        }
    }

    public function successResponse($ajax) {
        if(!$ajax) {
                return redirect('customer/dashboard')->with('success','Logged In Successfully');
                           }else{ return response()->json(array('success' => true));
        }
    }

    public function addressSave(Request $request){        
        $error = '';
        $customer  = $request->session()->get('customer');
        $data = $request->merge(['customer_id' => $customer['id'] ]);
        $email_id = '';
        $ajax = true;
        try {
            $customer = Customer_Address::create($request->all())->save();
        }
        catch(Exception $e){
            $error = $e->getMessage();
        }
        if($customer){
            return response()->json(array('success' => true, 'id' => $customer['id']));
        }
        else{
            return response()->json(array('success' => false,'message' => $error));
        }
    }

    public function saveQuote(){
        $quoteModel = new Quote();
        $quoteModel ->saveQuote();
    }

    public function getAddressHtml(Request $request)
    {
        $html = '';
        $helper = new Helper();
        $addresses = $helper->getAddresses();

        if (count($addresses) > 0)
            $html .= '<div class="address-list">
                  <form class="side-form form" name="shipping-address" id="shipping-address" method="post" role="form" aria-hidden="true">
                        <ul class="address-list" style="list-style: none">';
        foreach ($addresses as $address) {
            $html .= '<li>
                            <input type="radio" name="address" value=' . $address->id . ' required="true"> <b>' . $address->name . '</b>  
                            <div class="addr-content">' . $address->state . '</div>
                            </input>                
                         </li>';
        }
        $html .= '</ul>
                    <div class="invalid-feedback hidden">Oops, you missed this one.</div>
                    </form>
                     <button class="btn btn-primary next" id="shipping-next">Next</button>
                    </div>';
        return json_encode(array('address_html' => $html));
    }

}
