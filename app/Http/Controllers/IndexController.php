<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Model\Quote;
use Image;
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

            $img = Image::make('303270_0_1.jpg')->resize(50, 100);

            $img->save('assssa.jpg');
    }
}
