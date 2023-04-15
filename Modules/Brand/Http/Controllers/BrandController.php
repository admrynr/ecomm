<?php

namespace Modules\Brand\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Http\Models\Brands;
use App\Http\Models\Product;
use App\Helpers\Guzzle;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $title = 'Brand Management';

        $brand = Brands::with('products')->get();
        //return $brand;
        
        return view('brand::index', ['brands' => $brand])->withTitle($title);
    }

    public function data(Request $request )
    {
        if ($request->filter == 'all')
        $brand = Brands::all();
        else
        $brand = Brands::onlyTrashed()->get();

        return datatables::of($brand)->make(true);
    }

    //get info data
    public function info(Request $request)
    {
        $model = Brands::all();

        $total = $model->count();
        $trashed = Brands::onlyTrashed()->count();

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
            $bulk = Brands::where('id',$key)->delete();
            else if($data == 'restore')
            $bulk = Brands::where('id',$key)->restore();
            else 
            $bulk = Brands::where('id',$key)->forcedelete();
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
        return view('brand::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //dd($request);

        $brand = new Brands;

        $image = $request->file('image');

        $name = $image->getClientOriginalName();

        $upload = Storage::disk('public')->put('Brand', $image);

        $brand->name = $request->name;
        $brand->image = $upload;
        $brand->save();

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
        return view('brand::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data = Brands::where('id', $id)->first();

        return json_encode($data);    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $brand = Brands::findOrFail($id);

        $brand->name = $request->name;

        if(!$brand->update()){
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
        $brands = Brands::where('id', $id);

        Product::has('brands')->where('brands_id', $id)->update(['brands_id' => 0]);
        
        if(!$brands->delete()){
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
