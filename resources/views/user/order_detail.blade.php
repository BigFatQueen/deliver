@extends('FrontEnd_Template') @section('Manicontent')
<div class="my-card">
    <div class="my-card-header">
        <span class="title">
            <i class="fas fa-home"></i>
            Express
            <i class="fas fa-chevron-right"></i>
        </span>
        <span class="status">{{ $order->status->name }}</span>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-4">Order Code</div>
            <div class="col-8">
                :
                <p style="overflow-wrap: break-word">
                    {{ $order->code }}
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">China logistic</div>
            <div class="col-8">
                :
                <p style="overflow-wrap: break-word">
                    {{ $order->code }}
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-4">Recipient Names</div>
            <div class="col-8">: {{ $order->recipient_name }}</div>
        </div>
        <div class="row">
            <div class="col-4">Recipient Phone</div>
            <div class="col-8">: {{ $order->phone }}</div>
        </div>
        <div class="row">
            <div class="col-4">Recipient Address</div>
            <div class="col-8 text-success">
                : {{ $order->contact->full_address}}
            </div>
        </div>
        <div class="row">
            <div class="col-4">Total Package</div>
            <div class="col-8">: {{ $order->qty }}</div>
        </div>
        <div class="row">
            <div class="col-4">Total Cost</div>
            <div class="col-8">: {{ $order->price }}</div>
        </div>
        <div class="d-flex justify-content-around gap-1">
            <button class="btn">...</button>
            <form style="" method="POST" action="{{ route('order.delete', $order['id']) }}">
                @csrf @method('delete')

                <button type="submit" class="btn btn-outline-danger">
                    {{ __("Delete Order") }}
                </button>
            </form>

            <button class="btn btn-outline-success">
                Continue Place to Order
            </button>
            <button class="btn btn-outline-dark">
                Contact customer service
            </button>
        </div>
    </div>
</div>
@endsection