@extends('layouts.index')
@section('title')
{{ trans('translate.Unlocked_App')}}
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
                    <h1 class="h4 text-gray-900 mb-4">{{ trans('translate.welcome_unlocked')}}!</h1>
                    <p class=" text-gray-900 mb-4 alert-warning">{{ trans('translate.welcome_unlocked_2')}}!</p>
                     @if ( !empty(Session::get('appsLocked')))
                        <div  class="border-bottom-danger border-left-danger " Style="color: red" >
                        <strong>{{Session::all()['appsLocked'] }}</strong>
                        </div>
                        <br>
                    @endif
                     @if ( !empty(Session::get('change_email')))
                        <div  class="border-bottom-danger border-left-danger " Style="color: red" >
                        <strong>{{Session::all()['change_email'] }}</strong>
                        </div>
                        <br>
                    @endif
                    @if ( !empty(Session::get('again')))
                        <div  class="border-bottom-danger border-left-danger " Style="color: red" >
                        <strong>{{Session::all()['again'] }}</strong>
                        </div>
                        <br>
                    @endif
                  </div>
                <form class="user" method="POST" action="{{ route('sendEmailregistration') }}">
                       @csrf
                    <div class="form-group">
                      <input id="email" type="email" class="form-control form-control-user{{ $errors->has('email') ? ' is-invalid' : '' }}" aria-describedby="emailHelp" name="email" value="{{ old('email') }}" placeholder="{{ trans('translate.enter_email')}}" required autofocus>
                      @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                       @endif
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      {{ trans('translate.send') }}
                    </button>
                    <hr>
                  </form>
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>


@endsection
