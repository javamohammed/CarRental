@extends('layouts.index')
@section('title')
{{ trans('translate.all_cars') }}
@endsection

@section('content')
@push('css')
      <link href="{{URL::asset('css/all_cars.css') }}" rel="stylesheet">
@endpush
@push('js')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/js/bootstrap4-toggle.min.js"></script>
    <script>
    $(document).ready(function() {
        //https://gitbrent.github.io/bootstrap4-toggle/
        $('.available').change(function() {
            var id = $(this).attr("id").split('_')[1];
            let available = $(this).prop('checked')
            $.ajax({
                url: '{{ route("set-available")}}',
                type: 'GET',
                data: { available: available, id_car: id },
                success: function(data){

                }
            })
        })
     })

    </script>
@endpush
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
            <h1 class="text-center ">{{ trans('translate.all_cars') }}</h1>
            <br/>
             @if ( !empty(Session::get('car_add_succeed')))
                <div  class="border-bottom-success border-left-success " Style="color: green" >
                <strong>{{Session::all()['car_add_succeed'] }}</strong>
                </div>
                <br>
            @endif
             @if ( !empty(Session::get('car_deleted_succeed')))
                <div  class="border-bottom-success border-left-success " Style="color: green" >
                <strong>{{Session::all()['user_deleted_succeed'] }}</strong>
                </div>
                <br>
            @endif
            @if ( !empty(Session::get('car_updated_succeed')))
                <div  class="border-bottom-success border-left-success " Style="color: green" >
                <strong>{{Session::all()['car_updated_succeed'] }}</strong>
                </div>
                <br>
            @endif
            <br>
            <a href="{{ route('create_user')}}" class="btn btn-primary btn-circle btn-lg"><i class="fas fa-car-side"></i></a>
            <br>

            <main class="container pt-5">
        <div class="card mb-5">
            <div class="card-header">Cars</div>
            <div class="card-block p-0">
                <table class="table table-bordered table-sm m-0">
                    <thead class="">
                        <tr>
                            <th>#</th>
                            <th>{{trans('translate.brand')}}</th>
                            <th>{{trans('translate.model_car')}}</th>
                            <th>{{ trans('translate.registration_number')}}</th>
                            <th>{{ trans('translate.number_places')}}</th>
                            <th>{{ trans('translate.number_cylinder')}}</th>
                            <th>{{ trans('translate.color')}}</th>
                            <th>{{ trans('translate.type_of_car')}}</th>
                            <th>{{ trans('translate.purchaseDate')}}</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($cars as $car)
                        <tr>
                            <td>
                                <input class="available" {{ $car->available ==  1 ? 'checked':''}} id="available_{{$car->id}}" type="checkbox" data-toggle="toggle" data-size="xs">
                            </td>
                            <td>{{ $car->model->mark->mark}}</td>
                            <td>{{ $car->model->model}}</td>
                            <td>{{$car->registration_number}}</td>
                            <td>{{$car->number_places}}</td>
                            <td>{{$car->number_cylinder}}</td>
                            <td ><a class="btn btn-primary btn-circle .btn-sm" style="background: {{$car->color}}"><i class="fas fa-car-side"></i></a></td>
                            <td>{{$car->type_car}}</td>
                            <td>{{$car->purchaseDate}}</td>
                            <td>
                                <a href="{{url('/edit-car/'.$car->id)}}/edit" class="btn btn-success btn-circle btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash-alt"></i></a>
                                <a href="{{url('/show-car/'.$car->id)}}/show" class="btn btn-info btn-circle btn-sm"><i class="fas fa-info-circle"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>


        </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->


@endsection
