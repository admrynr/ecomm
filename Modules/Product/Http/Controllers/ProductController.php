<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use App\Helpers\Guzzle;
use Yajra\Datatables\Datatables;
use App\Http\Models\Product;
use App\Http\Models\Brands;
use App\Http\Models\Colors;
use App\Http\Models\Categories;
use App\Http\Models\SubCategories;
use App\Http\Models\Sizes;
use App\Http\Models\ProductColors;
use App\Http\Models\ProductSizes;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $title = 'Product Management';

        $category = Categories::all();

        $brand = Brands::all();

        $colors = Colors::all();

        $sizes = Sizes::all();

        return view('product::index')->withTitle($title)->withBrands($brand)->withCategories($category)->withColors($colors)->withSizes($sizes);
    }

    //get data for Edit
    public function edit($id, Request $request)
    {
        $data = Product::where('id', $id)->first();

        return json_encode($data);
    }

    //update data
    public function update($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $product->product_name = $request->name;
        $product->product_type = $request->type;
        $product->categories_id = $request->category;
        $product->base_price = $request->base;
        $product->final_price = $request->final;
        $product->stock = $request->stock;

        if(!$product->update()){
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

    //approve data
    public function approve($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $product->is_verified = 1;

        if(!$product->update()){
            $product = [
                'status' => 2,
                'message' => 'Fail Approve Data'
            ];
        }else{
            $data = [
                'status' => 1,
                'message' => 'Success Approve Data'
            ];
        }

        return json_encode($data);
    }

    //decline data
    public function decline($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $product->is_verified = 0;

        if(!$product->update()){
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

    //delete data
    public function destroy($id, Request $request)
    {
        $product = Product::where('id', $id);

        if(!$product->delete()){
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
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        /*
        $data = $request->validate([
            'file' => 'required'
        ]);
        */

        $product = new Product;

        $image = $request->file('file');

        $name = $image->getClientOriginalName();

        //dd($image);

        $upload = Storage::disk('public')->put('product', $image);

        /*$upload = $image->store(
            $image, 'public'
        );
        */

        $product->product_name = $request->name;
        $product->categories_id = $request->category;
        $product->brands_id = $request->brand;
        $product->mitra_price = $request->mitra_price;
        $product->reseller_price = $request->reseller_price;
        $product->stock = $request->stock;
        $product->is_verified = 0;
        $product->image = $upload;
        $product->save();

        $products_id = $product->id;

        $colors = $request->color;
        $sizes = $request->size;
        
        foreach ($colors as $c) {
            $pc = new ProductColors;

            $pc->products_id = $products_id;
            $pc->colors_id = $c;
            $pc->save();
        }

        foreach ($sizes as $s) {
            $ps = new ProductSizes;

            $ps->products_id = $products_id;
            $ps->sizes_id = $s;
            $ps->save();
        }

        $data = [
            'status' => 1,
            'message' => 'Success Update Data'
        ];

        return json_encode($data);
        
    }

    public function data(Request $request)
    {
        $categories = Categories::all();
        if ($request->filter == 'all')
        $product = Product::with('categories')->get();
        else if($request->filter == 'active')
        $product = Product::where('is_verified',1)->get();
        else if($request->filter == 'deactive')
        $product = Product::where('is_verified',0)->get();
        else if($request->filter == 'trashed')
        $product = Product::onlyTrashed()->get();
        else {
            foreach($categories as $c){
                if($request->filter == $c->name){
                    $product = Product::with('categories')->where('categories_id',$c->id)->get();
                }
            }
        }

        return datatables::of($product)->make(true);
    }

    //bulk data
    public function bulk($data, Request $request)
    {
        $datas = explode(',',$request->id);
        foreach($datas as $key){
            if($data == 'trash')
            $bulk = Product::where('id',$key)->delete();
            else if($data == 'activate')
            $bulk = Product::where('id',$key)->update(['is_verified'=>1]);
            else if($data == 'deactivate')
            $bulk = Product::where('id',$key)->update(['is_verified' => 0]);
            else if($data == 'restore')
            $bulk = Product::where('id',$key)->restore();
            else 
            $bulk = Product::where('id',$key)->forcedelete();
        }
        
        $data = [
            'status' => 1,
            'message' => 'Success Update Data'
        ];

        return json_encode($data);
    }

    //get info data
    public function info(Request $request)
    {
        $model = Product::all();
        $category = Categories::all();

        $active = Product::where('is_verified',1)->count();
        $deactive = Product::where('is_verified',0)->count();;
        $total = $model->count();
        $trashed = Product::onlyTrashed()->count();
        

        $info = [
            'total' => $total,
            'active' => $active,
            'deactive' => $deactive,
            'trashed' => $trashed,
        ];

    foreach($category as $c){
        $info[$c->name] = Product::with('categories')->where('categories_id',$c->id)->count();
    }

        return json_encode($info);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('product::show');
    }

    public function findsubcategory($id)
    {
        $subcategories = Categories::find($id)->subcategories;
        
        return json_encode($subcategories);
    }

}
