@extends('layouts.index')
@section('title')
{{ trans('translate.dashboard') }}
@endsection

@section('content')

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
     @include('layouts.menu')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        @include('layouts.navbar')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="container border-left-primary border-bottom-primary ">
            <br/>
            <h1 class="text-center "></h1>
            <br/>
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->

                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>

                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">{{ trans('translate.create_an_account')}}!</h1>
                                @if ( !empty(Session::get('appsLocked')))
                                            <div  class="border-bottom-danger border-left-danger " Style="color: red" >
                                            <strong>{{Session::all()['appsLocked'] }}</strong>
                                            </div>
                                            <br>
                                        @endif
                            </div>
                            <form class="user" method="POST" action="{{ $action_type === 'register' ? route('register') : route('update_user', ['id' => $user->id]) }}">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user {{ $errors->has('firstname') ? ' is-invalid' : '' }}" value="{{ $user->firstname ? $user->firstname : old('firstname') }}" id="firstname" name="firstname" placeholder="{{ trans('translate.first_name')}}" required autofocus>
                                        @if ($errors->has('firstname'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('firstname') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user {{ $errors->has('lastname') ? ' is-invalid' : '' }}" value="{{  $user->lastname ? $user->lastname : old('lastname') }}" id="lastname" name="lastname" placeholder="{{ trans('translate.last_name')}}" required autofocus>
                                        @if ($errors->has('lastname'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('lastname') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input id="email" type="email" class="form-control form-control-user{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ trans('translate.email')}}" name="email" value="{{$user->email ? $user->email : old('email') }}" required>
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input id="password" type="password" class="form-control form-control-user{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ trans('translate.password')}}" name="password" required>
                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        <input id="password-confirm" type="password" class="form-control form-control-user" name="password_confirmation" placeholder="{{ trans('translate.repeat_password')}}" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    {{ trans('translate.register_account')}}
                                </button>
                                <hr>
                            </form>
                            <hr>



            </div>
        </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->


@endsection
