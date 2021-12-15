@extends('Backend_Template') @section('mainContent')
<div class="container-fluid px-4">
    <h1 class="mt-4">Orders</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
        <li class="breadcrumb-item active">Order</li>
    </ol>
    <div class="
            date-filter
            d-flex
            flex-md-row flex-sm-row flex-xs-column flex-column
            justify-content-center
            gap-md-5 gap-sm-2 gap-2
            my-4
            align-items-md-center
            input-daterange
        ">
        <div>
        <span class="text-danger error-start d-none">Please Enter Start Date!</span>

            <div class="row g-3 align-items-center">
                

                <div class="col-auto">
                    <label for="Start_date" class="col-form-label">Start Order Date:</label>
                </div>
                <div class="col-auto">
                    <input type="date" id="Start_date" class="form-control required" aria-describedby="dateilterInline" />

                </div>
            </div>

        </div>
        
        <div>
            <span class="text-danger error-end d-none">Please Enter End Date!</span>
            <div class="row g-3 align-items-center">


                <div class="col-auto">
                    <label for="End_date" class="col-form-label">End Order Date:</label>
                </div>
                <div class="col-auto">
                    <input type="date" id="End_date" class="form-control required" aria-describedby="dateilterInline" />
                </div>
            </div>

        </div>

        <div>
            <button class="btn btn-primary btn-filter">Filter</button>
        </div>
        
    </div>

    <div class="card mb-4">
        <div class="card-body table-responsive">

            <table class="table " id="ordertable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order Code</th>
                        <th>Recipient Name</th>
                        <th>Address</th>
                        <th>Total Parcel</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                </thead>

                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
@endsection @section('script')
<script>
    var minDate, maxDate;

    
    

    $(document).ready(function () {
        
        var colors = {
        1: "#ff0000",
        2: "#2196f3",
        3: "#5417c1",
        4: "#03ad0a",
        };
        fetchData();
        function fetchData(start='',end=''){
            $("#ordertable").DataTable({
                    processing: true,
                    serverSide: true,
                    "destroy": true,
                    ajax: {
                        url: "{{ route('admin.order.list') }}",
                        data: {start_date:start,end_date:end}
                    
                    },
                     "aoColumnDefs": [
                      { "sClass": "my-td", "aTargets": [ 3 ] }
                    ],
                    columns:[
                    {data:'DT_RowIndex',name:'DT_RowIndex' },
                    {data:'OrderCode',name:'OrderCode' },
                    {data:'recipiant',name:'recipiant' },
                    {data:'address',name:'address' },
                    {data:'qty',name:'qty' },
                    {data:'statusAction',name:'statusAction' },
                    {data:'action',name:'action' },
                    ]
                    
             });
        }

        $('.btn-filter').click(function(){
           start=$('#Start_date').val();
           end=$('#End_date').val();
            if(start== ''||end==''){
                 $(`.error-start`).removeClass('d-none');

              
                 $(`.error-end`).removeClass('d-none');

                }else{
                     $(`.error-start`).addClass('d-none');

              
                 $(`.error-end`).addClass('d-none');
                 $('#ordertable').DataTable().destroy();

              fetchData(start,end);
                }
           // console.log($start,$end);
           
        })
        


        //button delete
        $('#ordertable').on('click','.btn-delete',function(){
            let id=$(this).data('id');
            let url="{{route('admin.order.destroy',':id')}}";

            url=url.replace(':id',id);

            $.ajax({
                url:url,
                type:'DELETE',
                success:function(res){
                    $("#ordertable").DataTable().ajax.reload();

                },
                error:function(err){
                    console.log(err);
                }

            })


        })

        //detail data
        $('#ordertable').on('click','.btn-detail',function(){
            let id=$(this).data('id');
            window.location.href="/admin/orders/detail/"+id;
        })

        //status change start

        $('#ordertable').on('click','.statusHandle',function(e){

            e.preventDefault();
            let statusid=$(this).data('statusid');

            let ordercode=$(this).data('ordercode');

            let formData={'sid':statusid,'orderCode':ordercode};

            $.ajax({
                url:"{{route('order.status.change')}}",
                type:'POST',
                data:formData,
                success:function(res){
                    $("#ordertable").DataTable().ajax.reload();

                },
                err:function(err){
                    console.log(err)
                }

            })
        })


        //edit
        $('#ordertable').on('click','.btn-edit',function(e){
             let id=$(this).data('id');
           window.location.href="/admin/orders/edit/"+id;
        })


       


       



    });
</script>
@endsection