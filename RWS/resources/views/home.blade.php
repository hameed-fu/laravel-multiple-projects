@extends('layouts.app')
@section('content')
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="https://cdn.socket.io/socket.io-1.3.4.js"></script>
<style type="text/css">
    #messages{
        border: 1px solid black;
        height: 300px;
        margin-bottom: 8px;
        overflow: scroll;
        padding: 5px;
    }
</style>
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">?</div>
                <div class="panel-body">
                
                <div class="row">
                    <div class="col-lg-8" >
                      <div id="messages" ></div>
                    </div>
                    <div class="col-lg-8" >
                            <form action="sendMessage" method="POST">
                            @csrf
                                <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}" > -->
                                <input type="hidden" name="user" value="{{ Auth::user()->name }}" >
                                <textarea  name="message" class="form-control msg"></textarea>
                                <br/>
                                <input type="submit" value="Send" class="btn btn-success send-msg">
                            </form>
                    </div>
                    
                </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
<hr>
<div class="container">
    <div class="row">
        <div class="col-md-8">
        <div id="message" ></div>
        <input type="text" class="form-control col-md-5" id="chatInput">
        </div>
    </div>
</div>
<script src="https://cdn.socket.io/4.1.2/socket.io.min.js" integrity="sha384-toS6mmwu70G0fw54EGlWWeA4z3dyJ+dlXBtSURSKN4vyRFOcxd3Bzjj/AoOwY+Rg" crossorigin="anonymous"></script>

<script>
    let ip_address = '127.0.0.1';
    let socket_port = '3000'
    let socket = io(ip_address + ':' + socket_port) 
    socket.on("connection")

    $("#chatInput").keypress(function(e){
        let message = $(this).val()
            if(e.which === 13 && !e.shiftKey){
                // $("#message").append(message+"<br>")
                socket.emit('chat',message);
                $(this).val("");
                return false;
            }
    })
    socket.on('chat',(message) => {
        $("#message").append(message+"<br>")
    });


    socket.on('message', function (data) {
        data = jQuery.parseJSON(data);
        console.log(data+"data from chanel");
        $( "#messages" ).append( "<strong>"+data.user+":</strong><p>"+data.message+"</p>" );
      });
    $(".send-msg").click(function(e){
        e.preventDefault();
        var token = $("input[name='_token']").val();
        var user = $("input[name='user']").val();
        var msg = $(".msg").val();
        // console.log(token,user,msg)
        if(msg != ''){
            $.ajax({
                type: "POST",
                url: "/sendMessage",
                dataType: "json",
                data: {'_token':token,'message':msg,'user':user},
                success:function(data){
                    console.log(data);
                    $(".msg").val('');
                }
            });
        }else{
            alert("Please Add Message.");
        }
    })
</script>
@endsection