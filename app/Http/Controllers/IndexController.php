<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Model\Quote;
use  App\Model\Banner;
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
        $banner = Banner:: where('status', 1)->get();
        return view('index')->with(['banner_coll' => $banner]);
    }

    public function test(Request $request){
        echo $basePath = public_path('test.jpg');
        die;

        $savePath = public_path('gallery') . "\\" . "303270_0_1._edited.jpg";
//         $path = 'C:\xampp182\htdocs\1clickpick\public\media\product\303270_0_1.jpg';
//        $savePath = 'C:\xampp182\htdocs\1clickpick\public\media\product\303270_0_1._edited.jpg';
        $img = Image::make($basePath)->resize(50, 100);
        $img->save($savePath);
    }
}
