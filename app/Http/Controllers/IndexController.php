<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Model\Quote;
class IndexController extends Controller
{
    /**

     * Constructor.

     *

     * @return void

     */

    public function __construct()
    {
        $this->middleware('bootstrap');
    }

    public function index  (){
        return view('index');
    }

    public function test(Request $request){
        $request ->session()->forget('cart'); die;
       $model =  new Quote();
        dd(session('cart'));
    }
}
