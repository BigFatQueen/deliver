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
         <link rel="stylesheet" href="{{asset('template/build/css/intlTelInput.css')}}" />
        <link href="{{ asset('template/css/myauth.css') }}" rel="stylesheet" />
        <style>
            body {
                font-family: "lato", sans-serif !important;
            }
            .iti{
                display: block;
            }
        </style>
    </head>

    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="{{asset('template/build/js/intlTelInput.js')}}"></script>
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
         var input = document.querySelector("#phone"),
          errorMsg = document.querySelector("#error-msg"),
    validMsg = document.querySelector("#valid-msg");
         var reset = function() {
                        input.classList.remove("error");
                        errorMsg.innerHTML = "";
                        errorMsg.classList.add("hide");
                       // validMsg.classList.add("hide");
                    };

        // Error messages based on the code returned from getValidationError
var errorMap = [ "Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

        var init=  intlTelInput(input, {
    initialCountry: "auto",
     customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
    return "e.g. " + selectedCountryPlaceholder;
  },
    geoIpLookup: function(success, failure) {
        $.get("https://ipinfo.io/45.125.4.252?token=ce4662e4e6410f", function() {}, "jsonp").always(function(resp) {
            var countryCode = (resp && resp.country) ? resp.country : "";
            success(countryCode);
        });
    },
    utilsScript: "{{asset('template/build/js/utils.js')}}"
});
        input.addEventListener('blur', function() {
            reset();
            if(input.value.trim()){
                if(init.isValidNumber()){
                    //validMsg.classList.remove("hide");
                    console.log(init.getNumber())
                }else{
                    input.classList.add("error");
                    var errorCode = init.getValidationError();
                    errorMsg.innerHTML = errorMap[errorCode];
                    errorMsg.classList.remove("hide");
                }
            }
        })

        input.addEventListener('change', reset);
        input.addEventListener('keyup', reset);
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