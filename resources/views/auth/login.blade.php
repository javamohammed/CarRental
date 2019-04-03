@extends('layouts.index')
@section('title')
Login
@endsection

@section('content')

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">{{ trans('translate.welcome_back')}}!</h1>
                     @if ( !empty(Session::get('appsLocked')))
                        <div  class="border-bottom-danger border-left-danger " Style="color: red" >
                        <strong>{{Session::all()['appsLocked'] }}</strong>
                        </div>
                        <br>
                    @endif
                     @if ( !empty(Session::get('admin_succeed')))
                        <div  class="border-bottom-success border-left-success " Style="color: green" >
                        <strong>{{Session::all()['admin_succeed'] }}</strong>
                        </div>
                        <br>
                    @endif
                    @if ( !empty(Session::get('request_send')))
                        <div  class="border-bottom-success border-left-success " Style="color: green" >
                        <strong>{{Session::all()['request_send'] }}</strong>
                        </div>
                        <br>
                    @endif
                  </div>
                <form class="user" method="POST" action="{{ route('login') }}">
                       @csrf
                    <div class="form-group">
                      <input id="email" type="email" class="form-control form-control-user{{ $errors->has('email') ? ' is-invalid' : '' }}" aria-describedby="emailHelp" name="email" value="{{ old('email') }}" placeholder="{{ trans('translate.enter_email')}}" required autofocus>
                      @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                       @endif
                    </div>
                    <div class="form-group">
                      <input id="password" type="password" class="form-control form-control-user{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ trans('translate.password')}}" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="customCheck">{{ trans('translate.remember_me')}}</label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      {{ trans('translate.login') }}
                    </button>
                    <hr>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">{{ trans('translate.forgot_password')}}?</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>


@endsection
