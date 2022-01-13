@extends('Backend_Template') @section('mainContent')
<div class="container-fluid px-4">
    <h1 class="mt-4">Staff Management</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">Staff Lists</li>
    </ol>
    
    <div class="row">
    	<div class="col-12">
    		<div class="text-end">
    			<a href="{{route('staff.create')}}"  class="btn btn-outline-success" >+ Add Role</a>
    		</div>
    		
    		<div class="card-body table-responsive">

    			@php $i=1 @endphp
	            <table class="table" id="staffTable" >
	                <thead>
	                    <tr>
	                    	<th>#</th>
	                        <th>Name</th>
	                        <th>Email</th>
	                        <th>Birthday</th>
	                        <th>Contact Info</th>
	                        <th>Action</th>
	                    </tr>
	                </thead>

	                <tbody>
	                	
	                </tbody>
	            </table>
	        </div>
	    </div>
    	
    </div>

   
    
    

	    
</div>
@endsection @section('script')
<script type="text/javascript">
	$("#staffTable").DataTable({
                    processing: true,
                    serverSide: true,
                    "destroy": true,
                    ajax: {
                        url: "{{ route('staff.index') }}",
                            
                    },
                     "aoColumnDefs": [
                      { "sClass": "my-td", "aTargets": [ 3 ] }
                    ],
                    columns:[
                    {data:'DT_RowIndex',name:'DT_RowIndex' },
                    {data:'name',name:'name' },
                    {data:'email',name:'email' },
                    {data:'dob',name:'dob' },
                    {data:function(data){
                    	return `<p><i class="fas fa-map-marker-alt"></i> ${data.address === null ? 'unknow':data.address}</p>
                    	<p><i class="fas fa-phone-alt"></i> ${data.phone=== null ? 'unknow':data.phone}</p>`
                    } },
                    
                    
                    {data:function(data){
                    	return `<button class="btn btn-info btn-edit text-white" data-id="${data.id}">Edit & Revoke Role</button>
                    	<button class="btn btn-danger btn-delete" data-id="${data.id}">Remove</button>
                    	`
                    }},
                    ]
                    
             });

	$('#staffTable').on('click','.btn-edit',function(){
		let id=$(this).data('id');
		let url="{{route('staff.edit',':id')}}";
		url=url.replace(':id',id);
		window.location.href=url;
	})

	$('#staffTable').on('click','.btn-delete',function(){
		let id=$(this).data('id');
		let url="{{route('staff.destroy',':id')}}";
		url=url.replace(':id',id);
		$.ajax({
			url:url,
			method:'DELETE',
			success:function(res){
				console.log(res);
				$('#staffTable').DataTable().ajax.reload();
			},
			error:function(err){
				console.log(err);
			}
		})
	})
</script>
@endsection