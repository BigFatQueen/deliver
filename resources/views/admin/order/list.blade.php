@extends('Backend_Template')
@section('mainContent')
<div class="container-fluid px-4">
    <h1 class="mt-4">Orders</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
        <li class="breadcrumb-item active">Order</li>
    </ol>
    <div class="date-filter d-flex flex-md-row flex-sm-row flex-xs-column flex-column justify-content-center gap-md-5 gap-sm-2 gap-2 my-4 align-items-md-center">

    	<div class="row g-3 align-items-center">
		  <div class="col-auto">
		    <label for="Start_date" class="col-form-label">Start Order Date:</label>
		  </div>
		  <div class="col-auto">
		    <input type="date" id="Start_date"  class="form-control" aria-describedby="dateilterInline">
		  </div>
		  
		</div>
		<div class="row g-3 align-items-center">
		  <div class="col-auto">
		    <label for="End_date" class="col-form-label">End Order Date:</label>
		  </div>
		  <div class="col-auto">
		    <input type="date" id="End_date" class="form-control" aria-describedby="dateilterInline">
		  </div>
		  
		</div>
    </div>

    <div class="card mb-4">
                            
        <div class="card-body table-responsive">
            <table class="table" id="ordertable">
                <thead>
                    <tr>
                        
                        <th>id</th>
                        <th>Order Code</th>
                        
                        <th>
                        	Action
                        </th>
                    </tr>
                </thead>
               
               <tbody>
               	</tbody>
            </table>
        </div>
    </div>
 </div>
@endsection
@section('script')
<script>

var minDate, maxDate;

    function getTable(){
        var table = $('#ordertable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.order.list') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'code', name: 'code'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    }
	
	$(document).ready(function(){

        //getOrdertable

        getTable();

		

	})

	


</script>
@endsection

