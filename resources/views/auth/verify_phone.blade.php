<x-guest-layout>
    <div class="wrapper">
        <h5>Verification</h5>
        <div class="cus-container">
            <div class="my-3">
                <div class="phone-img">
                    <div class="v-success"></div>
                </div>

            </div>
            <div id="getCode_div">
                <h5>Enter your phone number</h4>
                    <span class="sub-title-phone">We will send a code(SMS) to your phone number</span>
                    <div class="form-div mt-3">

                        <div class="mb-3">

                            <input type="phone" class="form-control" id="phone" name="phone" placeholder="+9590000000">

                        </div>

                        <div id="recaptcha-container"></div>



                        <a href="#" onclick="return phoneSendAuth();" class="btn btn-primary form-control">Send
                            Code!</a>

                    </div>
            </div>

            <div id="verify_div" class="d-none">
                <h5>Enter Code Number</h4>
                    <span class="sub-title-phone">Please check your phone and verify account!</span>
                    <div class="form-div mt-3">

                        <div class="code-div">

                            <input class="form-control code" id="verificationCode" type="text">
                        </div>


                        <a href="#" onclick="return codeverify();" class="btn btn-primary form-control">Verify
                            Code!</a>

                    </div>
            </div>


        </div>
    </div>
    </div>

    <x-slot name="script">


        <script type="text/javascript">
            window.onload = function() {
                render();

                // localStorage.removeItem('acc');
            };


            function render() {
                window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
                recaptchaVerifier.render();
            }


            function phoneSendAuth() {
                // console.log('helo');
                var number = $("#phone").val();
                console.log(number);

                let acc = localStorage.getItem('acc');
                accObj = JSON.parse(acc);
                accObj.phone = number;

                localStorage.setItem('acc', JSON.stringify(accObj));


                firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function(
                    confirmationResult) {

                    window.confirmationResult = confirmationResult;
                    coderesult = confirmationResult;
                    console.log(coderesult);

                    $('#getCode_div').addClass('d-none');
                    $('#verify_div').removeClass('d-none');



                }).catch(function(error) {
                    $("#error").text(error.message);
                    $("#error").show();
                });

                return true;

            }

            function codeverify() {


                var code = $("#verificationCode").val();

                coderesult.confirm(code).then(function(result) {
                    var user = result.user;
                    console.log(user);



                    if (user) {
                        // alert('heo');

                        let account = localStorage.getItem('acc');
                        $.ajax({
                            url: "{{route('register')}}",
                            type: 'post',
                            data: JSON.parse(account),
                            success: function(res) {
                                $('.v-success').addClass('show');
                                // console.log(res);
                                new swal({
                                    title: "Good job!",
                                    text: "Verification Completed!",
                                    icon: "success",
                                    button: "Continue",
                                }).then((value) => {
                                    window.location.href = '/user/order'
                                })



                            },
                            error: function(err) {
                                console.log(err);
                            }
                        })
                    }





                    //    swal("Click on either the button or outside the modal.")
                    //    .then((value) => {
                    //    swal(`The returned value is: ${value}`);
                    //    });



                }).catch(function(error) {
                    if (error) {
                        swal({
                            title: "Verification Failed!",
                            text: "Code is invalid!Try again!",
                            icon: "error",
                            button: "Try Again!",
                        });

                        $('#getCode_div').removeClass('d-none');
                        $('#verify_div').addClass('d-none');

                    }

                });
                return false;
            }
        </script>
    </x-slot>

</x-guest-layout>