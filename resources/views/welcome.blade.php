<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tugas Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                 color: #DCDCDC;
                
                 
            }
            .image{
                background-image: url("/Alfin/gb.jpg");
                width: 100%;
                height: 100%;
                position: fixed;
                float: left;
                left: 0;
                
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #DCDCDC;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
 

        </style>
    </head>
    <body>
        <div class="image">
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content" >
                <div class="title m-b-md">
                    Tugas Laravel Alfin
                   
                </div>

                <div class="links">
                    <a href="https://www.instagram.com/alfinrarry">Instagram</a>
                    <a href="https://www.facebook.com/alfinrarry">Facebook</a>
                    <a href="https://www.google.com/maps/place/Jl.+Diponegoro+No.167,+Dusu+Jalaan,+Padangan,+Kabupaten+Bojonegoro,+Jawa+Timur+62162/@-7.1527161,111.6072623,17z/data=!3m1!4b1!4m5!3m4!1s0x2e776464d57f5f23:0xd47360346163ca3a!8m2!3d-7.1527161!4d111.609451">Address</a>
                  
                </div>
            </div>
        </div>
</div>
        
    </body>
</html>
