<x-guest-layout>
    <div class="wrapper">
        <h5>Registration</h5>
        <div class="cus-container">
            <div class="logo-img"></div>
            <h3>Shipper </h3>

            <span class="sub-title">Welcome to Shpper Parcel</span>
            <form method="POST" action="{{ route('login') }}" class="form-div">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email </label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password </label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <input type="submit" class="btn btn-primary form-control" value="login" />

            </form>
            <span class="sub-title2">
                Needed an Account? <a href="{{route('register')}}">Sign Up</a>
            </span>

        </div>
    </div>
    </div>

    <x-slot name="script">

        <script>
            function loginAcc() {

                return false;
            }
        </script>

    </x-slot>

</x-guest-layout>