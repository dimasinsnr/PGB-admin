@extends('layouts.auth')

@section('main-content')
<div class="min-vh-100">
    <div class="row row no-gutters min-vh-100">
        <div class="col-4">
            <div class="w-100 h-100 pl-5 pr-5" style="background-color: #0D2A0D; position: relative;">
                <div style="height: 150px; width: 70px; background-color: #FCF4E7; float: right; border-bottom-left-radius: 50px; border-bottom-right-radius: 50px; opacity: 0.5;">
                </div>
                <div id="p" class="min-vh-100 d-flex flex-column justify-content-center my-auto">
                    <img src="{{ asset('img/pie-chart.png') }}" alt="img-clock" style="width: 90px">
                    <p style="font-weight: 800; font-size: 28px; margin: 10px 0 0 0; color: white;">PGB Bangau Putih</p>
                    <p style="font-weight: 700; font-size: 18px; margin: 5px 0 0 0; color: white;">A better way to grow</p>
                </div>
                <div style="position: absolute; bottom: 0; height: 150px; width: 70px; background-color: #FCF4E7; border-top-left-radius: 50px; border-top-right-radius: 50px; opacity: 0.5;">
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="container">
                <div class="min-vh-100">
                    <div class="p-4">
                        <img src="{{ asset('img/logo_pgb.png') }}" width="50px" style="display: block; margin: 0 0 0 auto;" alt="">
                    </div>
                    <div class="d-flex align-items-center" style="padding-left: 130px; padding-top: 80px;">
                        <form method="POST" action="{{ route('login') }}" class="user">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <p style="font-weight: 800; font-size: 30px; margin: 0; color: #0D2A0D;">{{ __('Login') }}</p>
                            <p class="mb-4" style="font-weight: 500; font-size: 18px; margin: 0; color: #0D2A0D;">Masuk dengan akun Anda</p>
            
                            <div class="form-group">
                                <input type="email" style="width: 350px; border: 1px solid #0D2A0D" class="form-control form-control-user" name="email" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required autofocus>
                            </div>
            
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" style="border: 1px solid #0D2A0D" name="password" placeholder="{{ __('Password') }}" required>
                            </div>
            
                            <div class="form-group">
                                <div class="custom-control custom-checkbox small ml-2">
                                    <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
                                </div>
                            </div>
                                    
                            @if ($errors->any())
                                <div class="alert alert-danger border-left-danger" role="alert">
                                    <ul class="pl-4 my-2">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
            
                            <div class="form-group">
                                <button type="submit" class="btn btn-user btn-block mt-4" style="width: 100px; background-color: #0D2A0D; color: white">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{-- 
@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">{{ __('Login') }}</h1>
                                </div>

                                @if ($errors->any())
                                    <div class="alert alert-danger border-left-danger" role="alert">
                                        <ul class="pl-4 my-2">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('login') }}" class="user">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" name="email" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required autofocus>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password" placeholder="{{ __('Password') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            {{ __('Login') }}
                                        </button>
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <button type="button" class="btn btn-github btn-user btn-block">
                                            <i class="fab fa-github fa-fw"></i> {{ __('Login with GitHub') }}
                                        </button>
                                    </div>

                                    <div class="form-group">
                                        <button type="button" class="btn btn-twitter btn-user btn-block">
                                            <i class="fab fa-twitter fa-fw"></i> {{ __('Login with Twitter') }}
                                        </button>
                                    </div>

                                    <div class="form-group">
                                        <button type="button" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> {{ __('Login with Facebook') }}
                                        </button>
                                    </div>
                                </form>

                                <hr>

                                @if (Route::has('password.request'))
                                    <div class="text-center">
                                        <a class="small" href="{{ route('password.request') }}">
                                            {{ __('Forgot Password?') }}
                                        </a>
                                    </div>
                                @endif

                                @if (Route::has('register'))
                                    <div class="text-center">
                                        <a class="small" href="{{ route('register') }}">{{ __('Create an Account!') }}</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
