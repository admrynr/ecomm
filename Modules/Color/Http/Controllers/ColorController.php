<?php

namespace Modules\Color\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Http\Models\Colors;
use App\Http\Models\Product;
use App\Helpers\Guzzle;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;


class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $title = 'Color Management';

        $color = Colors::with('products')->get();
        //return $color;
        
        return view('color::index', ['colors' => $color])->withTitle($title);
    }

    public function data(Request $request )
    {
        if ($request->filter == 'all')
        $color = Colors::all();
        else
        $color = Colors::onlyTrashed()->get();

        return datatables::of($color)->make(true);
    }

    //get info data
    public function info(Request $request)
    {
        $model = Colors::all();

        $total = $model->count();
        $trashed = Colors::onlyTrashed()->count();

        $info = [
            'total' => $total,
            'trashed' => $trashed
        ];

        return json_encode($info);
    }

    //bulk data
    public function bulk($data, Request $request)
    {
        $datas = explode(',',$request->id);
        foreach($datas as $key){
            if($data == 'trash')
            $bulk = Colors::where('id',$key)->delete();
            else if($data == 'restore')
            $bulk = Colors::where('id',$key)->restore();
            else 
            $bulk = Colors::where('id',$key)->forcedelete();
        }
        
        $data = [
            'status' => 1,
            'message' => 'Success Update Data'
        ];

        return json_encode($data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('color::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //dd($request);

        $color = new Colors;

        $image = $request->file('image');

        $name = $image->getClientOriginalName();

        $upload = Storage::disk('public')->put('Color', $image);

        $color->name = $request->name;
        $color->image = $upload;
        $color->save();

        $data = [
            'status' => 1,
            'message' => 'Success Update Data'
        ];

        return json_encode($data);
        
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('color::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data = Colors::where('id', $id)->first();

        return json_encode($data);    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $color = Colors::findOrFail($id);

        $color->name = $request->name;

        if(!$color->update()){
            $data = [
                'status' => 2,
                'message' => 'Fail Update Data'
            ];
        }else{
            $data = [
                'status' => 1,
                'message' => 'Success Update Data'
            ];
        }

        return json_encode($data);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $colors = Colors::where('id', $id);

        Product::has('colors')->where('colors_id', $id)->update(['colors_id' => 0]);
        
        if(!$colors->delete()){
            $data = [
                'status' => 2,
                'message' => 'Fail Update Data'
            ];
        }else{
            $data = [
                'status' => 1,
                'message' => 'Success Update Data'
            ];
        }

        return json_encode($data);
    }
}
