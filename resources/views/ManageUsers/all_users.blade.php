@extends('layouts.index')
@section('title')
{{ trans('translate.all_users') }}
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
            <h1 class="text-center ">{{ trans('translate.all_users') }}</h1>
            <br/>
             @if ( !empty(Session::get('user_add_succeed')))
                <div  class="border-bottom-success border-left-success " Style="color: green" >
                <strong>{{Session::all()['user_add_succeed'] }}</strong>
                </div>
                <br>
            @endif
             @if ( !empty(Session::get('user_deleted_succeed')))
                <div  class="border-bottom-success border-left-success " Style="color: green" >
                <strong>{{Session::all()['user_deleted_succeed'] }}</strong>
                </div>
                <br>
            @endif
            @if ( !empty(Session::get('user_updated_succeed')))
                <div  class="border-bottom-success border-left-success " Style="color: green" >
                <strong>{{Session::all()['user_updated_succeed'] }}</strong>
                </div>
                <br>
            @endif
            <br>
            <a href="{{ route('create_user')}}" class="btn btn-primary btn-circle btn-lg"><i class="fas fa-user-plus"></i></a>
            <br>
            <table class="table table-bordered" id="users-table">
                <thead>
                    <tr>
                        <th>{{ trans('translate.first_name') }}</th>
                        <th>{{ trans('translate.last_name') }}</th>
                        <th>{{ trans('translate.email') }}</th>
                        <th>{{ trans('translate.level') }}</th>
                        <th>{{ trans('translate.created_at') }}</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->


@endsection

 <script src="//code.jquery.com/jquery.js"></script>

        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

        <script type="text/javascript">

        $(function() {

            $('#users-table').DataTable({

                processing: true,
                serverSide: true,
                "searching": true,
                ajax: '{!! route('get.users') !!}',
                columns: [
                    { data: 'firstname', name: 'firstname'},
                    { data: 'lastname', name: 'lastname' },
                    { data: 'email', name: 'email'},
                    { data: 'level', name: 'level'},
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action'}

                ],
                "language": {
                "url": "{{URL::asset('vendor/datatables/translate/French.json') }}"
        }
            });

        });
         function delete_user(user_id){
             if(confirm('Do you want to delete this item?')){
               window.location = "{{url('delete')}}/"+user_id
            }
         }

        </script>
        @stack('scripts')
