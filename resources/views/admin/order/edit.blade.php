@extends('Backend_Template') @section('mainContent')
<div class="container-fluid px-4">
    <h1 class="mt-4">Orders</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard.index')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item "><a href="{{route('admin.order.list')}}">Order</a></li>
        <li class="breadcrumb-item "><a href="{{route('admin.order.detail',$order->id)}}">{{$order->order_code}}</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
    <form class="px-2 mt-5" method="post" action="{{route('admin.order.update',$order->id)}}" autocomplete="off">
        @csrf
        @method('PUT')

        <div class="mb-3 row">
            <label for="staticEmail" class="col-3 col-form-label">
                Warehouse
            </label>
            <div class="col-9 cus-input-fromControl">
                <input type="text" readonly class="form-control-plaintext " id="staticEmail" value="expresskoko" />
            </div>
        </div>

        <div class="mb-4 row">
            <label for="sender" class="col-3 col-form-label"> Sender </label>
            <div class="col-9 addressForm">
                <select id="sender" class="form-select required senderChange" onload="return getAddress($order->user_id);" aria-label="Default select example " name="sender">
                    <option value="0" selected>Please choose Sender Name</option>
                    @foreach($customers as $k=>$customer)
                    <option value="{{$customer->id}}"
                    	@if($customer->id == $order->user_id)
                    	selected
                    	@endif
                    	>
                        {{$customer->name}}
                    </option>
                    @endforeach
                </select>

            </div>
        </div>


        <hr />
        <div class="mb-3 row">
            <label for="codes" class="col-3 col-form-label">
                China logistic number
            </label>
            <div class="col-9 cus-input-fromControl">
                <input type="text" style="background-color:rgb(229, 227, 221); padding-left:20px"  class="form-control-plaintext required countQty"
                value="{{$others}}"  
                readonly 
                 id="codes" name="codes" placeholder="Please enter china logistic number" />
            </div>
        </div>
        <hr />

        <div class="mb-4 row">
            <label for="contact" class="col-3 col-form-label"> Address </label>

            <div class="col-9 addressForm" id="addressAjax">
                <input type="text" class="form-control-plaintext info " readonly placeholder="Please select Sender first to choose address" />
            </div>
        </div>

        <hr />
        <div class="mb-3 row">
            <label for="name" class="col-3 col-form-label"> Recipient Name </label>
            <div class="col-9 cus-input-fromControl">
                <input type="text" class="form-control-plaintext required" value="{{$order->recipient_name}}" id="name" name="name" placeholder="plases enter Recipient Name" />
            </div>
        </div>
        <hr />

        <div class="mb-3 row">
            <label for="phone" class="col-3 col-form-label">
                Recipient phone number
            </label>
            <div class="col-9 cus-input-fromControl">
                <input type="text" class="form-control-plaintext required" 
                value="{{$order->phone}}" 
                id="phone" name="phone" placeholder="please enter Recipient phone number (+95....)" />
            </div>
        </div>
        <hr />

        <div class="mb-3 row">
            <label for="Goodsqty" class="col-3 col-form-label">
                Numbers of Box
            </label>
            <div class="col-9 cus-input-fromControl">
                <input type="number" style="background-color:rgb(229, 227, 221);" class="form-control-plaintext required" readonly id="Goodsqty" value="{{$order->qty}}"  name="qty" placeholder="please enter good number" />
            </div>
        </div>
        <hr />
        <div class="mb-3 row">
            <label for="wieight" class="col-3 col-form-label"> Total Weight </label>
            <div class="col-9 cus-input-fromControl">
                <input type="number" class="form-control-plaintext required" id="weight" name="weight" placeholder="please enter good total wieight" value="{{$order->weight}}"  />
                <h6>Kg</h6>
            </div>
        </div>
        <hr />
        <div class="mb-3 row">
            <label for="goodNames" class="col-3 col-form-label"> Goods Name </label>
            <div class="col-9 cus-input-fromControl">
                <input type="text" class="form-control-plaintext" id="goodNames" name="goodsNames" placeholder="please enter good names" value="{{$order->goods}}"  />
            </div>
        </div>
        <hr />
        <div class="mb-3 row">
            <label for="price" class="col-3 col-form-label">
                Prices of Goods
            </label>
            <div class="col-9 cus-input-fromControl">
                <input type="text" class="form-control-plaintext  required" id="price" name="price" placeholder="please enter total price of Goods" value="{{$order->price}}" />
            </div>
        </div>
        <input type="submit" value="Order Now" class="btn btn-primary form-control" />
    </form>
</div>
@endsection
@section('script')
<script type="text/javascript">
	var id="{{$order->user_id}}";
	var address="{{$order->address_id}}"
	getAddress(id,address);
	function getAddress(id,address_id='') {

        let order = localStorage.getItem('adminOrder');
        let orderObj={contact_id:''};
        
            if(order){
                 orderObj = JSON.parse(order);

            }else{
                orderObj.contact_id=address_id;
            }
        
       
        let currentRequest = null;

        let createAddressRoute = "{{route('admin.address.createbyui',':id')}}";
        createAddressRoute = createAddressRoute.replace(':id', id);

        let url = "{{route('admin.order.getAddress',':id')}}";
        url = url.replace(":id", id);
        let html = '';
        currentRequest = jQuery.ajax({
            type: "get",
            data: {
                uid: id,
            },
            url: url,
            beforeSend: function() {
                //  $(".Loading").css("visibility", "visible");
                if (currentRequest != null) {
                    currentRequest.abort();
                }
            },
            success: function(data) {
                if (data.status == 200) {
                    html += `<select id="contact" class="form-select required" aria-label="Default select example " name="contact_id">
                    <option value="0" ${orderObj.contact_id == ''? "selected":'' }>Please choose one</option>`;
                    $.each(data.data, function(i, v) {
                        html += `
                                
                                <option value="${v.id}" `
                        if (v.id == orderObj.contact_id) {
                            html += 'selected'
                        }
                        html += `>
                                    No(${v.id}).
                                    ${v.full_address} ${v.city.name}
                                </option>
                                `

                    })
                    html += ` </select>
                            <a href="${createAddressRoute}" class="btn btn-light">+</a>`;

                } else {
                    html += `<div class="col-9 cus-input-fromControl">
                <input type="text" class="form-control-plaintext " id="codes" name="sadd" readonly placeholder="There is no address for Sender to choose" />
            </div>`
                }

                $('#addressAjax').html(html);

            },
            error: function(e) {
                console.log(e);
            },
        });
    }

    $('.senderChange').change(function(e) {
        let id = e.target.value;
        console.log(id);


        getAddress(id);



    })
</script>
@endsection