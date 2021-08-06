<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Chat</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

      
    </head>
    <body>
        <div class="container mt-4">
            <div id="message"></div>
            <div class="row">
                <input type="text" id="chatInput" class="form-control">
            </div>

            <hr>
              <!-- <div class="row">
              <form class="form-horizontal">
            <fieldset>
              <legend class="text-center">Contact us</legend>
              <div class="form-group">
                <label class=" control-label" for="name">Name</label>
                <div class=" ">
                  <input id="name" type="text" placeholder="Your name" class="form-control" autofocus>
                </div>
              </div>
              <div class="form-group">
                <label class=" control-label" for="email">E-mail</label>
                <div class=" ">
                  <input id="email" type="email" placeholder="Your email" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class=" control-label" for="subject">Subject</label>
                <div class=" ">
                  <input id="subject" type="text" placeholder="Your subject" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class=" control-label" for="message">Your message</label>
                <div class=" ">
                  <textarea class="form-control" id="message" name="message" placeholder="Please enter your message here..." rows="5"></textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12 text-right">
                  <button type="button" id="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </fieldset>
            </form>
              </div> -->
        </div>
        
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.socket.io/4.1.2/socket.io.min.js" integrity="sha384-toS6mmwu70G0fw54EGlWWeA4z3dyJ+dlXBtSURSKN4vyRFOcxd3Bzjj/AoOwY+Rg" crossorigin="anonymous"></script>
    <script>
        $(function() {
            let ip_address = '127.0.0.1';
            let socket_port = '3000'
            let socket = io(ip_address + ':' + socket_port) 
            socket.on("connection")
            $("#chatInput").keypress(function(e){
                let message = $(this).val()
                    if(e.which === 13 && !e.shiftKey){
                        // $("#message").append(message+"<br>")
                        socket.emit('userChat',message);
                        $(this).val("");
                        return false;
                        
                    }
            })
            socket.on('userChat',(message) => {
                $("#message").append(message+"<br>")
            });
            socket.on('new_message',(message) => {
                consol.log
            });

            // -------------- //
    //   $("#submit").click(function(){
      

    //    var dataString = { 
    //           message : $("#message").val(),
    //           _token : '{{ csrf_token() }}'
    //         };

    //     $.ajax({
    //         type: "POST",
    //         url: "",
    //         data: dataString,
    //         dataType: "json",
    //         cache : false,
    //         success: function(data){

    //           $("#name").val('');
    //           $("#email").val('');
    //           $("#subject").val('');
    //           $("#message").val('');

    //           if(data.success == true){
    //             console.log(data)
    //             let ip_address = '127.0.0.1';
    //             let socket_port = '3000'
    //             let socket = io(ip_address + ':' + socket_port) 

    //             socket.emit('new_message', { 
    //                 message: data.message,
    //             });

    //           }
          
    //         } ,error: function(xhr, status, error) {
    //           alert(error);
    //         },

    //     });

    // });

        })
    </script>
    </body>


</html>
