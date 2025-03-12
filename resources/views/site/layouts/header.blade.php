  <body>

    <!-- قائمة الأعلى -->
    <nav class="navbar navbar-expand-lg navbar-light bg-style">
      <div class="container">
     
        <a  class="navbar-brand"  href="{{ url('/') }}"><img src="{{ url('/public/upload/logo_waslat.png') }}" width="50px" height="50px" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
  
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            @if (Auth::check())
            <li  class="nav-item dropdown " >
                <a  class="nav-link dropdown-toggle nav-link-pad" href="#" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span> مرحبا بك يا {{ Auth::guard()->user()->name }}</span></a>
                <div class="dropdown-menu" aria-labelledby="accountDropdown">
                    <a class="dropdown-item" href="{{ route('mainPageSetting.userr',Auth::guard()->user()->name) }}">حسابي</a>
                    <a class="dropdown-item" href="{{ route('pageme.user',Auth::guard()->user()->name) }}">مواقعي</a>
                    <a class="dropdown-item" href="{{ route('logoutu') }}"    >تسجيل خروج</a>
            
                  </div>
            </li>
          
            @else
            <li class="nav-item  ">
                <a class="nav-link  nav-link-pad" href="{{ url('/package/all') }}">اشتراك </a>
            </li>
               <li class="nav-item">
                <a class="nav-link  nav-link-pad" href="{{ route('loginu') }}">تسجيل دخول</a>
              </li>

              
              {{-- <li class="nav-item">
                <a class="nav-link nav-link-pad" href="/auth/google">
                  التسجيل عن طريق البريد الإلكتروني
                </a>
              </li> --}}
                          @endif
         
                {{-- start lang--}}
             
                  
             
          
          
           {{-- end lang--}}


          </ul>
        </div>
      </div>
    </nav>
  
