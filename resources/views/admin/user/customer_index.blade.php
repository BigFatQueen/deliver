@extends('Backend_Template') @section('mainContent')
<div class="container-fluid px-4">
    <h1 class="mt-4">User List</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">
        	<a href="{{route('dashboard.index')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">User list</li>
        
    </ol>
    
	<div class="card mb-4">
        <div class="card-body table-responsive">

            <table class="table " id="customerTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
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
	$("#customerTable").DataTable({
                    processing: true,
                    serverSide: true,
                    "destroy": true,
                    ajax: {
                        url: "{{ route('admin.customer.index') }}",   
                    },
                    columns:[
                    {data:'DT_RowIndex',name:'DT_RowIndex' },
                    {data:'name',name:'name'},
                    {data:'email',name:'email'},
                    {data:'phone',name:'phone'},
                    {data:function(data){
                    	return `
                    	<button class="btn btn-info btn-list"
                    	data-id=${data.id} 
                    	data-name=${data.name}
                    	>Address Lists</button>
                    	
                    	<button class="btn btn-danger btn-delete" data-id=${data.id} 
                    	data-name=${data.name}>Delete</button>
                    	`;
                    },name:'action'}
                    
                    ]
                    
             });

	$('#customerTable').on('click','.btn-list',function(){
		let id=$(this).data('id');
		window.location.href=`/admin/address/getall/${id}`;
	})
	

</script>
@endsection