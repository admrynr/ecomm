<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Http\Models\Categories;
use App\Http\Models\Product;
use App\Http\Models\SubCategories;
use App\Helpers\Guzzle;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $title = 'Category Management';

        $category = Categories::with('products')->get();
        //return $category;
        
        return view('category::index', ['categories' => $category])->withTitle($title);
    }

    public function data(Request $request )
    {
        if ($request->filter == 'all')
        $category = Categories::all();
        else
        $category = Categories::onlyTrashed()->get();

        return datatables::of($category)->make(true);
    }

    //get info data
    public function info(Request $request)
    {
        $model = Categories::all();

        $total = $model->count();
        $trashed = Categories::onlyTrashed()->count();

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
            $bulk = Categories::where('id',$key)->delete();
            else if($data == 'restore')
            $bulk = Categories::where('id',$key)->restore();
            else 
            $bulk = Categories::where('id',$key)->forcedelete();
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
        return view('category::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //dd($request);

        $category = new Categories;

        $image = $request->file('image');

        $name = $image->getClientOriginalName();

        $upload = Storage::disk('public')->put('category', $image);

        $category->name = $request->name;
        $category->image = $upload;
        $category->save();

        $categories_id = $category->id;

        $subcategory = $request->sub_categories;

        foreach($subcategory as $sc)
        {
            $subcat = new SubCategories;
            $subcat->name = $sc;
            $subcat->categories_id = $categories_id;
            $subcat->save();
        }


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
        return view('category::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data = Categories::with('subcategories')->where('id', $id)->first();

        return json_encode($data);    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $category = Categories::findOrFail($id);

        $category->name = $request->name;

        if(!$category->update()){
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
        $categories = Categories::where('id', $id);

        Product::has('categories')->where('categories_id', $id)->update(['categories_id' => 0]);
        
        if(!$categories->delete()){
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
