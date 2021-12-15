@extends('Backend_Template') @section('mainContent')
<div class="container-fluid px-4">
    <h1 class="mt-4">Role & Permission</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
        <li class="breadcrumb-item active">Role & Permission</li>
        <li class="breadcrumb-item active">Role</li>
    </ol>
    
    <form method="POST" action="{{route('admin.rp.role.store')}}">
    	@csrf
	  <div class="mb-3">
	    <label for="roleName" class="form-label">Role Name</label>
	    <input type="text" name="name" class="form-control" id="roleName" aria-describedby="roleHelp">
	    <div id="roleHelp" class="form-text d-none">We'll never share your email with anyone else.</div>
	  </div>
	 <h5>Permissons</h5>
	 @php
	 $len= count($permissions);
	  @endphp
	 <div class="row px-4">
	 	@foreach($permissions as $permission)

		  <div class="col-6 mb-3 form-check">
		    <input type="checkbox" name="permission[]" class="form-check-input" value="{{$permission->id}}" id="exampleCheck1">
		    <label class="form-check-label" for="exampleCheck1">{{$permission->name}}</label>
		  </div>
		@endforeach
	 </div>

	  <button type="submit" class="btn btn-primary">Add New</button>
	</form>     
    

	    
</div>
@endsection @section('script')

@endsection