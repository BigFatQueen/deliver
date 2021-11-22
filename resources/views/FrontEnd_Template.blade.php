<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Tables - SB Admin</title>
        <link
            href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css"
            rel="stylesheet"
        />
        
        <link href="{{ asset('template/css/styles.css') }}" rel="stylesheet" />
        <link
            href="{{ asset('template/css/frontend.css') }}"
            rel="stylesheet"
        />
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
            crossorigin="anonymous"
        ></script>
    </head>
    <body class="sb-nav-fixed" >
        <nav class="navbar navbar-nav-scroll fixed-bottom navbar-light" style="margin-top: -50px;">
            <div class="container-fluid mynav">
                <a class="btn btn-default mynav-link">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
                <a href={{route('user.order.list')}} class="btn btn-default mynav-link">
                    <i class="fas fa-clipboard"></i>
                    <span>Order</span>
                </a>
                <a href="{{route('user.info')}}" class="btn btn-default mynav-link">
                    <i class="fas fa-user"></i>
                    <span>info</span>
                </a>
            </div>
        </nav>
        <!-- banner start -->

        <div style="max-height:100vh;margin-bottom:20vh;">@yield('Manicontent')</div>
        

        <script src="{{ asset('template/js/jquery.min.js') }}"></script>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"
        ></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('template/js/scripts.js') }}"></script>
        <script
            src="https://cdn.jsdelivr.net/npm/simple-datatables@latest"
            crossorigin="anonymous"
        ></script>
        <script src="{{
                asset('template/js/datatables-simple-demo.js')
            }}"></script>
            <script>
            //$('select').selectpicker();

            $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});</script>
            @yield('script')
    </body>
</html>
