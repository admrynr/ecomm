<?php

namespace App\Http\Controllers;

use App\Http\Models\ListModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ListModelController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listmodel = ListModel::all();

        return view('lists',['listmodel' => $listmodel]);

       
    }

    public function add()
    {

        return view('products/add');
  
    }

    public function edit($id)
    {
        $listmodel = ListModel::find($id);

        return view('products/update', ['product' => $listmodel]);
  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $image = $request->file('images');

        $upload = Storage::disk('public')->put('images', $image);

        //dd ($upload);

        $listModel = new ListModel;

        $listModel->product_name = $request->nampro;
        $listModel->price = $request->harpro;
        $listModel->stock = $request->stok;
        $listModel->image = $upload;

        $listModel->save();

        return redirect('/list');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Models\ListModel  $listModel
     * @return \Illuminate\Http\Response
     */
    public function show(ListModel $listModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ListModel  $listModel
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $image = $request->file('images');

        $upload = Storage::disk('public')->put('images', $image);

        $listModel = ListModel::find($id);

        $listModel->product_name = $request->nampro;
        $listModel->price = $request->harpro;
        $listModel->stock = $request->stok;
        $listModel->image = $upload;

        $listModel->save();

        return redirect('/list');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ListModel  $listModel
     * @return \Illuminate\Http\Response
     */
    public function delete($id, ListModel $listModel)
    {
        $listModel = ListModel::find($id);

        $listModel->delete();

        return redirect()->back();
    }
}
