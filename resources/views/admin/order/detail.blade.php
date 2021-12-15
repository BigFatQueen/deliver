@extends('Backend_Template') @section('mainContent')
<div class="container-fluid px-4">
    <h1 class="mt-4">Orders</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('admin.order.list')}}">Orders</a></li>

        <li class="breadcrumb-item active">Detail</li>
    </ol>

    <div class="col-8 mx-auto">
        <div class="card p-3">

            <h5>Order Detail</h5>

            <div class="mt-2">
                <div class="d-flex justify-content-between mx-2">
                    <div>
                        <span class="detail-info">Order ID</span>
                        <h6>{{$order->order_code}}</h6>
                    </div>

                    <div>
                    @php 
                    $colors = [
                    1=> "#ff0000",
                    2=>"#2196f3",
                    3=> "#5417c1",
                    4=> "#03ad0a",
                    ];

                    @endphp
                        
                        <h5><span class="badge" style="color:{{$colors[$order->status_id]}};border:1px solid {{$colors[$order->status_id]}}">{{$order->status->name}}</span></h5>

                    </div>



                </div>

                <div class="mx-4">
                    <div class="pt-2">
                        <span class="detail-info">Sender</span>
                        <h6>{{$order->user->name}}({{$order->user->phone}})</h6>
                    </div>
                    <div class="pt-2">
                        <span class="detail-info">Recipient</span>
                        <h6>{{$order->recipient_name}}({{$order->phone}})</h6>
                    </div>
                    <div class="pt-2">
                        <span class="detail-info">Address</span>
                        <h6>{{$order->contact->full_address}}({{$order->contact->city->name}})</h6>
                    </div>
                    <div class="pt-2">
                        <span class="detail-info">total Parcels</span>
                        <h6>
                            {{$others}}
                        </h6>

                    </div>
                    <div class="pt-2">
                        <span class="detail-info">total Weight</span>
                        <h6>
                            {{$order->weight}} Kg
                        </h6>
                    </div>

                    <div class="pt-2">
                        <span class="detail-info">total Names</span>
                        <h6>
                            {{$order->goods}}
                        </h6>
                    </div>

                    <div class="pt-2">
                        <span class="detail-info">total Price</span>
                        <h6>
                            {{$order->price}} Kyats
                        </h6>
                    </div>



                </div>


            </div>

            <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>

        </div>

    </div>

</div>



@endsection