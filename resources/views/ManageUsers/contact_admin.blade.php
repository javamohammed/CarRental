@extends('layouts.index')
@section('title')
{{ trans('translate.contact_form') }}
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
                                <h1 class="h4 text-gray-900 mb-4">{{ trans('translate.contact_form')}}!</h1>
                            </div>
                        <form class="user" method="POST" action="{{route('contact_admin_send')}}">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0 ">
                                        <input type="text" class="form-control form-control-user {{ $errors->has('subject') ? ' is-invalid' : '' }}" value="{{old('subject') }}" id="subject" name="subject" placeholder="{{ trans('translate.subject_form')}}" required autofocus>
                                        @if ($errors->has('subject'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('subject') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    @if ( !empty($email) ||  Auth::user()->level === 'admin' )
                                        <div class="col-sm-6">
                                            <input id="receiver_email" type="receiver_email" class="form-control form-control-user{{ $errors->has('receiver_email') ? ' is-invalid' : '' }}" placeholder="{{ trans('translate.email')}}" name="receiver_email" value="{{ !empty($email) ? $email : old('receiver_email') }}" required>
                                            @if ($errors->has('receiver_email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('receiver_email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    @endif

                                </div>

                                <div class="form-group">
                                       <textarea id="content" name="content" class="form-control  {{ $errors->has('content') ? ' is-invalid' : '' }}" placeholder="{{ trans('translate.content_form')}}" style="height:200px">{{old('content') }}</textarea>
                                        @if ($errors->has('content'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('content') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    {{ trans('translate.send')}}
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
