<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Tables - SB Admin</title>
        <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

        <link href="{{ asset('template/css/styles.css') }}" rel="stylesheet" />
        <link href="{{ asset('template/css/frontend.css') }}" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
    </head>

    <body class="sb-nav-fixed" style="background-color: #eeeded">
        <nav class="navbar navbar-nav-scroll fixed-bottom navbar-dark bg-light" style="margin-top: -50px">
            <div class="container-fluid mynav">
                <a class="btn btn-default mynav-link" href="{{ route('user.home') }}">
                    <i class="fas fa-home"></i>
                    <span>{{ __('HOME') }}</span>
                </a>
                <a href="{{ route('user.order.list') }}" class="btn btn-default mynav-link">
                    <i class="fas fa-clipboard"></i>
                    <span>{{__('Order')}}</span>
                </a>
                <a href="{{ route('user.info') }}" class="btn btn-default mynav-link">
                    <i class="fas fa-user"></i>
                    <span>{{__('Info')}}</span>
                </a>
            </div>
        </nav>
        <!-- banner start -->

        <div style="max-height: 100vh; margin-bottom: 20vh">
            @yield('Manicontent')
        </div>

        <script src="{{ asset('template/js/jquery.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('template/js/scripts.js') }}"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>

        <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js" crossorigin="anonymous"></script>
        <script src="{{
                asset('template/js/datatables-simple-demo.js')
            }}"></script>
        <script>
            //$('select').selectpicker();

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
        </script>
        @yield('script')
    </body>

</html>