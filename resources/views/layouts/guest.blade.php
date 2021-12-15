<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ config("app.name", "Laravel") }}</title>

        <!-- Fonts -->

        <!-- <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,900;1,100;1,300&display=swap" rel="stylesheet"> -->

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Roboto:ital,wght@0,100;0,300;0,400;0,900;1,100;1,300&display=swap" rel="stylesheet" />
        <link href="{{ asset('template/css/myauth.css') }}" rel="stylesheet" />
        <style>
            body {
                font-family: "lato", sans-serif !important;
            }
        </style>
    </head>

    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
    <script src="{{ asset('template/js/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // let firebaseConfig = {
        //     apiKey: "AIzaSyBVHlZ-7hKSmTXi1shjyqtP3pfh-wVS328",
        //     authDomain: "localhost",
        //     databaseURL: "https://deliveryprj-8176e-default-rtdb.firebaseio.com",
        //     projectId: "deliveryprj-8176e",
        //     storageBucket: "deliveryprj-8176e.appspot.com",
        //     messagingSenderId: "144627415309",
        //     appId: "1:144627415309:web:59d5b920329fa9aa19d844",
        //     measurementId: "G-56F3E2Z4WG",
        // };

        // second one start
        const firebaseConfig = {
            apiKey: "AIzaSyAcZI9qSCsonJOTCCItv6VR2O3ppbh0jMI",
            authDomain: "deliverprj.firebaseapp.com",
            projectId: "deliverprj",
            storageBucket: "deliverprj.appspot.com",
            messagingSenderId: "1015605864244",
            appId: "1:1015605864244:web:94b91a905761b3b838e761",
            measurementId: "G-6GVC4Q9FFJ",
        };
        // second one end

        firebase.initializeApp(firebaseConfig);
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
    </script>

    {{ $script }}

</html>