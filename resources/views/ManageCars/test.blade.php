
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" />
<script src="//code.jquery.com/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script type="text/javascript">
    Dropzone.autoDiscover = false
    $(document).ready( function(){
        $('#dropzonefileupload').dropzone({
            url: "/",
            paraName: 'files[]',
            autoDiscover:false,
            uploadMultiple:true,
            maxFiles: 15,
            maxFilessiz: 2,//MB
            acceptedFiles: 'image/*',
            dictDefaultMessage: 'إضغط هنا لرفع الملفات أو قم بسحب الملفات وإطلاقها هنا',
            dictRemoveFile: '{{trans('admin.delete')}}',
            params: {
                _token: '{{csrf_token()}}'
            },
            addRemoveLinks: true
        })
        //-----------------
    })

    </script>
    <style type="text/css">
    .dz-image {
        width: 100px;
        height: 100px;
    }
    </style>
    <div id="product_media" class="tab-pane fade">
      <center><h3>{{ trans('admin.other_files')}}</h3></center>
      <div class="dropzone" id="dropzonefileupload"></div>
    </div>

