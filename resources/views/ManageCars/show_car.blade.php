@extends('layouts.index')
@section('title')
{{ trans('translate.car_form') }}
@endsection

@section('content')

  @push('js')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
       <script type="text/javascript">
    Dropzone.autoDiscover = false;
   $(document).ready( function(){
     $('#dropzonefileupload').dropzone({
            url: " {{ route('add-imgs-car')}}",
            paraName: 'files[]',
            autoDiscover:false,
            uploadMultiple:true,
            maxFiles: 5,
            //maxFilesize: 4,//MB
            acceptedFiles: 'image/*',
            dictDefaultMessage: '{{ trans("translate.message_dropzone")}}',
            dictRemoveFile: '{{trans("translate.delete")}}',
            params: {
                _token: '{{csrf_token()}}',
                id_car : '{{$car->id}}'
            },
            addRemoveLinks: true,
            success: function (file, response) {
                $('.dz-remove').addClass( "btn" );
                $('.dz-remove').addClass( "btn-danger" );
                if(response != undefined){
                    var imageObj =JSON.parse(response)
                    let url = "{{url('storage/uploads/cars/img_link')}}";
                    console.log(imageObj.image1,imageObj.image2,imageObj.image3)

                    $('#image1').attr('src',url.replace('img_link', imageObj.image1));
                    file.fid = imageObj.image1
                    $('#image2').attr('src',url.replace('img_link', imageObj.image2));
                    file.fid = imageObj.image2
                    $('#image3').attr('src',url.replace('img_link', imageObj.image3));
                    file.fid = imageObj.image3
                    $('#image4').attr('src',url.replace('img_link', imageObj.image4));
                    file.fid = imageObj.image4
                    $('#image5').attr('src',url.replace('img_link', imageObj.image5));
                    file.fid = imageObj.image5

                }

                console.log("Successfully uploaded :");
            },
            error: function (file, response) {
                $('.dz-remove').addClass( "btn" );
                $('.dz-remove').addClass( "btn-danger" );
                console.log("errrror uploaded :");
            },
            removedfile: function(file){
                //console.log(file)
                $.ajax({
                    dataType: 'json',
                    method: 'post',
                    url:  "{{ route('delete-imgs-car')}}",
                    data: {_token:'{{csrf_token()}}', id: file.fid, id_car:'{{$car->id}}'},
                })
                let url = "{{url('storage/uploads/cars/img_link')}}";
                console.log(file)
                $("#"+file.imageId).attr('src', url.replace('img_link', 'empty-image.png'))
                console.log("Successfully deleted :");
                var fmock;
                return (fmock = file.previewElement) != null ? fmock.parentNode.removeChild(file.previewElement) : void 0
            },
            init: function (file){
                 @if ($car->paths_images->image1 != 'empty-image.png')
                    var image1 = "{{ $car->paths_images->image1 }}"
                    var image = image1.split('.')
                    var mock = { name: 'empty-image',fid: image1, imageId:'image1', size: '20', type: image[1], url: '{{ url('storage/uploads/cars/'.$car->paths_images->image1) }}' }
                    this.emit('addedfile',mock)
                    this.emit("thumbnail", mock, mock.url)
                 @endif

                 @if ($car->paths_images->image2 != 'empty-image.png')
                    var image2 = "{{ $car->paths_images->image2 }}"
                    var image = image2.split('.')
                    var mock = { name: 'empty-image',fid: image2, imageId:'image2', size: '20', type: image[1], url: '{{ url('storage/uploads/cars/'.$car->paths_images->image2) }}' }
                    this.emit('addedfile',mock)
                    this.emit("thumbnail", mock, mock.url)
                 @endif

                 @if ($car->paths_images->image3 != 'empty-image.png')
                    var image3 = "{{ $car->paths_images->image3 }}"
                    var image = image3.split('.')
                    var mock = { name: 'empty-image',fid: image3, imageId:'image3', size: '20', type: image[1], url: '{{ url('storage/uploads/cars/'.$car->paths_images->image3) }}' }
                    this.emit('addedfile',mock)
                    this.emit("thumbnail", mock, mock.url)
                 @endif

                 @if ($car->paths_images->image4 != 'empty-image.png')
                    var image4 = "{{ $car->paths_images->image4 }}"
                    var image = image4.split('.')
                    var mock = { name: 'empty-image',fid: image4, imageId:'image4', size: '20', type: image[1], url: '{{ url('storage/uploads/cars/'.$car->paths_images->image4) }}' }
                    this.emit('addedfile',mock)
                    this.emit("thumbnail", mock, mock.url)
                 @endif

                 @if ($car->paths_images->image5 != 'empty-image.png')
                    var image5 = "{{ $car->paths_images->image5 }}"
                    var image = image5.split('.')
                    var mock = { name: 'empty-image',fid: image5, imageId:'image5', size: '20', type: image[1], url: '{{ url('storage/uploads/cars/'.$car->paths_images->image5) }}' }
                    this.emit('addedfile',mock)
                    this.emit("thumbnail", mock, mock.url)
                 @endif


                $('.dz-progress').remove()
                $('.dz-remove').addClass( "btn" );
                $('.dz-remove').addClass( "btn-danger" );


            }
    });

 });

</script>
        <style type="text/css">
        .dz-image > img {
            width: 100px;
            height: 100px;
        }
        </style>

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
                                <h1 class="h4 text-gray-900 mb-4">{{ trans('translate.details_car')}}!</h1>
                            </div>
                            <div class="container">
	<br>
	<div class="row" id="ads">
    <!-- Category Card -->
    <div class="col-md-4">
        <div class="card rounded">
            <div class="card-image">
                <span class="card-notify-badge" >{{$car->purchaseDate}}</span>
            <span class="card-notify-year" style="background-color: {{$car->available == trans('translate.yes') ? 'green':'red'}} ">{{$car->available}}</span>
                <img class="img-fluid" id="image1"  src="{{ URL::asset('storage/uploads/cars/'.$car->paths_images->image1) }}" alt="Alternate Text" />
            </div>
            <div class="card-image-overlay m-auto">
            <span class="card-detail-badge">{{$car->type_car}}</span>
                <span class="card-detail-badge">{{ trans('translate.number_cylinder')}} ({{$car->number_cylinder}})</span>
                <span class="card-detail-badge">{{ trans('translate.number_places')}} ({{$car->number_places}})</span>
                <span class="card-detail-badge">{{ trans('translate.registration_number')}} ({{$car->registration_number}})</span>
                <span class="card-detail-badge" style="cursor:pointer">Description</span>

            </div>
            <div class="card-body text-center">
                <div class="ad-title m-auto">
                    <h5>{{ $car->model->mark->mark}} {{ $car->model->model}}</h5>
                </div>
                <a class="ad-btn" href="#">View</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card rounded">
            <div class="card-image">
                <img class="img-fluid" id="image2" src="{{ URL::asset('storage/uploads/cars/'.$car->paths_images->image2) }}" alt="Alternate Text" />
            </div>

        </div>

         <div class="card rounded">
            <div class="card-image">
                <img class="img-fluid" id="image3" src="{{ URL::asset('storage/uploads/cars/'.$car->paths_images->image3) }}" alt="Alternate Text" />
            </div>

        </div>

    </div>

    <div class="col-md-4">
        <div class="card rounded">
            <div class="card-image">
                <img class="img-fluid" id="image4" src="{{ URL::asset('storage/uploads/cars/'.$car->paths_images->image4) }}" alt="Alternate Text" />
            </div>

        </div>
         <div class="card rounded">
            <div class="card-image">
                <img class="img-fluid" id="image5" src="{{ URL::asset('storage/uploads/cars/'.$car->paths_images->image5) }}" alt="Alternate Text" />
            </div>

        </div>
    </div>

</div>
</div>

                            <hr>
                             <div class="dropzone" id="dropzonefileupload" style="margin-bottom: 10px"></div>



            </div>
        </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->


@endsection

