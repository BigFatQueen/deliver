@extends('FrontEnd_Template') @section('Manicontent')
<div class="my-card">
    <div class="my-card-header">
      <div class="titlebar">
    <div class="icon"><a href="{{ url()->previous()}}" style="color:#333;font-size: 1.5rem;"><i class="fas fa-chevron-left"></i></a></div>
    <div class="title">
        <h4>Order Detail ({{$order->code}})</h4>
    </div>
</div>


        
    </div>
    <div class="card-body">
        @php

         $colors = [
          1=> "#ff0000",
          2=>"#2196f3",
          3=> "#5417c1",
          4=> "#03ad0a",
          ];

         @endphp
         <h5>Order Detail</h5>

        <div class="detail-grid">
            <div>{{__('Order Code')}}</div>
            <div>:{{ $order->order_code }}</div>

            <div>{{__('China logistic code')}}</div>
            <div> :{{ $order->code }}</div>

            <div>{{__('Order Date')}}</div>
            <div> :{{ $order->order_date }}</div>

            <div>{{__('Status')}}</div>
            <div >:<span class="status" style="color: {{$colors[$order->status->id]}}">{{ $order->status->name }}</span></div>

            <div>{{__('Update Date')}}</div>
            <div> :{{ $order->updated_at }}</div>


            <div>{{__('Recipient Names')}}</div>
            <div> :{{ $order->recipient_name }}</div>

            <div>{{__('Recipient Phone')}}</div>
            <div> :{{ $order->phone }}</div>

            <div>{{__('Recipient Address')}}</div>
            <div> :{{ $order->contact->full_address }}</div>

            
        </div>
        <div class="d-flex justify-content-around gap-1 mt-2">
            <button class="btn">...</button>
            <form style="" method="POST" action="{{ route('order.delete', $order['id']) }}">
                @csrf @method('delete')

                <button type="submit" class="btn btn-outline-danger">
                    {{ __("Delete Order") }}
                </button>
            </form>
            <button class="btn btn-outline-dark">
                Contact customer service
            </button>
        </div>
    </div>
</div>
@endsection