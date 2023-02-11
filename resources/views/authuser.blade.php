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
<hr>


<!--Table-->
<div>
  <table class="table table-hover table-borderless table-striped tabled">
    <thead class="thead-dark">
    <tr>
      <th>Nama User</th>
      <th>Email</th>
      <th>Action</th>
    </tr>
  </thead>
    @foreach($user as $u)
    <tr>
      <td>{{ $u->name }}</td>
      <td>{{ $u->email }}</td>
      <td >
          @if ($u->is_verified == '1')
          <a  class="badge badge-light rowverif">Verified</a>
          @else
          <a data-id="{{$u->id}}" data-name="{{$u->name}}" data-toggle="modal" data-target="#confirmModal" href="#" class="badge badge-warning verify">Verify</a>
          @endif
      </td>

      </td>
    </tr>
    <!-- /.modal -->
    @endforeach
  </table>
</div>
<div id="confirmModal" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Confirmation</h5>
            </div>
            <div class="modal-body">
                <h6>Verify <span id="namecustomer"></span> ?</h6>
            </div>
            <div class="modal-footer">
              <a href="#" id="btncustomer" class="btn btn-primary" data-dismiss="modal">OK</a>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </div>
          

          </div>
        </div>
      </div>
    </div>
  </div>   
</div> <!-- end container -->
<!-- end wrapper -->
@section('script')
<script type="text/javascript" src="{{ URL::asset('js/authuser.js') }}"></script>
@endsection
@endsection