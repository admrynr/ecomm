@extends('layouts.master')

@section('breadcrumb')
                            <h4 class="page-title">Dashboard</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Welcome to POS Sample Dashboard</li>
                            </ol>
@endsection

@section('content')
<div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-body">

                            <h4 class="mt-0 header-title">Edit Product Form</h4>
                            <hr>

    <form method="POST" action="{{ url('/list/update/'.$product->id) }}">
            @csrf
            
            <div class="form-group row">
            <label for="nampro" class="col-sm-2 col-form-label">Nama Produk</label>

            <div class="col-sm-10">
            <input name ="nampro" id="nampro" type="text" class="form-control" value="{{$product->product_name}}">

            @error('nampro')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>
            </div>

            <div class="form-group row">
                <label for="harpro" class="col-sm-2 col-form-label">Harga Produk</label>

                <div class="col-sm-10">
                <input name="harpro" id="harpro" type="text" class="form-control" value="{{$product->price}}">

                @error('harpro')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
            </div>

            <div class="form-group row">
            <label for="stok" class="col-sm-2 col-form-label">Stok</label>

            <div class="col-sm-10">
            <input name="stok" id="stok" type="text" class="form-control" value="{{$product->stock}}">

            @error('stok')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>
            </div>

            <div class="form-group">
                <b>File Gambar</b><br/>
                <input type="file" name="images">
            </div>

        <div class="form-group row mb-0">
            <div class="col-md-12 offset-md-6">
                <button type="submit" class="btn btn-primary">
                    {{ __('Update') }}
                </button>
            </div>
        </div>
    </form>

        </div>
      </div>
    </div>   
  </div> 
</div>
@endsection