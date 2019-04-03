@extends('layouts.index')
@section('title')
{{trans('translate.manage_profile')}}
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
          <div class="container border border-primary ">
            <br/>
            <!-- ################# -->
            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4 border border-primary rounded-pill">{{ trans('translate.my_profile')}}!</h1>
                                @if ( !empty(Session::get('appsLocked')))
                                            <div  class="border-bottom-danger border-left-danger " Style="color: red" >
                                            <strong>{{Session::all()['appsLocked'] }}</strong>
                                            </div>
                                            <br>
                                        @endif
                            </div>
            <div class="container">
            <div class="row">
                <div class="col order-last">
                     @if ( !empty(Session::get('password_updated_succeed')))
                        <div  class="border-bottom-success border-left-success " Style="color: green" >
                        <strong>{{Session::all()['password_updated_succeed'] }}</strong>
                        </div>
                        <br>
                    @endif
                    <div id="change_password" style="display: {{ $errors->has('password') ? 'block' : 'none' }};">
                    <form class="user" method="POST" action="{{ route('change_password')}}">
                    @csrf
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
                   {{trans('translate.change_password')}}
                </button>

                </form>
                </div>
                </div>
                <div class="col">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->

                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>


                            <div class="card" style="width: 18rem;">
                            <img src="{{URL::asset('img/default_avatar.png')}}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Informations:</h5>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">{{trans('translate.full_name')}}:       {{$user->firstname }} {{$user->lastname }}</li>
                                    <li class="list-group-item">{{trans('translate.email')}}:      {{$user->email }}</li>
                                    <li class="list-group-item">{{trans('translate.level')}}:      {{$user->level }}</li>
                                    <li class="list-group-item">{{trans('translate.created_at')}}: {{$user->created_at }}</li>
                                </ul>
                                <div class="card-body">
                                    <button  class="btn btn-info" onclick="hide_show_changePassword()">{{trans('translate.change_password')}} ??</button>
                                </div>
                            </div>

                            <hr>



            </div>
    </div>

  </div>
</div>
            <!-- ################# -->

        </div><!-- container -->
        </div><!-- container-fluid -->

      </div> <!-- content -->


@endsection
<script>
    var change_password  = "{{ $errors->has('password') ? 'block' : 'none' }}"
function hide_show_changePassword(){
    var el = document.getElementById('change_password');
    if(change_password  === 'none'){
        el.style.display = "block";
        change_password  = 'block'
    }else{
        el.style.display = "none"
        change_password  = 'none'

    }

}

</script>
