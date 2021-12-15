@extends('Backend_Template') @section('mainContent')
<div class="col-10 mx-auto">
    <h1 class="mt-4">Orders</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
        <li class="breadcrumb-item "><a href="index.html">Order</a></li>
        <li class="breadcrumb-item active">OrderNew</li>
    </ol>
    <form class="px-2 mt-5" id="handleSubmit" autocomplete="off">
        @csrf

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
                <select id="sender" class="form-select required senderChange" aria-label="Default select example " name="sender">
                    <option value="0" selected>Please choose Sender Name</option>
                    @foreach($customers as $k=>$customer)
                    <option value="{{$customer->id}}">
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
                <input type="text" class="form-control-plaintext required countQty" id="codes" name="codes" placeholder="Please enter china logistic number" />
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
                <input type="text" class="form-control-plaintext required" id="name" name="name" placeholder="plases enter Recipient Name" />
            </div>
        </div>
        <hr />

        <div class="mb-3 row">
            <label for="phone" class="col-3 col-form-label">
                Recipient phone number
            </label>
            <div class="col-9 cus-input-fromControl">
                <input type="text" class="form-control-plaintext required" id="phone" name="phone" placeholder="please enter Recipient phone number (+95....)" />
            </div>
        </div>
        <hr />

        <div class="mb-3 row">
            <label for="Goodsqty" class="col-3 col-form-label">
                Numbers of Box
            </label>
            <div class="col-9 cus-input-fromControl">
                <input type="number" class="form-control-plaintext required" readonly id="Goodsqty" name="qty" placeholder="please enter good number" />
            </div>
        </div>
        <hr />
        <div class="mb-3 row">
            <label for="wieight" class="col-3 col-form-label"> Total Weight </label>
            <div class="col-9 cus-input-fromControl">
                <input type="number" class="form-control-plaintext required" id="weight" name="weight" placeholder="please enter good total wieight" />
                <h6>Kg</h6>
            </div>
        </div>
        <hr />
        <div class="mb-3 row">
            <label for="goodNames" class="col-3 col-form-label"> Goods Name </label>
            <div class="col-9 cus-input-fromControl">
                <input type="text" class="form-control-plaintext" id="goodNames" name="goodsNames" placeholder="please enter good names" />
            </div>
        </div>
        <hr />
        <div class="mb-3 row">
            <label for="price" class="col-3 col-form-label">
                Prices of Goods
            </label>
            <div class="col-9 cus-input-fromControl">
                <input type="text" class="form-control-plaintext  required" id="price" name="price" placeholder="please enter total price of Goods" />
            </div>
        </div>
        <input type="submit" value="Order Now" class="btn btn-primary form-control" />
    </form>
</div>
@endsection
@section('script')
<script>
    const errors = {
        sender: "Please Select Sender name!",
        codes: "Please enter china logistic number",
        contact_id: "Please Choose Recipient Address",
        name: "Please enter Recipient Name",
        phone: "Please enter Recipient Phone number",
        weight: "Please enter Total Good Wieight",
        goodsNames: "Please enter good names",
        price: "Please enter price",
    };
    getoldValue();
    $('.senderChange').change(function(e) {
        let id = e.target.value;
        console.log(id);


        getAddress(id);



    })

    function getAddress(id) {
        let order = localStorage.getItem('adminOrder');
        let orderObj={contact_id:''};
        
            if(order){
                 orderObj = JSON.parse(order);

            }else{
                orderObj.contact_id=0;
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

    $('input').keyup(function(e) {
        const {
            name,
            value
        } = e.target;
        // console.log(name, value);
        let adminOrder = {
            sender: '',
            codes: "",
            contact_id: '',
            name: "",
            phone: "",
            qty: "",
            weight: "",
            goodsNames: "",
            price: "",
        };

        let order = localStorage.getItem('adminOrder');

        if (!order) {
            adminOrder = {
                ...adminOrder,
                [name]: value
            };
        } else {
            adminOrder = JSON.parse(order);
            adminOrder = {
                ...adminOrder,
                [name]: value,
            };

        }

        localStorage.setItem('adminOrder', JSON.stringify(adminOrder));

    });

    $("select").change(function(e) {
        const {
            name,
            value
        } = e.target;
         console.log(name, value);

        let adminOrder = {
            sender: '',
            codes: "",
            contact_id: '',
            name: "",
            phone: "",
            qty: "",
            weight: "",
            goodsNames: "",
            price: "",
        };


        let order = localStorage.getItem("adminOrder");
        if (!order) {
            adminOrder = {
                ...adminOrder,
                [name]: value
            };
        } else {
            adminOrder = JSON.parse(order);
            adminOrder = {
                ...adminOrder,
                [name]: value,
            };

        }

        localStorage.setItem('adminOrder', JSON.stringify(adminOrder));
    });

    $('#addressAjax').on('change', 'select', function(e) {
        const {
            name,
            value
        } = e.target;

        console.log(name, value);
        let order = localStorage.getItem("adminOrder");

        adminOrder = JSON.parse(order);
        adminOrder = {
            ...adminOrder,
            [name]: value,
        }
        localStorage.setItem('adminOrder', JSON.stringify(adminOrder));

    })

    //auto qty
    $(".countQty").keyup(function(e) {
        var {
            value
        } = e.target;
        let data = value.split(",");

        let count = data.length;
        if (data[count - 1] == "") {
            count = data.length - 1;
        } else {
            count = count;
        }

        $("#Goodsqty").val(count);

        console.log(count);

        let order = localStorage.getItem("adminOrder");

        if (!order) {
            let adminOrder = {
                sender: '',
                codes: value,
                contact_id: '',
                name: "",
                phone: "",
                qty: count,
                weight: "",
                goodsNames: "",
                price: "",
            };

            localStorage.setItem("adminOrder", JSON.stringify(orderItem));
        } else {
            let orderItem = JSON.parse(order);
            orderItem.codes = value;
            orderItem.qty = count;
            localStorage.setItem("adminOrder", JSON.stringify(orderItem));
        }

        // let order = localStorage.getItem("order");

        // let obj = JSON.parse(order);
        // obj.qty = count;
        // localStorage.setItem("order", JSON.stringify(obj));
    });

    // formsubmit
    $("#handleSubmit").submit(function(e) {
        e.preventDefault();
        // console.log('helo');
        // action="{{ route('user.order.store') }}" method="post"
        let hasError = checkError();
        // //console.log(checkError());

        var formdata = $(this).serialize();
        // console.log(form);



        if (hasError == 1) {
            console.log("error");
        } else {
            $.ajax({
                url: "{{ route('user.order.store') }}",
                method: "post",
                data: formdata,
                success: function(response) {
                    //console.log(response);
                    if (response.status == 200) {
                        localStorage.removeItem("adminOrder");
                        window.location.href = "/admin/orders";
                    }
                },
                error: function(err) {
                    console.log(err);
                },
            });
        }

    });

    function checkError() {
        let error = 0;
        $(".required").each(function(i, el) {
            const {
                name,
                value,
                type
            } = el;

            console.log(name, value);
            if (value == "") {
                showError(errors[name]);
                error = 1;

            } else if ((value == 0)) {
                showError(errors[name]);
                error = 1;
            }



        });

        return error;

        // return false;
    }

    function showError(text) {
        swal.fire({
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

    function getoldValue() {
        let order = localStorage.getItem("adminOrder");
        if (order) {
            let orderObj = JSON.parse(order);
            for (const key in orderObj) {
                if (orderObj.hasOwnProperty(key)) {
                    if (key === "sender") {
                        $(`select[name="${key}"]`).val(orderObj[key]);

                        getAddress(orderObj[key]);

                    } else {
                        $(`input[name="${key}"]`).val(orderObj[key]);
                    }
                }
            }
        }
    }
</script>
@endsection