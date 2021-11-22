@extends('FrontEnd_Template') @section('Manicontent')
<div class="titlebar">
    <div class="icon"><i class="fas fa-chevron-left"></i></div>
    <div class="title">
        <h4>New Order</h4>
    </div>
</div>
<form class="px-2 mt-5" id="handleSubmit" >
@csrf
    
    <div class="mb-3 row">
        <label for="staticEmail" class="col-3 col-form-label">
            Warehouse
        </label>
        <div class="col-9 cus-input-fromControl">
            <input
                type="text"
                readonly
                class="form-control-plaintext required"
                id="staticEmail"
                value="expresskoko"
            />
        </div>
    </div>
    <hr />
    <div class="mb-3 row">
        <label for="codes" class="col-3 col-form-label">
            China logistic number
        </label>
        <div class="col-9 cus-input-fromControl">
            <input
                type="text"
                class="form-control-plaintext required"
                id="codes"
                name="codes"
                placeholder="Please enter china logistic number"
                
            />
        </div>
    </div>
    <hr />

    <div class="mb-4 row">
        <label for="contact" class="col-3 col-form-label">
            Foreign Reviewing number
        </label>
        <div class="col-9 addressForm">
            <select
                id="contact"
                class="form-select required"
                aria-label="Default select example "
                name="contact_id"
            >
               <option value="0" selected>Please choose one</option>
                @foreach($contacts as $k=>$contact)
                <option value="{{$contact->id}}"
                >{{$contact->full_address}},{{$contact->city->name}}</option>
                @endforeach
               
            </select>
            <a href="{{ route('contact.create') }}" class="btn btn-light">+</a>
        </div>
    </div>

    <hr />
    <div class="mb-3 row">
        <label for="name" class="col-3 col-form-label"> Recipient Name </label>
        <div class="col-9 cus-input-fromControl">
            <input
                type="text"
                class="form-control-plaintext required"
                id="name"
                name="name"
                placeholder="plases enter Recipient Name"
                
            />
        </div>
    </div>
    <hr />

    <div class="mb-3 row">
        <label for="phone" class="col-3 col-form-label">
            Recipient phone number
        </label>
        <div class="col-9 cus-input-fromControl">
            <input
                type="number"
                class="form-control-plaintext required"
                id="phone"
                name="phone"
                
                placeholder="please enter Recipient phone number"
            />
        </div>
    </div>
    <hr />
    <div class="mb-3 row">
        <label for="goodNames" class="col-3 col-form-label"> Goods Name </label>
        <div class="col-9 cus-input-fromControl">
            <input
                type="text"
                class="form-control-plaintext"
                id="goodNames"
                
                name="goodsNames"
                placeholder="please enter good names"
            />
        </div>
    </div>
    <hr />
    <div class="mb-3 row">
        <label for="Goodsqty" class="col-3 col-form-label">
            Numbers of Box
        </label>
        <div class="col-9 cus-input-fromControl">
            <input
                type="number"
                class="form-control-plaintext required"
                id="Goodsqty"
                
                name="qty"
                placeholder="please enter good number"
            />
        </div>
    </div>
    <hr />
    <div class="mb-3 row">
        <label for="price" class="col-3 col-form-label">
            Prices of Goods
        </label>
        <div class="col-9 cus-input-fromControl">
            <input
                type="text"
                class="form-control-plaintext required"
                id="price"
                
                name="price"
                placeholder="please enter total price of Goods"
            />
        </div>
    </div>
    <input
        type="submit"
        value="Order Now"
        class="btn btn-primary form-control "
    />
</form>
@endsection @section('script')
<script>
    const errors = {
        codes: "Please enter china logistic number",
         contact_id: "Please select Foreign Reviewing number",
        name: "Please enter Recipient Name",
        phone: "Please enter Recipient Phone number",
        goodsNames: "Please enter good names",
        qty: "Please enter qty",
        price: "Please enter price",
    };
    function getoldValue() {
        let order = localStorage.getItem("order");
        if (order) {
            let orderObj = JSON.parse(order);
            for (const key in orderObj) {
                if (orderObj.hasOwnProperty(key)) {
                    if (key === "contact_id") {
                        $(`select[name="${key}"]`).val(orderObj[key]);
                    } else {
                        $(`input[name="${key}"]`).val(orderObj[key]);
                    }
                }
            }
        }
    }
    $(document).ready(function () {
            getoldValue();
            $('input[type="text"]').keyup(function (e) {
                const { name, value } = e.target;
                //    console.log(name);
                let order = localStorage.getItem("order");

                if (!order) {
                    let orderItem = {
                        codes: "",
                        contact_id: "0",
                        name: "",
                        phone: "",
                        goodsNames: "",
                        qty: "",
                        price: "",
                    };
                    orderItem = { ...orderItem, [name]: value };
                    localStorage.setItem("order", JSON.stringify(orderItem));
                } else {
                    let orderItem = JSON.parse(order);
                    orderItem = { ...orderItem, [name]: value };

                    localStorage.setItem("order", JSON.stringify(orderItem));
                }
            });
            $('input[type="number"]').keyup(function (e) {
                const { name, value } = e.target;
                //    console.log(name);
                let order = localStorage.getItem("order");

                if (!order) {
                    let orderItem = {
                        codes: "",
                        contact_id: "",
                        name: "hel",
                        phone: "",
                        goodsNames: "",
                        qty: "",
                        price: "",
                    };
                    orderItem = { ...orderItem, [name]: value };
                    localStorage.setItem("order", JSON.stringify(orderItem));
                } else {
                    let orderItem = JSON.parse(order);
                    orderItem = { ...orderItem, [name]: value };

                    localStorage.setItem("order", JSON.stringify(orderItem));
                }
            });
            $("select").change(function (e) {
            const { name, value } = e.target;
            let order = localStorage.getItem("order");

            if (!order) {
                let orderItem = {
                    codes: "",
                    contact_id: "",
                    name: "hel",
                    phone: "",
                    goodsNames: "",
                    qty: "",
                    price: "",
                };
                orderItem = { ...orderItem, [name]: value };
                localStorage.setItem("order", JSON.stringify(orderItem));
            } else {
                let orderItem = JSON.parse(order);
                orderItem = { ...orderItem, [name]: value };

                localStorage.setItem("order", JSON.stringify(orderItem));
            } 
        });

        $("#handleSubmit").submit(function (e) {
            
            // action="{{ route('user.order.store') }}" method="post"
            let hasError=checkError();
            //console.log(checkError());

            var formdata = $(this).serialize();
        // console.log(form);

            if(!hasError){
                console.log('error');
            }else{
                $.ajax({
                        url: "{{ route('user.order.store') }}",
                        method: "post",
                        data: formdata,
                        success: function (response) {
                        if(response.status == 200){
                            localStorage.removeItem('order');
                            window.location.href='/user/order/list'
                        }
                        },
                        error: function (err) {
                            console.log(err);
                        },
                        
                    });
                  
            }
              e.preventDefault();
            
        
        
            
        });
    });

    function checkError(){
        $(".required").each(function (i, el) {
            const { name, value, type } = el;
            if (value == "") {
                showError(errors[name]);
                return false;
            } else {
               // console.log('helo');
                if (value == 0) {
                    showError(errors[name]);
                    return false;
                }
            }
        });

        return false;
    }

   


    function showError(text) {
        Swal.fire({
            text: `${text}`,
            showConfirmButton: false,
            timer: 2000,
            showClass: {
                popup: "slow-animation",
            },
            hideClass: {
                popup: "slow-animation-2",
            },
        });
    }
</script>
@endsection
