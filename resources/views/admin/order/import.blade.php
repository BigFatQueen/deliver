@extends('Backend_Template') @section('mainContent')
<div class="col-10 mx-auto">
    <h1 class="mt-4">Orders</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
        <li class="breadcrumb-item "><a href="index.html">Order</a></li>
        <li class="breadcrumb-item active">Excel Import</li>
    </ol>
    <div>
         <div class="card mb-4" id="addNewForm">
            <div class="card-header">Import Excel Report </div>
            <div class="card-body">
                <form action="{{ route('admin.order.importExcel') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="col row">
                         <div class="col-auto">
                            <label for="sender" class="col-form-label"> Sender </label>
                                <select id="sender" class="form-select required senderChange" aria-label="Default select example " name="sender">
                                    <option value="0" selected>Please choose Sender Name</option>
                                    @foreach($customers as $k=>$customer)
                                    <option value="{{$customer->id}}">
                                        {{$customer->name}}
                                    </option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="col-auto">
                            <label for="filename" class="col-form-label">Choose  file here</label>
                            <input
                                type="file"
                                name="file"
                                class="form-control"
                                id="filename"

                            />
                        </div>
                        <div class="col-auto d-flex gap-2 align-items-end ">

                            <input
                                type="button"
                                class="btn btn-primary d-inline-flex  float-end "
                                id="read-file"
                                value="Read file"
                                
                            />
                            <input
                                type="submit"
                                id="importData"
                                disabled=disabled
                                class="btn btn-success  d-inline-flex  float-end "
                                value="Import Orders"
                                
                            />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="table-responsive hidden">
        <h6 class="text-danger error-text d-none">Please add the correct address of Sender</h6>
        <table id="order-table" class="table table-striped table-bordered"
               style="width: 100%">
            <thead>
            <tr>
                <td>Code</td>
                <td>Recipient Name</td>
                <td>Recipient phone</td>
                <td>Address</td>
                <td>weight</td>
                <td>price</td>
            </tr>
            </thead>
        </table>
    </div>
</div>
@endsection
@section("script")
<script type="text/javascript">

    let order_table = $("#order-table").DataTable({
                        aoColumns: [
                                      null,
                                      null,
                                      null,
                                    { "sClass": "my-td" },
                                      null,
                                      null
                                    ],
                        pageLength: 20,
                        lengthMenu: [20, 30, 50, 75, 100],
                        order: [],
                        paging: true,
                        searching: true,
                        info: true,
                        data: [],
                        columns: [
                            {data: "code"},
                            {data: "recipient_name"},
                            {data: "recipient_phone"},
                            {data: function(data){
                                if(data.color=='red'){
                                    $('#importData').attr('disabled',true);
                                    $('.error-text').removeClass('d-none');
                                }else{
                                    $('#importData').attr('disabled',false);
                                    $('.error-text').addClass('d-none');
                                }
                                return `<span style="color:${data.color}">${data.address}</span>`
                            }},
                            {data: "weight"},
                            {data: "price"}
                        ]
                    });

    $('#read-file').click(()=>{
        let senderid=$('#sender').val();

        let formdata=new FormData();
        formdata.append('file',$('#filename').prop('files')[0]);
        formdata.append('sender',senderid);
        
         $.ajax({
        type: "POST",
        url: "{{route('admin.order.readExcel')}}",
        data: formdata,
        processData: false, // tell jQuery not to process the data
        contentType: false, // tell jQuery not to set contentType
        success: function (data) {
            order_table.clear().draw();
                order_table.rows.add(data).draw();
        },
        error: function (xhr, ajaxOptions, thrownError) {
        }
    })
    })
</script>
@endsection