@extends('Backend_Template') @section('mainContent')
<div class="container-fluid px-4">
    <h1 class="mt-4">Role & Permission</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
        <li class="breadcrumb-item active">Role & Permission</li>
    </ol>

    <div class="row">
        <div class="col-12">
            

            <div class="card ">
                <div class="card-header">
                    <h4 class="d-inline">New Saff Member</h4>
                    
                <a href="{{route('staff.index')}}" style="float:right" class="btn btn-outline-secondary">Back</a>
            
                </div>
                <div class="card-body">
                    @if($staff->exists)
                    <form action="{{route('staff.update',$staff->id)}}" method="POST">
                        @method('PUT')
                @else
                    <form action="{{route('staff.store')}}" method="POST">
                    @endif
                        @csrf
                      <div class="row col-10 mx-auto">
                          <div class="col-6">
                            <h4>Account Information</h4>
                              <div class="mb-3">
                                <label for="username" class="form-label">User Name </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="username" value="{{old('name',$staff->name)}}" name="name" aria-describedby="username_helper_text">
                                @error('name')
                                    <div id="username_helper_text"  class="form-text invalid-feedback">{{$message}}</div>
                                @enderror
                              </div>

                              <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" value="{{old('name',$staff->email)}}" name="email" aria-describedby="email_helper_text">
                                @error('email')
                                <div id="email_helper_text"  class="form-text invalid-feedback">{{$message}}</div>
                            @enderror
                              </div>

                              <div class="mb-3">
                                
                                <label for="exampleInputPassword1" class="form-label">
                                @if($staff->exists)
                                Reset Password
                                @else
                                Set Password
                                @endif
                                </label>

                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" aria-describedby="password_helper_text">
                                @error('password')
                                    <div id="password_helper_text"  class="form-text invalid-feedback">{{$message}}</div>
                                @enderror
                              </div>
                          </div>
                          <div class="col-6">
                            <h4>General Information</h4>
                              <div class="mb-3">
                                <label for="dob" class="form-label">Birthday Date </label>
                                <input type="date" name="dob" value="{{old('dob',$staff->dob)}}" class="form-control" id="dob" aria-describedby="dob_helper_text">
                                
                              </div>

                              

                              <div class="mb-3">
                                <label for="phoneNumber" class="form-label">Phone Number </label>
                                <input type="text" value="{{old('phone',$staff->phone)}}" name="phone" class="form-control" id="phoneNumber" aria-describedby="phoneNumber_helper_text">
                               
                              </div>

                              <div class="mb-3">
                                <label for="fulladdress" class="form-label">Full Address </label>
                                <input type="text" value="{{old('fulladdress',$staff->address)}}" name="fulladdress" class="form-control" id="fulladdress" aria-describedby="fulladdress_helper_text">
                                
                              </div>
                              

                             
                          </div>
                      </div>

                      
                      <div class="col-6 mx-auto">
                          <button type="submit" class="btn btn-primary form-control">Submit Now!</button>
                      </div>
                    </form>
                </div>

            </div>
        </div>

    </div>






</div>
@endsection @section('script')

@endsection
