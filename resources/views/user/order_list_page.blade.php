@extends('FrontEnd_Template') @section('Manicontent')
<ul class="nav nav-pills mb-3 my-cus-tab"  id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pills-home-tab" data-ddid="1" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
            {{__('Pending to WareHouse')}}
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-profile-tab" data-ddid="2" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
            {{__('WareHouse')}}
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-contact-tab" data-ddid="3" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
            {{__('In Transist')}}
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-contact-tab" data-ddid="4" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
            {{__('Arrived Myanmar Warehouse')}}
        </button>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active m-2"  id="pills-home" data-ddid=1 role="tabpanel" aria-labelledby="pills-home-tab">
        {{-- card start here --}}
        <div class="search-Field">
            <h5>Track Your Parcel</h5>
            <span>Enter parcel number to start tracking</span>
            <div class="input-group mb-3">
                <input type="text" class="form-control searchOrder-input" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" />
                <button class="btn input-group-text" id="inputGroup-sizing-sm">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        <div class="Loading">Loading...</div>
        <!-- end here -->
        <div class="resultCard"></div>
    </div>
    <div class="tab-pane fade" id="pills-profile" data-ddid=2  role="tabpanel" aria-labelledby="pills-profile-tab">
        {{-- card start here --}}
        <div class="search-Field">
            <h5>Track Your Parcel</h5>
            <span>Enter parcel number to start tracking</span>
            <div class="input-group mb-3">
                <input type="text" class="form-control searchOrder-input" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" />
                <button class="btn input-group-text" id="inputGroup-sizing-sm">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        <div class="Loading">Loading...</div>
        <!-- end here -->
        <div class="resultCard"></div>
    </div>
    <div class="tab-pane fade" id="pills-contact" data-ddid=3  role="tabpanel" aria-labelledby="pills-contact-tab">
        {{-- card start here --}}
        <div class="search-Field">
            <h5>Track Your Parcel</h5>
            <span>Enter parcel number to start tracking</span>
            <div class="input-group mb-3">
                <input type="text" class="form-control searchOrder-input" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" />
                <button class="btn input-group-text" id="inputGroup-sizing-sm">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        <div class="Loading">Loading...</div>
        <!-- end here -->
        <div class="resultCard"></div>
    </div>
     <div class="tab-pane fade" id="pills-contact" data-ddid=4  role="tabpanel" aria-labelledby="pills-contact-tab">
        {{-- card start here --}}
        <div class="search-Field">
            <h5>Track Your Parcel</h5>
            <span>Enter parcel number to start tracking</span>
            <div class="input-group mb-3">
                <input type="text" class="form-control searchOrder-input" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" />
                <button class="btn input-group-text" id="inputGroup-sizing-sm">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        <div class="Loading">Loading...</div>
        <!-- end here -->
        <div class="resultCard"></div>
    </div>
</div>
@endsection @section('script')

<script>
    let colors = {
        1: "#ff0000",
        2: "#2196f3",
        3: "#5417c1",
        4: "#03ad0a",
    };
    $('.nav-link').click(function(){
       $('.searchOrder-input').val('');
         let data=$(this).data('ddid');
        getData(data);
    })
    getData();
    function getData(id=1){
       
         let html='';
        $.ajax({
            url:"/get/orders/"+id,
            type:'get',
            success:function(res){
                if(res.data.length >0){
                   
                    $.each(res.data, function(i, v) {
                        console.log(v);
                        html += `<div class="my-card card m-3 border">
                                <!-- <div class="order-section"> -->
                                <!-- <div class="packagelogo">
                                    <img src="https://www.pngitem.com/pimgs/m/557-5570897_box-free-vector-icon-designed-by-pixel-buddha.png" alt="package" />
                                </div> -->
                                <div class="packageinfo">
                                    <div class="
                                            d-flex
                                            align-items-center
                                            justify-content-between
                                        ">
                                        <h6>#${v.order_code}</h6>
                                        <span style="align-self: flex-start" class="badge bg-danger">${
                                            v.code
                                        }</span
                                        >
                                    </div>
                                     <div style="display: inline-flex">
                                        <span class="to">Name:</span
                                        ><span
                                            class="address align-self-center"
                                            >${v.recipient_name}</span
                                        >
                                    </div>
                                    <div style="display: inline-flex">
                                        <span class="to">To:</span
                                        ><span
                                            class="address align-self-center"
                                            >${v.contact.full_address}</span
                                        >
                                    </div>



                                    <div>
                                        <span
                                            class="address status"
                                            style="color:${colors[v.status.id]};border-color:${colors[v.status.id]};"
                                        >
                                            ${v.status.name}
                                        </span>
                                    </div>
                                </div>

                                <!-- </div> -->
                                <div class="options">
                                    <button
                                        class="form-control order-detail"
                                        data-id="${v.id}"
                                    >
                                        View More
                                    </button>
                                </div>
                            </div>`;
                    });
                }
                console.log(html);
                $('.resultCard').html(html);
            },
            error:function(err){
                console.log(err)
            }
        })
    }
    
    $(".order-detail").click(function() {
        let id = $(this).data("id");
        gotoDetail(id);
        // let id = $(this).data("id");
        // let url = "{{route('user.order.detail',':id')}}";
        // url = url.replace(":id", id);
        // window.location.href = url;
    });

    $(".resultCard").on("click", ".order-detail", function() {
        // alert("helo");
        let id = $(this).data("id");
        gotoDetail(id);
    });

    function gotoDetail(id) {
        let url = "{{route('user.order.detail',':id')}}";
        url = url.replace(":id", id);
        window.location.href = url;
    }

    $(".searchOrder-input").keyup(function(e) {
        let {
            value
        } = e.target;
        var currentRequest = null;
        let html = "";
        let status=$('.active.tab-pane').data('ddid');
        // console.log(status);

        // Do the ajax stuff
        currentRequest = jQuery.ajax({
            type: "POST",
            data: {
                keyword: value,status:status
            },
            url: "{{route('order.search')}}",
            beforeSend: function() {
                $(".Loading").css("visibility", "visible");
                if (currentRequest != null) {
                    currentRequest.abort();
                }
            },
            success: function(data) {
                $(".Loading").css("visibility", "hidden");
                if (data.status != 200) {
                    html += "<h5 class='text-center'>No Data found!</h5>";
                } else {
                    // console.log(data);
                    // const {} = data;

                    $.each(data.data, function(i, v) {
                        console.log(v);
                        html += `<div class="my-card card m-3 border">
                                <!-- <div class="order-section"> -->
                                <!-- <div class="packagelogo">
                                    <img src="https://www.pngitem.com/pimgs/m/557-5570897_box-free-vector-icon-designed-by-pixel-buddha.png" alt="package" />
                                </div> -->
                                <div class="packageinfo">
                                    <div class="
                                            d-flex
                                            align-items-center
                                            justify-content-between
                                        ">
                                        <h6>#${v.order_code}</h6>
                                        <span style="align-self: flex-start" class="badge bg-danger">${
                                            v.code
                                        }</span
                                        >
                                    </div>
                                     <div style="display: inline-flex">
                                        <span class="to">Name:</span
                                        ><span
                                            class="address align-self-center"
                                            >${v.recipient_name}</span
                                        >
                                    </div>
                                    <div style="display: inline-flex">
                                        <span class="to">To:</span
                                        ><span
                                            class="address align-self-center"
                                            >${v.contact.full_address}</span
                                        >
                                    </div>



                                    <div>
                                        <span
                                            class="address status"
                                            style="color:${colors[v.status.id]};border-color:${colors[v.status.id]};"
                                        >
                                            ${v.status.name}
                                        </span>
                                    </div>
                                </div>

                                <!-- </div> -->
                                <div class="options">
                                    <button
                                        class="form-control order-detail"
                                        data-id="${v.id}"
                                    >
                                        View More
                                    </button>
                                </div>
                            </div>`;
                    });
                }
                $(".resultCard").html(html);
            },
            error: function(e) {
                console.log(e);
            },
        });
        // end here
    });
</script>
@endsection