<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Maersk Admin Panel</title>
        @include('layouts.head')
  </head>
<body style="background-image: url({{ asset('image/bg-login.jpg')}});background-repeat: no-repeat;
    background-size: 100% 100%;">
    <!-- Begin page -->
        <div id="wrapper">
            @yield('content')
        </div>
    @include('layouts.footer-script')
    </body>
</html>
