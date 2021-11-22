@extends('FrontEnd_Template')
@section('Manicontent')
<section class="banner container-fluid"></section>
        <!-- banner end -->
        <div class="container p-4">
            <a
                href="{{ route('user.order.create') }}"
                class="btn btn-primary form-control"
                >Add order</a
            >
            <a class="btn btn-primary form-control mt-2"> Import Order </a>
        </div>
@endsection