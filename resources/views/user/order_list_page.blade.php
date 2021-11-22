@extends('FrontEnd_Template') @section('Manicontent')
<ul class="nav nav-pills mb-3 my-cus-tab" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <button
            class="nav-link active"
            id="pills-home-tab"
            data-bs-toggle="pill"
            data-bs-target="#pills-home"
            type="button"
            role="tab"
            aria-controls="pills-home"
            aria-selected="true"
        >
            Pending to WareHouse
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button
            class="nav-link"
            id="pills-profile-tab"
            data-bs-toggle="pill"
            data-bs-target="#pills-profile"
            type="button"
            role="tab"
            aria-controls="pills-profile"
            aria-selected="false"
        >
            WareHouse
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button
            class="nav-link"
            id="pills-contact-tab"
            data-bs-toggle="pill"
            data-bs-target="#pills-contact"
            type="button"
            role="tab"
            aria-controls="pills-contact"
            aria-selected="false"
        >
            In Transist
        </button>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div
        class="tab-pane fade show active m-2"
        id="pills-home"
        role="tabpanel"
        aria-labelledby="pills-home-tab"
    >
        {{-- card start here  --}}
        @foreach($newOrders as $code=>$order)
        <div class="my-card">
            <div class="my-card-header">
                <span class="title">
                    <i class="fas fa-home"></i>
                    Express
                    <i class="fas fa-chevron-right"></i>
                </span>
                <span class="status">{{ $order["status"] }}</span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4">Order Code</div>
                    <div class="col-8">
                        :
                        <p style="overflow-wrap: break-word">
                            {{ $code }}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">China logistic</div>
                    <div class="col-8">
                        :
                        <p style="overflow-wrap: break-word">
                            {{ $order["codes"] }}
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">Recipient Names</div>
                    <div class="col-8">: {{ $order["recipient_name"] }}</div>
                </div>
                <div class="row">
                    <div class="col-4">Recipient Phone</div>
                    <div class="col-8">: {{ $order["phone"] }}</div>
                </div>
                <div class="row">
                    <div class="col-4">Recipient Address</div>
                    <div class="col-8 text-success">
                        : {{ $order["contact"] }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">Total Package</div>
                    <div class="col-8">: {{ $order["qty"] }}</div>
                </div>
                <div class="row">
                    <div class="col-4">Total Cost</div>
                    <div class="col-8">: {{ $order["price"] }}</div>
                </div>
                <div class="d-flex justify-content-around gap-1">
                    <button class="btn">...</button>
                    <form
                        style=""
                        method="POST"
                        action="{{ route('order.delete', $order['id']) }}"
                    >
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
        @endforeach
        {{-- card end here  --}}
    </div>
    <div
        class="tab-pane fade"
        id="pills-profile"
        role="tabpanel"
        aria-labelledby="pills-profile-tab"
    >
        I am profle
    </div>
    <div
        class="tab-pane fade"
        id="pills-contact"
        role="tabpanel"
        aria-labelledby="pills-contact-tab"
    >
        I am contact
    </div>
</div>
@endsection
