@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/morris/morris.css')}}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ $title }}</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item ">
                        <a href="#">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Master Data
                    </li>
                </ol>
                <div class="state-information d-none d-sm-block">
                    
                    {{-- <div class="state-graph">
                        <div style="font-size: 20pt;margin-bottom: -5px;color:black" id="total"></div>
                        <div class="info">Total {{ $title }}</div>
                    </div> --}}
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-6 text-left">
                        <h4 class="mt-0 m-b-30 header-title">{{ $title }} List</h4>
                    </div>
                    <div class="col-md-6 text-right">
                        <a class="pull-right add-data" href="#" id="add-data">
                        <span class="btn btn-rounded btn-success waves-effect waves-light">
                            <i class="ti-plus"></i> Create {{$title}}
                        </span>
                        </a>
                    </div>
                    </div>
                    {{-- @if(Session::get('user')->level == 1)
                        <div class="row">
                            <div class="col-md-2 text-left form-group">
                                <label class="control-label">Sekolah :</label>
                                <select class="form-control select2" id="selectsekolah">
                                    @foreach($sekolah as $sek)
                                        <option value="{{ $sek->id }}">{{ $sek->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @else
                        <input type="hidden" id="selectsekolah" value="{{ Session::get('user')->sekolah_id }}">
                    @endif --}}
                    <table id="dataTable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Product Name</th>
                            <th>Base Price</th>
                            <th>Final Price</th>
                            <th>Stock</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        
    </div>
    <!-- end row -->

</div> <!-- end container-fluid -->
@endsection
@section('data-content')
    @include('user::form.user')
@endsection

@section('script-bottom')
        <script type="text/javascript" src="{{ asset("js/cashier.js") }}"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                appcashier.handleUserPage();
                jQuery('#effective_date').datepicker({
                    autoclose: true,
                    todayHighlight: true
                });
                jQuery('#effective_until').datepicker({
                    autoclose: true,
                    todayHighlight: true
                });
                $('.select2').select2();
            })
        </script>
@endsection