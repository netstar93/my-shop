<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Customers;
use App\Model\Customer_Address;
use App\Model\Quote;
use League\Flysystem\Exception;

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

        $Customers = new Customers;
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
       $this->validate($request,[
           'email' => 'required|max:30',
           'password' => 'required'
       ]);
        $email_id =  $request->email;
        $pass =  $request->password;
        $ajax =  $request->ajax;
        $customer = Customers::where('email_address','=',$email_id) ->get()->first()->toArray();
        $customer['logged_in'] =  true;

        if( \Illuminate\Support\Facades\Hash::check($pass, $customer['password']) != false) {
            session(['customer' =>$customer]);

            //SAVE QUOTE
            $this ->saveQuote();

            if(!$ajax) {

              return redirect('customer/dashboard')->with('success', 'You are logged In successfully !!!');
            } else return response()->json(array('success' => true));
        
        }else{

            if(!$ajax) {
            return redirect('customer/login')->with('error','Incorrect EmailID/password.');
                       }else{ return response()->json(array('success' => false));}
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

}
