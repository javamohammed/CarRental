@extends('layouts.index')
@section('title')
{{trans('translate.bad_request')}}
@endsection

@section('content')
<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- 404 Error Text -->
          <div class="text-center">
            <div class="error mx-auto" data-text="404">404</div>
          <p class="lead text-gray-800 mb-5">{{trans('translate.page_not_found')}}</p>
            <p class="text-gray-500 mb-0">{{trans('translate.invalid_link')}}...!!</p>
          <a href="{{route('login')}}">&larr; {{trans('translate.back_to_login')}}</a>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->
@endsection
