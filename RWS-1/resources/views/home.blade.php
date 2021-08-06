@extends('layouts.app')
@section('content')

<div class="container">
<div id="snippetContent"> 
            <main class="content">
                <div class="container p-0"> 
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-12 col-lg-5 col-xl-3 border-right"> 
                            @foreach($users as $user)
                                <a href="{{route('home',$user->id)}}" class="list-group-item list-group-item-action border-0">
                                    <div class="badge bg-success float-right">5</div>
                                    <div class="d-flex align-items-start">
                                        <img src="https://ui-avatars.com/api/?name={{$user->name}}" class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40" />
                                        <div class="flex-grow-1 ml-3">
                                            {{$user->name}}

                                            <div class="small" id="status_{{$user->id}}">
                                            @if($user->is_online == 1)
                                                <span class="fa fa-circle chat-online"></span> online
                                            @else
                                                <span class="fa fa-circle chat-offline"></span> offline
                                            @endif
                                                
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                                <hr class="d-block d-lg-none mt-1 mb-0" />
                            </div>
                            <div class="col-12 col-lg-7 col-xl-9">
                            @if($id)
                                <div class="py-2 px-4 border-bottom d-none d-lg-block">
                                    <div class="d-flex align-items-center py-1">
                                        <div class="position-relative"><img src="https://ui-avatars.com/api/?name={{$otherUser->name}}" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40" /></div>
                                        <div class="flex-grow-1 pl-3">
                                            <strong>{{$otherUser['name']}}</strong>
                                            <div class="text-muted small"><em>Typing...</em></div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="position-relative" style="height:450px;overflow:scroll">
                                    <div class="chat-messages p-4" >
                                        @foreach($messages as $message)
                                        @if($message->sender_id == Auth::user()->id)
                                        <div class="chat-message-right pb-4">
                                            <div>
                                                <img src="https://ui-avatar.com/api?name={{Auth::user()->name}}" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40" />
                                                <div class="text-muted small text-nowrap mt-2">{{ date('h:I A',strtotime($message->creted_at)) }}</div>
                                            </div>
                                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                                <div class="font-weight-bold mb-1">You</div>
                                                {{$message->message}}
                                            </div>
                                        </div>
                                        @else
                                        <div class="chat-message-left pb-4">
                                            <div>
                                                <img src="https://ui-avatar.com/api?name={{$otherUser->name}}" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40" />
                                                <div class="text-muted small text-nowrap mt-2">{{ date('h:I A',strtotime($message->creted_at)) }}</div>
                                            </div>
                                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                                <div class="font-weight-bold mb-1">{$otherUser->name}}</div>
                                                {{$message->message}}
                                            </div>
                                        </div>
                                        @endif
                                       @endforeach
                                    </div>
                                </div>
                                <div class="flex-grow-0 py-3 px-4 border-top">
                                    <div class="input-group"><input type="text" class="form-control" placeholder="Type your message" /> <button class="btn btn-primary">Send</button></div>
                                </div>
                                @else

                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </main> 
        </div>
</div>

<script src="{{asset('js/app.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.socket.io/4.1.2/socket.io.min.js" integrity="sha384-toS6mmwu70G0fw54EGlWWeA4z3dyJ+dlXBtSURSKN4vyRFOcxd3Bzjj/AoOwY+Rg" crossorigin="anonymous"></script>
    <script>
       $(function(){
           let ip_address = '127.0.0.1';
           let socket_port = '3000'
           let user_id = "{{Auth::id()}}"
           let socket = io(ip_address + ':' + socket_port,{query:{user_id:user_id}}) 

           socket.on("user_connected",function(data){
               console.log('c'+data)
               $("#status_"+data).html('<span class="fa fa-circle chat-online"></span> online')
           })

           socket.on("user_disconected",function(data){
                console.log('d'+data)
               $("#status_"+data).html('<span class="fa fa-circle chat-offline"></span> offline')
           })
       })

        </script>
   
@endsection