@extends('layouts.master')

@section('breadcrumb')
                            <h4 class="page-title">Dashboard</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Welcome to POS Sample Dashboard</li>
                            </ol>
@endsection

@section('content')
            <div class="container-fluid">
                <div class="col-xl-20">
                    <div class="card m-b-12">
                        <div class="card-body">
                            <div class="row text-center m-t-20">
                                <div class="col-12">
<!-- Button trigger modal -->
<a href="{{ route('add') }}" class="btn btn-primary waves-effect waves-light" >
    Tambah Barang
</a>
  <hr>


  <!--Table-->
  <div>
    <table class="table table-hover table-borderless table-striped">
      <thead class="thead-dark">
      <tr>
        <th>Nama Produk</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Gambar</th>
        <th>Opsi</th>
      </tr>
    </thead>
      @foreach($listmodel as $p)
      <tr>
        <td>{{ $p->product_name }}</td>
        <td>Rp {{ $p->price }}</td>
        <td>{{ $p->stock }}</td>
        <td><image width="100px" class="rounded mx-auto d-block" src="{{asset(Storage::disk('local')->url($p->image))}}" alt="{{asset(Storage::disk('public')->url($p->image))}}"></td>
        <td>
          <a href="/list/edit/{{ $p->id }}" class="badge badge-light">Edit</a>
          |
          <a href="/list/hapus/{{ $p->id }}" class="badge badge-dark">Hapus</a>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
            </div>
          </div>
        </div>
      </div>
    </div>   
  </div> <!-- end container -->
<!-- end wrapper -->
@endsection