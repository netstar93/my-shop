<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Banner;
use Image;
use Storage;
use File;

class bannerController extends Controller
{
    protected $model;
    const WIDTH =  500;

    public function __construct()
    {
        $this -> model = new Banner();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = $this -> model ->getCollection();
        return view('admin/home/banner/grid',['collection' => $collection]);        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function new()
    {
      return view('admin/home/banner/new');
    }

    /**
     * Store a newly created resource in storage.
     *
*/
    public function save(Request $request)
    {
         // _log($request ->all());
        $this->validate($request, [
            'status' => 'required',
            'name' => 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $status = $request ->status;
        $image = $request->file('image');
        $image_name = time().'_banner.'.$image->getClientOriginalExtension();

        $destinationPath = public_path('media\banners');
        File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);
        try{
        $img = Image::make($image->getRealPath());
        $img->resize(1000, 400, function ($constraint) {
            $constraint->aspectRatio();
        })
//      ->resizeCanvas(1000, 350)
        ->save($destinationPath . '/' . $image_name);

            $this -> model ->status = $status;
            $this -> model ->name = ucfirst($request ->name);
            $this -> model ->path = $image_name;
            $id = $this -> model->save();
        }
        catch(Exception $e) {
         //  return redirect('admin/banner') ->with('error',$e ->getMessage());
         echo $e ->getMessage(); die;
        }

        if($id > 0) {
            return redirect('admin/banner') ->with('success','Banner Saved');
        }
        return redirect('admin/banner') ->with('error','Something Wrong !!!');
    }


/**
     * Display the specified resource.
     */
    public function show($aid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $banner = Banner ::findOrFail($id);
        return view('admin/home/banner/new') ->with(['banner' => $banner]);       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function delete(Request $request){     
      $data = $request ->all();
       if(isset($data['id'])){        
        $model = Banner::find($data['id']) ->delete();
        if($model)
          return json_encode(array('error' => false));
       }
       return json_encode(array('error' => true));
   }
}
