<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>POS Vantura | {{ $title }}</title>
        @include('layouts.head')
  </head>
<body>
        <div class="preloader" id="loaders">
            <div class="circular">
                <img class="text-center" src="{{ asset('images/loader.gif') }}" style="margin-bottom:-10px">
            <h5>Processing data, please wait ...</h5>
            </div>
        </div>
          <!-- Begin page -->
          <div id="wrapper">
      @include('layouts.topbar')
      @include('layouts.sidebar')
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
      @yield('content')
                </div> <!-- content -->
    {{-- @include('layouts.footer')     --}}
    @include('layouts.modal.master') 
            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->
    @include('layouts.footer-script')    
    </body>
</html>