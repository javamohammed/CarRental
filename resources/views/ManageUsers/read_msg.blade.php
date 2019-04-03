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
          <div class="container  ">
            <br/>
            <!-- ################# -->

            <div class="card float-left ">
                <div class="card-header ">
                    {{$message[0]['from_name']}}<{{$message[0]['sender_email']}}>
                </div>
                    <div class="card-body">
            <h5 class="card-title">{{$message[0]['subject']}}</h5>
                <p class="card-text">{{$message[0]['content']}}.</p>
                <p id="p_answer"><a href="#" class="btn btn-primary" id="answer">repondere</a></p>
            </div>
            </div>

            <!-- ################# -->

        </div><!-- container -->
        </div><!-- container-fluid -->

      </div> <!-- content -->


@endsection

