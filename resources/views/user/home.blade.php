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

            <a class="btn btn-primary form-control mt-2 import" > Import Order </a>
            <form class="d-none" action="{{route('file-import')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" id="fileImport" >
            </form>
        </div>
@endsection
@section('script')
<script type="text/javascript">
    $('.import').click((e)=>{
        e.preventDefault();
        $('#fileImport').click();
    })

    $('#fileImport').change((e)=>{
        
        $('form').submit();
    })
</script>
@endsection