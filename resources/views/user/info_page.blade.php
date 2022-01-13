@extends('FrontEnd_Template') @section('Manicontent')

<div class="titlebar">
    <div class="icon"><a href="{{ route('user.home')}}" style="color:#333;font-size: 1.5rem;"><i class="fas fa-chevron-left"></i></a></div>
    <div class="title">
        <h4>{{__('Me')}}</h4>
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
                            {{__('Address Management')}}
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
                           {{__('Contact Customer Service')}}
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
                            {{__('My Orders')}}
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
            <a href="#exampleModal" style="text-decoration:none" data-bs-toggle="modal">
                <li class="list-group-item">
                    <div class="d-flex justify-content-between py-2">
                        <span>
                            <i class="fas fa-headset"></i>
                            {{__('Language')}}
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
                            {{__('Logout')}}
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

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Language:{{ Config::get('languages')[App::getLocale()] }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <ul class="list-group list-group-flush">
          
          @foreach (Config::get('languages') as $lang => $language)
        @if ($lang != App::getLocale())
        <li class="list-group-item">
                <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}"> {{$language}}</a>
                </li>
        @endif
    @endforeach
        </ul>
      </div>
      
    </div>
  </div>
</div>

@endsection

