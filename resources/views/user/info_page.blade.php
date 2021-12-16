@extends('FrontEnd_Template') @section('Manicontent')

<div class="titlebar">
    <div class="icon"><a href="{{ route('user.home')}}" style="color:#333;font-size: 1.5rem;"><i class="fas fa-chevron-left"></i></a></div>
    <div class="title">
        <h4>Me</h4>
    </div>
</div>
<div class="">
    <div class="user_info_div">
        <div class="avatar" style="
                background-image: url('https://cdn1.vectorstock.com/i/1000x1000/31/95/user-sign-icon-person-symbol-human-avatar-vector-12693195.jpg');
            "></div>
        <div class="user_info_content">
            <h3>{{Auth::check() ? Auth::user()->name :'unknown'}}</h3>
            <span>email:{{Auth::check() ? Auth::user()->email :'unknown'}}</span>
        </div>
    </div>
    <div>
        <ul class="list-group list-group-flush">
            <a style="text-decoration: none" href="{{ route('user.address.list') }}">
                <li class="list-group-item">
                    <div class="d-flex justify-content-between py-2">
                        <span>
                            <i class="fas fa-map-marker-alt"></i>
                            Address Management
                        </span>
                        <div class="icon">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                </li>
            </a>
            <a>
                <li class="list-group-item">
                    <div class="d-flex justify-content-between py-2">
                        <span>
                            <i class="fas fa-headset"></i>
                            Contact Customer Service
                        </span>
                        <div class="icon">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                </li>
            </a>
            <a>
                <li class="list-group-item">
                    <div class="d-flex justify-content-between py-2">
                        <span>
                            <i class="fas fa-bars"></i>
                            My Order
                        </span>
                        <div class="icon">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                </li>
            </a>
        </ul>
    </div>
    <div class="mt-3">
        <ul class="list-group list-group-flush">
            <a>
                <li class="list-group-item">
                    <div class="d-flex justify-content-between py-2">
                        <span>
                            <i class="fas fa-headset"></i>
                            Language
                        </span>
                        <div class="icon">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                </li>
            </a>
            <a href="route('logout')" style="text-decoration: none" onclick="event.preventDefault();document.getElementById('logoutform').closest('form').submit();">
                <li class="list-group-item">
                    <div class="d-flex justify-content-between py-2">
                        <span>
                            <i class="fas fa-cog"></i>
                            Logout
                        </span>
                        <div class="icon">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                </li>
                <form method="POST" id="logoutform" class="d-inline" action="{{ route('logout') }}">
                    @csrf
                </form>
            </a>
        </ul>
    </div>
</div>

@endsection

