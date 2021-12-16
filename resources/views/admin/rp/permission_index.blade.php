@extends('Backend_Template') @section('mainContent')
<div class="container-fluid px-4">
    <h1 class="mt-4">Role & Permission</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">
        	<a href="{{route('dashboard.index')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Role & Permission</li>
        <li class="breadcrumb-item active">Permission</li>
    </ol>
    
   <div class="card mb-2" id="NewPermission">
	   	<div class="card-header">
	   		<h5>New Permission </h5>
	   	</div>
	   	<div class="card-body">
	   		 <form method="POST" action="{{route('admin.rp.p.store')}}">
	    	@csrf
		  <div class="mb-3">
		    <label for="roleName" class="form-label">Permission Name</label>
		    <input type="text" name="name" class="form-control" id="roleName" aria-describedby="roleHelp">
		    <div id="roleHelp" class="form-text d-none">We'll never share your email with anyone else.</div>
		  </div>
		 

		  <button type="submit" class="btn btn-primary">Add New</button>
		</form> 
	   	</div>
   </div> 


   <div class="card mb-2 d-none" id="EditPermission">
	   	<div class="card-header">
	   		<h5>Update Permission </h5>
	   	</div>
	   	<div class="card-body">
	   		 <form method="POST">
	    	@csrf
	    	@method('PUT')
		  <div class="mb-3">
		    <label for="roleName" class="form-label">Permission Name</label>
		    <input type="text" name="ename" class="form-control" id="roleName" aria-describedby="roleHelp">
		    <div id="roleHelp" class="form-text d-none">We'll never share your email with anyone else.</div>
		  </div>
		 

		  <button type="submit" class="btn btn-primary">Update</button>
		</form> 
	   	</div>
   </div>

	<div class="card mb-4">
        <div class="card-body table-responsive">

            <table class="table " id="permissionTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Permission</th>
                        <th>Action</th>

                    </tr>
                </thead>

                <tbody></tbody>
            </table>
        </div>
    </div>   
    

	    
</div>
@endsection @section('script')
<script type="text/javascript">
	$("#permissionTable").DataTable({
                    processing: true,
                    serverSide: true,
                    "destroy": true,
                    ajax: {
                        url: "{{ route('admin.rp.p.index') }}",   
                    },
                    columns:[
                    {data:'DT_RowIndex',name:'DT_RowIndex' },
                    {data:'name',name:'name'},
                    {data:function(data){
                    	return `
                    	<button class="btn btn-warning btn-edit"
                    	data-id=${data.id} 
                    	data-name=${data.name}
                    	>Edit</button>
                    	<button class="btn btn-danger btn-delete" data-id=${data.id} 
                    	data-name=${data.name}>Delete</button>
                    	`;
                    },name:'action'}
                    
                    ]
                    
             });

	$('#permissionTable').on('click','.btn-edit',function(){
		$('#NewPermission').addClass('d-none');
		$('#EditPermission').removeClass('d-none');

		let name=$(this).data('name');
		let id=$(this).data('id');
		$('input[name="ename"]').val(name);
		url="{{route('admin.rp.p.update',':id')}}"
		url=url.replace(":id",id);
		// console.log(url);
		$('#EditPermission form').attr('action',url);
	})

	$('#permissionTable').on('click','.btn-delete',function(){
		

		let name=$(this).data('name');
		let id=$(this).data('id');
		$.ajax({
			url:"/admin/rp/p/delete/"+id,
			method:"DELETE",
			success:function(res){
				if(res.status ==200){
					$('#permissionTable').DataTable().ajax.reload();
				}
			},
			error:function(err){
				console.log(err);
			}
		})
	})

</script>
@endsection