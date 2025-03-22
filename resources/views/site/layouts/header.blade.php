  <body>
    <div class="sidebar" id="sidebar">
      <div class="sidebar-header">
        <button class="close-btn" id="closeSidebar">&times;</button>
      </div>
      <ul class="sidebar-menu">
        @if (Auth::check())
        <li   > <span class="user-side"> مرحبا بك يا {{ Auth::guard()->user()->name }}</span></li>
        @endif  
        <li><a href="{{ url('/') }}">الرئيسية</a></li>
        @if (Auth::check())
        <li ><a   href="{{ route('mainPageSetting.userr',Auth::guard()->user()->name) }}">حسابي</a></li>
        <li ><a   href="{{ route('pageme.user',Auth::guard()->user()->name) }}">مواقعي</a></li>
        <li ><a    href="{{ url('user/mysubscribe')}}">باقتي</a></li>
        <li ><a   href="{{ route('logoutu') }}"    >تسجيل خروج</a></li>     
        @else
        <li ><a href="{{ url('/package/all') }}">اشتراك </a></li>
        <li ><a href="{{ route('loginu') }}">تسجيل دخول</a></li>         
                      @endif

        {{-- <li>

          <a href="#" class="has-submenu">الخدمات <i class="fas fa-chevron-down toggle-submenu"></i></a>
          <ul class="submenu">
            <li><a href="/service1">خدمة 1</a></li>
            <li><a href="/service2">خدمة 2</a></li>
          </ul>
        </li> --}}
      
      </ul>
    </div>
    
    <!-- قائمة الأعلى -->
    <nav class="navbar nav-top navbar-expand-lg navbar-light bg-style">
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
                    <a class="dropdown-item" href="{{ url('user/mysubscribe')}}">باقتي</a>
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
  
