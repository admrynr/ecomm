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
                <div class="state-information d-none d-sm-block">
                <ol class="breadcrumb m-t-15">
                    <li class="breadcrumb-item ">
                        <a href="#">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Master Data
                    </li>
                </ol>
                    
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
                                <h4 class="header-title">{{ $title }} List</h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('color.index') }}" class="btn {{ empty(Request::get('filter')) ? 'btn-primary' : 'btn-secondary' }} text-white">All (<span id="total"></span>)</a>
                                <a href="{{ route('color.index') }}?filter=trashed"  class="btn {{ !empty(Request::get('filter')) && Request::get('filter') == 'trashed' ? 'btn-primary' : 'btn-secondary' }} text-white">Trashed (<span id="trashed"></span>)</a>
                                <input type="hidden" id="filter" value="{{ empty(Request::get('filter')) ? 'all' : Request::get('filter') }}">
                            </div>
                            </div>
                        </div>
                    </div>
            </div>
        <div class="col-xl-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-6 text-left m-b-30">
                            <div class="dropdown mo-mb-2">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Bulk Action
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 33px, 0px);">
                                    <a class="dropdown-item bulk-button" data-title="restore" href="#">Restore</a>
                                    <a class="dropdown-item bulk-button" data-title="trash" href="#">Delete</a>
                                    <a class="dropdown-item bulk-button" data-title="delete" href="#">Permantly Delete</a>
                                </div>
                                <input type="hidden" id="bulkvalue">
                            </div>
                        </div>
                    <div class="col-md-6 text-right">
                        <a class="pull-right add-data" href="#" id="add-data">
                        <span class="btn btn-rounded btn-success waves-effect waves-light">
                            <i class="ti-plus"></i> Create {{$title}}
                        </span>
                        </a>
                    </div>
                    </div>
                    <table id="dataTableColor" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th></th>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Preview</th>
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
    @include('color::form.color')
@endsection


@section('script-bottom')
        <script type="text/javascript" src="{{ asset("js/color.js") }}"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                appuser.handleUserPage($('#filter').val());
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