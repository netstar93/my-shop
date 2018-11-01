<?php

namespace App\Http\Controllers\Rules;

use App\Model\Catalog_Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CatalogruleController extends Controller
{

    public function __construct() {
        $this ->model = new Catalog_Rule();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = $this ->model :: all();
        return view('admin.rules.grid') ->with([
            'collection' => $collection 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.rules.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request ->all();
        $this ->model->name = $data['name'];
        $this ->model->description = $data['desc'];
        $this ->model->usage_per_customer = $data['usage_per_customer'];
        $this ->model->discount_type = $data['discount_type'];
        $this ->model->discount_amount = $data['discount_amount'];
        $this ->model->from_date = $data['from'];
        $this ->model->to_date = $data['to'];
        $this ->model->save();
        echo $this ->model ->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rules\Catalog_Rule  $catalog_Rule
     * @return \Illuminate\Http\Response
     */
    public function show(Catalog_Rule $catalog_Rule)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rules\Catalog_Rule  $catalog_Rule
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Catalog_Rule :: find($id);
        return view('admin.rules.new') ->with(['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rules\Catalog_Rule  $catalog_Rule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Catalog_Rule $catalog_Rule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rules\Catalog_Rule  $catalog_Rule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catalog_Rule $catalog_Rule)
    {
        //
    }
}
