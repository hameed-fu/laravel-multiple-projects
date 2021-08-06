<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    </head>
    <body class="antialiased" id="app">
        <div class="relative flex items-top  min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="containter ">
                <div class="row">
                    <div class="col-md-10 ml-auto" id="data">
                        
                    </div>
                </div>
            </div>
        </div>
    <script>

        $(function(){
            $.ajax({
                url: "https://jsonplaceholder.cypress.io/todos",
                method: "GET",
                beforeSend:function(){
                    $("#data").html("loading...");
                },
                success (data){
                        $.each(data,function(index,value){
                            $("#data").append('<div class="card" style="width:600px"><div class="card-body"><h4 class="card-title">'+value.title+'</h4><p class="card-text">Some example text.</p><button data-id="'+value.id+'" class="btn show btn-primary">See Profile</button></div></div><br>');
                        });
                    console.log(data)
                }
            })
            $(".show").click(function(){
                console.log("ok")
                alert("oij")
            })
        })

    </script>
    </body>
</html>
