@extends('Backend_Template') @section('mainContent')
<div class="container-fluid px-4">
    <h1 class="mt-4">Address Lists</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">
        	<a href="{{route('dashboard.index')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
        	<a href="{{route('admin.customer.index')}}">Users List</a>
        </li>
        <li class="breadcrumb-item active">
        	<a href="{{route('admin.userid.addresses',$user->id)}}">{{$user->name}}</a>
        </li>
        <li class="breadcrumb-item active">Address list</li>
    </ol>
    
   

	<div class="card mb-4">
        <div class="card-body table-responsive">

            <table class="table " id="addressTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Address</th>
                        <th>City</th>
                        <th>Action</th>

                    </tr>
                </thead>

                <tbody></tbody>
            </table>
        </div>
    </div>   
    
    <form class="d-none" action="" id="addressDelete" method="post">
    	@csrf
    	@method('DELETE')
    	<input type="submit" value="submit" />
    </form>
	    
</div>
@endsection @section('script')
<script type="text/javascript">
	const userid="{{$user->id}}";
	$("#addressTable").DataTable({
                    processing: true,
                    serverSide: true,
                    "destroy": true,
                    ajax: {
                        url: `/admin/address/getall/${userid}`,   
                    },
                    columns:[
                    {data:'DT_RowIndex',name:'DT_RowIndex' },
                    {data:'full_address',name:'full_address'},
                    {data:'city.name',name:'cityName'},
                    {data:function(data){
                    	return `
                    	<button class="btn btn-warning btn-edit"
                    	data-id=${data.id} 
                    	>Edit</button>
                    	<button class="btn btn-danger btn-delete" data-id=${data.id} >Delete</button>
                    	`;
                    },name:'action'}
                    
                    ]
                    
             });

	$("#addressTable").on('click','.btn-edit',function(){
		let id=$(this).data('id');

		window.location.href="/admin/address/edit/"+id;
	})

	$("#addressTable").on('click','.btn-delete',function(){
		let id=$(this).data('id');
		let url="{{route('contact.destroy',':id')}}";
		url=url.replace(':id',id);

		$('#addressDelete').attr('action',url);
		$('#addressDelete').submit();

		
	})

</script>
@endsection