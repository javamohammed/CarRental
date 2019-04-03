@extends('layouts.index')
@section('title')
{{ trans('translate.contact_form') }}
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
            maxFiles: 4,
            maxFilesize: 2,//MB
            acceptedFiles: 'image/*',
            dictDefaultMessage: '{{ trans("translate.message_dropzone")}}',
            dictRemoveFile: '{{trans("translate.delete")}}',
            params: {
                _token: '{{csrf_token()}}'
            },
            addRemoveLinks: true,
            success: function (file, response) {
                var imgName = response;
                $('.dz-remove').addClass( "btn" );
                $('.dz-remove').addClass( "btn-danger" );
                file.fid = imgName

                console.log("Successfully uploaded :");
            },
            error: function (file, response) {
                $('.dz-remove').addClass( "btn" );
                $('.dz-remove').addClass( "btn-danger" );
                console.log("errrror uploaded :");
            },
            removedfile: function(file){
                console.log(file)
                $.ajax({
                    dataType: 'json',
                    method: 'post',
                    url:  "{{ route('delete-imgs-car')}}",
                    data: {_token:'{{csrf_token()}}', id: file.fid}
                })
                var fmock;
                return (fmock = file.previewElement) != null ? fmock.parentNode.removeChild(file.previewElement) : void 0
            }
    });

 });

</script>
        <style type="text/css">
        .dz-image {
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
                                <h1 class="h4 text-gray-900 mb-4">{{ trans('translate.contact_form')}}!</h1>
                            </div>
               <center><h3>{{ trans('admin.other_files')}}</h3></center>
                <div class="dropzone" id="dropzonefileupload"></div>

                            <hr>



            </div>
        </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->


@endsection
