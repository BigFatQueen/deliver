<x-guest-layout>
    <div class="wrapper">
        <h5>Registration</h5>
        <div class="cus-container">
            <div class="logo-img"></div>
            <h3>Shipper </h3>
            <span class="sub-title">Create New Account</span>
            <div class="form-div">

                <div class="mb-3">
                    <label for="username" class="form-label">Username </label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email </label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password </label>
                    <input type="password" class="form-control" id="password" name="email">
                </div>

                <a href="{{route('auth.phone.verify')}}" onclick="return saveAccount();" class="btn btn-primary form-control">Continue</a>

            </div>
            <span class="sub-title2">
                Already have an Account? <a href="{{route('login')}}">Sign In</a>
            </span>

        </div>
    </div>
    </div>

    <x-slot name="script">


        <script type="text/javascript">
            function saveAccount() {

                let name = $('#username').val();
                let email = $('#email').val();
                let password = $('#password').val();
                let acc = localStorage.getItem('acc');
                let newacc = {
                    name: name,
                    email: email,
                    ps: password,
                    phone: '',
                }
                if (!acc) {
                    localStorage.setItem('acc', JSON.stringify(newacc));

                }
                console.log(newacc);

                return true;
            }

            window.onload = function() {
                // render();
                localStorage.removeItem('acc');
            };

            // function render() {
            //     window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
            //     recaptchaVerifier.render();
            // }


            // function phoneSendAuth() {
            //     // console.log('helo');
            //     var number = $("#phone").val();
            //     console.log(number);
            //     firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function(
            //         confirmationResult) {

            //         window.confirmationResult = confirmationResult;
            //         coderesult = confirmationResult;
            //         console.log(coderesult);

            //         if (coderesult != undefined) {
            //             (async() => {
            //                 //your function
            //                 // start here 
            //                 const {
            //                     value: code
            //                 } = await Swal.fire({
            //                     title: 'Please Enter Verification Code',
            //                     'text': 'Verify Code has been sent to registered phon!',
            //                     input: 'text',
            //                     inputLabel: 'Your Verify Code',

            //                 })


            //                 if (code) {
            //                     coderesult.confirm(code).then(function(result) {
            //                         var user = result.user;
            //                         console.log(user);

            //                         alert('success');

            //                         // $("#successRegsiter").text("you are register Successfully.");
            //                         // $("#successRegsiter").show();

            //                     }).catch(function(error) {
            //                         alert('error');
            //                         // $("#error").text(error.message);
            //                         // $("#error").show();

            //                     });
            //                 }
            //                 // end here 
            //             })()




            //         }

            //         // $("#sentSuccess").text("Message Sent Successfully.");
            //         // $("#sentSuccess").show();

            //     }).catch(function(error) {
            //         $("#error").text(error.message);
            //         $("#error").show();
            //     });

            //     return false;

            // }

            // function codeverify() {
            //     alert('e');
            //     // var code = $("#verificationCode").val();

            //     // coderesult.confirm(code).then(function(result) {
            //     //     var user = result.user;
            //     //     console.log(user);

            //     //     $("#successRegsiter").text("you are register Successfully.");
            //     //     $("#successRegsiter").show();

            //     // }).catch(function(error) {
            //     //     $("#error").text(error.message);
            //     //     $("#error").show();
            //     // });
            // }
        </script>
    </x-slot>

</x-guest-layout>