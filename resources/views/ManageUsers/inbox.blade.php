@extends('layouts.index')
@section('title')
{{ trans('translate.inbox') }}
@endsection

@section('content')
<script src="//code.jquery.com/jquery.js"></script>
<script type="text/javascript">
var dataInbox =  {count_msg :{!! json_encode($count_msg) !!}, messages: {!! json_encode($messages) !!}}
var dataSent = {count_msg_sent :{!! json_encode($count_msg_sent) !!}, messagesSent: {!! json_encode($messagesSent) !!}}
var id_msg_selected = 0 ;
var id_sent_selected = 0;
  $(document).ready(function() {
    $('#v-pills-inbox-tab').on('click', () => {
        $.ajax({
            url: "{{route('inbox_msgs')}}",
            beforeSend(xhr){
                $("#v-pills-inbox").html('<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>');
            },
            success: function(data){

                dataInbox = data
                var count_msg  = '';
                var html = '<ul class="list-group">'
                for (const key in dataInbox) {

                    if (key === 'count_msg') {
                        count_msg = dataInbox[key];
                    }else{
                        for (const k in dataInbox[key]) {
                            let bold = ''
                            if(dataInbox[key][k].is_readed == "0"){
                                bold='font-weight-bold'
                            }
                            html = html +'<li id="'+dataInbox[key][k].id+'" style="cursor: pointer;" class="list-group-item msg-item '+bold+'">'+dataInbox[key][k].subject+'</li>'
                        }
                    }
                }
                 //console.log(dataInbox)
                 html =  html+'</ul>'
                $("#v-pills-inbox").html(html);
                $('#count_msg').html(count_msg)
            }
            });

    })
    //Sent
    $('#v-pills-sent-tab').on('click', () => {
        $.ajax({
            url: "{{route('sent_msgs')}}",
            beforeSend(xhr){
                $("#v-pills-sent").html('<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>');
            },
            success: function(data){
                dataSent = data
                var count_msg_sent  = '';
                var html = '<ul class="list-group">'
                for (const key in dataSent) {

                    if (key === 'count_msg_sent') {
                        count_msg_sent = dataSent[key];
                    }else{

                        for (const k in dataSent[key]) {
                            html = html +'<li id="'+dataSent[key][k].id+'" style="cursor: pointer;" class="list-group-item sent-item ">'+dataSent[key][k].subject+'</li>'
                        }
                    }
                }
                 html =  html+'</ul>'
                 //console.log(count_msg_sent,html)
                $("#v-pills-sent").html(html);
                $('#count_msg_sent').html(count_msg_sent)
            }
            });

    })
})

$(document).on('click', '.msg-item', function () {
    var id = $(this).attr("id");
    var contact = ''
    dataInbox.messages.forEach(element => {
        if(element.id == id){
            contact = element
        }
    });
    $(".card-title").html(contact.subject);
    $(".card-header").text(contact.from_name+"<"+contact.sender_email+">");
    $(".card-text").html(contact.content);
    if(id_msg_selected != 0){
        $("#"+id_msg_selected).css({ 'background-color' : '', 'color' : '' });
    }
    id_msg_selected = id
    $("#"+id).css("background-color", "#6495ED");
    $("#"+id).css("color", "white");
    $("#"+id).removeClass("font-weight-bold");
    $(".card").removeClass('d-none')
    //$("#answer").remove();
    //####################
    if(contact.is_readed == "0"){
        let tmpId = '_'+id
        let url = "{{url('/inbox/read/id_msg')}}";
        $.ajax({
                url: url.replace('id_msg', tmpId),
                type: 'GET',
                data: { id: 22 },
                success: function(data){
                    contact.is_readed = "1"
                    dataInbox.count_msg--
                    $('.contact_nav_'+id).remove()
                    $('.count_unread').text(dataInbox.count_msg)
                    if(dataInbox.count_msg === 0 ){
                        let urlImg = "{{URL::asset('img/no-nothing.gif')}}"
                        let msg = "{{ trans('translate.Not_message_found')}}"
                        $('.elements').html ('<div class="dropdown-item d-flex align-items-center count_unread_empty"  >'+
                        '<div class="dropdown-list-image mr-3">'+
                        '<img class="rounded-circle" src="'+urlImg+'" alt="">'+
                        '<div class="status-indicator bg-success"></div>'+
                        '</div>'+
                        '<div class="font-weight-bold">'+
                        '<div class="text-truncate">'+msg+'</div>'+
                        '<div class="small text-gray-500">--</div></div> </div>')
                    }
                    console.log(data)
                }
                });
    }

    //#####################
    let route =  "{{url('/contact_admin/id_receiver')}}";
    $("#answer").remove();
    $( "#p_answer" ).append( "<a href='"+route.replace('id_receiver', id)+"' class='btn btn-primary' id='answer'>repondere</a>" );


     //console.log(contact);

});
$(document).on('click', '.sent-item', function () {
    var id = $(this).attr("id");
    var contact = ''
    dataSent.messagesSent.forEach(element => {
        if(element.id == id){
            contact = element
        }
    });
    if(id_sent_selected != 0){
        $("#"+id_sent_selected).css({ 'background-color' : '', 'color' : '' });
    }
    id_sent_selected = id
    $("#"+id).css("background-color", "#6495ED");
    $("#"+id).css("color", "white");
    $(".card").removeClass('d-none')

    $(".card-title").html(contact.subject);
    $(".card-header").text(contact.from_name+"<"+contact.sender_email+">");
    $(".card-text").html(contact.content);
    $("#answer").remove();

});
$(document).on('click', '.nav-link', function () {
    $(".card").addClass('d-none')
});




</script>
<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
     @include('layouts.menu')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->


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
                                <h1 class="h4 text-gray-900 mb-4">{{ trans('translate.inbox')}}!</h1>
                                 @if ( !empty(Session::get('contact_sending')))
                                    <div  class="border-bottom-success border-left-success " Style="color: green" >
                                    <strong>{{Session::all()['contact_sending'] }}</strong>
                                    </div>
                                    <br>
                                @endif
                            </div>


<div class="container">
  <div class="row">
    <div class="col-sm">
      <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
		<a class="nav-link active border border-primary" id="v-pills-inbox-tab" data-toggle="pill" href="#v-pills-inbox" role="tab" aria-controls="v-pills-inbox" aria-selected="true">inbox(<span id='count_msg'>{{ $count_msg}}</span>)</a>
		<a class="nav-link border border-primary" id="v-pills-sent-tab" data-toggle="pill" href="#v-pills-sent" role="tab" aria-controls="v-pills-sent" aria-selected="false">sent(<span id='count_msg_sent'>{{ $count_msg_sent}}</span>)</a>
		</div>
    </div>
    <div class="col-sm">
     <div class="tab-content float-left" id="v-pills-tabContent">


		<div class="tab-pane fade  show active" id="v-pills-inbox" role="tabpanel" aria-labelledby="v-pills-inbox-tab">
            <ul class="list-group">
            @foreach($messages as $message)
            <li id={{$message['id']}} style="cursor: pointer;" class="list-group-item msg-item {{$message['is_readed']== 0 ? 'font-weight-bold': ''}}">{{$message['subject']}}</li>
            @endforeach
            </ul>

        </div>

        <div class="tab-pane fade" id="v-pills-sent" role="tabpanel" aria-labelledby="v-pills-sent-tab">
         <ul class="list-group">
            @foreach($messagesSent as $message)
            <li  id={{$message['id']}} style="cursor: pointer;" class="list-group-item sent-item">{{$message['subject']}}</li>
            @endforeach
            </ul>
            </div>
		</div>
    </div>
    <div class="col-sm"><!-- Begin -->
      <div class="card float-left d-none">
        <div class="card-header ">
            {{$messages[0]['from_name']}}<{{$messages[0]['sender_email']}}>
        </div>
            <div class="card-body">
            <h5 class="card-title">{{$messages[0]['subject']}}</h5>
                <p class="card-text">{{$messages[0]['content']}}.</p>
            <p id="p_answer"><a href="{{route('contact_admin', ['id_receiver' => $messages[0]['id'] ])}}" class="btn btn-primary" id="answer">repondere</a></p>
            </div>
            </div>

    </div><!-- End -->

  </div>
</div>


<hr>




        </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->


@endsection
