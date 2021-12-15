@extends('FrontEnd_Template') @section('Manicontent')
<div class="titlebar">
    <div class="icon"><i class="fas fa-chevron-left"></i></div>
    <div class="title">
        <h4>Address Management</h4>
    </div>
</div>
<div class="d-flex justify-content-center">
    <a href="{{ route('contact.create') }}" class="btn btn-outline-primary mt-3 my_cus_btn">
        <span> <i class="fas fa-plus"></i></span> Add New Recipient Address</a>
</div>
<div class="mt-2">
    <ul class="list-group">
        @foreach($contacts as $contact)
        <li class="list-group-item border-0">
            <div class="ms-2 me-auto">
                <div class="fw-bold">
                    <span style="color: #f44336"> No({{$contact->id}}).</span> {{$contact->full_address}}
                </div>
                {{$contact->city->name !== null ? $contact->city->name:'unknow city'}}
            </div>
            <div class="ms-2 me-auto mt-2">
                <form style="display: inline" method="POST" action="{{ route('contact.destroy',$contact->id) }}">
                    @csrf @method('delete')

                    <button type="submit" class="btn btn-danger">
                        {{ __("Remove") }}
                    </button>
                </form>
                <a href="{{ route('contact.edit',$contact->id) }}" class="btn btn-warning mx-2">Edit</a
                >
            </div>
        </li>
        <hr />
        @endforeach
    </ul>
</div>
@endsection @section('script')
<script>
    $(document).ready(function () {});
</script>
@endsection