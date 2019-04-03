@extends('layouts.index')
@section('title')
{{ trans('translate.car_form') }}
@endsection

@section('content')

  @push('js')


      <script src="//code.jquery.com/jquery.js"></script>


       <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
     <script src="https://unpkg.com/gijgo@1.9.13/js/messages/messages.fr-fr.js" type="text/javascript"></script>
       <script type="text/javascript">
        //var local = "{{ session( 'langDatePicker') == 'en-en' ? '' : session( 'langDatePicker') }}"
        var  local = 'fr-fr'
        var datepicker, config;
        config = {
            uiLibrary: 'bootstrap4'
        };
        if(local !== 'en-en'){
             config = {
            locale:local,
            uiLibrary: 'bootstrap4'
        };
        }
        console.log(local,config)
        $(document).ready(function () {
            datepicker = $('#datepicker').datepicker(config);
            $('#ddlLanguage').on('change', function () {
                var newLang = $(this).val();
                config.locale = 'newLang';
                datepicker.destroy();
                datepicker = $('#datepicker').datepicker(config);
            });
        });
    </script>
      <script src="//cdn.rawgit.com/twbs/bootstrap/v4.1.3/dist/js/bootstrap.bundle.min.js"></script>
       <script src="js/bootstrap-colorpicker.js"></script>
<script type="text/javascript">
function rgb2hex(rgb){

            rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
            return (rgb && rgb.length === 4) ? "#" +
            ("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
            ("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
            ("0" + parseInt(rgb[3],10).toString(16)).slice(-2) : '';
        }
function get_models_cars(mark_id){
    let url = "{{url('/get-models-cars/mark_id')}}";
            $.ajax({
                url:  url.replace('mark_id', mark_id),
                type: 'GET',
                beforeSend: function (){
                    $('#model_id').html('')
                    $('#model_loaded').html('<span class="spinner-border text-primary" role="status" style="position: absolute;top: 5px;"></span>')
                },
                success: function(data){
                    $('#model_loaded').html('')
                    var selectOptions = '<option {{ old("model_id") == "" ? "selected" : "" }}  >{{ trans("translate.choose_model")}}...</option>'
                    data.map(model => {
                        selectOptions = selectOptions + '<option  {{ old("model_id") == "'+model.id+'" ? "selected" : "" }}  value="'+model.id+'">'+model.model+'</option>'
                    });
                    $('#model_id').html(selectOptions)

                    }
                });
}

$(document).ready(function() {
    var old_markid = {!! old('mark_id') !!}
    console.log('=========> ', old_markid)
    if( old_markid != undefined){
        get_models_cars(old_markid)
    }
    $( "#mark_id" ).change(function() {
        var mark_id = this.value;
        get_models_cars(mark_id)
        });
})



$(document).on('click', '.colorpicker', function () {
    var  color = $("#color").val();
    var hexColor = rgb2hex(color)
     $("#color").val(hexColor)
      console.log('kkkk', hexColor)
});
</script>

  <script>

    $(function () {
      // Basic instantiation:
      $('#color').colorpicker();
      $('#color').on('colorpickerChange', function(event) {
        $('.color_display').css('background-color', event.color.toString());
      });
    });
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
            <h1 class="text-center "></h1>
            <br/>
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->

                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>

                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">{{ trans('translate.car_form')}}!</h1>
                            </div>
                        <form class="user" method="POST" action="{{route('add-car')}}" >
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0 ">
                                       <select id="mark_id" name="mark_id" class="form-control">
                                           <option {{ old('mark_id') == '' ? "selected" : "" }} >{{trans('translate.choose_brand')}}...</option>
                                           @foreach ($car_marks as $car_mark)
                                       <option  {{ old('mark_id') == $car_mark->id ? "selected" : "" }} value="{{$car_mark->id}}">{{$car_mark->mark}}</option>
                                           @endforeach
                                       </select>
                                        @if ($errors->has('mark_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('mark_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                        <div class="col-sm-6"  >
                                            <select id="model_id" name="model_id" class="form-control" >
                                            <option selected>{{ trans('translate.The_first_Choose_Brand')}}</option>
                                            </select>
                                            <span id="model_loaded"></span>
                                            @if ($errors->has('model_id'))
                                             <span style="width: 100%;margin-top: .25rem;font-size: 80%;color: #e74a3b;">
                                                <strong>{{ $errors->first('model_id') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                       <input type="text" class="form-control form-control-user {{ $errors->has('registration_number') ? ' is-invalid' : '' }}" value="{{ old('registration_number') }}" id="registration_number" name="registration_number" placeholder="{{ trans('translate.registration_number')}}" required autofocus>
                                        @if ($errors->has('registration_number'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('registration_number') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                        <div class="col"  >
                                             <input type="number" class="form-control form-control-user {{ $errors->has('number_places') ? ' is-invalid' : '' }}" value="{{ old('number_places') }}" id="number_places" name="number_places" placeholder="{{ trans('translate.number_places')}}" required autofocus>
                                        @if ($errors->has('number_places'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('number_places') }}</strong>
                                        </span>
                                        @endif
                                        </div>

                                        <div class="col"  >
                                             <input type="number" class="form-control form-control-user {{ $errors->has('number_cylinder') ? ' is-invalid' : '' }}" value="{{ old('number_cylinder') }}" id="number_cylinder" name="number_cylinder" placeholder="{{ trans('translate.number_cylinder')}}" required autofocus>
                                        @if ($errors->has('number_cylinder'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('number_cylinder') }}</strong>
                                        </span>
                                        @endif
                                        </div>

                                        <div class="col"  >
                                             <input type="text" class="form-control form-control-user {{ $errors->has('color') ? ' is-invalid' : '' }}" value="{{ old('color') }}" id="color" name="color" placeholder="{{ trans('translate.color')}}" required >
                                             <span class="color_display rounded-pill" style="position: absolute;top:12px;left:150px">
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                        @if ($errors->has('color'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('color') }}</strong>
                                        </span>
                                        @endif
                                        </div>
                                         <div class="col"  >
                                             <select id="type_car" name="type_car" class="form-control " >
                                                <option {{ old('type_car') == '' ? "selected" : "" }} >{{ trans('translate.choose_type_of_car')}}</option>
                                                <option value="diesel" {{ old('type_car') == 'diesel' ? "selected" : "" }}>{{ trans('translate.diesel')}}</option>
                                                <option value="gasoline" {{ old('type_car') == 'gasoline' ? "selected" : "" }}>{{ trans('translate.gasoline')}}</option>
                                                <option value="electric" {{ old('type_car') == 'electric' ? "selected" : "" }}>{{ trans('translate.electric')}}</option>
                                            </select>
                                        @if ($errors->has('type_car'))
                                         <span style="width: 100%;margin-top: .25rem;font-size: 80%;color: #e74a3b;">
                                            <strong>{{ $errors->first('type_car') }}</strong>
                                        </span>
                                        @endif
                                        </div>



                                </div>

                                    <div class="form-group row">
                                         <div class="col">
                                            <input id="datepicker" width="276" class="{{ $errors->has('purchaseDate') ? ' is-invalid' : '' }}" value="{{ old('purchaseDate') }}"  name="purchaseDate" placeholder="{{ trans('translate.purchaseDate')}}" required  />
                                            @if ($errors->has('purchaseDate'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('purchaseDate') }}</strong>
                                            </span>
                                            @endif
                                            </div>
                                            <div class="col">
                                                <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="available" name="available">
                                                <label class="form-check-label" for="defaultCheck1">
                                                    {{ trans('translate.available_car')}}
                                                </label>
                                                @if ($errors->has('available'))
                                                    <span style="width: 100%;margin-top: .25rem;font-size: 80%;color: #e74a3b;">
                                                        <strong>{{ $errors->first('available') }}</strong>
                                                    </span>
                                                @endif
                                                </div>
                                        </div>
                                    </div>

                                <div class="form-group">
                                       <textarea id="description" name="description" class="form-control  {{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="Description" style="height:200px">{{old('description') }}</textarea>
                                        @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    {{ trans('translate.add')}}
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

