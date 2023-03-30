@extends('layouts.master-without-nav')

@section('content')
        <!-- Begin page -->
        <div class="wrapper-page">

            <div class="card">
                <div class="card-body">

                    <h3 class="text-center m-0">
                        <a href="index" class="logo logo-admin"><img src="{{ URL::asset('images/logosenja.jpeg') }}" height="60" alt="logo"></a>
                    </h3>

                    @if (Session::has('message'))
                    <div class="alert alert-warning" role="alert">
                        {!! Session::get('message') !!}
                    </div>
                    @endif

                    <div class="p-3">
                        <h5 class="text-muted font-18 m-b-5 text-center">Welcome Back !</h5>
                        <p class="text-muted text-center">Please Sign In to Continue</p>

                    <form method="POST" class="form-horizontal m-t-30" action="{{ route('authenticate') }}">
                        @csrf

                        <div class="form-group row">

                                <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus placeholder="Phone">

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group row">

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group row m-t-20">
                            <div class="col-sm-6">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customControlInline">
                                    <label class="custom-control-label" for="customControlInline">Remember me</label>
                                </div>
                            </div>
                            <div class="col-sm-6 text-right">
                                <button class="btn btn-dark w-md waves-effect waves-light" type="submit">Log In</button>
                            </div>
                        </div>

                        <div class="form-group m-t-10 mb-0 row">
                            <div class="col-12 m-t-20">
                                <a href="pages-recoverpw" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    <div class="m-t-40 text-center">
                <p>© {{date('Y')}} Lexa. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
            </div>

        </div>
        
@endsection