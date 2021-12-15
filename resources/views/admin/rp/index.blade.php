@extends('Backend_Template') @section('mainContent')
<div class="container-fluid px-4">
    <h1 class="mt-4">Role & Permission</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
        <li class="breadcrumb-item active">Role & Permission</li>
    </ol>
    
    <div class="row">
    	<div class="col-12">
    		<div class="text-end">
    			<a href="{{route('admin.rp.role.create')}}"  class="btn btn-outline-success" >+ Add Role</a>
    		</div>
    		
    		<div class="card-body table-responsive">

    			@php $i=1 @endphp
	            <table class="table " >
	                <thead>
	                    <tr>
	                    	<th>#</th>
	                        <th>Name</th>
	                        <th>Action</th>
	                    </tr>
	                </thead>

	                <tbody id="roleTable">
	                	@foreach($roles as $r)
	                	<tr>
	                		<td>{{$i++}}</td>
	                		<td><i class="fas fa-user "></i> {{$r->name}}</td>
	                		<td>
	                			
	                			<button class="btn btn-info btn-edit" data-id="{{$r->id}}"
	                				data-type="{{$r->name}}"
	                				>Info</button>
	                				<a href="{{route('admin.rp.role.edit',$r->id)}}" class="btn btn-warning btn-edit" >Edit</a>
	                				<button href="{{route('admin.rp.role.delete',$r->id)}}"
	                				data-id="{{$r->id}}" class="btn btn-danger btn-delete" >Delete</button>
	                		</td>
	                	</tr>
	                	@endforeach
	                </tbody>
	            </table>
	        </div>
	    </div>
    	
    </div>

    <div id="show-Role-detail d-none">
    	<div class="card col-8 mx-auto">
    	<div class="card-header">Role Detail

    	</div>
	    	<div class="card-body">
	    		<h6>Role Type: <span class="text-success roleName"><i class="fas fa-user"></i></span></h6>
	    		<h6>Allowed Permission are:</h6>
	    		<ul id="rolePermission" style="display: grid;grid-template-columns: auto auto;">
	    			
	    		</ul>
	    	</div>
	    </div>
    </div>
    
    

	    
</div>
@endsection @section('script')
<script type="text/javascript">
	$('#roleTable').on('click','.btn-info', function(){
		let id=$(this).data('id');
		let name=$(this).data('type');
		$('#show-Role-detail').removeClass('d-none');

		let url="{{route('admin.rp.role.show',':id')}}";
		url=url.replace(':id',id);
		let html='';
		$('.roleName').html(name);
		$.ajax({
			url:url,
			type:'get',
			success:(res)=>{
				if(res.length >0){
					$.each(res,function(i,v){
						html+=`<li style="
    display: block;"> <i class="fas fa-check-circle text-success"></i> ${v.name}</li>`

					})
					$('#rolePermission').html(html);
				}
			},
			error:(err)=>{
				console.log(err);
			}
		})	


	})

	$('#roleTable').on('click','.btn-delete',function(){
		

		
		let id=$(this).data('id');
		console.log(id);
		$.ajax({
			url:"/admin/rp/r/destroy/"+id,
			method:"DELETE",
			success:function(res){
				if(res.status ==200){
					$('#roleTable').DataTable().ajax.reload();
				}
			},
			error:function(err){
				console.log(err);
			}
		})
	})
</script>
@endsection