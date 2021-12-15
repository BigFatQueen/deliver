@extends('FrontEnd_Template') @section('Manicontent')
<div class="titlebar">
    <div class="icon"><i class="fas fa-chevron-left"></i></div>
    <div class="title">
        <h4>Add New Address</h4>
    </div>
</div>

@if($contact->exists)
<form class="px-2 mt-5" action="{{route('contact.update',$contact->id)}}" method="post">
    @method('put') @else

    <form class="px-2 mt-5" action="{{ route('contact.store') }}" method="post">
        @endif @csrf
        <h6 style="color: #0b1820" class="text-center my-4 text-primary">
            Creating new Recipient Address of
            <span style="text-transform: uppercase; color: #3498db">{{$user->name}}</span
            >
        </h6>

        <input type="hidden" name="uid" value="{{$user->id}}" />

        <div class="mb-4 row">
            <label for="contact" class="col-3 col-form-label"> City </label>
            <div class="col-9 cus-input-fromControl">
                <select
                    id="contact"
                    class="form-select"
                    aria-label="Default select example"
                    name="city_id"
                >
                    <option value="0">Choose One</option>
                    @foreach($cities as $city)
                    <option value="{{$city->id}}" @if($contact->
                        city_id == $city->id) selected @endif >{{$city->name}}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-4 row">
            <label for="fulladdress" class="col-3 col-form-label">
                Address details @error('fulladdress')
                <span class="text-danger">required</span> @enderror
            </label>
            <div class="col-9 form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="fulladdress" name="fulladdress" style="height: 200px">
                    {{old('fulladdress',$contact->full_address)}}
                    </textarea
                >
                <label for="floatingTextarea2"
                    >No,floor,building,township...</label
                >
            </div>
        </div>
        @if($contact->exists)
        <input
            type="submit"
            value="Update Now!"
            class="btn btn-primary form-control"
        />
        @else
        <input
            type="submit"
            value="Add Now!"
            class="btn btn-primary form-control"
        />
        @endif
    </form>
    @endsection
</form>